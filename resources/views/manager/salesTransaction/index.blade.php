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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Penjualan') }}</h5>
              </div>
              <div class="col-6"> </div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                </div>
            </div>
          </div>
          {{-- LIST OF SALES TRANSACTIONS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">Tahun</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($months as $m)
                        <tr>
                        <?php
                            $year = explode(" ", $m);
                            $year = $year[1];
                        ?>
                            <td class="text-center"> {{ $year }} </td>
                        <?php
                            $month = explode(" ", $m);
                            $month = $month[0];
                        ?>
                            <td> {{ $month }} </td>
                            <td>
                                <a href="sales_transaction/{{$year}}/{{$month}}"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection