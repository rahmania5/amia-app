<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.salesReport.index', compact('years', 'months'));
    }

    public function store(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        return redirect()->route('admin.sales.show', [$year, $month, 'show']);
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
            return view('admin.salesReport.printLaporanPenjualan', compact('printTransactions', 'monthName', 'year', 'month'));
        } else if ($action == 'show') {
            return view('admin.salesReport.show', compact('salesTransactions', 'monthName', 'year', 'month'));
        }
    }
}
