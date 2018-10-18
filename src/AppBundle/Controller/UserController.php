<?php

namespace AppBundle\Controller;

use AppBundle\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/add", name="adduser")
     */
    public function addAction(Request $request, UserService $userService)
    {
        if($request->get('pseudo')) {
            $userService->add($request->get('pseudo'));
        }

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/assign", name="assignUser")
     */
    public function assignAction(Request $request, UserService $userService)
    {
        if($request->get('taskid') && $request->get('userid')) {
            $userService->addTask($request->get('taskid'), $request->get('userid'));
        }

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/remove", name="removeuser")
     */
    public function removeAction(Request $request, UserService $userService)
    {
        $userService->delete($request->get('id'));

        return $this->redirectToRoute('todolist');
    }
}
