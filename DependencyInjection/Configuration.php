<?php

namespace Oni\TravelConnectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{


  /**
   * {@inheritdoc}
   */
  public function getConfigTreeBuilder()
  {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('travel_connect');

        $rootNode
            //->append($this->getWTSProviderNode('wts'))
            ->append($this->getClassNode())

            ->children()
            ->scalarNode('theme')->cannotBeEmpty()->defaultValue('default')->end()
            ->scalarNode('travel_connect_url')->cannotBeEmpty()->defaultValue('tc')->end()
              ->arrayNode('providers')
              ->addDefaultsIfNotSet()
              ->canBeUnset()
                ->children()
                  ->arrayNode('wts')
                    ->children()
                      ->scalarNode('username')->cannotBeEmpty()->end()
                      ->scalarNode('password')->cannotBeEmpty()->end()
                    ->end()
                  ->end()
                ->end()
              ->end()
            ->end()
        ;

    return $treeBuilder;

  }

  public function getContainerExtension(){



  }

  /**
   * @param string $name
   */
  private function getWTSProviderNode($name)
  {
    $treeBuilder = new TreeBuilder();
    $node = $treeBuilder->root($name);

    $node
      ->children()
      ->scalarNode('username')->cannotBeEmpty()->defaultValue('none')->end()
      ->scalarNode('password')->defaultValue('none')->end()
      ->end()
    ;

    return $node;
  }

  private function getClassNode(){

    $treeBuilder = new TreeBuilder();
    $node = $treeBuilder->root('class');

    $node
      ->addDefaultsIfNotSet()
      ->children()
        ->scalarNode('wts_class')->cannotBeEmpty()->defaultValue('Oni\\TravelConnectBundle\\Providers\\WtsProvider')->end()
      ->end()
    ;

    return $node;
  }

}
