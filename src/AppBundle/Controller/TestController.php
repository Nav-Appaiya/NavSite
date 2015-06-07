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
        return $this->render('@App/test.html.twig');
    }
}