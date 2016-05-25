<?php

namespace Oni\TravelPortBundle\Tests\Controller;

use Oni\TravelPortBundle\Tests\Controller\Front\TcTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{

    use TcTestCase;

    public function testIndex()
    {
        $client = static::createClient();

        $hostname = $this->getHost();

        $crawler = $client->request('GET', $hostname.'/');

        $this->assertTrue($client->getResponse()->isRedirect($hostname.'/login'));

    }




}
