<?php
namespace Oni\CoreBundle\EventListeners;

use Oni\CoreBundle\SessionKeys;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\LanguageValidator;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validation;

class ThemeListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'en', ContainerInterface $container)
    {
        $this->defaultLocale = $defaultLocale;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {

        //Add twig global variables
        $this->addTwigGlobals();

    }



    public function addTwigGlobals(){

        //Add avaialble language to twig template as a global variable
        $this->container->get('twig')->addGlobal('travel_connect_theme', $this->container->getParameter('oni_travel_connect.theme'));

    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}