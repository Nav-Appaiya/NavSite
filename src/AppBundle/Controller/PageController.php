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
        $yql_url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20%0Afrom%20html%0Awhere%20url%3D%22http%3A%2F%2Fhackersays.com%2F%22%20%0Aand%20xpath%3D%27%2F%2F*%5B%40id%3D%22quotes%22%5D%2Fli%27&format=json&callback=";
        $rawQuotes = file_get_contents($yql_url);
        $cleanQuotes = json_decode($rawQuotes)->query->results->li;

        foreach ($cleanQuotes as $dataid) {
            $quotes[] = [
                'quote' => $dataid->blockquote->p->span,
                'author' => $dataid->blockquote->cite
            ];
        }

        return $this->render('AppBundle:Page:home.html.twig', [
            'quotes'=>$quotes
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
