<?php

namespace Oni\TravelPortBundle\ProviderSupport;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface ProviderInterface{

    /**
     *
     * Prepares Bundle for provider usage
     *
     */
    public static function prepare(ContainerBuilder $container ,$config);

}