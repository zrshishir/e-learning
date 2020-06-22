<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([],function(){
    Route::post('login', 'Auth\AuthController@login');
    Route::post('signup', 'Auth\AuthController@signup');
    Route::get('unauth', 'Auth\AuthController@unAuthMessage')->name('unauth');

    Route::group(['middleware'=>'auth:api'], function(){
        Route::get('logout', 'Auth\AuthController@logout');//logout 

        //course
        Route::get('course', 'Course\CourseController@index');
        Route::post('course', 'Course\CourseController@store');
        Route::delete('course/{id}', 'Course\CourseController@delete');

        //user-course
        Route::get('user-course', 'UserCourse\UserCourseController@index');
        Route::post('user-course', 'UserCourse\UserCourseController@store');
        Route::delete('user-course/{id}', 'UserCourse\UserCourseController@delete');

        //lesson
        Route::get('lesson', 'Lesson\LessonController@index');
        Route::post('lesson', 'Lesson\LessonController@store');
        Route::delete('lesson/{id}', 'Lesson\LessonController@delete');

        //question
        Route::get('question', 'Question\QuestionController@index');
        Route::post('question', 'Question\QuestionController@store');
        Route::delete('question/{id}', 'Question\QuestionController@delete');

        //response
        Route::get('response', 'Response\ResponseController@index');
        Route::post('response', 'Response\ResponseController@store');
        Route::delete('response/{id}', 'Response\ResponseController@delete');
        Route::get('question/{id}', 'Response\ResponseController@question');

        //user-course
        Route::get('user-course', 'UserCourse\UserCourseController@index');
        Route::post('user-course', 'UserCourse\UserCourseController@store');
        Route::delete('user-course/{id}', 'UserCourse\UserCourseController@delete');

        
    });
});
