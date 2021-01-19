<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\CalendarService;
use App\Service\MailToNewMember;
use Google_Client;
use Google_Service;
use Google_Service_Calendar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ClientException;







class IndexController extends AbstractController
{
    private $params;
    private $client;
    public $em;

    public function __construct (Google_Client $client, ParameterBagInterface $params, SessionInterface $session )
    {
        $this->client = $client;
        $this->params = $params;
        $this->session = $session;
    }


    /**
     * @Route("/index", name="index")
     * @param Request $request
     */
    public function indexAction(Request $request){

        $client = new Client();
        $consumeyKey = $this->getParameter('app.discogs_consumer_key');
        $consumerSecret = $this->getParameter('app.discogs_consumer_secret');
        $baseDiscogsApi = 'https://www.discogs.com/';
        $imgRecSpec ='';
        $recArray = [];
        $responseContents = [];
        $videosArray = [];
        $coverImgCount=0;
        $guzzleException='';
        $discogsCredentials = 'key='.$consumeyKey.'&secret='.$consumerSecret;
        /* auth of type "https://api.discogs.com/database/search?q=Nirvana&key=foo123&secret=bar456" */

        // SI  ON RECOIT UNE REQUETE AJAX
        if ($request->isXmlHttpRequest()) {
            $coverImgCount = $request->query->get('count');
            dump($coverImgCount);die;
        }


            // PREMIERE RECHERCHE AFIN DE TROUVER LOBJET VOULU
        if($request->request->get('query-discogs')){
            $this->session->set('discogsQueryResult','');
            $queryString = $request->request->get('query-discogs');
            $res = $client->request('GET', 'https://api.discogs.com/database/search?q='.$queryString.'&'.$discogsCredentials);
            $responseContents = json_decode($res->getBody()->getContents(), true);
            $pagesOfDiscogsResponse = $responseContents['pagination']['pages'];
            $recResults = $responseContents['results'];
            $imgRecSpec = $responseContents['results'][0]['cover_image'];
            $this->session->set('discogsQueryResult',$responseContents);

/*            dump($responseContents);die;*/


            // SI ON A DU CONTENU ALORS ON VA LISTER LES RELEASE PAR TYPE DOBJET
            if($responseContents){
                if($responseContents['results'][0]['type'] == 'label') {
                    $client = new Client();
                    $resSpec = $client->request('GET', 'https://api.discogs.com/labels/'.$responseContents['results'][1]['id'].'/releases?'.$discogsCredentials);
                    $recArray = json_decode($resSpec->getBody()->getContents(),true);
                }
                elseif($responseContents['results'][0]['type'] == 'artist') {
                    $client = new Client();
                    $resSpec = $client->request('GET', 'https://api.discogs.com/artists/'.$responseContents['results'][1]['id'].'/releases?'.$discogsCredentials);
                    $recArray = json_decode($resSpec->getBody()->getContents(),true);
                }
                else {
                    $blop = 2;
                }

                // ICI ON VIENT CHERCHER LES VIDEOS UNES A UNES
                if(!empty($recArray)) {
                    $i=1;
                    foreach ($recArray['releases'] as $release)
                    {
                        $i++;
                        if($i==4){
                            break;
                        }
                        sleep(2);
                        $client = new Client();
                        try{
                            $resSpec = $client->request('GET', 'https://api.discogs.com/releases/'.$release['id'],
                                ['exceptions' => false]
                            );
                            $releaseInfos = json_decode($resSpec->getBody()->getContents(),true);
                        } catch (ClientException $exception) {
                            $guzzleException = $exception->getMessage();
                            break;
                        }
                        if (array_key_exists('videos',$releaseInfos)) {
                            foreach ($releaseInfos['videos'] as $video){
                                array_push($videosArray, $video['uri']);
                            }
                        }
                    }
                    dump($videosArray);die;

                }
            }
        }


        $discogsAuthUri = 'https://api.discogs.com/oauth/request_token';
        $apiEndPOint = 'https://api.discogs.com/database/search?q=Nirvana&'.$discogsCredentials;

/*        if($pagesOfDiscogsResponse) {
            $secondPageResponse = $client->request('GET', 'https://api.discogs.com/database/search?q='.$queryString.'&'.$discogsCredentials.'&page=2');
            $secondPagContent = json_decode($secondPageResponse->getBody()->getContents());
        }*/


        return $this->render('index.html.twig',[
            'img'=>$imgRecSpec,
            'responseContents'=>$responseContents,
            'videosArray'=>$videosArray,
            'guzzleException'=>$guzzleException
        ]);

    }


