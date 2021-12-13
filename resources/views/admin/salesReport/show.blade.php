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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Penjualan '. $monthName .' '. $year) }}</h5>
              </div>
              <div class="col-6">
                <a href="{{ route('admin.sales.show', [$year, $monthName, 'printLaporan']) }}" target="blank"><button type="button" class="btn btn-primary btn-round float-right">
                <span class="fas fa-print"></span> Print</button></a>
              </div>
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
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Distributor</th>
                        <th scope="col">Jenis Pembayaran</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($salesTransactions as $st)
                        <tr>
                            <td>{{ $st->tanggal_transaksi }}</td>
                            <td>{{ $st->distributor->user->name }}</td>
                            <td>{{ $st->jenis_pembayaran }}</td>
                            <td class="text-right">{{ $st->total_transaksi }}</td>
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