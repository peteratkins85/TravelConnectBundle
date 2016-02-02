<?php

namespace Oni\TravelConnectBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;


class TravelConnectTwigHelper extends \Twig_Extension {

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container){

        $this->container = $container;

    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
          'getTheme'             => new \Twig_SimpleFunction('get_travel_connect_theme', array($this, 'getTheme')),
          'getThemeAssetPath' => new \Twig_SimpleFunction('get_travel_connect_theme_asset_path', array($this, 'getThemeAssetPath')),
        );
    }

    /**
     * @param string $string
     * @return int
     */
    public function getTheme () {
        return $this->container->getParameter('oni_travel_connect.theme');
    }

    public function getThemeAssetPath(){

        $theme = $this->container->getParameter('oni_travel_connect.theme');

        $path = '/themes/travel-connect/'.$theme.'/';

        return $path;

    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'travel_connect_service';
    }

}