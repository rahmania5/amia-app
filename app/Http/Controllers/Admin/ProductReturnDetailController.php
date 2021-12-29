<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReturnDetail;
use App\Models\ProductReturn;
use App\Models\SalesTransaction;
use App\Models\SalesTransactionDetail;
use App\Models\Distributor;
use Illuminate\Http\Request;

class ProductReturnDetailController extends Controller
{
    public function index($id, $salesTransactionId)
    {
        $return = ProductReturn::findOrFail($id);
        $returnDetails = ProductReturnDetail::where('product_return_id', $id)
            ->join('sales_transaction_details', 'sales_transaction_details.id', '=', 'product_return_details.sales_transaction_detail_id')
            ->select('product_return_details.*')
            ->orderBy('goods_id')->paginate(10);
        
        $salesTransaction = SalesTransaction::findOrFail($salesTransactionId);
        $goods = SalesTransactionDetail::join('goods', 'goods.id', 'sales_transaction_details.goods_id')
            ->where('sales_transaction_id', $salesTransactionId)
            ->pluck('nama_barang','goods.id');

        return view('admin.productReturn.show', compact('return', 'returnDetails', 'salesTransaction', 'goods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty_return' => 'required',
            'alasan_return' => 'required',
        ]);      

        $returnDetail = new ProductReturnDetail;
        $salesDetailId = SalesTransactionDetail::where('goods_id', $request->goods_id)
            ->where('sales_transaction_id', $request->sales_transaction_id)->value('id');
        
        $returnDetail->sales_transaction_detail_id = $salesDetailId;
        $returnDetail->product_return_id = $request->product_return_id;
        $returnDetail->qty_return = $request->qty_return;
        $returnDetail->alasan_return = $request->alasan_return;

        $return = ProductReturn::findOrFail($request->product_return_id);
        if ($request->qty_return > $returnDetail->sales_transaction_detail->qty) {
            return redirect()->route('admin.return.show', [$return->id, $request->sales_transaction_id])
                ->with('error', 'Please enter a valid quantity for the returned items.');
        } else {
            if ($returnDetail->save()) {
                $return->total_return = $return->total_return + 
                ($returnDetail->qty_return * $returnDetail->sales_transaction_detail->goods->harga_barang);
                $return->save();
            }
        }

        return redirect()->route('admin.return.show', [$return->id, $request->sales_transaction_id])
            ->with('success', 'Item added successfully.');
    }

    public function submitReturn($id)
    {
        $return = ProductReturn::findOrFail($id);
        $return->status_return = "Diajukan";
        $return->save();

        return redirect()->route('admin.return.index')->with('success', 'Return submitted successfully.');
    }

    public function declineReturn($id, Request $request)
    {
        $return = ProductReturn::findOrFail($id);
        $return->status_return = 'Ditolak';
        $return->keterangan = $request->keterangan;
        $return->save();

        return redirect()->route('admin.return.index')->with('success', 'Product return declined successfully.');
    }
    
    public function confirmReturn($id, $salesTransactionId)
    {
        $return = ProductReturn::findOrFail($id);
        $salesTransaction = SalesTransaction::findOrFail($salesTransactionId);

        $distributor = Distributor::findOrFail($salesTransaction->distributor_id);
        
        if ($salesTransaction->sisa_utang > 0) {
            $salesTransaction->total_transaksi = $salesTransaction->total_transaksi - $return->total_return;
            $salesTransaction->sisa_utang = $salesTransaction->sisa_utang - $return->total_return;
            $salesTransaction->save();
        } else {
            $distributor->sisa_uang_return = $distributor->sisa_uang_return + $return->total_return;
            $distributor->save();
        }

        $return->status_return = 'Diterima';
        $return->save();

        return redirect()->route('admin.return.index')->with('success', 'Product return confirmed successfully.');
    }

    public function destroy($id)
    {
        $returnDetail = ProductReturnDetail::findOrFail($id);
        $return = ProductReturn::findOrFail($returnDetail->product_return_id);

        $return->total_return = $return->total_return - 
            ($returnDetail->qty_return * $returnDetail->sales_transaction_detail->goods->harga_barang);
        $return->save();
        $returnDetail->delete();

        return redirect()->route('admin.return.show', [$return->id, $returnDetail->sales_transaction_detail->sales_transaction_id])
            ->with('success', 'Item removed successfully.');
    }
}
