<?php

namespace Tests\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuildingControllerTest extends WebTestCase
{
    public function testIndexWithoutSession()
    {
        $client = static::createClient();

        $client->request('GET', '/building');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}