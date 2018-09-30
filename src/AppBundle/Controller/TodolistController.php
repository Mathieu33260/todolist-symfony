<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Model\Task;

class TodolistController extends Controller
{
    /**
     * @Route("/", name="todolist")
     */
    public function indexAction(Request $request)
    {
        $tasks = $this->get('session')->get('tasks');
        return $this->render('todolist/index.html.twig',
            [
                'tasks' => $tasks
            ]);
    }

    /**
     * @Route("/add", name="addtask")
     */
    public function addAction(Request $request)
    {
        $tasks = $this->get('session')->get('tasks');
        $tasks[] = new Task(
            $request->get('name'),
            $request->get('priority'));
        $this->get('session')->set('tasks', $tasks);
        return $this->render('todolist/add.html.twig');
    }

    /**
     * @Route("/edit", name="edittask")
     */
    public function editAction(Request $request)
    {
        $tasks = $this->get('session')->get('tasks');
        $taskReturn = null;
        foreach($tasks as $task) {
            if($task->id == $request->get('id')) {
                $taskReturn = $task;
            }
        }
        return $this->render('todolist/edit.html.twig', ['task' => $taskReturn]);
    }

    /**
     * @Route("/delete", name="deletetask")
     */
    public function deleteAction(Request $request)
    {

        return $this->render('todolist/delete.html.twig');
    }
}