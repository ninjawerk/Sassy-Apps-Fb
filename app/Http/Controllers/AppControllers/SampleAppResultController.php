<?php

namespace App\Http\Controllers\AppControllers;

use App\FbApp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SampleAppResultController extends Controller
{
    protected $id = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Input::has('appid')) {
            $id = Input::get('appid');
            $app = FbApp::find($id);
            $appData = $app->data;
            $retry = $app->retry;

            if (Input::has('fbid')) {
                if (Auth::user()->fbid == Input::get('fbid')) {
                    $resultId = Input::get('result', -1);
                    $safeResultId = Input::get('result', 0);
                    return view('fbapp', compact('resultId', 'appData', 'retry', 'app','safeResultId'));
                }
            }
            $resultId = -1;
            $safeResultId = Input::get('result', 0);
            return view('appcontainer', compact('resultId', 'appData', 'retry', 'app','safeResultId'));
        }
        abort('404');

    }
}
