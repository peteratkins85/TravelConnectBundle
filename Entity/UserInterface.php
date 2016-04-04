<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 17/01/2016
 * Time: 14:22
 */

namespace Oni\TravelConnectBundle\Entity;


interface UserInterface {

    const ROLE_DEFAULT = 'TRAVEL_CONNECT_USER';

    public function getCompnayAccount();


}