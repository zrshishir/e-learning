<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = "user_types";
    protected $fillable = ['name', 'active'];
}
