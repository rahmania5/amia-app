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
        $distributors = Distributor::all();

        return view('manager.distributor.index', compact('provinces', 'distributors'));
    }

    public function show($action=null, $provinceId=null)
    {
        if ($provinceId) {
            $province = Province::findOrFail($provinceId);
            $distributors = Distributor::join('districts', 'districts.id', '=', 'distributors.district_id')
                ->join('cities', 'cities.id', '=', 'districts.city_id')
                ->where('province_id', $provinceId)
                ->paginate(20);

            $printDistributors = Distributor::join('districts', 'districts.id', '=', 'distributors.district_id')
                ->join('cities', 'cities.id', '=', 'districts.city_id')
                ->where('province_id', $provinceId)
                ->get();

            if ($action == 'printLaporan') {
                return view('manager.distributor.printLaporanDistributor', compact('province', 'printDistributors'));
                
            } else if ($action == 'show') {
                return view('manager.distributor.show', compact('province', 'distributors'));
            }
        } else {
            $distributors = Distributor::join('districts', 'districts.id', '=', 'distributors.district_id')
                ->join('cities', 'cities.id', '=', 'districts.city_id')
                ->join('provinces', 'provinces.id', 'cities.province_id')
                ->orderBy('provinces.id')
                ->paginate(20);

            $printDistributors = Distributor::join('districts', 'districts.id', '=', 'distributors.district_id')
                ->join('cities', 'cities.id', '=', 'districts.city_id')
                ->join('provinces', 'provinces.id', 'cities.province_id')
                ->orderBy('provinces.id')
                ->get();

            if ($action == 'printLaporan') {
                return view('manager.distributor.printLaporanDistributor', compact('printDistributors'));
            } else if ($action == 'show') {
                return view('manager.distributor.show', compact('distributors'));
            }
        }
    }
}
