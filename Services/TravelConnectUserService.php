<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 18/01/2016
 * Time: 22:47
 */

namespace Oni\TravelConnectBundle\Services;


use Oni\TravelConnectBundle\Entity\Repository\UsersRepository;

class TravelConnectUserService {

    public function __construct(UsersRepository $travelConnectUserRepository) {

        $this->travelConnectUserRepository = $travelConnectUserRepository;

    }

}