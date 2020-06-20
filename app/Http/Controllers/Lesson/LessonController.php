<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\HelperController;
use App\Model\BasicTable\Lesson;
use App\Model\BasicTable\Course;
use Auth, Validator, DB;

class LessonController extends Controller
{
    private $helping = "";
    

    public function __construct(){
        $this->helping = new HelperController();
    }

    public function index(){
        $datas = Lesson::with('course')->get();
        $courses = Course::get();
        
    	if(! empty($datas)){
            return response()->json($this->helping->indexData(['datas' => $datas, 'courses'=>$courses]));
        }else{
            return response()->json($this->helping->noContent());
        } 
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'course_id' => 'required|numeric'
            ]);
            
        if($validator->fails()){
        	$errorMsg = null;

            $errors = $validator->errors();
            
            foreach ($errors->all() as $msg) {
                $errorMsg .= $msg;
            }
            return response()->json($this->helping->validatingErrors($errorMsg));
        }
        
        if(! $request->id){
            $dtExist = Lesson::where('name', $request->name)->where('course_id', $request->course_id)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }

            try {
                DB::beginTransaction();
    
                Lesson::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $request->course_id,
                    'name' => $request->name,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Lesson::with('course')->get();
                $courses = Course::get();
                return response()->json($this->helping->savingData(['datas' => $datas, 'courses'=>$courses]));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }else{

        	$dtExist = Lesson::find($request->id);
        	
        	if(! $dtExist){
            	return response()->json($this->helping->invalidEditId());
            }
            
            $dtExist = Lesson::where('name', $request->name)->where('course_id', $request->course_id)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }
            
            try {
                DB::beginTransaction();
    
                Lesson::where('id', $request->id)->update([
                    'user_id' => Auth::user()->id,
                    'course_id' => $request->course_id,
                    'name' => $request->name,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Lesson::with('course')->get();
                $courses = Course::get();
                return response()->json($this->helping->savingData(['datas' => $datas, 'courses'=>$courses]));
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
   
            $dbData = Lesson::find($id);
    
            if(! $dbData){
                return response()->json($this->helping->noContent());
            }

            try {
                DB::beginTransaction();
                Lesson::where('id', $id)->delete();
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Lesson::with('course')->get();
                $courses = Course::get();
                return response()->json($this->helping->deletingData(['datas' => $datas, 'courses'=>$courses]));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }

        $datas = Lesson::with('course')->get();
        $courses = Course::get();
        return response()->json($this->helping->invalidDeleteId(['datas' => $datas, 'courses'=>$courses]));
    }
}
