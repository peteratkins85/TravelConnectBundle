<?php

namespace Oni\TravelPortBundle\Providers\Wts;

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
 * @author Peter Atkins <peter.atkins85@gmail.com>
 *
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
        $this->apiClient = $this->container->get('oni_travel_port_provider_client.wts');

    }

    public function searchHotel($search = array())
    {
        $stringRequest = '?action=hotel_search&username=thuraya&password=travel123&checkin_date=14/05/2016&checkout_date=22/05/2016&sel_currency=EUR&sel_country=68&sel_city=LONDON&chk_ratings=["3.0","4.0","5.0"]&sel_nationality=1&availableonly=1&number_of_rooms=2&roomDetails=[{"numberOfAdults":"1","numberOfChild":"0","ChildAge":"0"}]&gzip=no';
        $outputArray = [];
        parse_str($stringRequest, $outputArray);
        $results = $this->apiClient->searchHotel($outputArray);

        $results = $results;
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
          'oni_travel_port.wts.username',
          $providerConf['username']
        );
        $container->setParameter(
          'oni_travel_port.wts.password',
          $providerConf['password']
        );

        $clientId = 'oni_travel_port_provider_client.wts';

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