<?php

namespace App\Model\BasicTable;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lessons";
    protected $fillable = ['user_id', 'course_id', 'name', 'active'];
}
