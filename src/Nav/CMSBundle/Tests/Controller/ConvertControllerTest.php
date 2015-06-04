<?php

namespace Nav\CMSBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConvertControllerTest extends WebTestCase
{
    public function testConvert()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/convert');
    }

}
