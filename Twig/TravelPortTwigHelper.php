<?php

namespace Oni\TravelPortBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;


class TravelPortTwigHelper extends \Twig_Extension {

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
          'getTheme'             => new \Twig_SimpleFunction('get_travel_port_theme', array($this, 'getTheme')),
          'getThemeAssetPath' => new \Twig_SimpleFunction('get_travel_port_theme_asset_path', array($this, 'getThemeAssetPath')),
        );
    }

    /**
     * @param string $string
     * @return int
     */
    public function getTheme () {
        return $this->container->getParameter('oni_travel_port.theme');
    }

    public function getThemeAssetPath(){

        $theme = $this->container->getParameter('oni_travel_port.theme');

        $path = '/themes/travel-connect/'.$theme.'/';

        return $path;

    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'travel_port_service';
    }

}