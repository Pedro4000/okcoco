<?php

namespace ContainerGxkxXR7;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCache_WebpackEncoreService extends App_KernelProdContainer
{
    /*
     * Gets the private 'cache.webpack_encore' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['cache.webpack_encore'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('r6weaRjAHp', 0, $container->getParameter('container.build_id'), ($container->targetDir.''.'/pools'), ($container->privates['logger'] ?? ($container->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger())));
    }
}
