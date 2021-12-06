<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::orderBy('tanggal_pengantaran', 'DESC')
            ->latest('id')->paginate(25);

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
        $request->validate([
            'driver_id' => 'required',
            'vehicle_id' => 'required',
            'tanggal_pengantaran' => 'required',
            'jam_berangkat' => 'required',
            'sales_transaction_id' => 'required',
        ]);        

        $delivery = new Delivery;
        $delivery->driver_id = $request->driver_id;
        $delivery->vehicle_id = $request->vehicle_id;
        $delivery->tanggal_pengantaran = $request->tanggal_pengantaran;
        $delivery->jam_berangkat = $request->jam_berangkat;
        $delivery->jam_diterima = $request->jam_diterima;

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
        $vehicles = Vehicle::all()->pluck('jenis_kendaraan','id');

        return view('admin.delivery.edit', compact('delivery', 'drivers', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);

        $request->validate([
            'driver_id' => 'required',
            'vehicle_id' => 'required',
            'tanggal_pengantaran' => 'required',
            'jam_berangkat' => 'required'
        ]);        

        $delivery->driver_id = $request->driver_id;
        $delivery->vehicle_id = $request->vehicle_id;
        $delivery->tanggal_pengantaran = $request->tanggal_pengantaran;
        $delivery->jam_berangkat = $request->jam_berangkat;
        $delivery->jam_diterima = $request->jam_diterima;

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
