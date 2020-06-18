<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\HelperController;
use App\Model\BasicTable\Question;
use Auth, Validator, DB;

class QuestionController extends Controller
{
    private $helping = "";
    

    public function __construct(){
        $this->helping = new HelperController();
    }

    public function index(){
    	$datas = Question::get();
        
    	if(! empty($datas)){
            return response()->json($this->helping->indexData($datas));
        }else{
            return response()->json($this->helping->noContent());
        } 
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
                'lesson_id' => 'required|numeric',
                'question' => 'required|string',
                'option1'=> 'required|string',
                'option2'=> 'required|string',
                'option3'=> 'required|string',
                'option4'=> 'required|string',
                'correct_option'=> 'required|string'
            ]);
            
        if($validator->fails()){
        	$errorMsg = null;

            $errors = $validator->errors();
            
            foreach ($errors->all() as $msg) {
                $errorMsg .= $msg;
            }
            return response()->json($this->helping->validatingErrors($errorMsg));
        }

        $totalQuestion = Question::where('lesson_id', $request->lesson_id)->where('question', $request->question)->count();
        
        if($totalQuestion > 10){
            $responseData = $this->helping->responseProcess(1, 200, "you have enlisted 10 questions already.", "");
            return response()->json($responseData);
        }

        if(! $request->id){
            $dtExist = Question::where('lesson_id', $request->lesson_id)->where('question', $request->question)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }

            try {
                DB::beginTransaction();
    
                Question::create([
                    'user_id' => Auth::user()->id,
                    'lesson_id' => $request->lesson_id,
                    'question' => $request->question,
                    'option1' => $request->option1,
                    'option2' => $request->option2,
                    'option3' => $request->option3,
                    'option4' => $request->option4,
                    'correct_option' => $request->correct_option,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Question::get();
                return response()->json($this->helping->savingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }else{

        	$dtExist = Question::find($request->id);
        	
        	if(! $dtExist){
            	return response()->json($this->helping->invalidEditId());
            }
            
            $dtExist = Question::where('lesson_id', $request->lesson_id)->where('question', $request->question)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }
            
            try {
                DB::beginTransaction();
    
                Question::where('id', $request->id)->update([
                    'user_id' => Auth::user()->id,
                    'lesson_id' => $request->lesson_id,
                    'question' => $request->question,
                    'option1' => $request->option1,
                    'option2' => $request->option2,
                    'option3' => $request->option3,
                    'option4' => $request->option4,
                    'correct_option' => $request->correct_option,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Question::get();
                return response()->json($this->helping->savingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }
    }

     public function delete($id){
        if($id){
            if(! is_numeric($id)){
                return response()->json($this->helping->notNumeric());
            }
   
            $dbData = Question::find($id);
    
            if(! $dbData){
                return response()->json($this->helping->noContent());
            }

            try {
                DB::beginTransaction();
                Question::where('id', $id)->delete();
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Question::get();
                return response()->json($this->helping->deletingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }

        $datas = Question::get();
        return response()->json($this->helping->invalidDeleteId($datas));
    }
}
