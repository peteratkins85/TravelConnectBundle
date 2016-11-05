<?php

namespace Oni\TravelPortBundle\Controller;

use Oni\CoreBundle\Controller\CoreController;
use Oni\TravelPortBundle\Services\UserService;

class UserController extends CoreController
{

    /**
     * @var \Oni\TravelPortBundle\Services\UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function indexAction()
    {
        $travelPortUsers = $this->userService->findAll();

        return $this->render('TravelPortBundle:User:index.html.twig', array(
            'users' => $travelPortUsers,
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
