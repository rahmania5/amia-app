@extends('layouts.app', [
    'namePage' => 'Pengelolaan Transaksi',
    'class' => 'sidebar-mini ',
    'activePage' => 'sales_transaction',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Transaksi Penjualan') }}</h5>
              </div>
              <div class="col-6">
                <a href="sales_transaction/create"><button type="button" class="btn btn-primary btn-round float-right">
                <span class="fas fa-plus-circle"></span> Insert Data</button></a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-9"></div>
              <div class="col-3">
              <form method="GET" action="{{ url()->current() }}">
                <div class="input-group no-border">
                  <input name="keyword" type="text" value="{{ request('keyword') }}" class="form-control" placeholder="Search...">
                  <div class="input-group-append">
                    <div class="input-group-text" style="padding: 5px 5px 5px 0px;">
                      <button class="btn btn-fab btn-icon btn-round btn-primary" style="margin: 0px;" type="submit">
                      <i class="now-ui-icons ui-1_zoom-bold"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
            </div>
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
                        <th scope="col">Distributor</th>
                        <th scope="col">Utang</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($salesTransactions as $st)
                        <tr>
                            <td> {{ $loop->iteration + $salesTransactions->firstItem() - 1 }} </td>
                            <td>{{ $st['tanggal_transaksi'] }}</td>
                            <td>{{ $st->distributor->user->name }}</td>
                            <td>{{ $st['sisa_utang'] }}</td>
                            <td>{{ $st['status'] }}</td>
                            <td>
                                <a href="sales_transaction/{{$st->id}}/show"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                                <a href="sales_transaction/{{$st->id}}/edit"><button type="button" class="btn btn-outline-warning"><span class="fas fa-edit"></span></button></a>
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