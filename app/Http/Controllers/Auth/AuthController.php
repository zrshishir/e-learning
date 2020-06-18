<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helper\HelperController;
use Validator, DB;
use App\User;

class AuthController extends Controller
{
    private $helping = "";

    public function __construct(Request $request){
        $this->helping = new HelperController();
    }

    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        
        if($validator->fails()){
            $errors = $validator->errors();
            $errorMsg = "";

            foreach ($errors->all() as $msg) {
                $errorMsg .= $msg;
            }

            $responseData = $this->helping->responseProcess(1, 422, $errorMsg, "");

            return response()->json($responseData);
        }

        try {
            DB::beginTransaction();

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'active'=>1,
                'user_type_id' => 1
            ]);
    
            $user->save();

            DB::commit();
            $bug = 0;
        } catch (Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
        }
        
        if($bug == 0){
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $user['api_token'] = $success['token'];
                $user['token_type'] = "Bearer";
                
                $responseData = $this->helping->responseProcess(0, 200, "Your are logged in", ['users' => $user]);
                return response()->json($responseData); 
            } 
            else{ 
                $responseData = $this->helping->responseProcess(1, 401, "You have entered an incorrect Phone No/Password combination.", "");
                return response()->json($responseData); 
            } 
        } elseif($bug == 1062){
            $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
            return response()->json($responseData); 
        }else{
            $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
            return response()->json($responseData);
            $res = 'something went wrong';
        }
    }

    public function login(Request $request){ 
        $user = User::where('email', $request->email)->first();
        if(! $user){
            $responseData = $this->helping->responseProcess(1, 401, "User does not exist. Please Sign Up.", "");
            return response()->json($responseData);
        }
       
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 

            $user = Auth::user(); 

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user['api_token'] = $success['token'];
            $user['token_type'] = "Bearer";

            $responseData = $this->helping->responseProcess(0, 200, "Your are logged in", [
                'users' => $user
            ]);

            return response()->json($responseData); 
        } 
        else{ 
            $responseData = $this->helping->responseProcess(1, 401, "incorrect Password", "");
            return response()->json($responseData); 
        } 
    }

    public function logout(Request $request)
    {
        $loggedInChecked = Auth::check();
      
        $request->user()->token()->revoke();
        $responseData = $this->helping->responseProcess(0, 200, "Successfully logged out", "");
        return response()->json($responseData);
    }
}
