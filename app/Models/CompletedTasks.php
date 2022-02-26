<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedTasks extends Model
{
    use HasFactory;

    protected $table = "completed_tasks";

    protected $fillable = [
        "user_answer",
        "lab_id",
        "student_id",
        "task_id",
        "is_correct"
    ];
    public $timestamps = false;
}
