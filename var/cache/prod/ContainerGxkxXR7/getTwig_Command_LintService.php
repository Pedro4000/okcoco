<?php

namespace ContainerGxkxXR7;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTwig_Command_LintService extends App_KernelProdContainer
{
    /*
     * Gets the private 'twig.command.lint' shared service.
     *
     * @return \Symfony\Bundle\TwigBundle\Command\LintCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        $container->privates['twig.command.lint'] = $instance = new \Symfony\Bundle\TwigBundle\Command\LintCommand(($container->services['twig'] ?? $container->load('getTwigService')));

        $instance->setName('lint:twig');

        return $instance;
    }
}
