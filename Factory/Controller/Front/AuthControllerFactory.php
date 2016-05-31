<?php

namespace Oni\TravelPortBundle\Factory\Controller\Front;


use Oni\CoreBundle\Factory\CoreAbstractFactory;
use Oni\TravelPortBundle\Controller\Front\AuthController;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthControllerFactory extends CoreAbstractFactory{

	function getService( ContainerInterface $serviceContainer ) {

		$this->setContainer($serviceContainer);
		$authController = new AuthController();
		$authController = $this->injectControllerDependencies($authController);

		return $authController;

	}

}