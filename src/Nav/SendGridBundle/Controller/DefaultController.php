<?php

namespace Nav\SendGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NavSendGridBundle:Default:index.html.twig');
    }
}
