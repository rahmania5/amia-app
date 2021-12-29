<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryDetail;
use App\Models\Delivery;
use App\Models\SalesTransactionDetail;
use App\Models\SalesTransaction;
use App\Models\ProductReturnDetail;
use Illuminate\Http\Request;

class DeliveryDetailController extends Controller
{
    public function index($id, $action=null)
    {
        $delivery = Delivery::findOrFail($id);
        $deliveryDetails = DeliveryDetail::where('delivery_id', $id)
            ->join('sales_transaction_details', 'sales_transaction_details.id', '=', 'delivery_details.sales_transaction_detail_id')
            ->select('delivery_details.*')
            ->orderBy('goods_id')->paginate(10);

        $printDeliveryDetails = DeliveryDetail::where('delivery_id', $id)
            ->join('sales_transaction_details', 'sales_transaction_details.id', '=', 'delivery_details.sales_transaction_detail_id')
            ->select('delivery_details.*')
            ->orderBy('goods_id')->get();

        // to get sales transaction ID
        $deliveryDetail = $deliveryDetails->first();
        $salesTransactionId = $deliveryDetail->sales_transaction_detail->sales_transaction_id;
        $salesTransaction = SalesTransaction::findOrfail($salesTransactionId);

        // to get return data
        $returnDetails = ProductReturnDetail::join('sales_transaction_details', 'sales_transaction_details.id', '=', 'product_return_details.sales_transaction_detail_id')
            ->join('product_returns', 'product_returns.id', '=', 'product_return_details.product_return_id')
            ->where('sales_transaction_id', $salesTransactionId)
            ->where('status_return', 'Diterima')
            ->get();

        // $goods = SalesTransactionDetail::join('goods', 'goods.id', 'sales_transaction_details.goods_id')
        //     ->where('sales_transaction_id', $salesTransactionId)
        //     ->pluck('nama_barang','goods.id');

        if ($action == 'printSurat') {
            return view('admin.delivery.printSurat', compact('delivery', 'printDeliveryDetails', 'salesTransaction', 'returnDetails'));
        } else if ($action == 'show'){
            return view('admin.delivery.show', compact('delivery', 'deliveryDetails', 'salesTransaction', 'salesTransactionId'));
        }
    }

    public function edit($id)
    {
        $deliveryDetail = DeliveryDetail::findOrFail($id);

        return view('admin.delivery.editItem', compact('deliveryDetail'));
    }

    public function update(Request $request, $id)
    {
        $deliveryDetail = DeliveryDetail::findOrFail($id);

        $request->validate([
            'qty_barang_dikirim' => 'required'
        ]);      

        $deliveryDetail->qty_barang_dikirim = $request->qty_barang_dikirim;

        if ($request->qty_barang_dikirim > $deliveryDetail->sales_transaction_detail->qty) {
            return redirect()->route('delivery.editItem', $deliveryDetail->id)
                ->with('error', 'Please enter a valid quantity for the delivered items.');
        } else {
            $deliveryDetail->save();

            return redirect()->route('delivery.show', 
                ['id'=>$deliveryDetail->delivery_id, 'action'=>'show'])
                ->with('success', 'Item updated successfully.');
        }
    }

    public function destroy($id)
    {
        $deliveryDetail = DeliveryDetail::findOrFail($id);
        $deliveryDetail->delete();

        return redirect()->route('delivery.show', 
            ['id'=>$deliveryDetail->delivery_id, 'action'=>'show'])
            ->with('success', 'Item removed successfully.');
    }
}
