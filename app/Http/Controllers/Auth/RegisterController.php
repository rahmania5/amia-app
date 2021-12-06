<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Foundation\Auth\RegistersUsers;
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

    public function index()
    {
        $provinces = Province::all()->pluck('nama_provinsi','id');
        
        return view('auth.register', compact('provinces'));
    }

    public function cities($province_id)
    {
        $cities = City::where('province_id', $province_id)->pluck('nama_kab_kota', 'cities.id');

        return json_encode($cities);
    }

    public function districts($city_id)
    {
        $districts = District::where('city_id', $city_id)->pluck('nama_kecamatan', 'districts.id');

        return json_encode($districts);
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
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:distributors'],
            'district_id' => ['required'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->distributor()->create([
            'nik' => $data['nik'],
            'user_id' => $user->id,
            'district_id' => $data['district_id'],
            'alamat' => $data['alamat'],
            'no_telepon' => $data['no_telepon']
        ]);

        return $user;
    }
}
