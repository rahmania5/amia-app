<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Delivery;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'DESC')->paginate(15);

        return view('admin.vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_polisi'=>'required|unique:vehicles',
            'jenis_kendaraan'=>'required'
        ]);

    	$vehicle = new Vehicle;
        $vehicle->no_polisi = $request->no_polisi;
        $vehicle->jenis_kendaraan = $request->jenis_kendaraan;
        $vehicle->save();
            
        return redirect()->route('vehicle.index')->with('success', 'Data created successfully.');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('admin.vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'no_polisi'=>'required|unique:vehicles,no_polisi,'.$id,
            'jenis_kendaraan'=>'required'
        ]);

        $vehicle->no_polisi = $request->no_polisi;
        $vehicle->jenis_kendaraan = $request->jenis_kendaraan;
        
        if ($vehicle->save()) {
            return redirect()->route('vehicle.index')->with('success', 'Data updated successfully.');
        }
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $delivery = Delivery::where('vehicle_id', $vehicle->id)->get();

        if (!$delivery->isEmpty()) {
            return redirect()->route('vehicle.index')
                ->with('error', "Data cannot be deleted because it's being referenced by other data.");
        } else {
            $vehicle->delete();
            return redirect()->route('vehicle.index')->with('success', 'Data deleted successfully.');    
        }
    }
}
