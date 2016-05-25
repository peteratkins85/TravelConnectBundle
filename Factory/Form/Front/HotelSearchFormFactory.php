<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 21/05/2016
 * Time: 17:37
 */

namespace Oni\TravelPortBundle\Factory\Form\Front;


use Oni\CoreBundle\Factory\CoreFactoryInterface;
use Oni\TravelPortBundle\Form\Front\HotelSearchForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HotelSearchFormFactory  {


	public function getService( ContainerInterface $serviceContainer ) {
		
		$countryService = $serviceContainer->get('oni_country_service');
		
		return new HotelSearchForm(
			$countryService
		);
		
	}
}