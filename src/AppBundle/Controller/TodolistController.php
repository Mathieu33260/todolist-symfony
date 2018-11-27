<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use AppBundle\Service\FilterService;
use AppBundle\Service\SortService;
use AppBundle\Service\TaskService;
use AppBundle\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodolistController extends Controller
{
    /** @var UserService $userService */
    private $userService;

    /** @var TaskService $taskService */
    private $taskService;

    /** @var FilterService $filterService */
    private $filterService;

    /** @var SortService $sortService */
    private $sortService;

    public function __construct(UserService $userService, TaskService $taskService,
                                FilterService $filterService, SortService $sortService)
    {
        $this->userService = $userService;
        $this->taskService = $taskService;
        $this->filterService = $filterService;
        $this->sortService = $sortService;
    }

    /**
     * @Route("/", name="todolist")
     */
    public function indexAction()
    {
        $tasks = $this->taskService->filterSort();
        $filter = $this->filterService->getFilter();
        $sort = $this->sortService->getSort();

        return $this->render('todolist/index.html.twig',
            [
                'tasks' => $tasks,
                'filter' => $filter,
                'sort' => $sort
            ]);
    }

    /**
     * @Route("/add", name="addtask")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('todolist');
        }

        return $this->render('todolist/task/addTask.html.twig', ['taskForm' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edittask")
     */
    public function updateAction(Task $task, Request $request)
    {
        //$task->setName($task->getName());

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('todolist');
        }

        return $this->render('todolist/task/editTask.html.twig',
            [
                'taskForm' => $form->createView(),
                'id' => $task->getId()
            ]);
    }

    /**
     * @Route("/delete/{id}", name="deletetask")
     */
    public function deleteAction(Task $task)
    {
        $this->taskService->delete($task);

        return $this->redirectToRoute('todolist');
    }
}
