<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\ProductionDetail;
use App\Models\SalesTransactionDetail;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Goods::orderBy('id')->paginate(15);

        return view('admin.goods.index', compact('goods'));
    }

    public function create()
    {
        return view('admin.goods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'=>'required',
            'stok_barang'=>'required',
            'harga_barang'=>'required'
        ]);

    	$goods = new Goods;
        $goods->nama_barang = $request->nama_barang;
        $goods->stok_barang = $request->stok_barang;
        $goods->harga_barang = $request->harga_barang;
        $goods->save();
            
        return redirect()->route('goods.index')->with('success', 'Data created successfully.');
    }

    public function edit($id)
    {
        $goods = Goods::findOrFail($id);

        return view('admin.goods.edit', compact('goods'));
    }

    public function update(Request $request, $id)
    {
        $goods = Goods::findOrFail($id);

        $request->validate([
            'nama_barang'=>'required',
            'stok_barang'=>'required',
            'harga_barang'=>'required'
        ]);

        $goods->nama_barang = $request->nama_barang;
        $goods->stok_barang = $request->stok_barang;
        $goods->harga_barang = $request->harga_barang;

        if ($goods->save()) {
            return redirect()->route('goods.index')->with('success', 'Data updated successfully.');
        }
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);
        $productionDetail = ProductionDetail::where('goods_id', $goods->id)->get();
        $transactionDetail = SalesTransactionDetail::where('goods_id', $goods->id)->get();

        if (!$productionDetail->isEmpty() || !$transactionDetail->isEmpty()) {
            return redirect()->route('goods.index')
                ->with('error', "Data cannot be deleted because it's being referenced by other data.");
        } else {
            $goods->delete();
            return redirect()->route('goods.index')->with('success', 'Data deleted successfully.');    
        }
    }
}
