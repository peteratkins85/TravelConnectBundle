<?php

namespace Oni\TravelPortBundle\Controller\Front;

use Oni\CoreBundle\Controller\CoreController;
use Oni\TravelPortBundle\Entity\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class IndexController extends CoreController
{

    public function indexAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
        //$content = file_get_contents('http://alpha.new.wts-travel.com/WSV1/index.php?action=hotel_search&username=thuraya&password=travel123&checkin_date=13/05/2016&checkout_date=15/05/2016&sel_currency=GBP&sel_country=67&sel_city=DUBAI&chk_ratings=[%224.0%22]&sel_nationality=68&availableonly=1&number_of_rooms=1&roomDetails=[{%22numberOfAdults%22:%221%22,%22numberOfChild%22:%220%22,%22ChildAge%22:%220%22}]&gzip=no');
       // echo $content; exit;
        $this->get('oni_travel_port_provider.wts')->searchHotel();

        return $this->render('@travel_port/'.$this->travelPortTheme.'/index.html.twig', array(
        ));

    }





}