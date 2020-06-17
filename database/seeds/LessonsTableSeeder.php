<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Model\BasicTable\Lesson;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Lesson::insert([
            ['user_id'=>1, 'course_id'=>1, 'name'=>'lesson1', 'active'=>1],
            ['user_id'=>1, 'course_id'=>1, 'name'=>'lesson2', 'active'=>1],
            ['user_id'=>1, 'course_id'=>1, 'name'=>'lesson3', 'active'=>1],
            ['user_id'=>1, 'course_id'=>1, 'name'=>'lesson4', 'active'=>1],
            ['user_id'=>1, 'course_id'=>1, 'name'=>'lesson5', 'active'=>1],
            ['user_id'=>1, 'course_id'=>2, 'name'=>'lesson6', 'active'=>1],
            ['user_id'=>1, 'course_id'=>2, 'name'=>'lesson7', 'active'=>1],
            ['user_id'=>1, 'course_id'=>2, 'name'=>'lesson8', 'active'=>1],
            ['user_id'=>1, 'course_id'=>2, 'name'=>'lesson9', 'active'=>1],
            ['user_id'=>1, 'course_id'=>2, 'name'=>'lesson10', 'active'=>1],
            ['user_id'=>1, 'course_id'=>3, 'name'=>'lesson11', 'active'=>1],
            ['user_id'=>1, 'course_id'=>3, 'name'=>'lesson12', 'active'=>1],
            ['user_id'=>1, 'course_id'=>3, 'name'=>'lesson13', 'active'=>1],
            ['user_id'=>1, 'course_id'=>3, 'name'=>'lesson14', 'active'=>1],
            ['user_id'=>1, 'course_id'=>3, 'name'=>'lesson15', 'active'=>1],
        ]);
    }
}
