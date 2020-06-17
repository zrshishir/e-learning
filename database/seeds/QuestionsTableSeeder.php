<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Model\BasicTable\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Question::insert([
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question1', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question2', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question3', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question4', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question5', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question6', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question7', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question8', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question9', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>1, 'question'=>'lesson1question10', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],

            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question1', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question2', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question3', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question4', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question5', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question6', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question7', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question8', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question9', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>2, 'question'=>'lesson2question10', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],

            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question1', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question2', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question3', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question4', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question5', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question6', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question7', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question8', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question9', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>3, 'question'=>'lesson3question10', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],

            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question1', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question2', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question3', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question4', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question5', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question6', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question7', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question8', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question9', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>4, 'question'=>'lesson4question10', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],

            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question1', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question2', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question3', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question4', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question5', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question6', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question7', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt3'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question8', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt4'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question9', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt1'],
            ['user_id'=>1, 'lesson_id'=>5, 'question'=>'lesson5question10', 'active'=>1, 'option1'=>'opt1', 'option2'=>'opt2', 'option3'=>'opt3', 'option4'=>'opt4', 'correct_option'=>'opt2'],
        ]);
    }
}
