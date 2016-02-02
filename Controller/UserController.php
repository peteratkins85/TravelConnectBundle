<?php

namespace Oni\TravelConnectBundle\Controller;

use Oni\CoreBundle\Controller\CoreController;
use Oni\TravelConnectBundle\Entity\Repository\UsersRepository;

class UserController extends CoreController
{

    public function __construct(UsersRepository $travelConnectUserRepository) {

        $this->travelConnectUserRepository = $travelConnectUserRepository;

    }

    public function indexAction()
    {

        $travelConnectUsers = $this->travelConnectUserRepository->findAll();

        return $this->render('TravelConnectBundle:User:index.html.twig', array(
            'travelConnect' => $travelConnectUsers,
        ));
    }

    public function addAction()
    {

        $TcUser = $this->get('oni_travel_connect_user');


        return $this->render('TravelConnectBundle:User:add.html.twig', array(
            // ...
        ));
    }

    public function editAction($id)
    {
        return $this->render('TravelConnectBundle:User:edit.html.twig', array(
            // ...
        ));
    }


}
