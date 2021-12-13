<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SalesTransaction;
use App\Models\Distributor;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('tanggal_pembayaran', 'like', "%{$request->keyword}%")
            ->orWhere('name', 'like', "%{$request->keyword}%")
            ->orWhere('status_pembayaran', 'like', "%{$request->keyword}%");
        })->join('sales_transactions', 'sales_transactions.id', '=', 'payments.sales_transaction_id')
        ->join('distributors', 'distributors.id', '=', 'sales_transactions.distributor_id')
        ->join('users', 'users.id', 'distributors.user_id')
        ->select('payments.*', 'users.name')
        ->orderBy('tanggal_pembayaran', 'DESC')->latest('payments.id')->paginate(25);
    
        $payments->appends($request->only('keyword'));

        return view('admin.payment.index', compact('payments'));
    }

    public function loanIndex(Request $request)
    {
        $loans = Distributor::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('name', 'like', "%{$request->keyword}%");
        })->join('users', 'users.id', '=', 'distributors.user_id')
        ->join('sales_transactions', 'distributors.id', '=', 'sales_transactions.distributor_id')
        ->where('jenis_pembayaran', 'Utang')
        ->select('users.name', 'distributors.alamat', 'distributors.id')
        ->groupBy('distributors.id')
        ->orderBy('name')->paginate(25);
    
        $loans->appends($request->only('keyword'));

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
        $payment->status_pembayaran = 'Sudah dikonfirmasi';
        $payment->keterangan = $request->keterangan;

        if ($request->metode_pembayaran == 'Transfer') {
            $request->validate([
                'bukti_pembayaran'=>'image|mimes:jpeg,png,jpg,svg|max:2048, required'
            ]);

            if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid())
            {
                $filename = $request->file('bukti_pembayaran')->getClientOriginalName();
                $request->bukti_pembayaran->move(public_path('bukti_pembayaran'), $filename);
                $payment->bukti_pembayaran = $filename;
            }
        }

        $salesTransaction = SalesTransaction::findOrFail($request->sales_transaction_id);
        
        if ($payment->save()) {
            if ($salesTransaction->status == "Selesai") {
                $salesTransaction->sisa_utang = $salesTransaction->sisa_utang - $payment->jumlah_pembayaran;
            } else {
                $salesTransaction->sisa_utang = $salesTransaction->total_transaksi - $payment->jumlah_pembayaran;
                $salesTransaction->status = "Menunggu dikirim";
            }
            $salesTransaction->save();
        }
            
        return redirect()->route('admin.sales_transaction.show', ['id'=>$salesTransaction->id, 'action'=>'show'])
            ->with('success', 'Payment completed successfully.');
    }

    public function confirmFullPayment($salesTransactionId, $paymentId)
    {
        $salesTransaction = SalesTransaction::findOrFail($salesTransactionId);
        $payment = Payment::findOrFail($paymentId);
        
        $payment->status_pembayaran = 'Sudah dikonfirmasi';
        $payment->save();

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

        $payment->status_pembayaran = 'Sudah dikonfirmasi';
        $payment->save();
        
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
