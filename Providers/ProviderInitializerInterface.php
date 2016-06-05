<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 03/06/2016
 * Time: 14:18
 */

namespace Oni\TravelPortBundle\Providers;


interface ProviderInitializerInterface {

	public function addCurrencies();

	public function init($providerConf);

}