<?php

namespace App\Http\Controllers;

use Gate;
use App\Models\User;
use App\Models\Distributor;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        if (auth()->user()->distributor) {
            $distributor = Distributor::where('user_id', auth()->user()->id)->first();
            $provinces = Province::all()->pluck('nama_provinsi','id');
            $countLoan = $distributor->sales_transaction()
                ->where('jenis_pembayaran', 'Utang')
                ->where('status', 'Selesai')
                ->count();
    
            return view('profile.edit', compact('provinces', 'countLoan'));
        } else {
            return view('profile.edit');
        }
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
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        
        if (auth()->user()->distributor) {
            $distributor = Distributor::where('user_id', auth()->user()->id)->first();
            $distributor->nik = $request->nik;
            if (!is_int($request->district_id)) {
                $district_id = District::where('nama_kecamatan', $request->district_id)->value('id');
                $distributor->district_id = $district_id;
            } else {
                $distributor->district_id = $request->district_id;
            }
            $distributor->alamat = $request->alamat;
            $distributor->no_telepon = $request->no_telepon;
            $distributor->update();
        }

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
