<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesTransactionDetail;
use App\Models\SalesTransaction;
use App\Models\Goods;
use App\Models\Distributor;
use Illuminate\Http\Request;

class SalesTransactionDetailController extends Controller
{
    public function index($id, $action=null)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);

        $goods = Goods::all()->pluck('nama_barang','id');

        $salesTransactionDetails = SalesTransactionDetail::where('sales_transaction_id', $id)
            ->orderBy('goods_id')->paginate(10);

        $printTransactionDetails = SalesTransactionDetail::where('sales_transaction_id', $id)
            ->orderBy('goods_id')->get();

        $countPayment = $salesTransaction->payment()->count();

        if ($action == 'printPOB') {
            return view('admin.salesTransaction.printPOB', compact('salesTransaction', 'printTransactionDetails'));
        } else if ($action == 'printFaktur') {
            return view('admin.salesTransaction.printFaktur', compact('salesTransaction', 'printTransactionDetails', 'countPayment'));
        } else if ($action == 'show') {
            return view('admin.salesTransaction.show', compact('salesTransaction', 'goods', 'salesTransactionDetails'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_transaction_id' => 'required',
            'goods_id' => 'required',
            'qty' => 'required'
        ]);        

        $salesTransactionDetail = new SalesTransactionDetail;
        $salesTransactionDetail->sales_transaction_id = $request->sales_transaction_id;
        $salesTransactionDetail->goods_id = $request->goods_id;
        $salesTransactionDetail->qty = $request->qty;
        $salesTransactionDetail->keterangan = $request->keterangan;

        $goods = Goods::findOrFail($request->goods_id);
        if ($request->qty > $goods->stok_barang) {
            return redirect()->route('admin.sales_transaction.show', 
                ['id'=>$salesTransactionDetail->sales_transaction_id, 'action'=>'show'])
                ->with('error', 'Sorry, we do not have enough item in stock to fulfil your order.');
        } else {
            if ($salesTransactionDetail->save()) {
                $goods = Goods::findOrFail($salesTransactionDetail->goods_id);
                $goods->stok_barang = $goods->stok_barang - $salesTransactionDetail->qty;
                $goods->save();

                $salesTransaction = SalesTransaction::findOrFail($request->sales_transaction_id);
                $salesTransaction->total_transaksi = $salesTransaction->total_transaksi + ($request->qty * $goods->harga_barang);
                $salesTransaction->save();
    
                return redirect()->route('admin.sales_transaction.show', 
                    ['id'=>$salesTransactionDetail->sales_transaction_id, 'action'=>'show'])
                    ->with('success', 'Item added successfully.');
            }
        }
    }

    public function submitOrder($id)
    {
        // $salesTransactionDetails = SalesTransactionDetail::where('sales_transaction_id', $id)->get();

        // foreach ($salesTransactionDetails as $std) {
        //     $goods = Goods::findOrFail($std->goods_id);
        //     $goods->stok_barang = $goods->stok_barang - $std->qty;
        //     $goods->save();
        // }

        $salesTransaction = SalesTransaction::findOrFail($id);
        $distributor = Distributor::findOrFail($salesTransaction->distributor_id);
        if ($salesTransaction->jenis_pembayaran == 'Lunas') {
            $salesTransaction->status = "Menunggu pembayaran";
        } else if ($salesTransaction->jenis_pembayaran == 'Utang') {
            $salesTransaction->status = "Menunggu persetujuan utang";
        }
        $salesTransaction->total_transaksi = $salesTransaction->total_transaksi - $distributor->sisa_uang_return;
        // mengurangi sisa uang return
        $distributor->sisa_uang_return = 0;
        $distributor->save();
        $salesTransaction->save();

        return redirect()->route('admin.sales_transaction.index')->with('success', 'Order submitted successfully.');
    }


    public function approveLoan($id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);
        $salesTransaction->sisa_utang = $salesTransaction->total_transaksi;
        $salesTransaction->status = "Menunggu dikirim";
        $salesTransaction->save();

        // $paymentDetail = new PaymentDetail;
        // $paymentDetail->sales_transaction_id = $id;
        // $paymentDetail->save();

        return redirect()->route('admin.sales_transaction.show', ['id'=>$id, 'action'=>'show'])
            ->with('success', 'Loan request approved successfully.');
    }

    public function finishTransaction($id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);
        $salesTransaction->status = "Selesai";
        $salesTransaction->save();

        return redirect()->route('admin.sales_transaction.show', ['id'=>$id, 'action'=>'show'])
            ->with('success', 'Transaction completed successfully.');
    }

   public function destroy($id)
    {
        $salesTransactionDetail = SalesTransactionDetail::findOrFail($id);
        $goods = Goods::findOrFail($salesTransactionDetail->goods_id);
        $salesTransaction = SalesTransaction::findOrFail($salesTransactionDetail->sales_transaction_id);

        $goods->stok_barang = $goods->stok_barang + $salesTransactionDetail->qty;
        $goods->save();
        
        $salesTransaction->total_transaksi = $salesTransaction->total_transaksi - ($salesTransactionDetail->qty * $goods->harga_barang);
        $salesTransaction->save();
        $salesTransactionDetail->delete();

        return redirect()->route('admin.sales_transaction.show', 
            ['id'=>$salesTransactionDetail->sales_transaction_id, 'action'=>'show'])
            ->with('success', 'Item removed successfully.');
    }
}
