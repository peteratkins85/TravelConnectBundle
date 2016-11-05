<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 27/05/2016
 * Time: 08:18
 */

namespace Oni\TravelPortBundle\Services;


use Oni\CoreBundle\Service\CountryService;

class TravelPortService {

	/**
	 * @var \Oni\CoreBundle\Service\CountryService
	 */
	protected $countryService;


	/**
	 * TravelPortService constructor.
	 *
	 * @param \Oni\CoreBundle\Service\CountryService $countryService
	 */
	public function __construct(CountryService $countryService) {

		$this->countryService = $countryService;

	}

	


}