<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTasks extends Model
{
    use HasFactory;

    protected $fillable = [
        "group_id",
        "task_id",
    ];

    public $timestamps = false;
}
