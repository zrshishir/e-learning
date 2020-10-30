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
            ['user_id'=>1, 'course_id'=>1, 'name'=>'lesson1', 'active'=>1]
        ]);
    }
}
