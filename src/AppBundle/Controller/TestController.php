<?php

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 7-6-2015
 * Time: 18:09.
 */

namespace AppBundle\Controller;

use AppBundle\Core\NavController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController
 * @package AppBundle\Controller
 */
class TestController extends NavController
{

	/**
     * @Route("/", name="test_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
//        echo '<pre>';
//        $client = new \Github\Client();
//        $repositories = $client->api('user')->repositories('Nav-Appaiya');
//        $response = $client->api('repo')->commits()->all('Nav-Appaiya', 'NavSite', array('sha' => 'master'));
    return $this->render('@App/test.html.twig');
        print_r($response);
        die('died at testing');
        $feedburner = $this->get('toolbox.feedburner');
        $techzine = $feedburner->load('http://feeds.feedburner.com/Tutorialzine');
        $tweakers = $feedburner->load('http://feeds.feedburner.com/tweakers/nieuws');

        return $this->render('AppBundle:Page:news.html.twig', [
            'techzine' => $techzine->getThreeEntries(),
            'tweakers' => $tweakers->getFiveEntries(),
            'greeting' => $this->greeting(),
        ]);
    }


    /**
     * @Route("/bootstrap", name="test_bootstrap")
     */
    public function bootstrapAction()
    {
        return $this->render('@App/V2/base.html.twig');
    }
}
