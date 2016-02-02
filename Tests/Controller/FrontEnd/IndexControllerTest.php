<?php

namespace Oni\TravelConnectBundle\Tests\Controller;

use Oni\TravelConnectBundle\Tests\Controller\FrontEnd\TcTestCase;
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
