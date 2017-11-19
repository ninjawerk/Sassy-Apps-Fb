<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        if (Auth::guest()) {
            $urlaction = Input::get('url');

            if(Input::has('url')){
                Session::put('urlintented',  $urlaction);
            }
            else{
                $prevUrl = URL::previous() ;
                Session::put('prevurl', $prevUrl);
            }
            Session::save();

            return Socialite::driver('facebook')->redirect();
        } else {
            $url = Input::get('url');
            return redirect('/' . $url);
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $iurl = Session::get('urlintented');
        $hasurl=Session::has('urlintented');
        $purl = Session::get('prevurl');

        $user = Socialite::driver('facebook')->user();
        $authUser = $this->findOrCreateUser($user, 'facebook');
        Auth::login($authUser, true);



        if($hasurl){
            Log::info("Logging one variable: " . $iurl);
            return redirect(  $iurl);
        }else{
            return redirect($purl);
        }

    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->email)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'username' => $user->name,
            'email' => $user->email,
            'fbid' => $user->id,
        ]);
    }
}
