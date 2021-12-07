@extends('layouts.app', [
    'namePage' => 'Pengelolaan Transaksi',
    'class' => 'sidebar-mini',
    'activePage' => 'sales_transaction'
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
                                <span class="float-left"><h5 class="card-title">{{ __('Informasi Transaksi') }}</h5>
                            </div>
                            <div class="col-2">
                            @if ($salesTransaction->status == "Menunggu dikirim" || $salesTransaction->status == "Selesai")
                                <div class="dropdown float-right">
                                    <button type="button" class="btn btn-round btn-outline-info dropdown-toggle btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-print"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="printPOB" target="blank">Print POB</a>
                                        <a class="dropdown-item" href="printFaktur" target="blank">Print Faktur Penjualan</a>
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                    
                    {{ Form::open(['route' => ['admin.sales_transaction.addItem'], 'method' => 'post']) }}
                    {{ csrf_field() }}
                    <div class="card-body">
                    {{ Form::model($salesTransaction, []) }}

                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Distributor</p>
                            <div class="col-sm-9">
                            {{ Form::text('distributor_id', $salesTransaction->distributor->user->name, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>    
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Tanggal Transaksi</p>
                            <div class="col-sm-9">
                            {{ Form::text('tanggal_transaksi', $salesTransaction->tanggal_transaksi, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Jenis Pembayaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('jenis_pembayaran', $salesTransaction->jenis_pembayaran, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @if ($salesTransaction->status == 'Belum dipesan')
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Sisa Uang Return</p>
                            <div class="col-sm-9">
                            {{ Form::text('sisa_uang_return', $salesTransaction->distributor->sisa_uang_return, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Total Transaksi</p>
                            <div class="col-sm-9">
                            {{ Form::text('total_transaksi', $salesTransaction->total_transaksi, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            @if ($salesTransaction->status != 'Belum dipesan')
                            <label class="col-form-label text-info">Sudah dikurangi sisa uang return</label>   
                            @endif 
                            </div>
                        </div>
                        @if ($salesTransaction->jenis_pembayaran == "Utang")
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Sisa Utang</p>
                            <div class="col-sm-9">
                            {{ Form::text('sisa_utang', $salesTransaction->sisa_utang, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @if ($salesTransaction->status == "Menunggu dikirim")
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Jatuh Tempo</p>
                            <div class="col-sm-9">
                            {{ Form::text('jatuh_tempo', date('Y-m-d', strtotime($salesTransaction->tanggal_transaksi." +15 days")), ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Tanggal Kirim</p>
                            <div class="col-sm-9">
                            {{ Form::text('tanggal_kirim', $salesTransaction->tanggal_kirim, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Status Transaksi</p>
                            <div class="col-sm-9">
                            {{ Form::text('status', $salesTransaction->status, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Detail Data Transaksi') }}</h5>
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
                    @if ($salesTransaction->status == "Belum dipesan")
                    @include('admin.salesTransaction.addItem_form')                
                        <div class="col-10">
                            <input type="submit" value="Tambah Barang" class="btn btn-primary btn-round float-right mb-3"/>
                        </div>
                    </div>
                    @endif
                    {{ Form::close() }}

                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="float-right">
                            {{ $salesTransactionDetails->links() }}
                            </div>
                        </div>
                    </div>
                    {{-- LIST OF SALES TRANSACTION DETAILS --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Keterangan</th>
                                    @if ($salesTransaction->status == "Belum dipesan")
                                    <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($salesTransactionDetails as $std)
                                    <tr>
                                        <td>{{ $loop->iteration + $salesTransactionDetails->firstItem() - 1 }}</td>
                                        <td>{{ $std['qty'] }}</td>
                                        <td>{{ $std->goods->nama_barang }}</td>
                                        <td>{{ $std->goods->harga_barang }}</td>
                                        <td>{{ $std['qty'] * $std->goods->harga_barang }}</td>
                                        <td>{{ $std['keterangan'] }}</td>
                                        @if ($salesTransaction->status == "Belum dipesan")
                                        <td>
                                            <form method="POST" action="{{ route('admin.sales_transaction.removeItem', $std->id) }}">
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
                    <div class="card-footer">
                        @if ($salesTransaction->status == "Belum dipesan")
                        <form method="POST" action="{{ route('admin.sales_transaction.submitOrder', $salesTransaction->id) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" value="Pesan Barang" class="btn btn-primary btn-round" onclick="return confirmOrder()">  
                        </div>   
                        </form>
                        @elseif ($salesTransaction->status == "Menunggu pembayaran" || ($salesTransaction->status == "Selesai" && $salesTransaction->sisa_utang > 0))
                        <div class="text-right">
                            <a href="{{ route('admin.payment.create', $salesTransaction->id) }}">
                                <button type="button" class="btn btn-primary btn-round">Bayar Pesanan</button>
                            </a>    
                        </div>
                        @elseif ($salesTransaction->status == "Menunggu persetujuan utang")
                        <form method="POST" action="{{ route('admin.sales_transaction.approveLoan', $salesTransaction->id) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" value="Terima Pengajuan Utang" class="btn btn-primary btn-round" onclick="return confirmLoan()"> 
                        </div>   
                        </form>
                        @elseif ($salesTransaction->status == "Menunggu dikirim")
                        <form method="POST" action="{{ route('admin.sales_transaction.finishTransaction', $salesTransaction->id) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <a href="{{ route('delivery.create', $salesTransaction->id) }}">
                                <button type="button" class="btn btn-info btn-round">Antar Barang</button>
                            </a>
                            <a href="{{ route('admin.return.create', $salesTransaction->id) }}">
                                <button type="button" class="btn btn-warning btn-round">Return Barang</button>
                            </a> 
                            <input type="submit" value="Pesanan Diterima" class="btn btn-primary btn-round" onclick="return confirmFinish()">  
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
    function confirmOrder() {
        var result = confirm("Pastikan data yang dimasukkan sudah benar. Yakin ingin memesan barang?");
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

    function confirmLoan() {
        var result = confirm("Persetujuan tidak dapat dicancel. Yakin ingin menyetujui utang?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }

    function confirmFinish() {
        var result = confirm("Pastikan barang sudah diterima dan sesuai. Yakin ingin menyelesaikan transaksi?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush
