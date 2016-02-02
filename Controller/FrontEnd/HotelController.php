<?php

namespace Oni\TravelConnectBundle\Controller\FrontEnd;

use Oni\CoreBundle\Controller\CoreController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HotelController extends CoreController
{

    public function indexAction($name)
    {

        $this->denyAccessUnlessGranted('ROLE_TRAVEL_CONNECT_USER', null, 'Unable to access this page!');
        $this->get('oni_travel_connect_provider.wts')->searchHotel();


        return $this->render('@travel_connect/'.$this->travelConnectTheme.'/hotelSearch.html.twig', array(
        ));

    }

    public function hotelResultsAction(Request $request)
    {



    }

}
