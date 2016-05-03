<?php

namespace Oni\TravelPortBundle\Controller\FrontEnd;

use Oni\CoreBundle\Controller\CoreController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HotelSearchController extends CoreController
{

    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_TRAVEL_CONNECT_USER', null, 'Unable to access this page!');
        $this->get('oni_travel_connect_provider.wts')->searchHote();

        return $this->render('@travel_connect/'.$this->travelPortTheme.'/hotel_search.html.twig', array(
        ));

    }

    public function hotelResultsAction(Request $request)
    {



    }

}
