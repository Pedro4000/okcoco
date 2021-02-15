<?php

namespace Container4xhEliz;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGoogleClientService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'Google_Client' shared service.
     *
     * @return \Google_Client
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'google'.\DIRECTORY_SEPARATOR.'apiclient'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Google'.\DIRECTORY_SEPARATOR.'Client.php';

        $container->privates['Google_Client'] = $instance = new \Google_Client();

        $instance->setDeveloperKey($container->getEnv('GOOGLE_API_KEY'));
        $instance->setClientId($container->getEnv('GOOGLE_CLIENT_ID'));
        $instance->setClientSecret($container->getEnv('GOOGLE_CLIENT_SECRET'));

        return $instance;
    }
}