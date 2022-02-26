<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @mixin \Illuminate\Database\Query\Builder
 */
class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";
    protected $fillable = [
        "question",
        "lab_id",
        "answer",
        "created_at",
        "updated_at",
    ];
}
