<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public $HOME;


    public function __construct()
    {
        $this->HOME = route('index');
    }
    public function login(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|max:255|exists:users,email',
                    'password' => 'required|string',
                ]);
                if ($validator->fails()) {
                    return back()->with('error', $validator->errors()->all());
                }
                $auth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                if ($auth === true) {
                    User::where('id', Auth::user()->id)->update(['last_login' => Carbon::now()]);
                    return redirect()->intended($this->HOME);
                } else {
                    return back()->with('error', 'Invalid username/password.')->withInput();
                }
            case 'GET':
                return view('auth.login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
