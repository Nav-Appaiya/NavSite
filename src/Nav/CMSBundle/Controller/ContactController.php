<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 8-3-2015
 * Time: 0:28
 */

namespace Nav\CMSBundle\Controller;

use Nav\CMSBundle\Entity\Contact;
use Nav\CMSBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{

    public function indexAction(Request $request)
    {
        // Contact Model as under Entity Dir
        $contact = new Contact();

        // Create a form for that Model
        $form = $this->createForm(new ContactType(), $contact);

        // Handle the request a.k.a. submitted form data
        $form->handleRequest($request);

        // Do stuff if submitted data is valid
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contact->updatedTimestamps();
            $em->persist($contact);
            $em->flush();
            $this->get('session')
                ->getFlashBag()
                ->add('success', 'Thank you, Have a nice day!');

            return $this->redirect($this->generateUrl('nav_contact'));
        }

        return $this->render('NavCMSBundle:Default:contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
