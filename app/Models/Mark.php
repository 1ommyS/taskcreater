<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        "student_id",
        "lab_id",
        "mark",
        "created_at",
        "updated_at",
    ];
}
