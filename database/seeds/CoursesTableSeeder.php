<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Model\BasicTable\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Course::insert([
            ['user_id'=>1, 'name'=>'course1', 'active'=>1],
            ['user_id'=>1, 'name'=>'course2', 'active'=>1],
            ['user_id'=>1, 'name'=>'course3', 'active'=>1]
        ]);
    }
}
