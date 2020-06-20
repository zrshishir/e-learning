<?php

namespace App\Model\BasicTable;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";
    protected $fillable = ['user_id', 'lesson_id', 'question', 'active', 'option1', 'option2', 'option3', 'option4', 'correct_option'];

    public function lesson(){
        return $this->belongsTo('App\Model\BasicTable\Lesson');
    }
}
