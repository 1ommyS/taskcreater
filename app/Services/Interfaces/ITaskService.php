<?php

namespace App\Services\Implementations;

interface ITaskService
{
    public function getTasks (int $count): \Illuminate\Database\Eloquent\Collection|array;

    public function createTask (int $amount, $lab_id, array $types, array $encoding_types, array $memory_types, array $values);

    public function checkAnswers (int $lab_id, $answers, int $student_id);

    public function assignTasksToGroup (int $group_id, array $tasks_id);

    public function getVariants (int $lab_id);
}