    /**
     * @Route("/ajaxImage", name="ajaxImage")
     * @param Request $request
     */
    public function ajaxImageAction(Request $request){

        $queryResults = $this->session->get('discogsQueryResult');
        return new JsonResponse($queryResults);

    }

    /**
     * @Route("/sign_up", name="sign_up")
     * @param Request $request
     * @param MailToNewMember $mailToNewMember
     * @param MailerInterface $mailerInterface
     * @param CalendarService $calendarService
     * @param ParameterBagInterface $params
     * @return Response
     */
    public function signUpAction(Request $request, MailToNewMember $mailToNewMember, MailerInterface $mailerInterface, CalendarService $calendarService)
    {
//        $mailToNewMember->sendMailToNewMember($mailerInterface);

        $em = $this->getDoctrine()->getManager();
        $newUser = new User();
        $userForm = $this->createForm(UserType::class, $newUser, [
            'action' => $this->generateUrl('sign_up'),
            'method' => 'POST',
        ] );

        $userForm->handleRequest($request);

        // On traite le formulaire et on vient enregister le nouvel utilisateur
        if ($userForm->isSubmitted() && $userForm->isValid()  ) {
            $userForm->getData();
            $newUser->setIsMailAddressVerified(false);
            $em->persist($newUser);
            $em->flush();
        }

/*        $finder = new Finder();
        $finder->in(__DIR__.'/../..');
        $credentialsFiles = $finder->files()->name('credentials.json');
        foreach($credentialsFiles as $credentialsFile) {
            $absoluteFilePathCredentials = $credentialsFile->getRealPath();
        }*/


        return $this->render('signup.html.twig', [
            'number' => 3,
            'userForm'=> $userForm->createView()
        ]);
    }

    /**
     * @Route("/google_redirect_for_calendar", name="google_redirect_for_calendar")
     * @param Request $request
     * @param CalendarService $calendarService
     */
    public function getGoogleCalendarRedirectInformationAction (Request $request, CalendarService $calendarService) {

        $request->getPathInfo();
        $this->session->set('auth_code',$request->query->get('code'));
        $google_code = $request->query->get('code');
        $dateTimeNow = new \DateTime();
        $dateTime3339 = $dateTimeNow->format("Y-m-d\TH:i:sP");

        // Set up the google client with the general info
        $client = new Google_Client();
        $client->setAuthConfig('credentials.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $client->setRedirectUri('http://127.0.0.1:8000/google_redirect_for_calendar');

        // if an access token has already been set in session
        if($this->session->get('access_token')) {

            $client->setAccessToken($this->session->get('access_token'));
            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                }
                else {
                    if ($request->query->get('code')){
                        $accessToken = $client->fetchAccessTokenWithAuthCode($google_code);
                        $client->setAccessToken($accessToken);
                        $this->session->set('access_token',$accessToken);
                    }
                }
                $service = new Google_Service_Calendar($client);
                $calendarId = 'primary';
                $optionsForListEvent = [
                    'timeMin' => $dateTime3339
                ];
                $results = $service->events->listEvents($calendarId, $optionsForListEvent);
            }
        }
        elseif ($request->query->get('code')) {
            $accessToken = $client->fetchAccessTokenWithAuthCode($google_code);
            $client->setAccessToken($accessToken);
            $this->session->set('access_token',$accessToken);
        }
        else {
            $authUrl = $client->createAuthUrl();
            return $this->redirect($authUrl);
        }

        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';
        $optionsForListEvent = [
            'timeMin' => $dateTime3339
        ];
        $results = $service->events->listEvents($calendarId, $optionsForListEvent);

        return $this->render('events.html.twig', [
            'events' => $results
        ]);;
    }



    /**
     * @Route("/resume", name="resume")
     */
    public function resume()
    {
        return;
    }

}
