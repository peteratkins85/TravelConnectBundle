<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 28/05/2016
 * Time: 01:19
 */

namespace Oni\TravelPortBundle\Factory\Controller\Front;


use Oni\CoreBundle\Factory\CoreAbstractFactory;
use Oni\TravelPortBundle\Controller\Front\AccountController;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AccountControllerFactory extends CoreAbstractFactory{

	function getService( ContainerInterface $serviceContainer ) {

		$this->setContainer($serviceContainer);
		$accountController = new AccountController();
		$accountController = $this->injectControllerDependencies($accountController);

		return $accountController;

	}

}