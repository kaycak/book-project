<?php

namespace Admin\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request, Guard $auth)
    {
        if($auth->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('/books')->withSuccess('You has been successfully logged in.');
        }
        return redirect()->back()->withInput()->withError(trans('auth.failed'));
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function logout(Guard $auth)
    {
        if ($auth->logout()) {
            return guest('login')->withSuccess('You has been successfully logged out.');
        }
        return redirect('/');
    }
}