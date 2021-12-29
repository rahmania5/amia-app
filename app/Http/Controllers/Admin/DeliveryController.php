<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $deliveries = Delivery::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('tanggal_pengantaran', 'like', "%{$request->keyword}%");
        })->orderBy('tanggal_pengantaran', 'DESC')->latest('id')->paginate(25);
    
        $deliveries->appends($request->only('keyword'));

        return view('admin.delivery.index', compact('deliveries'));
    }

    public function create($id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);
        $drivers = Driver::all()->pluck('nama_driver','id');
        $vehicles = Vehicle::all()->pluck('no_polisi','id');

        return view('admin.delivery.create', compact('salesTransaction', 'drivers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $delivery = new Delivery;
        $driverId = $delivery->driver_id = $request->driver_id;
        $vehicleId = $delivery->vehicle_id = $request->vehicle_id;
        $tanggal = $delivery->tanggal_pengantaran = $request->tanggal_pengantaran;
        $jamBerangkat = $delivery->jam_berangkat = $request->jam_berangkat;
        $delivery->jam_diterima = $request->jam_diterima;

        $request->validate([
            'driver_id' => [
                'required',
                Rule::unique('deliveries')->where(function ($query) use($driverId, $tanggal, $jamBerangkat) {
                    return $query->where('driver_id', $driverId)
                    ->where('tanggal_pengantaran', $tanggal)
                    ->where('jam_berangkat', $jamBerangkat);
                }),
            ],
            'vehicle_id' => [
                'required',
                Rule::unique('deliveries')->where(function ($query) use($vehicleId, $tanggal, $jamBerangkat) {
                    return $query->where('vehicle_id', $vehicleId)
                    ->where('tanggal_pengantaran', $tanggal)
                    ->where('jam_berangkat', $jamBerangkat);
                }),
            ],
            'tanggal_pengantaran' => 'required',
            'jam_berangkat' => 'required',
            'sales_transaction_id' => 'required',
        ],
        [
            'driver_id.unique' => 'You cannot input the same driver at the same leaving time.',
            'vehicle_id.unique' => 'You cannot input the same vehicle at the same leaving time.'
        ]);        

        $salesTransaction = SalesTransaction::findOrFail($request->sales_transaction_id);
        $salesTransactionDetails = $salesTransaction->sales_transaction_detail()->get();

        if ($delivery->save()) {
            foreach ($salesTransactionDetails as $std) {
                $deliveryDetail = new DeliveryDetail;
                $deliveryDetail->delivery_id = $delivery->id;
                $deliveryDetail->sales_transaction_detail_id = $std->id;
                $deliveryDetail->qty_barang_dikirim = $std->qty;
                $deliveryDetail->save();
            }
        }

        return redirect()->route('delivery.show', ['id'=>$delivery->id, 'action'=>'show'])
            ->with('success', 'Data created successfully. Please modify items that will be delivered first.');
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        $drivers = Driver::all()->pluck('nama_driver','id');
        $vehicles = Vehicle::all()->pluck('no_polisi','id');

        return view('admin.delivery.edit', compact('delivery', 'drivers', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);        

        $driverId = $delivery->driver_id = $request->driver_id;
        $vehicleId = $delivery->vehicle_id = $request->vehicle_id;
        $tanggal = $delivery->tanggal_pengantaran = $request->tanggal_pengantaran;
        $jamBerangkat = $delivery->jam_berangkat = $request->jam_berangkat;
        $delivery->jam_diterima = $request->jam_diterima;

        $request->validate([
            'driver_id' => [
                'required',
                Rule::unique('deliveries')->where(function ($query) use($driverId, $tanggal, $jamBerangkat) {
                    return $query->where('driver_id', $driverId)
                    ->where('tanggal_pengantaran', $tanggal)
                    ->where('jam_berangkat', $jamBerangkat);
                })->ignore($id),
            ],
            'vehicle_id' => [
                'required',
                Rule::unique('deliveries')->where(function ($query) use($vehicleId, $tanggal, $jamBerangkat) {
                    return $query->where('vehicle_id', $vehicleId)
                    ->where('tanggal_pengantaran', $tanggal)
                    ->where('jam_berangkat', $jamBerangkat);
                })->ignore($id),
            ],
            'tanggal_pengantaran' => 'required',
            'jam_berangkat' => 'required'
        ],
        [
            'driver_id.unique' => 'You cannot input the same driver at the same leaving time.',
            'vehicle_id.unique' => 'You cannot input the same vehicle at the same leaving time.'
        ]);

        if ($delivery->save()) {
            return redirect()->route('delivery.show', ['id'=>$delivery->id, 'action'=>'show'])
            ->with('success', 'Data updated successfully.');
        }
    }

    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $deliveryDetails = DeliveryDetail::where('delivery_id', $id)->get();

        if (!$deliveryDetails->isEmpty()) {
            return redirect()->route('delivery.index')->with('error', "Data cannot be deleted because it's being referenced by other data.");
        } else {
            $delivery->delete();
            return redirect()->route('delivery.index')->with('success', 'Data deleted successfully.');
        }
    }
}
