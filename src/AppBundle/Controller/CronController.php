<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 20-7-2015
 * Time: 21:09
 */

namespace AppBundle\Controller;

use AppBundle\Core\NavController;
use AppBundle\Entity\quotes;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class CronController extends NavController
{
    /**
     *   Cron controller
     *   Add actions to the index
     *   Will run every 15 min
     *   Url: http://navappaiya.nl/cron/index
     */
    public function indexAction()
    {
        $result = $this->fetchQuotesAndFillDatabase();

        return new Response('Cron finished', 200);
    }


    public function fetchQuotesAndFillDatabase()
    {
        $url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22http%3A%2F%2Fquotesondesign.com%2F%22%20and%0A%20%20%20%20%20%20xpath%3D%27%2F%2F*%5B%40id%3D%22quote-content%22%5D%2Fp%2Ftext()%5B1%5D%27&format=json&callback=";
        $client = new Client();
        $em = $this->getDoctrine()->getManager();
        $request = $client->get($url);
        $fetchedQuote = json_decode($request->getBody()->getContents())->query->results;
        $q = $em->getRepository('AppBundle:quotes')->findOneBy(array(
            'content' => (string)$fetchedQuote
        ));
        if($q == null){
            $quote = new quotes();
            $quote->setContent($fetchedQuote);
            $em->persist($quote);
        }
        $em->flush();
        return false;
    }
}