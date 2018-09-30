<?php

namespace AppBundle\Model;

/**
 * Class Task
 * @package AppBundle\Model
 */
class Task {

    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var int $priority */
    private $priority;

    /** @var bool $done */
    private $done;

    /** @var int $userId */
    private $userId;

    /**
     * Task constructor.
     * @param $name
     * @param null $priority
     * @param null $userId
     */
    public function __construct($name, $priority = null, $userId = null)
    {
        $this->id = uniqid();
        $this->name = $name;
        $this->priority = $priority;
        $this->done = false;
        $this->userId = $userId;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


}