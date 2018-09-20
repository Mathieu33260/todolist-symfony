<?php

namespace AppBundle\Model;

class Task {

    public $name;
    public $id;
    public $priority;

    public function __construct($id,$name,$priority)
    {
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
    }

}