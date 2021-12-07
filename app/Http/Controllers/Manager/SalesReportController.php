<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        $months = [];
        $years = [];

        for ($year=0; $year<=2; $year++) {
            $yearData = date('Y') - $year;
            $years[$yearData] = $yearData;
        }

        for ($month=1; $month<=12; $month++) {
            $monthData = date('F', mktime(0, 0, 0, $month, 1, date('Y')));
            $months[$monthData] = $monthData;
        }

        return view('manager.salesTransaction.index', compact('years', 'months'));
    }

    public function store(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        return redirect()->route('manager.sales.show', [$year, $month, 'show']);
    }

    public function show($year, $month, $action=null)
    {
        $monthName = $month;
        $month = date('m', strtotime($month));

        $salesTransactions = SalesTransaction::whereYear('tanggal_transaksi', $year)
            ->whereMonth('tanggal_transaksi', $month)
            ->where('status', 'Selesai')
            ->paginate(20);
        
        $printTransactions = SalesTransaction::whereYear('tanggal_transaksi', $year)
            ->whereMonth('tanggal_transaksi', $month)
            ->where('status', 'Selesai')
            ->get();

        if ($action == 'printLaporan') {
            return view('manager.salesTransaction.printLaporanPenjualan', compact('printTransactions', 'monthName', 'year', 'month'));
        } else if ($action == 'show') {
            return view('manager.salesTransaction.show', compact('salesTransactions', 'monthName', 'year', 'month'));
        }
    }
}
