<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin  \Illuminate\Database\Query\Builder
 */
class Notification extends Model
{
    protected $fillable = [
        "student_id",
        "group_id",
        "readed",
    ];
    use HasFactory;
}
