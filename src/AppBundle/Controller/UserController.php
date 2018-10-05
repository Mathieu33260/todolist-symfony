<?php

namespace AppBundle\Controller;

use AppBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Model\Task;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/add", name="adduser")
     */
    public function addAction(Request $request)
    {
        $users = $this->get('session')->get('users');
        if($request->get('pseudo')) {
            $users[] = new User($request->get('pseudo'));
            $this->get('session')->set('users', $users);
        }

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/assign", name="assignUser")
     */
    public function assignAction(Request $request)
    {
        $users = $this->get('session')->get('users');
        $tasks = $this->get('session')->get('tasks');
        if($request->get('taskid')) {
            $taskFind = null;
            $userFind = null;
            /** @var Task $task */
            foreach($tasks as $task) {
                if($task->getId() == $request->get('taskid')) {
                    $task->setUserId($request->get('userid'));
                }
            }
            /** @var User $user */
            foreach($users as $user) {
                if($user->getId() == $request->get('userid')) {
                    $user->addTask('taskid');
                }
            }
            $this->get('session')->set('users', $users);
            $this->get('session')->set('tasks', $tasks);
        }

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/remove", name="removeuser")
     */
    public function removeAction(Request $request)
    {
        $users = $this->get('session')->get('users');
        $cpt = 0;
        /** @var User $user */
        foreach($users as $user) {
            if($user->getId() == $request->get('id')) {
                array_splice($users, $cpt, 1);
            }
            $cpt++;
        }
        $this->get('session')->set('users', $users);
        return $this->redirectToRoute('todolist');
    }
}
