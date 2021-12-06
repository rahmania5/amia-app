<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SalesTransaction;
use App\Models\Distributor;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::join('sales_transactions', 'sales_transactions.id', '=', 'payments.sales_transaction_id')
            ->join('distributors', 'distributors.id', '=', 'sales_transactions.distributor_id')
            ->where('user_id', auth()->user()->id)
            ->orderBy('tanggal_transaksi', 'DESC')
            ->select('payments.*')
            ->latest('payments.id')->paginate(15);

        return view('distributor.payment.index', compact('payments'));
    }

    public function create($id)
    {
        $metodePembayaran = ['Cash'=>'Cash', 'Transfer'=>'Transfer'];
        $salesTransaction = SalesTransaction::findOrFail($id);
        
        return view('distributor.payment.create', compact('salesTransaction', 'metodePembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_transaction_id'=>'required',
            'metode_pembayaran'=>'required',
            'tanggal_pembayaran'=>'required',
            'jumlah_pembayaran'=>'required',
            'bukti_pembayaran' =>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

    	$payment = new Payment;
        $payment->sales_transaction_id = $request->sales_transaction_id;
        $payment->metode_pembayaran = $request->metode_pembayaran;
        $payment->tanggal_pembayaran = $request->tanggal_pembayaran;
        $payment->jumlah_pembayaran = $request->jumlah_pembayaran;
        $payment->keterangan = $request->keterangan;

        if ($request->metode_pembayaran == 'Transfer') {
            $request->validate([
                'bukti_pembayaran' =>'image|mimes:jpeg,png,jpg,svg|max:2048, required'
            ]);

            if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid())
            {
                $filename = $request->file('bukti_pembayaran')->getClientOriginalName();
                $filepath = $request->bukti_pembayaran->storeAs('public/bukti_pembayaran', $filename);
                $payment->bukti_pembayaran = $filepath;
            }
        }

        $salesTransaction = SalesTransaction::findOrFail($request->sales_transaction_id);
        
        if ($payment->save()) {
            $salesTransaction->status = "Menunggu konfirmasi pembayaran";
            $salesTransaction->save();
        }
            
        return redirect()->route('distributor.sales_transaction.show', ['id'=>$salesTransaction->id, 'action'=>'show'])
            ->with('success', 'Payment completed successfully. Please wait while we are processing your payment.');
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return view('distributor.payment.show', compact('payment'));
    }

    public function loanShow($id)
    {
        $distributor = Distributor::findOrFail($id);

        $printTransactions = $distributor->sales_transaction()
            ->where('jenis_pembayaran', 'Utang')
            ->where('status', 'Selesai')
            ->get();
        
        return view('distributor.printKartu', compact('distributor', 'printTransactions'));
    }
}
