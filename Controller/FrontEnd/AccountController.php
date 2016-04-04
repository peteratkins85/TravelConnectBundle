<?php

namespace Oni\TravelConnectBundle\Controller\FrontEnd;

use Oni\CoreBundle\Controller\CoreController;

class AccountController extends CoreController
{
    public function indexAction()
    {
        return $this->render('@travel_connect/'.$this->travelConnectTheme.'/account.html.twig', array(
        ));
    }
}
