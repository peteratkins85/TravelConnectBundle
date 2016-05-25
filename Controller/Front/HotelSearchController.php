<?php

namespace Oni\TravelPortBundle\Controller\Front;

use Oni\CoreBundle\Controller\CoreController;
use Oni\CoreBundle\Doctrine\Spec\CitySearch;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Repository\CityRepository;
use Oni\TravelPortBundle\Form\Front\HotelSearchForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HotelSearchController extends CoreController
{

    /**
     * @var \Oni\TravelPortBundle\Form\Front\HotelSearchForm
     */
    protected $hotelSearchForm;

    public function __construct(HotelSearchForm $hotelSearchForm) {

        $this->hotelSearchForm = $hotelSearchForm;

    }

    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        
        $hotelSearchForm = $this->createForm(HotelSearchForm::class);


        return $this->render('@travel_port/'.$this->travelPortTheme.'/hotel_search.html.twig', array(
            'hotelSearchForm' => $hotelSearchForm->createView()
        ));

    }

    public function hotelResultsAction(Request $request)
    {

        

    }

}
