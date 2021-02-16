<?php

namespace ContainerD2cEjfu;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDiscogsServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\DiscogsService' shared autowired service.
     *
     * @return \App\Service\DiscogsService
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Service'.\DIRECTORY_SEPARATOR.'DiscogsService.php';

        return $container->privates['App\\Service\\DiscogsService'] = new \App\Service\DiscogsService(($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')));
    }
}
