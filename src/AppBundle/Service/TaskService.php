<?php

namespace AppBundle\Service;

use AppBundle\Model\Task;

class TaskService
{
    public function filter($tasks, $by)
    {
        $tasksDone = [];
        $tasksUndone = [];
        /** @var Task $task */
        foreach($tasks as $task) {
            if($task->isDone()) {
                $tasksDone[] = $task;
            } else {
                $tasksUndone[] = $task;
            }
        }
        switch ($by) {
            case 'done';
                return $tasksDone;
                break;
            case 'undone':
                return $tasksUndone;
                break;
            default :
                return $tasks;
        }
    }
}