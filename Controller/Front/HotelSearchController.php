<?php

namespace Oni\TravelPortBundle\Controller\Front;

use Oni\CoreBundle\Controller\CoreController;
use Oni\CoreBundle\Doctrine\Spec\CitySearch;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Country;
use Oni\TravelPortBundle\Form\Front\HotelSearchForm;
use Oni\TravelPortBundle\Providers\ProviderContainer;
use Oni\TravelPortBundle\TravelPortGlobals;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class HotelSearchController extends CoreController
{

    /**
     * @var \Oni\TravelPortBundle\Form\Front\HotelSearchForm
     */
    private $hotelSearchForm;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    /**
     * @var \Oni\TravelPortBundle\Providers\ProviderContainer
     */
    private $providerContainer;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    private $session;

    public function __construct(HotelSearchForm $hotelSearchForm, ProviderContainer $providerContainer, Session $session) {

        $this->hotelSearchForm = $hotelSearchForm;
        $this->providerContainer = $providerContainer;
        $this->session = $session;

    }

    public function indexAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $searchResults = array('hotel');
        $hotelSearchForm = $this->createForm(HotelSearchForm::class);

        if ($request->isMethod('POST')) {

            $hotelSearchForm->handleRequest($request);

            if ($hotelSearchForm->isSubmitted() && $hotelSearchForm->isValid()) {

                $data = $hotelSearchForm->getData();

                $searchResults = $this->providerContainer->processHotelSearchRequest($data);

                $this->get('session')->get(TravelPortGlobals::SESSION_PROVIDER_RESULT);

                //$this->addFlash('notice',$this->translator->trans('Lucky you'));

            }else{

                $this->flashErrors($hotelSearchForm);

            }

        }

        return $this->render('@travel_port/'.$this->travelPortTheme.'/hotel_search.html.twig', array(
            'hotelSearchForm' => $hotelSearchForm->createView(),
            'providerResults'   => $searchResults
        ));

    }

    public function hotelResultsAction(Request $request)
    {

        

    }

    public function wtsCitiesImport(){

        $wtsClient = $this->get('oni_travel_port_provider_client.wts');

        $countries = $wtsClient->getCountries();

        $doctrine = $this->getDoctrine();

        foreach( $countries as $country ){

            $countryEntity = $doctrine->getRepository(Country::class)->findOneBy(array('name'  => $country->name));

            if ($countryEntity) {

                $cities = $wtsClient->getCities($country->code);

                if (!empty($cities->citiy_info) && is_array($cities->citiy_info)) {

                    foreach ( $cities->citiy_info as $city ) {

                        $cityEntity = $doctrine->getRepository(City::class)->findOneBy(array('cityName' => ucwords( strtolower( $city->name ) )));

                        if (empty($cityEntity)) {

                            $cityEntity = new City();

                            $cityEntity->setCityName( ucwords( strtolower( $city->name ) ) );
                            $cityEntity->setCountry( $countryEntity );

                            $em = $doctrine->getEntityManager();

                            $em->persist( $cityEntity );
                            $em->flush();

                        }else{
                            continue;
                        }

                    }

                }

                echo $countryEntity->getIso();
            }


        }


        exit;

    }

}
