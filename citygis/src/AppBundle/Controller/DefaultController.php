<?php

namespace AppBundle\Controller;

use Faker\Factory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Loads home page
     * this twig file is found at /www/app/Resource/ 
     * not in the actual src/AppBundle file structure
     */
    public function indexAction(Request $request)
    {
        dump($this->fake());



       return $this->render('AppBundle::layout.html.twig');
    }

    public function fake($fakeThis = 'name')
    {
        $faker = Factory::create();
        return $faker->$fakeThis;
    }
}
