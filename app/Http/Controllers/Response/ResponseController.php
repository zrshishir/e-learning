<?php

namespace App\Http\Controllers\Response;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\HelperController;
use App\Model\BasicTable\Response;
use App\Model\BasicTable\Question;
use App\Model\BasicTable\UserCourse;
use Auth, Validator, DB;

class ResponseController extends Controller
{
    private $helping = "";
    

    public function __construct(){
        $this->helping = new HelperController();
    }

    public function index(){
        $userId = Auth::user()->id;
        $datas = DB::table('user_courses')
                        ->leftJoin('courses', 'user_courses.course_id', '=', 'courses.id')
                        ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')
                        ->where('user_courses.user_id', $userId)
                        ->select('lessons.*')
                        ->get();
        
    	if(count($datas) > 0){
            return response()->json($this->helping->indexData(['lessons'=>$datas]));
        }else{
            $responseData = $this->helping->responseProcess(1, 200, "You have not assigned a course yet, please take courses.", "");
            return response()->json($responseData); 
        } 
    }

    public function question($id){
        $lessonId = $id;
        $userId = Auth::user()->id;

        $dts = DB::table('questions')
                
                ->join('responses', function($join) use($lessonId)
                {
                    $join->on('questions.id', '!=', 'responses.question_id')->where('questions.lesson_id', $lessonId);
                })
                ->select('questions.*')
                ->get();
return response()->json($dts);
        $questions = DB::table('questions')
                                ->leftJoin('responses', 'questions.id', '!=', 'responses.question_id')
                                ->where('questions.lesson_id', $lessonId)
                                ->select('questions.id', 'questions.question', 'questions.option1', 'questions.option2', 'questions.option3', 'questions.option4')
                                ->get();
        
        $datas = DB::table('user_courses')
                                ->leftJoin('courses', 'user_courses.course_id', '=', 'courses.id')
                                ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')
                                ->where('user_courses.user_id', $userId)
                                ->select('lessons.*')
                                ->get();
        
    	if(count($questions) > 0){
            return response()->json($this->helping->indexData(['questions' => $questions, 'lessons' => $datas]));
        }else{
            $responseData = $this->helping->responseProcess(1, 200, "You have answered all the questions, please select a different lesson or assign to new course.", "");
            return response()->json($responseData); 
        } 
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
                'question_id' => 'required|numeric',
                'response' => 'required|string',
            ]);
            
        if($validator->fails()){
        	$errorMsg = null;

            $errors = $validator->errors();
            
            foreach ($errors->all() as $msg) {
                $errorMsg .= $msg;
            }
            return response()->json($this->helping->validatingErrors($errorMsg));
        }
        $answer = Question::find($request->question_id)->correct_option;
        // return response()->json($answer);
        if(! $request->id){
            $dtExist = Response::where('question_id', $request->question_id)->where('response', $request->response)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }

            try {
                DB::beginTransaction();
    
                Response::create([
                    'user_id' => Auth::user()->id,
                    'question_id' => $request->question_id,
                    'response' => $request->response,
                    'right_wrong' => ($answer == $request->response) ? 1 : 0,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Response::get();
                return response()->json($this->helping->savingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        // }else{

        // 	$dtExist = Response::find($request->id);
        	
        // 	if(! $dtExist){
        //     	return response()->json($this->helping->invalidEditId());
        //     }
            
        //     $dtExist = Response::where('question_id', $request->question_id)->where('response', $request->response)->first();
        
        //     if(! is_null($dtExist)){
        //         return response()->json($this->helping->existData());
        //     }
            
        //     try {
        //         DB::beginTransaction();
    
        //         Response::where('id', $request->id)->update([
        //             'user_id' => Auth::user()->id,
        //             'course_id' => $request->course_id,
        //             'name' => $request->name,
        //             'active' => 1
        //         ]);
    
        //         DB::commit();
        //         $bug = 0;
        //     } catch (Exception $e){
        //         DB::rollback();
        //         $bug = $e->errorInfo[1];
        //     }
        //     if($bug == 0){
        //         $datas = Response::get();
        //         return response()->json($this->helping->savingData($datas));
        //     } elseif($bug == 1062){
        //         $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
        //         return response()->json($responseData); 
        //     }else{
        //         $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
        //         return response()->json($responseData);
        //     }
        }
    }

     public function delete($id){
        if($id){
            if(! is_numeric($id)){
                return response()->json($this->helping->notNumeric());
            }
   
            $dbData = Response::find($id);
    
            if(! $dbData){
                return response()->json($this->helping->noContent());
            }

            try {
                DB::beginTransaction();
                Response::where('id', $id)->delete();
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Response::get();
                return response()->json($this->helping->deletingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }

        $datas = Response::get();
        return response()->json($this->helping->invalidDeleteId($datas));
    }
}
