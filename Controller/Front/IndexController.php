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

        return $this->render('@travel_port/'.$this->travelPortTheme.'/index.html.twig', array(
        ));

    }


}