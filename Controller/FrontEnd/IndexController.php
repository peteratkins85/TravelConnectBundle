<?php

namespace Oni\TravelPortBundle\Controller\FrontEnd;

use Oni\CoreBundle\Controller\CoreController;
use Oni\TravelPortBundle\Entity\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class IndexController extends CoreController
{

    public function indexAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_TRAVEL_CONNECT_USER', null, 'Unable to access this page!');
        $this->get('oni_travel_connect_provider.wts')->searchHotel();

        return $this->render('@travel_connect/'.$this->travelPortTheme.'/index.html.twig', array(
        ));

    }





}