<?php

namespace AppBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class User {

    /** @var int $id */
    private $id;

    /** @var string $pseudo */
    private $pseudo;

    /** @var ArrayCollection $tasksId */
    private $tasksId;

    public function __construct($pseudo)
    {
        $this->id = uniqid();;
        $this->pseudo = $pseudo;
        $this->tasksId = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return ArrayCollection
     */
    public function getTasksId()
    {
        return $this->tasksId;
    }

    /**
     * @param ArrayCollection $tasksId
     */
    public function setTasksId($tasksId)
    {
        $this->tasksId = $tasksId;
    }


    /**
     * @param int $id
     */
    public function addTask($id)
    {
        if (!$this->tasksId->contains($id)) {
            $this->tasksId[] = $id;
        }
    }

    /**
     * @param int $id
     */
    public function removeTask($id)
    {
        if ($this->tasksId->contains($id)) {
            $this->tasksId->removeElement($id);
        }
    }

}