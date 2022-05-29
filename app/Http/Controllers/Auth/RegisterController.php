<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    public $HOME;


    public function __construct()
    {
        $this->HOME = route('index');
    }

    public function register(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                // $input = $request->all();
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|unique:users,email|string|email|max:255|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/',
                    'password' => 'required|string|min:6|confirmed:password_confirmation',
                    'password_confirmation' => 'required|string|min:6',
                ]);
                if ($validator->fails()) {
                    return back()->with('error', $validator->errors()->all());
                }
                $user_id = User::insertGetId(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'email_verified_at' => Carbon::now(), 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
                if ($user_id) {
                    $auth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                    if ($auth === true) {
                        return redirect()->intended($this->HOME);
                    }
                } else {
                    return back()->with('error', 'Failed to complete registration.')->withInput();
                }
            case 'GET':
                return view('auth.register');
        }
    }
}
