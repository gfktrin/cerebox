<?php

namespace Cerebox\Http\Controllers\Auth;

use Cerebox\Http\Controllers\Controller;
use Cerebox\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = 'login-redirect';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToFacebook(){
        return \Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $facebook_user = \Socialite::driver('facebook')->stateless()->user();

        $user = User::where('facebook_id',$facebook_user->id)->get()->first();

        if(is_null($user))
            $user = User::where('email', $facebook_user->email)->get()->first();

        if(!is_null($user))
            $user->facebook_id = $facebook_user->id;
        else
            $user = User::create([
                'name' => $facebook_user->name,
                'email' => $facebook_user->email,
                'facebook_id' => $facebook_user->id
            ]);

        \Auth::login($user);

        return redirect()->action('HomeController@loginRedirect');
    }
}
