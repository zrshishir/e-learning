<?php

namespace App\Model\BasicTable;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";
    protected $fillable = ['user_id', 'name', 'active'];
}
