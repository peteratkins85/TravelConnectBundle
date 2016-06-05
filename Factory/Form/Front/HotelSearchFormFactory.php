<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 21/05/2016
 * Time: 17:37
 */

namespace Oni\TravelPortBundle\Factory\Form\Front;


use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Factory\CoreFactoryInterface;
use Oni\TravelPortBundle\Form\Front\HotelSearchForm;
use Oni\TravelPortBundle\TravelPortGlobals;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class HotelSearchFormFactory  {


	public function getService( ContainerInterface $serviceContainer ) {
		
		$countryService = $serviceContainer->get('oni_country_service');
		$availableCurrencies = $serviceContainer->getParameter(TravelPortGlobals::CURRENCY_PARAM_KEY);
		$request = $serviceContainer->get('request_stack')->getCurrentRequest();
		$formData = [
			'cities' => []
		];

		$routeName = $request->get('_route');

		if ($routeName == 'oni_travel_port_hotel_search'){

			if ($hotelForm = $request->get('hotel_search_form')){

				if ($hotelForm['country']) {
					$cities = $countryService->getCitiesByCountryId($hotelForm['country']);
					$formData['cities'] = $cities;
				}

			}

		}
		
		$form = new HotelSearchForm(
			$countryService,
			$availableCurrencies,
			$formData
		);

		return $form;
		
	}
}