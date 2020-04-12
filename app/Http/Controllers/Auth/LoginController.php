<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {                

        $this->validateLogin($request);

        if(Auth::attempt(['username' =>$request->username, 'password'=>$request->password, 'status' => 1])){
            return redirect()->route('main');
        }

        return back()->withErrors(['user' => trans('auth.failed')])->withInput(request(['username']));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
