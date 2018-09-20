<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Model\Task;

/**
 * @Route("/todolist")
 */
class TodolistController extends Controller
{
    /**
     * @Route("/", name="todolist")
     */
    public function indexAction(Request $request)
    {
        $tasks = $this->get('session')->get('tasks');
        var_dump($tasks);
        return $this->render('todolist/index.html.twig');
    }

    /**
     * @Route("/add", name="addtask")
     */
    public function addAction(Request $request)
    {
        $this->get('session')->set('tasks', [new Task(1,'la tache',3)]);
        return $this->render('todolist/add.html.twig');
    }

    /**
     * @Route("/edit", name="edittask")
     */
    public function editAction(Request $request)
    {

        return $this->render('todolist/edit.html.twig');
    }

    /**
     * @Route("/delete", name="deletetask")
     */
    public function deleteAction(Request $request)
    {

        return $this->render('todolist/delete.html.twig');
    }
}
