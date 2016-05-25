<?php

namespace Oni\TravelPortBundle\Tests\Controller\Front;

trait TcTestCase
{


    /***
     *
     * Get Travel Connect Hostname
     *
     * @return string
     *
     */
    public function getHost(){

        $container = self::$kernel->getContainer();

        if ($container->hasParameter('domain')){

            $hostname = $container->getParameter('domain');
            $hostname = 'http://tc.'.$hostname;

            return $hostname;

        }

    }

}