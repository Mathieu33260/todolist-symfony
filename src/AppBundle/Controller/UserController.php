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
        $tasks = $this->get('session')->get('tasks');
        if($request->get('pseudo')) {
            $users[] = new User($request->get('pseudo'));
            $this->get('session')->set('users', $users);
        }

        return $this->redirectToRoute('todolist');
    }
}
