<?php

namespace Nav\CMSBundle\Controller;

use Nav\CMSBundle\Entity\Visitor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrackingController extends Controller
{
    public function trackVisit()
    {
        $visitor = new Visitor();
        $em = $this->getDoctrine()->getManager();

        $hostname = gethostname();
        $ip = $this->getRequest()->getClientIp();

        if ($ip != '127.0.0.2') {
            $visitor->setHostname($hostname);
            $visitor->setIp($ip);
            $em->persist($visitor);
        }

        $em->flush();
    }
}
