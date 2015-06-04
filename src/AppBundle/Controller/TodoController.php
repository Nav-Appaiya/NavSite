<?php

namespace AppBundle\Controller;

use AppBundle\Entity\todo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            if($request->request->get('todo_new')){
                $todo = new todo();
                $todo->setContent($request->request->get('todo_new'));
                $todo->setIp($request->getClientIp());
                $todo->setCreatedAt();
                $todo->setDeletedAt();
                $em->persist($todo);
            }
            $em->flush();
        }
        $todos = $em->getRepository('AppBundle:todo')->findAll();

        return $this->render('AppBundle:Page:todo.html.twig', [
            'todos'=>$todos
        ]);
    }

}
