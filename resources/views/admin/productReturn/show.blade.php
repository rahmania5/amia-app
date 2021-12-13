@extends('layouts.app', [
    'namePage' => 'Pengelolaan Return',
    'class' => 'sidebar-mini',
    'activePage' => 'return'
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
                                <span class="float-left"><h5 class="card-title">{{ __('Informasi Return Barang') }}</h5>
                            </div>
                        </div>
                    </div>
                    
                    {{ Form::open(['route' => ['admin.return.addItem'], 'method' => 'post']) }}
                    {{ csrf_field() }}
                    <div class="card-body">
                    {{ Form::model($return, []) }}

                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">ID Transaksi</p>
                            <div class="col-sm-9">
                            <a href="{{ route('admin.sales_transaction.show', [$salesTransaction->id, 'show']) }}">
                            {{ Form::text('sales_transaction_id', $salesTransaction->id, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Total Return</p>
                            <div class="col-sm-9">
                            {{ Form::text('total_return', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Status Return</p>
                            <div class="col-sm-9">
                            {{ Form::text('status_return', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Detail Data Return Barang') }}</h5>
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
                    @if ($return->status_return == "Belum diajukan")
                    @include('admin.productReturn.addItem_form')                
                        <div class="col-10">
                            <input type="submit" value="Tambah Barang" class="btn btn-primary btn-round float-right mb-3"/>
                        </div>
                    @endif
                    {{ Form::close() }}
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="float-right">
                                {{ $returnDetails->links() }}
                                </div>
                            </div>
                        </div>
                        {{-- LIST OF RETURN DETAILS --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="text-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Alasan Return</th>
                                        @if ($return->status_return == "Belum diajukan")
                                        <th scope="col">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($returnDetails as $rd)
                                        <tr>
                                            <td>{{ $loop->iteration + $returnDetails->firstItem() - 1 }}</td>
                                            <td>{{ $rd->sales_transaction_detail->goods->nama_barang }}</td>
                                            <td>{{ $rd->sales_transaction_detail->goods->harga_barang }}</td>
                                            <td>{{ $rd['qty_return'] }}</td>
                                            <td>{{ $rd['qty_return'] * $rd->sales_transaction_detail->goods->harga_barang }}</td>
                                            <td>{{ $rd['alasan_return'] }}</td>
                                            @if ($return->status_return == "Belum diajukan")
                                            <td>
                                                <form method="POST" action="{{ route('admin.return.removeItem', $rd->id) }}">
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
                    <div class="card-footer">
                        @if ($return->status_return == "Belum diajukan")
                        <form method="POST" action="{{ route('admin.return.submit', $return->id) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" value="Return Barang" class="btn btn-primary btn-round" onclick="return confirmReturn()">
                        </div>   
                        </form>
                        @elseif ($return->status_return == "Diajukan")
                        <form method="POST" action="{{ route('admin.return.decline', $return->id) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" formaction="{{ route('admin.return.decline', $return->id) }}" value="Tolak Pengajuan Return" class="btn btn-danger btn-round" onclick="return confirmDecline()">   
                            <input type="submit" formaction="{{ route('admin.return.confirm', ['id'=>$return->id, 'salesTransactionId'=>$salesTransaction->id]) }}" value="Terima Pengajuan Return" class="btn btn-info btn-round" onclick="return confirmAccept()">
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
  <script>
    function confirmReturn() {
        var result = confirm("Pastikan data yang dimasukkan sudah benar. Yakin ingin return barang?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
    function confirmDelete() {
        var result = confirm("Yakin ingin menghapus data?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
    function confirmDecline() {
        var result = confirm("Status tidak dapat diubah. Yakin ingin menolak pengajuan return?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
    function confirmAccept() {
        var result = confirm("Persetujuan tidak dapat dicancel. Yakin ingin menyetujui pengajuan return?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush
