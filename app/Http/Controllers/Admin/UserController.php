<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Distributor;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role', 'DESC')->orderBy('name')->paginate(15);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = ['Admin'=>'Admin', 'Manager'=>'Manager'];
        
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required'
        ]);

    	$user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();
            
        return redirect()->route('user.index')->with('success', 'Data created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->role != 'Distributor') {
            $roles = ['Admin'=>'Admin', 'Manager'=>'Manager'];

            return view('admin.user.edit', compact('user', 'roles'));
        } else {
            $distributor = Distributor::where('user_id', $id)->first();
            $provinces = Province::all()->pluck('nama_provinsi','id');
            
            return view('admin.user.edit', compact('user', 'distributor', 'provinces'));
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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($user->role == 'Distributor') {
            $distributor = Distributor::where('user_id', $id)->first();

            $request->validate([
                'nik'=>'required',
                'district_id'=>'required',
                'alamat'=>'required',
                'no_telepon'=>'required'
            ]);

            $distributor->nik = $request->nik;
            if (!is_int($request->district_id)) {
                $district_id = District::where('nama_kecamatan', $request->district_id)->value('id');
                $distributor->district_id = $district_id;
            } else {
                $distributor->district_id = $request->district_id;
            }
            $distributor->alamat = $request->alamat;
            $distributor->no_telepon = $request->no_telepon;

            if ($user->save() && $distributor->save()) {
                return redirect()->route('user.show', $id)->with('success', 'Data updated successfully.');
            }
        } else {
            if ($user->save()) {
                return redirect()->route('user.index')->with('success', 'Data updated successfully.');
            }
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $distributor = Distributor::where('user_id', $id)->first();

        $salesTransactions = SalesTransaction::join('distributors', 'distributors.id', 'sales_transactions.distributor_id')
            ->where('user_id', $id)
            ->get();
        if ($user->role == "Distributor") {
            if (!$salesTransactions->isEmpty()) {
                return redirect()->route('user.index')
                    ->with('error', "Data cannot be deleted because it's being referenced by other data.");
            } else {
                $distributor->delete();
                $user->delete();
                return redirect()->route('user.index')->with('success', 'Data deleted successfully.');    
            }
        } else {
            $user->delete();
                return redirect()->route('user.index')->with('success', 'Data deleted successfully.');
        }
    }
}
