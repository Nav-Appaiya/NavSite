<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7-6-2015
 * Time: 18:09
 */

namespace AppBundle\Controller;

use AppBundle\Core\NavController;

class TestController extends NavController
{
    public function indexAction()
    {
        $feedburner = $this->get('toolbox.feedburner');
        $techzine = $feedburner->load("http://feeds.feedburner.com/Tutorialzine");
        $tweakers = $feedburner->load("http://feeds.feedburner.com/tweakers/nieuws");

        return $this->render('AppBundle::test.html.twig', [
            'techzine' => $techzine->getThreeEntries(),
            'tweakers'=> $tweakers->getFiveEntries(),
            'greeting'=>$this->greeting()
        ]);

        return $this->render('@App/test.html.twig', [
            'greeting' => $this->greeting()
        ]);
    }

    public function loadNews()
    {

    }
}