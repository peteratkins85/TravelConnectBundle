<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 23/12/2015
 * Time: 01:21
 */

namespace Oni\CoreBundle\Factory;

use Oni\TravelPortBundle\Controller\UserController;
use Oni\TravelPortBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Oni\CoreBundle\Controller\CoreController;
use Doctrine\ORM\EntityRepository;



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

        $userRepository = $serviceContainer->get('doctrine.orm.default_entity_manager')->getRepository(User::class);

        $userController = new UserController(
            $userRepository
        );

        $userController = $this->prepareController($userController);

        return $userController;

    }



}