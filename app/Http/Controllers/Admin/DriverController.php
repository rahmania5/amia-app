<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('nama_driver')->paginate(15);

        return view('admin.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_driver'=>'required'
        ]);

    	$driver = new Driver;
        $driver->nama_driver = $request->nama_driver;
        $driver->save();
            
        return redirect()->route('driver.index')->with('success', 'Data created successfully.');
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);

        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $request->validate([
            'nama_driver'=>'required'
        ]);

    	$driver->nama_driver = $request->nama_driver;

        if ($driver->save()) {
            return redirect()->route('driver.index')->with('success', 'Data updated successfully.');
        }
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $delivery = Delivery::where('driver_id', $driver->id)->get();

        if (!$delivery->isEmpty()) {
            return redirect()->route('driver.index')
                ->with('error', "Data cannot be deleted because it's being referenced by other data.");
        } else {
            $driver->delete();
            return redirect()->route('driver.index')->with('success', 'Data deleted successfully.');    
        }
    }
}
