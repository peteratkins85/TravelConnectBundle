<?php

namespace Oni\TravelPortBundle\Providers;

use Oni\TravelPortBundle\ProviderSupport\ProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Oni\TravelPortBundle\ProviderSupport\HotelProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class WTSProvider
 *
 * http://www.wts-travel.com/
 *
 * @package Oni\TravelPortBundle\Providers
 *
 */
class WtsProvider implements HotelProviderInterface, ProviderInterface
{

    const PROVIDER_ID = 'wts.provider';

    /** @var  ContainerInterface */
    protected $container;
    /** @var  WtsApiClient  */
    protected $apiClient;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
        $this->apiClient = $this->container->get('oni_travel_connect_provider_client.wts');

    }

    public function searchHotel($search = array())
    {


    }

    /**
     *
     * Use by configuration class
     * set parameters
     *
     */
    public static function prepare(ContainerBuilder $container, $providerConf)
    {

        if (!isset($providerConf['username']) || !isset($providerConf['password'])) {

            throw new Exception(
              'Username and password must be set for WTS provider'
            );

        }

        $container->setParameter(
          'oni_travel_connect.wts.username',
          $providerConf['username']
        );
        $container->setParameter(
          'oni_travel_connect.wts.password',
          $providerConf['password']
        );

        $clientId = 'oni_travel_connect_provider_client.wts';

        //Check if service for API client exists
        if ($container->has($clientId)) {

            $args = array(
                'username' =>$providerConf['username'],
                'password' =>$providerConf['password']
            );
            $client = $container->findDefinition($clientId);
            $client->addArgument($args);

        }

    }

}