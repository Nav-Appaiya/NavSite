<?php

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 13-6-2015
 * Time: 0:35.
 */

namespace AppBundle\Core;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Defining Controller as a Service
 * to add my custom stuff.
 * Class NavController.
 */
class NavController extends Controller
{
    public function greeting()
    {
        $welcome = 'Hi';
        if (date('H') < 12) {
            $welcome = 'Goodmorning';
        } elseif (date('H') > 11 && date('H') < 18) {
            $welcome = 'Goodafternoon';
        } elseif (date('H') > 17) {
            $welcome = 'Goodevening';
        }

        return $welcome;
    }
}
