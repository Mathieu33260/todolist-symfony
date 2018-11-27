<?php

namespace AppBundle\Service;

use AppBundle\Entity\Task;
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

    /** @var SortService $sortService */
    private $sortService;

    public function __construct(EntityManagerInterface $entityManager, FilterService $filterService, UserService $userService, SortService $sortService)
    {
        $this->entityManager = $entityManager;
        $this->filterService = $filterService;
        $this->userService = $userService;
        $this->sortService = $sortService;
    }

    /**
     * @param string|null $paramFilter
     * @param string|null $paramSort
     * @return Collection|Task[]
     */
    public function filterSort($paramFilter = null, $paramSort = null)
    {
        $filter = $paramFilter ? $paramFilter : $this->filterService->getFilter();
        $sort = $paramSort ? $paramSort : $this->sortService->getSort();
        $sort = $sort ? [$sort => 'ASC'] : ['id' => 'ASC'];
        switch ($filter) {
            case 'done';
                return $this->entityManager->getRepository(Task::class)->findBy(['done' => true], $sort);
                break;
            case 'undone':
                return $this->entityManager->getRepository(Task::class)->findBy(['done' => false], $sort);
                break;
            default :
                return $this->entityManager->getRepository(Task::class)->findBy([], $sort);
        }
    }

    public function delete(Task $task) {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
}