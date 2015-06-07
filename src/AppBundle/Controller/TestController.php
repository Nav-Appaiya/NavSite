<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7-6-2015
 * Time: 18:09
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        // Load the url
        $feedburner = $this->get('toolbox.feedburner');
        $response = $feedburner->load("http://feeds.feedburner.com/Tutorialzine");

        var_dump($feedburner->getEntries());exit;

        // Get entries


        return $this->render('@App/test.html.twig');
    }
}