<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Models\ProductionDetail;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        $productions = Production::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('tanggal_produksi', 'like', "%{$request->keyword}%");
        })->orderBy('tanggal_produksi', 'DESC')->paginate(15);
    
        $productions->appends($request->only('keyword'));

        return view('admin.production.index', compact('productions'));
    }

    public function create()
    {
        return view('admin.production.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_produksi'=>'required'
        ]);

    	$production = new Production;
        $production->tanggal_produksi = $request->tanggal_produksi;
        $production->save();
            
        return redirect()->route('production.show', [$production->id]);
    }

    public function destroy($id)
    {
        $production = Production::findOrFail($id);
        $productionDetail = ProductionDetail::where('production_id', $production->id)->get();
        
        if (!$productionDetail->isEmpty()) {
            return redirect()->route('production.index')
                ->with('error', "Data cannot be deleted because it's being referenced by other data.");
        } else {
            $production->delete();
            return redirect()->route('production.index')->with('success', 'Data deleted successfully.');    
        }
    }
}
