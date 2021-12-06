@extends('layouts.app', [
    'namePage' => 'Pengelolaan Pembayaran',
    'class' => 'sidebar-mini',
    'activePage' => 'payment'
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
                        <h5 class="card-title">{{ __('Informasi Pembayaran') }}</h5>
                    </div>

                    <div class="card-body">
                    {{ Form::model($payment, []) }}

                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">ID Transaksi</p>
                            <div class="col-sm-9">
                            <a href="{{ route('admin.sales_transaction.show', [$payment->sales_transaction_id, 'show']) }}">
                            {{ Form::text('sales_transaction_id', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Tanggal Pembayaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('tanggal_pembayaran', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Metode Pembayaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('metode_pembayaran', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Jumlah Pembayaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('jumlah_pembayaran', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @if ($payment->metode_pembayaran == "Transfer")
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Bukti Pembayaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('bukti_pembayaran', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Keterangan</p>
                            <div class="col-sm-9">
                            {{ Form::text('keterangan', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    
                    <div class="card-footer">
                        @if ($payment->sales_transaction->status == "Menunggu konfirmasi pembayaran")
                        <form method="POST" action="{{ route('payment.confirmFullPayment', 
                            ['salesTransactionId'=>$payment->sales_transaction_id, 'paymentId'=>$payment->id]) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" value="Konfirmasi Pembayaran" class="btn btn-primary btn-round" onclick="return confirmPayment()">  
                        </div>   
                        </form>
                        @elseif ($payment->sales_transaction->status == "Selesai" && $payment->sales_transaction->sisa_utang > 0)
                        <form method="POST" action="{{ route('payment.confirmLoanPayment', 
                            ['salesTransactionId'=>$payment->sales_transaction_id, 'paymentId'=>$payment->id]) }}">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" value="Konfirmasi Pembayaran" class="btn btn-primary btn-round" onclick="return confirmPayment()">  
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
    function confirmPayment() {
        var result = confirm("Konfirmasi tidak dapat dicancel. Yakin ingin mengonfirmasi pembayaran?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush
