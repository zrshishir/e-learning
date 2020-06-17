<?php

namespace App\Model\BasicTable;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = "responses";
    protected $fillable = ['user_id', 'question_id', 'response', 'right_wrong'];
}
