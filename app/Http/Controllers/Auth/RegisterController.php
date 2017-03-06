<?php

namespace Cerebox\Http\Controllers\Auth;

use Cerebox\Address;
use Cerebox\Http\Controllers\Controller;
use Cerebox\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;

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
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'nickname' => 'required',
            'phone' => 'required',
            // 'zipcode' => 'required',
            // 'address' => 'required',
            // 'number' => 'required',
            // 'complement' => 'required',
            'city_id' => 'required|exists:cities,id',
            // 'state' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nickname' => $data['nickname'],
            'phone' => $data['phone'],
            'city_id' => $data['city_id']
        ]);

        // $user->address()->create([
        //     'zipcode' => $data['zipcode'],
        //     'address' => $data['address'],
        //     'number' => $data['number'],
        //     'complement' => $data['complement'],
        //     'city' => $data['city'],
        //     'state' => $data['state']
        // ]);

        return $user;
    }
}
