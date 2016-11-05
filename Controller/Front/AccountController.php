<?php

namespace Oni\TravelPortBundle\Controller\Front;

use Oni\CoreBundle\Controller\CoreController;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class AccountController extends CoreController
{

    public function __construct()
    {
    }


    public function indexAction()
    {

        


        return $this->render('@travel_port/'.$this->travelPortTheme.'/account/index.html.twig', array(
        ));
    }
}
