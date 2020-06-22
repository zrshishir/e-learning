<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Helper\HelperController;
use App\Model\BasicTable\Course;
use Auth, Validator, DB;

class CourseController extends Controller
{
    private $helping = "";
    

    public function __construct(){
        $this->helping = new HelperController();
    }

    public function index(): JsonResponse{
    	$datas = Course::get();
        
    	if(! empty($datas)){
            return response()->json($this->helping->indexData($datas));
        }else{
            return response()->json($this->helping->noContent());
        } 
    }

    public function store(Request $request): JsonResponse{

        $validator = Validator::make($request->all(), [
                'name' => 'required|string'
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
            try {
                DB::beginTransaction();
    
                Course::create([
                    'user_id' => Auth::user()->id,
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
                $datas = Course::get();
                return response()->json($this->helping->savingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }else{

        	$dtExist = Course::find($request->id);
        	
        	if(! $dtExist){
            	return response()->json($this->helping->invalidEditId());
            }
            
            try {
                DB::beginTransaction();
    
                Course::where('id', $request->id)->update([
                    'user_id' => Auth::user()->id,
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
                $datas = Course::get();
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

     public function delete($id): JsonResponse{
        if($id){
            if(! is_numeric($id)){
                return response()->json($this->helping->notNumeric());
            }
   
            $dbData = Course::find($id);
    
            if(! $dbData){
                return response()->json($this->helping->noContent());
            }

            try {
                DB::beginTransaction();
                Course::where('id', $id)->delete();
                DB::commit();
                $bug = 0;
            } catch (Exception $e){
                DB::rollback();
                $bug = $e->errorInfo[1];
            }
            if($bug == 0){
                $datas = Course::get();
                return response()->json($this->helping->deletingData($datas));
            } elseif($bug == 1062){
                $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
                return response()->json($responseData); 
            }else{
                $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
                return response()->json($responseData);
            }
        }

        $datas = Course::get();
        return response()->json($this->helping->invalidDeleteId($datas));
    }
}
