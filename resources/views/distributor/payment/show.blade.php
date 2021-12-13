@extends('layouts.app', [
    'namePage' => 'Pembayaran Tagihan',
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
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Status Pembayaran</p>
                            <div class="col-sm-9">
                            {{ Form::text('status_pembayaran', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Keterangan</p>
                            <div class="col-sm-9">
                            {{ Form::text('keterangan', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @if ($payment->metode_pembayaran == "Transfer")
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Bukti Pembayaran</p>
                            <div class="col-sm-5">
                            <img class="img-responsive" src="{{ asset('bukti_pembayaran/'.$payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" title="Bukti Pembayaran">
                            </div>
                        </div>
                        @endif
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
