<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Helper\HelperController;
use App\Model\BasicTable\Response;
use App\Model\BasicTable\Question;
use App\Model\BasicTable\UserCourse;
use Auth, DB;

class ReportController extends Controller
{
    private $helping = "";
    

    public function __construct(){
        $this->helping = new HelperController();
    }

    public function personalReport(): JsonResponse{
        $userId = Auth::user()->id;
        $totalRes = Response::where('user_id', $userId)
                                ->count();
        $userSpecific = Response::where('user_id', $userId)
                        ->select('right_wrong', DB::raw('count(right_wrong) as total'))
                        ->groupBy('right_wrong')
                        ->get();
        // $systemSpecific = Response::select('right_wrong', DB::raw('count(right_wrong) as total'))
        //                 ->groupBy('right_wrong')
        //                 ->get();
        $reportDetails = Response::with('questions')->where('user_id',$userId)->get();
        if(count($reportDetails) > 0){
            return response()->json($this->helping->indexData(['totalRes'=>$totalRes, 'reports'=>$userSpecific, 'reportDetails'=>$reportDetails]));
        }else{
            $responseData = $this->helping->responseProcess(1, 200, "You have not assigned a course yet, please take courses.", "");
            return response()->json($responseData); 
        } 
    }
}
