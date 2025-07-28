<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Socialite;
use Illuminate\Support\Facades\Session;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
{
    if (!Session::isStarted()) {
        Session::start();
    }
    return Socialite::driver('azure')->stateless()->redirect();
}

public function handleProviderCallback()
{
    try {
        if (!Session::isStarted()) {
            Session::start();
        }
        
        $user = Socialite::driver('azure')->stateless()->user();

        Session::put('user', [
            'userName' => $user->getName(),
            'userId' => $user->getId(),
        ]);

        \Log::info('User stored in session: ', Session::get('user'));

        return redirect('/');
        //return $user()->json([]);
    } catch (\Exception $e) {
        \Log::error('Error in handleProviderCallback: ', ['exception' => $e]);
        return $e;
    }
}
}
