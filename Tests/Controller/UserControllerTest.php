<?php

namespace Oni\TravelPortBundle\Tests\Controller;


use Oni\CoreBundle\Tests\CoreTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    use CoreTestCase;

    public function testIndex()
    {
        $client = static::createClient();

        $hostname = $this->getHost();

        $client->request('GET', $hostname.'/admin/travel-connect/users');

        $this->assertTrue($client->getResponse()->isRedirect($hostname.'/admin/login'));

    }

    public function testAdd()
    {
        $client = static::createClient();

        $hostname = $this->getHost();

        $client->request('GET', $hostname.'/admin/travel-connect/user/add');

        $this->assertTrue($client->getResponse()->isRedirect($hostname.'/admin/login'));
    }

    public function testEdit()
    {
        $client = static::createClient();

        $hostname = $this->getHost();

        $client->request('GET', $hostname.'/admin/travel-connect/user/edit/{id}');

        $this->assertTrue($client->getResponse()->isRedirect($hostname.'/admin/login'));
    }

}
