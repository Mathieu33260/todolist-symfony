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
        $users = $this->get('session')->get('users');
        $tasks = $this->get('session')->get('tasks');
        return $this->render('todolist/index.html.twig',
            [
                'users' => $users,
                'tasks' => $tasks
            ]);
    }

    /**
     * @Route("/add", name="addtask")
     */
    public function addAction(Request $request)
    {
        $users = $this->get('session')->get('users');
        $tasks = $this->get('session')->get('tasks');
        if($request->get('name')) {
            $tasks[] = new Task(
                $request->get('name'),
                $request->get('priority'),
                $request->get('userid'));
            $this->get('session')->set('tasks', $tasks);
        }

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/edit", name="edittask")
     */
    public function editAction(Request $request)
    {
        $tasks = $this->get('session')->get('tasks');
        $taskReturn = null;
        /** @var Task $task */
        foreach($tasks as $task) {
            if($task->getId() == $request->get('id')) {
                $task->setName($request->get('name'));
                $task->setPriority($request->get('priority'));
                $task->setDone($request->request->has('done'));
            }
        }
        $this->get('session')->set('tasks', $tasks);
        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/delete", name="deletetask")
     */
    public function deleteAction(Request $request)
    {



        return $this->redirectToRoute('todolist');
    }
}
