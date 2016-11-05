<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 23/12/2015
 * Time: 01:21
 */

namespace Oni\TravelPortBundle\Factory\Controller;

use Oni\CoreBundle\Factory\CoreAbstractFactory;
use Oni\TravelPortBundle\Controller\UserController;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UserControllerFactory extends CoreAbstractFactory
{

    /**
     *
     * Return Controller Class
     *
     * @param ContainerInterface $serviceContainer
     *
     * @return UserController
     *
     */
    public function getService(ContainerInterface $serviceContainer){

        $userService = $serviceContainer->get('oni_travel_port_user_service');

        $userController = new UserController(
            $userService
        );

        $userController = $this->injectControllerDependencies($userController);

        return $userController;

    }



}