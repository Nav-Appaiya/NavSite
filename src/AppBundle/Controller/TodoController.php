<?php

namespace AppBundle\Controller;

use AppBundle\Entity\todo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:todo');
        $flashbag = $this->get('session')->getFlashBag();

        // DeletedAt defines if a todoitem lives or not.
        $todos = $repo->createQueryBuilder('t')
                    ->where('t.deletedAt IS NULL')
                    ->getQuery()
                    ->execute();

        if($request->getMethod() === "POST"){
            $todo = new todo();
            $todo->setContent($request->request->get('todo_new'));
            $em->persist($todo);
            $em->flush();
            $flashbag->add('success', 'Added todo!');
            return $this->redirectToRoute('project_todo');
        }

        return $this->render('@App/Page/todo.html.twig', array(
            'todos' => $todos
        ));
    }

    public function deleteThisTodoAction($todo)
    {
        $flashbag = $this->get('session')->getFlashBag();
        $em = $this->getDoctrine()->getManager();
        if($todo == null){
            $flashbag->add('error', 'No real todo id specified to delete');
        }
        $todoRepo = $em->getRepository('AppBundle:todo');
        $foundTodo = $todoRepo->findOneBy(array(
            'id' => $todo
        ));

        if($foundTodo){
            $foundTodo->setDeletedAt(new \DateTime());
            $em->persist($foundTodo);
            $em->flush();
            $flashbag->add('success','Successfull finished this todo! ');
        }else{
            $flashbag->add('error', 'Could not find the specified todo...');
        }
        return $this->redirectToRoute('project_todo');
    }
}
