<?php

namespace Oni\TravelPortBundle\ProviderSupport;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface ProviderInterface  {


    public function __construct(ContainerInterface $container);

    /**
     * @return string
     */
    public function getProviderKey();



}