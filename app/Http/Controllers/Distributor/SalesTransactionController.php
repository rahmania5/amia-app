<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use App\Models\Distributor;
use Illuminate\Http\Request;

class SalesTransactionController extends Controller
{
    public function index()
    {
        $salesTransactions = SalesTransaction::join('distributors', 'distributors.id', '=', 'sales_transactions.distributor_id')
            ->where('user_id', auth()->user()->id)
            ->select('sales_transactions.*')
            ->orderBy('tanggal_transaksi', 'DESC')
            ->latest('sales_transactions.id')->paginate(15);

        return view('distributor.salesTransaction.index', compact('salesTransactions'));
    }

    public function create()
    {
        $jenisPembayaran = ['Lunas'=>'Lunas', 'Utang'=>'Utang'];
        
        return view('distributor.salesTransaction.create', compact('jenisPembayaran'));
    }

    public function store(Request $request)
    {
        $distributor = Distributor::where('user_id', auth()->user()->id)->first();
        $request->validate([
            'tanggal_transaksi'=>'required',
            'jenis_pembayaran'=>'required'
        ]);

    	$salesTransaction = new SalesTransaction;
        $salesTransaction->distributor_id = $distributor->id;
        $salesTransaction->tanggal_transaksi = $request->tanggal_transaksi;
        $salesTransaction->jenis_pembayaran = $request->jenis_pembayaran;
        $salesTransaction->total_transaksi = 0;
        $salesTransaction->tanggal_kirim = $request->tanggal_kirim;

        $loan = $distributor->sales_transaction()
            ->where('sisa_utang', '>', 0)
            ->count();
              
        if ($loan > 0) {
            return redirect()->back()->with('error', 'Unable to process transaction due to loan from previous transaction.');
        } else {
            $salesTransaction->save();
            return redirect()->route('distributor.sales_transaction.show', 
                ['id'=>$salesTransaction->id, 'action'=>'show']);
        }
    }
}
