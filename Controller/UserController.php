<?php

namespace Oni\TravelPortBundle\Controller;

use Oni\CoreBundle\Controller\CoreController;
use Oni\TravelPortBundle\Entity\Repository\UsersRepository;

class UserController extends CoreController
{

    public function __construct(UsersRepository $travelPortUserRepository) {

        $this->travelPortUserRepository = $travelPortUserRepository;

    }

    public function indexAction()
    {
        $travelPortUsers = $this->travelPortUserRepository->findAll();

        return $this->render('TravelPortBundle:User:index.html.twig', array(
            'travelPort' => $travelPortUsers,
        ));
    }

    public function addAction()
    {

        $TcUser = $this->get('oni_travel_port_user');


        return $this->render('TravelPortBundle:User:add.html.twig', array(
            // ...
        ));
    }

    public function editAction($id)
    {
        return $this->render('TravelPortBundle:User:edit.html.twig', array(
            // ...
        ));
    }


}
