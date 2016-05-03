<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/01/2016
 * Time: 03:27
 */

namespace Oni\TravelPortBundle\Providers;


use Oni\TravelPortBundle\ProviderSupport\ProviderInterface;

class TravelPortProviderContainer
{

    public function __construct()
    {
        $this->providers = array();
    }

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

}