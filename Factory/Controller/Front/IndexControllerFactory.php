<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 28/05/2016
 * Time: 00:57
 */

namespace Oni\TravelPortBundle\Factory\Controller\Front;


use Oni\CoreBundle\Factory\CoreAbstractFactory;
use Oni\TravelPortBundle\Controller\Front\IndexController;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IndexControllerFactory extends CoreAbstractFactory{

	function getService( ContainerInterface $serviceContainer ) {

		$this->setContainer($serviceContainer);
		$indexController = new IndexController();
		$indexController = $this->injectControllerDependencies($indexController);

		return $indexController;

	}

}