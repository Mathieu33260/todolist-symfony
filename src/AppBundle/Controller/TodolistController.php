<?php

namespace AppBundle\Controller;

use AppBundle\Service\FilterService;
use AppBundle\Service\TaskService;
use AppBundle\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodolistController extends Controller
{
    /**
     * @Route("/", name="todolist")
     */
    public function indexAction(Request $request, TaskService $taskService,
                                UserService $userService, FilterService $filterService)
    {
        $users = $userService->getAll();
        $tasks = $taskService->filter();
        $filter = $filterService->getFilter();

        return $this->render('todolist/index.html.twig',
            [
                'users' => $users,
                'tasks' => $tasks,
                'filter' => $filter
            ]);
    }

    /**
     * @Route("/add", name="addtask")
     */
    public function addAction(Request $request, TaskService $taskService,
                              UserService $userService, FilterService $filterService)
    {
        if($request->get('name')) {
            $taskService->add(
                $request->get('name'),
                $request->get('priority'),
                $request->get('userid')
            );
        }

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/edit", name="edittask")
     */
    public function editAction(Request $request, TaskService $taskService)
    {
        $taskService->edit(
            $request->get('id'),
            $request->get('name'),
            $request->get('priority'),
            $request->get('done'),
            $request->get('userid')
        );

        return $this->redirectToRoute('todolist');
    }

    /**
     * @Route("/delete", name="deletetask")
     */
    public function deleteAction(Request $request, TaskService $taskService)
    {
        $taskService->delete($request->get('id'));

        return $this->redirectToRoute('todolist');
    }
}
