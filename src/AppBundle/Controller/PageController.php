<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 * @package AppBundle\Controller
 */
class PageController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        $feedburner = $this->get('toolbox.feedburner');
        $techzine = $feedburner->load("http://feeds.feedburner.com/Tutorialzine");
        $tweakers = $feedburner->load("http://feeds.feedburner.com/tweakers/nieuws");

        return $this->render('AppBundle:Page:home.html.twig', [
            'posts' => $techzine->getThreeEntries(),
            'tweakers'=> $tweakers->getFiveEntries(),
            'greeting'=>$this->greeting()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction(Request $request)
    {
        $rawBadges = "http://backpack.openbadges.org/displayer/160839/group/53555.json";
        $response = json_decode(file_get_contents($rawBadges));

        return $this->render('AppBundle:Page:about.html.twig', [
            'badges' => $response->badges
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {
        return $this->render('AppBundle:Page:contact.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectAction()
    {
        return $this->render('AppBundle:Page:project.html.twig');
    }

    public function errorAction()
    {
        return $this->render('AppBundle:Page:error.html.twig');
    }

    public function greeting()
    {
        $welcome = 'Hi';
        if (date("H") < 12) {
            $welcome = 'Good morning';
        } else if (date('H') > 11 && date("H") < 18) {
            $welcome = 'Good afternoon';
        } else if(date('H') > 17) {
            $welcome = 'Good evening';
        }
        $date = new \DateTime("NOW");

        $theTimeIs = $date->format('H:i');
        return $welcome . ", current time " . $theTimeIs;
    }
}
