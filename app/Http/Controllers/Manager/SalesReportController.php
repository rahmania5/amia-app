<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        $unsortedMonths = [];

        for ($month=1; $month<=36; $month++) {
            $monthData = date('F Y', mktime(0, 0, 0, $month, 1, date('Y') - 2));
            $unsortedMonths[$month] = $monthData;
        }
        $months = array_reverse($unsortedMonths);

        return view('manager.salesTransaction.index', compact('months'));
    }

    public function show($year, $month)
    {
        $monthName = $month;
        $month = date('m', strtotime($month));

        $salesTransactions = SalesTransaction::whereYear('tanggal_transaksi', $year)
            ->whereMonth('tanggal_transaksi', $month)
            ->where('status', 'Selesai')
            ->paginate(20);
        
        return view('manager.salesTransaction.show', compact('salesTransactions', 'monthName', 'year'));
    }
}
