<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

use DB;


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

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerView()
    {
        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user_get = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user = User::findOrFail($user_get->id);
            DB::commit();
            return redirect()->route('registerConfirmed');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('loginView');
        }
    }
    public function registerConfirmed()
    {
        return view('auth.register_confirmed');
    }
}
