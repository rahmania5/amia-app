<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SalesTransaction;
use App\Models\Distributor;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('tanggal_pembayaran', 'DESC')
            ->latest('id')->paginate(25);

        return view('admin.payment.index', compact('payments'));
    }

    public function loanIndex()
    {
        $loans = Distributor::join('users', 'users.id', '=', 'distributors.user_id')
            ->join('sales_transactions', 'distributors.id', '=', 'sales_transactions.distributor_id')
            ->where('jenis_pembayaran', 'Utang')
            ->select('users.name', 'distributors.alamat', 'distributors.id')
            ->groupBy('distributors.id')
            ->orderBy('name')->paginate(25);

        return view('admin.loan.index', compact('loans'));
    }

    public function loanShow($id, $action=null)
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
            return view('admin.loan.printKartu', compact('distributor', 'printTransactions'));
        } else if ($action == 'show'){
            return view('admin.loan.show', compact('distributor', 'salesTransactions'));
        }
    }

    public function create($id)
    {
        $metodePembayaran = ['Cash'=>'Cash', 'Transfer'=>'Transfer'];
        $salesTransaction = SalesTransaction::findOrFail($id);
        
        return view('admin.payment.create', compact('salesTransaction', 'metodePembayaran'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'sales_transaction_id'=>'required',
            'metode_pembayaran'=>'required',
            'tanggal_pembayaran'=>'required',
            'jumlah_pembayaran'=>'required',
            'bukti_pembayaran'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

    	$payment = new Payment;
        $payment->sales_transaction_id = $request->sales_transaction_id;
        $payment->metode_pembayaran = $request->metode_pembayaran;
        $payment->tanggal_pembayaran = $request->tanggal_pembayaran;
        $payment->jumlah_pembayaran = $request->jumlah_pembayaran;
        $payment->keterangan = $request->keterangan;

        if ($request->metode_pembayaran == 'Transfer') {
            $request->validate([
                'bukti_pembayaran'=>'image|mimes:jpeg,png,jpg,svg|max:2048, required'
            ]);

            if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid())
            {
                $filename = $request->file('bukti_pembayaran')->getClientOriginalName();
                $filepath = $request->bukti_pembayaran->storeAs('public/bukti_pembayaran', $filename);
                $payment->bukti_pembayaran = $filepath;
            }
        }

        $salesTransaction = SalesTransaction::findOrFail($request->sales_transaction_id);
        // $distributor = Distributor::findOrFail($salesTransaction->distributor_id);
        
        if ($payment->save()) {
            if ($salesTransaction->status == "Selesai") {
                $salesTransaction->sisa_utang = $salesTransaction->sisa_utang - $payment->jumlah_pembayaran;
            } else {
                $salesTransaction->sisa_utang = $salesTransaction->total_transaksi - $payment->jumlah_pembayaran;
                $salesTransaction->status = "Menunggu dikirim";
            }
            // // mengurangi sisa uang return
            // $distributor->sisa_uang_return = 0;
            // $distributor->save();
            $salesTransaction->save();
        }
            
        return redirect()->route('admin.sales_transaction.show', ['id'=>$salesTransaction->id, 'action'=>'show'])
            ->with('success', 'Payment completed successfully.');
    }

    public function confirmFullPayment($salesTransactionId, $paymentId)
    {
        $salesTransaction = SalesTransaction::findOrFail($salesTransactionId);
        $payment = Payment::findOrFail($paymentId);
        
        $salesTransaction->status = "Menunggu dikirim";
        $salesTransaction->sisa_utang = $salesTransaction->total_transaksi - $payment->jumlah_pembayaran;
        $salesTransaction->save();

        return redirect()->route('admin.sales_transaction.show', ['id'=>$salesTransactionId, 'action'=>'show'])
            ->with('success', 'Payment confirmed successfully.');
    }

    public function confirmLoanPayment($salesTransactionId, $paymentId)
    {
        $salesTransaction = SalesTransaction::findOrFail($salesTransactionId);
        $payment = Payment::findOrFail($paymentId);

        $salesTransaction->sisa_utang = $salesTransaction->sisa_utang - $payment->jumlah_pembayaran;
        $salesTransaction->save();

        return redirect()->route('admin.sales_transaction.show', ['id'=>$salesTransactionId, 'action'=>'show'])
            ->with('success', 'Payment confirmed successfully.');
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return view('admin.payment.show', compact('payment'));
    }
}
