<?php

namespace Oni\TravelPortBundle\Controller\FrontEnd;

use Oni\CoreBundle\Controller\CoreController;

class AccountController extends CoreController
{
    public function indexAction()
    {
        return $this->render('@travel_port/'.$this->travelPortTheme.'/account.html.twig', array(
        ));
    }
}
