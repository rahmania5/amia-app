@extends('layouts.app', [
    'namePage' => 'Laporan Penjualan',
    'class' => 'sidebar-mini ',
    'activePage' => 'sales',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
  @if (session('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
  @elseif (session('error'))
    <div class="alert alert-danger" role="alert">
    {{ session('error') }}
    </div>
  @endif
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-6">
                <span class="float-left"><h5 class="card-title">{{ __('Laporan Penjualan') }}</h5>
                <h6 class="card-title">{{ __('Pilih Tahun dan Bulan Laporan') }}</h6>
              </div>
              <div class="col-6"> </div>
            </div>
          </div>
          <div class="card-body">
            <form class="form" method="POST" action="{{ route('manager.sales.store') }}">
              @csrf
              <div class="form-group row">
                <p class="ml-3 mt-2 align-middle">Tahun</p>
                <div class="col-sm-3">
                  {{ Form::select('year', $years, null, ['class' => 'form-control', 'name' => 'year', 'placeholder' => 'Pilih Tahun']) }}
                </div>
                <p class="ml-3 mt-2 align-middle">Bulan</p>
                <div class="col-sm-5">
                  {{ Form::select('month', $months, null, ['class' => 'form-control', 'name' => 'month', 'placeholder' => 'Pilih Bulan']) }}
                </div>
                <button type="submit" class="btn btn-primary btn-round mt-0">{{ __('Lihat Laporan') }}</button>       
              </div>
            </form>    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection