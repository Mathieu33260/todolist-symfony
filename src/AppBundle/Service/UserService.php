<?php

namespace AppBundle\Service;

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

    public function delete(User $user) {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}