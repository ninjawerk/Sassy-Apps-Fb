<?php

namespace App\Http\Controllers;

use App\AppUserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ResultsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return string
     */
    public function save()
    {
        if (Input::has('appid')) {

            $userid = Auth::user()->id;
            $appid = Input::get('appid');
            $res1 = Input::get('result1', '');
            $res2 = Input::get('result2', '');
            $res3 = Input::get('result3', '');
            $res4 = Input::get('result4', '');
            $existingRes = AppUserResult::where('fbapp_id','=',$appid)->where('user_id','=',$userid)->first();

            if ($existingRes!=null){
                $existingRes->ResultData1 = $res1;
                $existingRes->ResultData2 = $res2;
                $existingRes->ResultData3 = $res3;
                $existingRes->ResultData4 = $res4;
                $existingRes->save();
            }

            $res = new AppUserResult;
            $res->fbapp_id = $appid;
            $res->user_id = $userid;
            $res->ResultData1 = $res1;
            $res->ResultData2 = $res2;
            $res->ResultData3 = $res3;
            $res->ResultData4 = $res4;
            $res->save();
        }

        return 'ok';
    }
}
