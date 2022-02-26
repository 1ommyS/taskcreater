<?php


namespace App\Repositories\Implementations;


use App\Models\Mark;
use App\Models\Point;
use App\Repositories\Interfaces\IMarkRepository;
use Illuminate\Database\Eloquent\Collection;

class MarkRepository implements IMarkRepository
{

    public function saveStudentMark (int $student_id, int $group_id, int $mark, $date): void
    {

    }

    public function getStudentMarks (int $student_id, int $group_id): Collection
    {
        // TODO: Implement getStudentMarks() method.
    }

    public function getStudentMarkOnTheDate (int $student_id, int $group_id, $date): Collection
    {
        // TODO: Implement getStudentMarkOnTheDate() method.
    }

    public function getStudentMarkDuringThePeriod (int $student_id, int $group_id, $first_day, $last_day): Collection
    {
        // TODO: Implement getStudentMarkDuringThePeriod() method.
    }
}