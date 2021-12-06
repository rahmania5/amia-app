@extends('layouts.app', [
    'namePage' => 'Laporan Distributor',
    'class' => 'sidebar-mini ',
    'activePage' => 'distributor',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Distributor Provinsi '. $province->nama_provinsi) }}</h5>
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
          {{-- LIST OF DISTRIBUTORS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">Distributor</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Kabupaten/Kota</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No. Telp</th>
                        <th scope="col">Jumlah Transaksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($distributors as $d)
                        <tr>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->nik }}</td>
                            <td>{{ $d->district->city->nama_kab_kota }} </td>
                            <td>{{ $d->district->nama_kecamatan }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>{{ $d->no_telepon }}</td>
                            @if ($d->sales_transaction)
                            <td class="text-center">{{ $d->sales_transaction->count() }}</td>
                            @else
                            <td class="text-center">0</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data penjualan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection