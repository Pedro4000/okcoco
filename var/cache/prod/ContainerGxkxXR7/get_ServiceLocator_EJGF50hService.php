<?php

namespace ContainerGxkxXR7;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_EJGF50hService extends App_KernelProdContainer
{
    /*
     * Gets the private '.service_locator.EJGF50h' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.EJGF50h'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'mailToNewMember' => ['privates', 'App\\Service\\MailToNewMember', 'getMailToNewMemberService', true],
            'mailerInterface' => ['privates', 'mailer.mailer', 'getMailer_MailerService', true],
        ], [
            'mailToNewMember' => 'App\\Service\\MailToNewMember',
            'mailerInterface' => '?',
        ]);
    }
}