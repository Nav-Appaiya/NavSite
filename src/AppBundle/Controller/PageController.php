<?php

namespace AppBundle\Controller;

use AppBundle\Entity\contact;
use AppBundle\Form\contactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Guzzle\Http\Client;
use Guzzle\Plugin\Oauth\OauthPlugin;

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


        return $this->render('AppBundle:Page:home.html.twig', [
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
    public function contactAction(Request $request)
    {
        $contact = new contact();
        $form = $this->createForm(new contactType(), $contact);
        $form->add('submit', 'submit');

        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'Thanks for your submission, I will get back to you.');
            return $this->redirect($this->generateUrl(
                'nav_contact'
            ));
        }



        return $this->render('AppBundle:Page:contact.html.twig', [
            'form'=>$form->createView()
        ]);
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

    public function newsAction()
    {
        // Page for Feeds with PHP news
        $feedburner = $this->get('toolbox.feedburner');
        $techzine = $feedburner->load("http://feeds.feedburner.com/Tutorialzine");
        $tweakers = $feedburner->load("http://feeds.feedburner.com/tweakers/nieuws");

        return $this->render('AppBundle:Page:news.html.twig', [
            'posts' => $techzine->getThreeEntries(),
            'tweakers'=> $tweakers->getFiveEntries(),
            'greeting'=>$this->greeting()
        ]);
    }

    private function greeting($time = false)
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
        if($time){
            return $welcome . ", current time " . $theTimeIs;
        }
        return $welcome;
    }
}
