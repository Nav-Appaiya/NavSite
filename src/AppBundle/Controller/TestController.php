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
        $welcome = 'Hi';
        if (date("H") < 12) {
            $welcome = 'Good morning';
        } else if (date('H') > 11 && date("H") < 18) {
            $welcome = 'Good afternoon';
        } else if(date('H') > 17) {
            $welcome = 'Good evening';
        }

        return $this->render('@App/test.html.twig', [
            'greeting' => $welcome
        ]);
    }
}