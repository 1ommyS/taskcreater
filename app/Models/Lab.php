<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Query\Builder
 */
class Lab extends Model
{
    use HasFactory;

    protected $table = "labs";
    public $timestamps = false;
    public $fillable = [
      "group_id",
      "lab_name"
    ];
}
