<?php

namespace App\Http\Controllers;

use App\FbApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AppSplashController extends Controller
{
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
        if ($request->has('appid')) {
            $id = Input::get('appid');
            $app = FbApp::find($id);
            return view('splash',compact('app'));
        }
        return view('home');
    }
}
