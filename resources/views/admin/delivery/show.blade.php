@extends('layouts.app', [
    'namePage' => 'Pengelolaan Pengantaran',
    'class' => 'sidebar-mini',
    'activePage' => 'delivery'
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <span class="float-left"><h5 class="card-title">{{ __('Informasi Pengantaran') }}</h5>
                            </div>
                            <div class="col-2">
                                <a href="printSurat" target="blank">
                                <button type="button" class="btn btn-round btn-outline-info btn-icon float-right">
                                    <i class="fa fa-print"></i>
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                    {{ Form::model($delivery, []) }}

                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">ID Transaksi</p>
                            <div class="col-sm-9">
                            <a href="{{ route('admin.sales_transaction.show', [$salesTransactionId, 'show']) }}">
                            {{ Form::text('sales_transaction_id', $salesTransactionId, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Tanggal Pengantaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('tanggal_pengantaran', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Driver</p>
                            <div class="col-sm-9">
                            {{ Form::text('driver_id', $delivery->driver->nama_driver, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">No. Kendaraan</p>
                            <div class="col-sm-9">
                            {{ Form::text('vehicle_id', strtoupper($delivery->vehicle->no_polisi), ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Jam Berangkat</p>
                            <div class="col-sm-9">
                            {{ Form::text('jam_berangkat', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Jam Diterima</p>
                            <div class="col-sm-9">
                            {{ Form::text('jam_diterima', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Detail Data Pengantaran') }}</h5>
                    </div>
                    <div class="card-body">
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
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="float-right">
                            {{ $deliveryDetails->links() }}
                            </div>
                        </div>
                    </div>
                    {{-- LIST OF DELIVERY DETAILS --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Qty Barang Dikirim</th>
                                    @if ($salesTransaction->status != "Selesai")
                                    <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($deliveryDetails as $dd)
                                    <tr>
                                        <td>{{ $loop->iteration + $deliveryDetails->firstItem() - 1 }}</td>
                                        <td>{{ $dd->sales_transaction_detail->goods->nama_barang }}</td>
                                        <td>{{ $dd['qty_barang_dikirim'] }}</td>
                                        @if ($salesTransaction->status != "Selesai")
                                        <td>
                                            <form method="POST" action="{{ route('delivery.removeItem', $dd->id) }}">
                                            <a href="{{ route('delivery.editItem', $dd->id) }}"><button type="button" class="btn btn-outline-warning"><span class="fas fa-edit"></span></button></a>
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirmDelete()"><span class="fas fa-trash"></span></button>       
                                            </form>
                                        </td>
                                        @endif
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

@push('js')
  <script>
    function confirmDelete() {
        var result = confirm("Yakin ingin menghapus data?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush
