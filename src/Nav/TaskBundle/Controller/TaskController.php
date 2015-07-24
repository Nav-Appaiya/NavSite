<?php

namespace Nav\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * TaskController for CRUD operations on Tasks
 * Nav Appaiya 30-May-2015.
 *
 * Class TaskController
 */
class TaskController extends Controller
{
    /**
     * Listing all Tasks.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }

    /**
     * Showing a specific Task By Id.
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }

    /**
     * Showing the Create Form.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }

    /**
     * Takes the post data from the create form
     * Only accepts post requests, see routing.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }

    /**
     * Shows edit form for a Task.
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }

    /**
     * Takes the form data from editform and redirects
     * the user to main.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }

    /**
     * Delete a task, this will not have a view
     * but it will delete the task and redirect the user.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction()
    {
        return $this->render('NavTaskBundle:Task:index.html.twig');
    }
}
