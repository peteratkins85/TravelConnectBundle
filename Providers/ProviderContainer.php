<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/01/2016
 * Time: 03:27
 */

namespace Oni\TravelPortBundle\Providers;


use Oni\TravelPortBundle\Exceptions\InvalidProviderRequestException;
use Oni\TravelPortBundle\ProviderSupport\HotelProviderInterface;
use Oni\TravelPortBundle\ProviderSupport\ProviderInterface;
use Oni\TravelPortBundle\TravelPortGlobals;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;

class ProviderContainer
{

    const PROVIDER_HOTEL_SEARCH = 1;

    /**
     * @var array
     */
    protected $hotelSearchResponses;

    /**
     * @var array
     */
    protected $providers;

    protected $providerContainerSession;
    
    public function __construct(ContainerInterface $container, Session $session)
    {
        $this->providers = array();
        $this->container = $container;
        $this->session = $session;
        $this->setProviderContainerSession();
    }

    public function setProviderContainerSession(){

        if ($providerSession = $this->session->get(TravelPortGlobals::SESSION_PROVIDER_RESULT)){

            $this->providerContainerSession = $providerSession;

        }else{

            $this->providerContainerSession = $this->session->set(TravelPortGlobals::SESSION_PROVIDER_RESULT, array());

        }

    }

    public function updateProviderContainerSession($providerContainerArray){

        $this->session->set(TravelPortGlobals::SESSION_PROVIDER_RESULT, $providerContainerArray);

    }

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }



    public function processHotelSearchRequest($formData){

        foreach ($this->providers as $provider){

            if ($provider instanceof HotelProviderInterface){

                try {

                    $this->response[] = $provider->searchHotel( $formData );

                }catch (InvalidProviderRequestException $e) {

                    echo $e->getMessage(); exit;
                    //TODO log error

                }catch (\Exception $e){

                    echo $e->getMessage(); exit;

                }

            }

        }

        return $this->processResults($this->response, self::PROVIDER_HOTEL_SEARCH);



    }

    public function processResults($response, $requestType){

        switch($requestType){

            case self::PROVIDER_HOTEL_SEARCH:

                $uniqueSearchId = $this->getUniqueSearchId();
                $response['uniqueSearchId'] = $uniqueSearchId;

                $this->providerContainerSession[TravelPortGlobals::SESSION_HOTEL_SEARCH_RESULTS][$this->getUniqueSearchId()] = $response;
                $this->updateProviderContainerSession($this->providerContainerSession);
                return $response;

            default:
                break;

        }




    }

    protected function getUniqueSearchId(){

        return md5('searchId'.time());

    }

}