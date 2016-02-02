<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/01/2016
 * Time: 03:40
 */

namespace Oni\TravelConnectBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TravelConnectCompilerPass implements CompilerPassInterface
{

    /**
     *
     * Let find all class tags with the oni_tavel_connect.provider tag
     * and add them to the Travel Connect provider container service
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('oni_travel_connect_provider_container')) {
            return;
        }

        $definition = $container->findDefinition(
          'oni_travel_connect_provider_container'
        );

        $taggedServices = $container->findTaggedServiceIds(
          'oni_tavel_connect.provider'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
              'addProvider',
              array(new Reference($id))
            );
        }

    }
}