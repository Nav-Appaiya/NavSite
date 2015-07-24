<?php

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 24-3-2015
 * Time: 1:19.
 *
 * Youtube downloader Controller
 * - Render form
 * - Take postdata
 * - Process and return download
 */

namespace Nav\CMSBundle\Controller;

use Nav\CMSBundle\Entity\Youtube;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SoundcloudController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('NavCMSBundle:Media:soundcloud.html.twig');
    }

    public function getCleanVideoId($url)
    {
        // https://www.youtube.com/watch?v=uBRhI4Rn7hQ
        $first = explode('/', $url);

        // watch?v=uBRhI4Rn7hQ
        $last = $first[count($first) - 1];

        // TODO: Find out if this is always true (11 chars chopped of the end)
        $final = substr($last, -11);

        return $final;
    }
}
