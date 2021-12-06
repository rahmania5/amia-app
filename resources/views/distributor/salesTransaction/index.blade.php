@extends('layouts.app', [
    'namePage' => 'Pemesanan Barang',
    'class' => 'sidebar-mini ',
    'activePage' => 'order',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Transaksi Pembelian') }}</h5>
              </div>
              <div class="col-6">
                <a href="sales_transaction/create"><button type="button" class="btn btn-primary btn-round float-right">
                <span class="fas fa-plus-circle"></span> Insert Data</button></a>
              </div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $salesTransactions->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF SALES TRANSACTIONS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Pembayaran</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($salesTransactions as $st)
                        <tr>
                            <td> {{ $loop->iteration + $salesTransactions->firstItem() - 1 }} </td>
                            <td>{{ $st['tanggal_transaksi'] }}</td>
                            <td>{{ $st['jenis_pembayaran'] }}</td>
                            <td>{{ $st['total_transaksi'] }}</td>
                            <td>{{ $st['status'] }}</td>
                            <td>
                                <a href="sales_transaction/{{$st->id}}/show"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
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