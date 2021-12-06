@extends('layouts.app', [
    'namePage' => 'Pembayaran Tagihan',
    'class' => 'sidebar-mini ',
    'activePage' => 'payment',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Pembayaran') }}</h5>
              </div>
              <div class="col-6"></div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $payments->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF PAYMENTS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th scope="col">Metode</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">No. Transaksi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($payments as $p)
                        <tr>
                            <td> {{ $loop->iteration + $payments->firstItem() - 1 }} </td>
                            <td>{{ $p['tanggal_pembayaran'] }}</td>
                            <td>{{ $p['metode_pembayaran'] }}</td>
                            <td>{{ $p['jumlah_pembayaran'] }}</td>
                            <td><a href="sales_transaction/{{$p->sales_transaction_id}}/show">{{ $p['sales_transaction_id'] }}</a></td>
                            <td>
                                <a href="payment/{{$p->id}}"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
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