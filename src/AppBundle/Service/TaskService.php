<?php

namespace AppBundle\Service;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var FilterService $filterService
     */
    private $filterService;

    /**
     * @var UserService $userService
     */
    private $userService;

    public function __construct(EntityManagerInterface $entityManager, FilterService $filterService, UserService $userService)
    {
        $this->entityManager = $entityManager;
        $this->filterService = $filterService;
        $this->userService = $userService;
    }

    /**
     * @param string|null $paramFilter
     * @return Collection|Task[]
     */
    public function filter($paramFilter = null)
    {
        $filter = ($paramFilter ? $paramFilter : $this->filterService->getFilter());
        switch ($filter) {
            case 'done';
                return $this->entityManager->getRepository(Task::class)->findBy(['done' => true]);
                break;
            case 'undone':
                return $this->entityManager->getRepository(Task::class)->findBy(['done' => false]);
                break;
            default :
                return $this->entityManager->getRepository(Task::class)->findAll();
        }
    }

    public function add($name, $priority, $userId) {
        $task = new Task();
        $task->setName($name);
        $task->setPriority($priority);
        $task->setDone(false);

        if($userId) {
            /** @var User $user */
            $user = $this->userService->get($userId);
            $task->setUser($user);
        }
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function edit($id, $name, $priority, $done, $userId) {
        /** @var Task $task */
        $task = $this->entityManager->getRepository(Task::class)->find($id);
        $task->setName($name);
        $task->setPriority($priority);
        $task->setDone($done);

        if($userId) {
            /** @var User $user */
            $user = $this->userService->get($userId);
            $task->setUser($user);
        }
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function delete($id) {
        /** @var Task $task */
        $task = $this->entityManager->getRepository(Task::class)->find($id);
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
}