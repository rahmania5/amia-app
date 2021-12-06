<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\Province;
use Illuminate\Http\Request;

class DistributorReportController extends Controller
{
    public function index()
    {
        $provinces = Province::paginate(10);

        return view('manager.distributor.index', compact('provinces'));
    }

    public function show($provinceId)
    {
        $province = Province::findOrFail($provinceId);
        $distributors = Distributor::join('districts', 'districts.id', '=', 'distributors.district_id')
            ->join('cities', 'cities.id', '=', 'districts.city_id')
            ->where('province_id', $provinceId)
            ->paginate(20);
 
        return view('manager.distributor.show', compact('province', 'distributors'));
    }
}
