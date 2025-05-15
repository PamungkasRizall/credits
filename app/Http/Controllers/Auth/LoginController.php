<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';///RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest:visitor')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showAdminLoginForm()
    {
        return view('auth.login-visitor');
    }

    // public function visitorLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email'   => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if (Auth::guard('visitor')->attempt($request->only(['email','password']), $request->get('remember')))
    //     {
    //         return redirect()->route('visitor.home');
    //     }

    //     return back()->withInput($request->only('email', 'remember'));
    // }

    // public function logout(Request $request)
    // {
    //     $redirectTo = (Auth::guard('visitor')->check()) ? 'visitor.login' : 'login';

    //     $this->guard()->logout();

    //     $request->session()->flush();

    //     $request->session()->regenerate();

    //     return redirect()->route($redirectTo);
    // }

    public function index()
    {
        return view('errors.404');
    }
}
