<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/01/2016
 * Time: 03:27
 */

namespace Oni\TravelPortBundle\Providers;


use Oni\TravelPortBundle\Exceptions\InvalidProviderRequestException;
use Oni\TravelPortBundle\Providers\DataObjects\Hotel\Hotel;
use Oni\TravelPortBundle\ProviderSupport\HotelProviderInterface;
use Oni\TravelPortBundle\ProviderSupport\ProviderInterface;
use Oni\TravelPortBundle\TravelPortGlobals;
use Ramsey\Uuid\Uuid;
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
        $this->id = Uuid::uuid4();
        $this->providers = array();
        $this->container = $container;
        $this->session = $session;
        $this->setProviderContainerSession();
    }

    private function setProviderContainerSession()
    {

        if ($providerSession = $this->session->get(TravelPortGlobals::SESSION_PROVIDER_RESULT)){

            $this->providerContainerSession = $providerSession;

        }else{

            $this->providerContainerSession = $this->session->set(TravelPortGlobals::SESSION_PROVIDER_RESULT, array());

        }

    }

    public function getProviderContainerSessionValueByKey($key)
    {

        $sessionContainer = $this->session->get(TravelPortGlobals::SESSION_PROVIDER_RESULT);

        if (!empty($sessionContainer[$key])){

            return $sessionContainer[$key];

        }

        return false;

    }

    private function updateProviderContainerSession($providerContainerArray)
    {

        $this->session->set(TravelPortGlobals::SESSION_PROVIDER_RESULT, $providerContainerArray);

    }

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }


    /**
     * @param $formData
     *
     * @return mixed
     */
    public function processHotelSearchRequest($formData)
    {

        $responses = false;

        foreach ($this->providers as $provider){

            if ($provider instanceof HotelProviderInterface){

                try {

                    $response = $provider->searchHotel($formData)?: false;

                    if (!empty($response)) {
                        $responses[] = $response;
                    }

                }catch (InvalidProviderRequestException $e) {

                    //TODO log errors

                }catch (\Exception $e){

                   //TODO log errors

                }

            }

        }

        return $this->processResults($responses, self::PROVIDER_HOTEL_SEARCH);

    }

    public function processResults($response, $requestType){

        if (empty($response))
            return false;

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