<?php

namespace AppBundle\Service;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Collection|User[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    /**
     * @param $id
     * @return User
     */
    public function get($id)
    {
        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->find($id);
        return $user;
    }

    public function add($pseudo) {
        $user = new User();
        $user->setPseudo($pseudo);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function delete($id) {
        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $tasks = $user->getTasks();
        foreach ($tasks as $task) {
            $user->removeTask($task);
        }
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function addTask($taskId, $userId) {
        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        /** @var Task $task */
        $task = $this->entityManager->getRepository(Task::class)->find($taskId);
        $user->addTask($task);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}