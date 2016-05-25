<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 06/05/2016
 * Time: 23:39
 */

namespace Oni\TravelPortBundle\Factory\Service;


use Oni\CoreBundle\Factory\CoreAbstractFactory;
use Oni\TravelPortBundle\Services\UserService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserServiceFactory extends CoreAbstractFactory{

	public function getService(ContainerInterface $serviceContainer)
	{

		$encoderFactory = $serviceContainer->get('security.encoder_factory');
		$objectManager  = $serviceContainer->get('doctrine.orm.entity_manager');
		$class = 'Oni\\TravelPortBundle\\Entity\\User';

		$userService = new UserService(
			$encoderFactory,
			$objectManager,
			$class
		);

		return $userService;


	}

}