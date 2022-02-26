<?php

namespace App\Services\Implementations;

use App\Models\CompletedTasks;
use App\Models\GroupTasks;
use App\Models\Notification;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    public function notifyTeacherAboutSolvedTasks ($student_id, $group_id)
    {
        Notification::query()->create(["student_id" => $student_id, "group_id" => $group_id]);
    }
}