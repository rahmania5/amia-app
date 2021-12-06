<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Distributor;

class LoanReportController extends Controller
{
    public function index()
    {
        $loans = Distributor::join('users', 'users.id', '=', 'distributors.user_id')
            ->join('sales_transactions', 'distributors.id', '=', 'sales_transactions.distributor_id')
            ->where('jenis_pembayaran', 'Utang')
            ->select('users.name', 'distributors.alamat', 'distributors.id')
            ->groupBy('distributors.id')
            ->orderBy('name')->paginate(25);

        return view('manager.loan.index', compact('loans'));
    }

    public function show($id, $action=null)
    {
        $distributor = Distributor::findOrFail($id);

        $salesTransactions = $distributor->sales_transaction()
            ->where('jenis_pembayaran', 'Utang')
            ->where('status', 'Selesai')
            ->paginate(20);

        $printTransactions = $distributor->sales_transaction()
            ->where('jenis_pembayaran', 'Utang')
            ->where('status', 'Selesai')
            ->get();
        
        if ($action == 'printKartu') {
            return view('manager.loan.printKartu', compact('distributor', 'printTransactions'));
        } else if ($action == 'show'){
            return view('manager.loan.show', compact('distributor', 'salesTransactions'));
        }
    }
}
