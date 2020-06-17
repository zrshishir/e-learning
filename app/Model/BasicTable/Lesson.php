<?php

namespace App\Model\BasicTable;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lessons";
    protected $fillable = ['user_id', 'course_id', 'name', 'active'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function course(){
        return $this->belongsTo('App\Model\BasicTable\Course');
    }

    public function questions(){
        return $this->hasMany('App\Model\BasicTable\Questions');
    }
}
