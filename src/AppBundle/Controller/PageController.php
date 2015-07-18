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
        $yql_url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22http%3A%2F%2Fquotesondesign.com%2F%22%20and%0A%20%20%20%20%20%20xpath%3D%27%2F%2F*%5B%40id%3D%22quote-content%22%5D%2Fp%2Ftext()%5B1%5D%27&format=json&callback=";

        $content = json_decode(file_get_contents($yql_url));
        $quote = $content->query->results;

        return $this->render('AppBundle:Page:home.html.twig', [
            'quote'=>$quote
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
        $contact = new \Nav\CMSBundle\Entity\Contact();
        $contactType = new \Nav\CMSBundle\Form\ContactType();
        $form = $this->createForm($contactType, $contact);
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Your email has been sent! Thanks!');
                return $this->redirect($this->generateUrl(
                    'nav_contact'
                ));
            }
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
