<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends Controller
{

	/**
     * @Route("/", name="v2_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@App/V2/base.html.twig');
    }

    /**
     * @Route("/", name="v2_about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render('@App/V2/base.html.twig');
    }

    /**
     * @Route("/", name="v2_project")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectAction()
    {
        return $this->render('@App/V2/base.html.twig');
    }
}
