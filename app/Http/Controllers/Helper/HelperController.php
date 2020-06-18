<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Transaction\Transaction;
use App\Model\Settings\ActivityLog;
use App\User;
use Schema, DB, Auth;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class HelperController extends Controller
{
    private $agent;

    public function __construct(){
        $this->agent = new Agent();
    }

    public function noContent(){
        return $this->responseProcess(0, 204, "No Content", "");
    }

    public function indexData($datas){
        return $this->responseProcess(0, 200, "Datas...", $datas);
    }

    public function validatingErrors($errorMsg){
        return $this->responseProcess(1, 422, $errorMsg, "");
    }

    public function invalidEditId(){
        return $this->responseProcess(1, 403, "Invalid id.", "");
    }

    public function savingData($datas){
        return $this->responseProcess(0, 201, "Data has been saved.", $datas);
    }

    public function serverError(){
        return $this->responseProcess(1, 500, "Internal Server Error.", "");
    }

    public function notNumeric(){
        return $this->responseProcess(1, 403, "The id should be a number.", "");
    }

    public function deletingData($datas){
        return $this->responseProcess(0, 200, "Data has been deleted successfully.", $datas);
    }

    public function invalidDeleteId($datas){
        return $this->responseProcess(1, 400, "Please give a valid id.", $datas);
    }

    public function invalidLogin($message){
        return $this->responseProcess(1, 401, $message, "");
    }

    public function loggedIn($datas){
        return $this->responseProcess(0, 200, "You are logged in...", $datas);
    }

    public function existData(){
        return $this->responseProcess(1, 400, "You have already provided this data.", "");
    }


    public function responseProcess($errorCode, $statusCode, $msg, $data){
        $responseData['error'] = $errorCode; 
        $responseData['statusCode'] = $statusCode;
        $responseData['errorMsg'] = $msg;
        $responseData['data'] = $data ;
        
        $this->activityLogStorage($errorCode, $statusCode, $msg, Auth::user(), $data);

        return $responseData;
    }
    //activity logs

    public function activityLogStorage($errorCode, $statusCode, $msg, $user, $data){

        $route = \Route::current();
        $platform = $this->agent->platform();
        $brows = $this->agent->browser();
        $robo = $this->agent->robot();
        $dev = $this->agent->device();
        $logs = ActivityLog::create([
                'action_type' => $_SERVER['REQUEST_METHOD'],
                'request_url' => $_SERVER['REQUEST_URI'],
                'os' => ($platform) ? $platform . ", Version: " . $this->agent->version($platform): $_SERVER['HTTP_USER_AGENT'],
                'browser' => ($brows) ? $brows. "( " . $this->agent->version($brows) . " )" : "",
                'robot' => ($robo) ? $robo. "( " . $this->agent->version($robo) . " )" : "",
                'device' => $dev,
                'ip' => $_SERVER['REMOTE_ADDR'] . ":" . $_SERVER['REMOTE_PORT'],
                'function_to_hit' => $route->action['controller'],
                'user_id' => ($user) ? $user->id : "",
                'error_code' => $errorCode,
                'status_code' => $statusCode,
                'response_message' => $msg, 
                // 'response_data' => json_encode($data)
        ]);

        return true;
    }


    public function storingFunction(Request $request){
        $input = $request->all();
        $routeName = Route::currentRouteName();
        $routeUri = Route::getCurrentRoute()->uri();
        try {
            DB::beginTransaction();

            Model::create($input);

            DB::commit();
            $bug = 0;
        } catch (Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
        }

        if($bug == 0){
            return response()->json('success');//success
        } elseif($bug == 1062){
            $res = 'Data is found duplicate';
        }else{
            $res = 'something went wrong';
        }
    }


    public function definingUser($routePath, $userType){
       
        if($routePath == 'api/investor' && $userType == 5){
            return true;
        }elseif ($routePath == 'api' && $userType == 4) {
            return true;
        }elseif ($routePath == 'api/shadhin' && $userType == 1) {
            return true;
        }else{
            return false;
        }
    }

    public function minusCheck($vlaue){
        if($vlaue == -1){
            return true;
        }else{
            return false;
        }
    }

    public function phoneValidation($phone){
        $totalDigit = strlen($phone);
        $firstThreeDigit = substr($phone, 0, 3);
        $firstDigit = substr($phone, 0, 1);

        if(($totalDigit == 11) && ($firstDigit == 0) && ($firstThreeDigit == '019' || $firstThreeDigit == '018' || $firstThreeDigit == '017' || $firstThreeDigit == '016' || $firstThreeDigit == '015' || $firstThreeDigit == '014' || $firstThreeDigit == '013')){
            return true;
        }else{
            return false;
        }
       
    }
}
