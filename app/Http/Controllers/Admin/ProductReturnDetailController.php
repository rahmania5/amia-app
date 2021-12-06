<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReturnDetail;
use App\Models\ProductReturn;
use App\Models\SalesTransaction;
use App\Models\Distributor;
use Illuminate\Http\Request;

class ProductReturnDetailController extends Controller
{
    public function index($id)
    {
        $return = ProductReturn::findOrFail($id);
        $returnDetails = ProductReturnDetail::where('product_return_id', $id)
            ->join('sales_transaction_details', 'sales_transaction_details.id', '=', 'product_return_details.sales_transaction_detail_id')
            ->select('product_return_details.*')
            ->orderBy('goods_id')->paginate(10);

        // to get sales transaction ID
        $returnDetail = $returnDetails->first();
        $salesTransactionId = $returnDetail->sales_transaction_detail->sales_transaction_id;
        
        return view('admin.productReturn.show', compact('return', 'returnDetails', 'salesTransactionId'));
    }

    public function edit($id)
    {
        $returnDetail = ProductReturnDetail::findOrFail($id);

        return view('admin.productReturn.editItem', compact('returnDetail'));
    }

    public function update(Request $request, $id)
    {
        $returnDetail = ProductReturnDetail::findOrFail($id);
        $old_qty = $returnDetail->qty_return;

        $request->validate([
            'qty_return' => 'required',
            'alasan_return' => 'required',
        ]);      

        $returnDetail->qty_return = $request->qty_return;
        $returnDetail->alasan_return = $request->alasan_return;

        $return = ProductReturn::findOrFail($returnDetail->product_return_id);
        if ($request->qty_return > $returnDetail->sales_transaction_detail->qty) {
            return redirect()->route('distributor.return.editItem', $returnDetail->id)
                ->with('error', 'Please enter a valid quantity for the returned items.');
        } else {
            if ($returnDetail->save()) {
                $return->total_return = $return->total_return - 
                ($old_qty * $returnDetail->sales_transaction_detail->goods->harga_barang) +
                ($returnDetail->qty_return * $returnDetail->sales_transaction_detail->goods->harga_barang);
                $return->save();
            }
        }

        return redirect()->route('admin.return.show', [$return->id])
            ->with('success', 'Item updated successfully.');
    }

    public function submitReturn($id)
    {
        $return = ProductReturn::findOrFail($id);
        $return->status_return = "Diajukan";
        $return->save();

        return redirect()->route('admin.return.index')->with('success', 'Return submitted successfully.');
    }

    public function declineReturn($id)
    {
        $return = ProductReturn::findOrFail($id);
        $return->status_return = 'Ditolak';
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

        return redirect()->route('admin.return.show', [$return->id])
            ->with('success', 'Item removed successfully.');
    }
}
