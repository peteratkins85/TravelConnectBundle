<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 17/01/2016
 * Time: 14:22
 */

namespace Oni\TravelPortBundle\Entity;

use Oni\UserManagerBundle\Entity\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface{

    public function getAgency();


}