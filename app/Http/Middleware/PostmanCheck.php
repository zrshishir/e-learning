<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class PostmanCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     private $agent;

    public function __construct(){
        $this->agent = new Agent();
    }
    public function handle($request, Closure $next)
    {
        $platform = $this->agent->platform();
        $brows = $this->agent->browser();
        if($platform == "AndroidOS" || $brows){
            return $next($request);
        }

        $responseData['error'] = 1; 
        $responseData['statusCode'] = 400;
        $responseData['errorMsg'] = "Sorry, you are not allowed to access it.";
        $responseData['data'] = "" ;


        return response()->json($responseData);
    }
}
