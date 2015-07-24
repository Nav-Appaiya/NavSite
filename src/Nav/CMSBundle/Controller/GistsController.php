<?php

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 8-3-2015
 * Time: 0:28.
 */

namespace Nav\CMSBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GistsController extends Controller
{
    public function indexAction()
    {
        return $this->render('@NavCMS/Gists/index.html.twig', [
            'gists' => $this->getGists(),
        ]);
    }

    public function getGists()
    {
        $client = new Client();

        return $client->get('https://api.github.com/users/nav-appaiya/gists')->json();
    }
}
