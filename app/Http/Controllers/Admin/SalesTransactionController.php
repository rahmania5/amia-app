<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use App\Models\Distributor;
use Illuminate\Http\Request;

class SalesTransactionController extends Controller
{
    public function index(Request $request)
    {
        $salesTransactions = SalesTransaction::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('tanggal_transaksi', 'like', "%{$request->keyword}%")
            ->orWhere('name', 'like', "%{$request->keyword}%")
            ->orWhere('status', 'like', "%{$request->keyword}%");
        })->join('distributors', 'distributors.id', '=', 'sales_transactions.distributor_id')
        ->join('users', 'users.id', '=', 'distributors.user_id')
        ->select('sales_transactions.*', 'users.name')
        ->orderBy('tanggal_transaksi', 'DESC')->latest('sales_transactions.id')->paginate(25);

        $salesTransactions->appends($request->only('keyword'));
        
        return view('admin.salesTransaction.index', compact('salesTransactions'));
    }

    public function create()
    {
        $distributors = Distributor::join('users', 'distributors.user_id', 'users.id')
            ->select('users.name', 'distributors.id')
            ->orderBy('users.name')
            ->pluck('name','id');

        $jenisPembayaran = ['Lunas'=>'Lunas', 'Utang'=>'Utang'];
        
        return view('admin.salesTransaction.create', compact('distributors', 'jenisPembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'distributor_id'=>'required',
            'tanggal_transaksi'=>'required',
            'jenis_pembayaran'=>'required'
        ]);

    	$salesTransaction = new SalesTransaction;
        $salesTransaction->distributor_id = $request->distributor_id;
        $salesTransaction->tanggal_transaksi = $request->tanggal_transaksi;
        $salesTransaction->jenis_pembayaran = $request->jenis_pembayaran;
        $salesTransaction->total_transaksi = 0;
        $salesTransaction->tanggal_kirim = $request->tanggal_kirim;

        $distributor = Distributor::findOrFail($request->distributor_id);
        $loan = $distributor->sales_transaction()
            ->where('sisa_utang', '>', 0)
            ->count();
              
        if ($loan > 0) {
            return redirect()->back()->with('error', 'Unable to process transaction due to loan from previous transaction.');
        } else {
            $salesTransaction->save();
            return redirect()->route('admin.sales_transaction.show', 
                ['id'=>$salesTransaction->id, 'action'=>'show']);
        }
    }

    public function edit($id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);
        $jenisPembayaran = ['Lunas'=>'Lunas', 'Utang'=>'Utang'];

        if ($salesTransaction->status == 'Selesai') {
            return redirect()->route('admin.sales_transaction.index')->with('error', "Data cannot be edited because the transaction has been completed.");
        } else {
            return view('admin.salesTransaction.edit', compact('salesTransaction', 'jenisPembayaran'));
        }
    }

    public function update(Request $request, $id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);

        if ($salesTransaction->status == 'Belum dipesan') {
            $request->validate([
                'jenis_pembayaran'=>'required',
                'tanggal_kirim'=>'required'
            ]);
            $salesTransaction->jenis_pembayaran = $request->jenis_pembayaran;
            $salesTransaction->tanggal_kirim = $request->tanggal_kirim;
        } else {
            $request->validate([
                'tanggal_kirim'=>'required'
            ]);
            $salesTransaction->tanggal_kirim = $request->tanggal_kirim;
        }

        if ($salesTransaction->save()) {
            return redirect()->route('admin.sales_transaction.show', ['id'=>$salesTransaction->id, 'action'=>'show'])
            ->with('success', 'Data updated successfully.');
        }
    }
}
