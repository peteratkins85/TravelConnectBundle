<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 18/01/2016
 * Time: 22:47
 */

namespace Oni\TravelPortBundle\Services;


use Oni\TravelPortBundle\Entity\Repository\UsersRepository;

class TravelPortUserService {

    public function __construct(UsersRepository $travelPortUserRepository) {

        $this->travelPortUserRepository = $travelPortUserRepository;

    }

}