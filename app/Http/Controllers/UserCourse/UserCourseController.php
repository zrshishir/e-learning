<?php

namespace App\Http\Controllers\UserCourse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\HelperController;
use App\Model\BasicTable\UserCourse;
use Auth, Validator, DB;

class UserCourseController extends Controller
{
    private $helping = "";
    

    public function __construct(){
        $this->helping = new HelperController();
    }

    public function index(){
    	$datas = UserCourse::get();
        
    	if(! empty($datas)){
            return response()->json($this->helping->indexData($datas));
        }else{
            return response()->json($this->helping->noContent());
        } 
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
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
            $dtExist = UserCourse::where('user_id', $request->user_id)->where('course_id', $request->course_id)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }

            try {
                DB::beginTransaction();
    
                UserCourse::create([
                    'user_id' => $request->user_id,
                    'course_id' => $request->course_id,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = UserCourse::get();
                return response()->json($this->helping->savingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }else{

        	$dtExist = UserCourse::find($request->id);
        	
        	if(! $dtExist){
            	return response()->json($this->helping->invalidEditId());
            }
            
            $dtExist = UserCourse::where('user_id', $request->user_id)->where('course_id', $request->course_id)->first();
        
            if(! is_null($dtExist)){
                return response()->json($this->helping->existData());
            }
            
            try {
                DB::beginTransaction();
    
                UserCourse::where('id', $request->id)->update([
                    'user_id' => $request->user_id,
                    'course_id' => $request->course_id,
                    'active' => 1
                ]);
    
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = UserCourse::get();
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
   
            $dbData = UserCourse::find($id);
    
            if(! $dbData){
                return response()->json($this->helping->noContent());
            }

            try {
                DB::beginTransaction();
                UserCourse::where('id', $id)->delete();
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = UserCourse::get();
                return response()->json($this->helping->deletingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }

        $datas = UserCourse::get();
        return response()->json($this->helping->invalidDeleteId($datas));
    }
}
