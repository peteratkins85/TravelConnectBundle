<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 04/06/2016
 * Time: 10:20
 */

namespace Oni\TravelPortBundle\ProviderSupport;


abstract class AbstractProvider implements ProviderInterface{

	public function getProviderKey() {

		$array = explode('\\',  get_class($this));
		$array = array_pop($array);
		$providerKey = preg_split('/(?=[A-Z])/', $array)[1];
		return strtolower($providerKey);

	}

}