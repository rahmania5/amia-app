@extends('layouts.app', [
    'namePage' => 'Return Barang',
    'class' => 'sidebar-mini ',
    'activePage' => 'return',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Return Barang') }}</h5>
              </div>
              <div class="col-6"></div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $returns->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF PRODUCT RETURNS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Total Return</th>
                        <th scope="col">Status</th>
                        <th scope="col">No. Transaksi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($returns as $r)
                        <tr>
                            <td> {{ $loop->iteration + $returns->firstItem() - 1 }} </td>
                            <td>{{ $r['total_return'] }}</td>
                            <td>{{ $r['status_return'] }}</td>
                            <td><a href="sales_transaction/{{$r->sales_transaction_id}}/show">{{ $r['sales_transaction_id'] }}</a></td>
                            <td>
                                <a href="return/{{$r->id}}"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
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