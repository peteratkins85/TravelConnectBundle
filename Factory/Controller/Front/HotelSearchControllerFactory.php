<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 22/05/2016
 * Time: 00:57
 */

namespace Oni\TravelPortBundle\Factory\Controller\Front;


use Oni\CoreBundle\Factory\CoreAbstractFactory;
use Oni\TravelPortBundle\Controller\Front\HotelSearchController;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HotelSearchControllerFactory extends CoreAbstractFactory{

	public function getService(ContainerInterface $serviceContainer){

		$this->setContainer($serviceContainer);
		$hotelSearchForm = $serviceContainer->get('oni_travel_port_hotel_search_form');
		$providerContainer = $serviceContainer->get('oni_travel_port_provider_container');
		$session = $serviceContainer->get('session');

		$hotelSearchController = new HotelSearchController(
			$hotelSearchForm,
			$providerContainer,
			$session
		);

		$hotelSearchController = $this->injectControllerDependencies($hotelSearchController);

		return $hotelSearchController;

	}

}