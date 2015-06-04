<?php

namespace Nav\SEOShopBundle\Controller;

use Nav\SEOShopBundle\Entity\shop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // Create a page where user can add seoshop with API Key + API secret
        // CRUD The connection
        $shop = new shop();
        $em = $this->getDoctrine()->getEntityManager();
        $form = $this->createFormBuilder($shop)
            ->add('name', 'text')
            ->add('api_key', 'text')
            ->add('api_secret', 'text')
            ->add('save', 'submit', array('label' => 'Save shop'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($shop);
            $em->flush();
            return $this->redirect($this->generateUrl('nav_about'));
        }
        return $this->render('NavSEOShopBundle:Default:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
