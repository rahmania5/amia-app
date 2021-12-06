<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionDetail;
use App\Models\Production;
use App\Models\Goods;
use Illuminate\Http\Request;

class ProductionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $production = Production::findOrFail($id);

        $goods = Goods::all()->pluck('nama_barang','id');

        $productionDetails = ProductionDetail::where('production_id', $id)
            ->orderBy('goods_id')->paginate(10);

        return view('admin.production.show', compact('production', 'goods', 'productionDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_id' => 'required',
            'goods_id' => 'required',
            'qty_barang_jadi' => 'required',
            'qty_barang_rusak' => 'required'
        ]);        

        $productionDetail = new ProductionDetail;
        $productionDetail->production_id = $request->production_id;
        $productionDetail->goods_id = $request->goods_id;
        $productionDetail->qty_barang_jadi = $request->qty_barang_jadi;
        $productionDetail->qty_barang_rusak = $request->qty_barang_rusak;

        if ($productionDetail->save()) {
            return redirect()->route('production.show', [$productionDetail->production_id])
                ->with('success', 'Item added successfully.');
        }
    }

    public function produce($id)
    {
        $productionDetails = ProductionDetail::where('production_id', $id)->get();

        foreach ($productionDetails as $pd) {
            $goods = Goods::findOrFail($pd->goods_id);
            $goods->stok_barang = $goods->stok_barang + $pd->qty_barang_jadi;
            $goods->save();
        }

        return redirect()->route('production.index')->with('success', 'Stock added successfully.');
    }

    public function destroy($id)
    {
        $productionDetail = ProductionDetail::findOrFail($id);
        $productionDetail->delete();

        return redirect()->route('production.show', [$productionDetail->production_id])
            ->with('success', 'Item removed successfully.');

    }
}
