<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\ProductReturn;
use App\Models\SalesTransaction;
use App\Models\ProductReturnDetail;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public function index()
    {
        $returns = ProductReturnDetail::join('sales_transaction_details', 'sales_transaction_details.id', '=', 'product_return_details.sales_transaction_detail_id')
            ->join('sales_transactions', 'sales_transactions.id', '=', 'sales_transaction_details.sales_transaction_id')
            ->join('distributors', 'distributors.id', '=', 'sales_transactions.distributor_id')
            ->join('product_returns', 'product_returns.id', '=', 'product_return_details.product_return_id')
            ->where('user_id', auth()->user()->id)
            ->select('product_returns.*', 'sales_transaction_id')
            ->latest('product_returns.id')->paginate(15);

        return view('distributor.productReturn.index', compact('returns'));
    }

    public function create($id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);

        return view('distributor.productReturn.create', compact('salesTransaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status_return' => 'required',
            'sales_transaction_id' => 'required'
        ]);        
        
        $return = new ProductReturn;
        $return->total_return = 0;
        $return->status_return = 'Belum diajukan';

        $return->save();

        return redirect()->route('distributor.return.show', [$return->id, $request->sales_transaction_id])
            ->with('success', 'Data created successfully. Please add items that will be returned first.');
    }

    public function show(ProductReturn $productReturn)
    {
        return view('distributor.productReturn.show', compact('productReturn'));
    }
}
