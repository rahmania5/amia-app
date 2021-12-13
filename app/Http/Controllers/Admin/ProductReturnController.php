<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReturn;
use App\Models\SalesTransaction;
use App\Models\ProductReturnDetail;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public function index(Request $request)
    {
        $returns = ProductReturnDetail::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('status_return', 'like', "%{$request->keyword}%");
        })->join('sales_transaction_details', 'sales_transaction_details.id', '=', 'product_return_details.sales_transaction_detail_id')
        ->join('sales_transactions', 'sales_transactions.id', '=', 'sales_transaction_details.sales_transaction_id')
        ->join('distributors', 'distributors.id', '=', 'sales_transactions.distributor_id')
        ->join('users', 'users.id', '=', 'distributors.user_id')
        ->join('product_returns', 'product_returns.id', '=', 'product_return_details.product_return_id')
        ->select('product_returns.*', 'sales_transaction_id', 'users.name as distributor')
        ->latest('product_returns.id')->paginate(15);
    
        $returns->appends($request->only('keyword'));

        return view('admin.productReturn.index', compact('returns'));
    }

    public function create($id)
    {
        $salesTransaction = SalesTransaction::findOrFail($id);

        return view('admin.productReturn.create', compact('salesTransaction'));
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

        return redirect()->route('admin.return.show', [$return->id, $request->sales_transaction_id])
            ->with('success', 'Data created successfully. Please add items that will be returned first.');
    }
}
