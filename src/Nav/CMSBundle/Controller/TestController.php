<?php

namespace Nav\CMSBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TestController extends Controller
{
    public function indexAction()
    {
        $bulk = ['something' => [
            'key' => 'value'
        ]];
        return $this->renderSomething($bulk);

    }

    public function feedBurner($feedUrl)
    {
        $client = new Client();
        $response = $client->get("http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q=" . $feedUrl)->json(['object' => true]);
        return $response->responseData->feed;
    }

    public function notification()
    {
        $notifications = $this->get('nav.notification');

        $notifications->add("test1", array("type" => "instant", "message" => "This is awesome"));
        $notifications->add("test2", array("type" => "instant", "message" => "This is awesome"));

        return $this->render('NavNotificationBundle:Notifications:success.html.twig', [
            'notifications' => $notifications
        ]);
    }

    public function renderSomething($values)
    {
        return $this->render('@NavCMS/Default/test.html.twig', $values);
    }

}
