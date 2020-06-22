<?php

namespace App\Model\BasicTable;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $table = "user_courses";
    protected $fillable = ['user_id', 'course_id', 'active'];

    public function course(){
        return $this->belongsTo('App\Model\BasicTable\Course');
    }

}
