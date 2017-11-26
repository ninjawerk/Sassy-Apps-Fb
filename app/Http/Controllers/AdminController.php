<?php

namespace App\Http\Controllers;

use App\FbApp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->fbid == '10215040688036489' ||
            Auth::user()->fbid == '10213410197041305' ||
            Auth::user()->fbid == '1609454522426108'
        ) {

            $userCount = User::all()->count();
            return view('admin', compact('userCount'));
        }

        abort('404');
    }

    public function save(Request $request)
    {
        if (Auth::user()->fbid == '10215040688036489' ||
            Auth::user()->fbid == '10213410197041305' ||
            Auth::user()->fbid == '1609454522426108'
        ) {
            $app = new FbApp();
            $app->name = Input::get('title');
            $app->description = Input::get('desc');
            $app->icon_url = Input::get('iconurl');
            $app->link = '';
            $app->data = Input::get('jsondata');
            $app->og_title_prefix = Input::get('fbsharetitle');
            $app->og_description = Input::get('fbsharedescription');
            $app->retry = Input::has('retry');
            $app->save();
        }
        return redirect('admin');

    }


    public function editIndex(Request $request)
    {
        if (Auth::user()->fbid == '10215040688036489' ||
            Auth::user()->fbid == '10213410197041305' ||
            Auth::user()->fbid == '1609454522426108'
        ) {
            if (Input::has('id'))
                $app = FbApp::find(Input::get('id'));
            return view('adminedit', compact('app'));
        }
        return redirect('admin');

    }

    public function saveEdit(Request $request)
    {
        if (Auth::user()->fbid == '10215040688036489' ||
            Auth::user()->fbid == '10213410197041305' ||
            Auth::user()->fbid == '1609454522426108'
        ) {
            if (Input::has('id'))
            {
                $app = FbApp::find(Input::get('id'));
                $app->name = Input::get('title');
                $app->description = Input::get('desc');
                $app->icon_url = Input::get('iconurl');
                $app->link = '';
                $app->data = Input::get('jsondata');
                $app->og_title_prefix = Input::get('fbsharetitle');
                $app->og_description = Input::get('fbsharedescription');
                $app->retry = Input::has('retry');
                $app->save();
                return redirect('fbapp?appid=' . $app->id );
            }
        }
        abort('404');
    }
}
