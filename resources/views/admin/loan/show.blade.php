@extends('layouts.app', [
    'namePage' => 'Laporan Piutang',
    'class' => 'sidebar-mini',
    'activePage' => 'user'
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Informasi Distributor') }}</h5>
                    </div>

                    <div class="card-body">
                    {{ Form::model($distributor, []) }}

                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Nama</p>
                            <div class="col-sm-9">
                            {{ Form::text('name', $distributor->user->name, ['class' => 'form-control-plaintext', 'name' => 'name', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Alamat</p>
                            <div class="col-sm-9">
                            {{ Form::text('alamat', $distributor->alamat, ['class' => 'form-control-plaintext', 'name' => 'alamat', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">No. HP</p>
                            <div class="col-sm-9">
                            {{ Form::text('no_telepon', $distributor->no_telepon, ['class' => 'form-control-plaintext', 'name' => 'no_telepon', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Sisa Uang Return</p>
                            <div class="col-sm-9">
                            {{ Form::text('sisa_uang_return', $distributor->sisa_uang_return, ['class' => 'form-control-plaintext', 'name' => 'no_telepon', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <span class="float-left"><h5 class="card-title">{{ __('Riwayat Piutang') }}</h5>
                            </div>
                            <div class="col-2">
                                <a href="printKartu" target="blank">
                                    <button type="button" class="btn btn-round btn-outline-info btn-icon float-right">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </a>
                            </div>
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
                    {{-- LIST OF LOANS --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary text-center">
                                <tr>
                                    <th rowspan="2" scope="col">Tanggal</th>
                                    <th rowspan="2" scope="col">No. SPB</th>
                                    <th rowspan="2" scope="col">Total Transaksi</th>
                                    <th rowspan="2" scope="col">Tanggal</th>
                                    <th rowspan="2" scope="col">Pembayaran</th>
                                    <th rowspan="2" scope="col">Saldo Akhir</th>
                                    <th rowspan="2" scope="col">Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($salesTransactions as $st)
                                <tr>
                                    <td>{{ $st->tanggal_transaksi }}</td>
                                    @if (isset($st->sales_transaction_detail[0]->delivery_detail[0]->delivery_id))
                                        <td class="text-center"> {{ $st->sales_transaction_detail[0]->delivery_detail[0]->delivery_id }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                    <td class="text-right">{{ $st['total_transaksi'] }}</td>
                                    <td> </td>
                                    <td> </td>
                                    <td class="text-right">{{ $st['total_transaksi'] }}</td>
                                    <td> </td>
                                </tr>
                                @if (!$st->payment->isEmpty())
                                @foreach($st->payment as $payment)
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td>{{ $payment->tanggal_pembayaran }}</td>
                                    <td class="text-right">{{ $payment->jumlah_pembayaran }}</td>
                                    @if ($st->payment[0]->id == $payment->id)
                                    <td class="text-right">{{ $st->total_transaksi - $payment->jumlah_pembayaran }}</td>
                                    @elseif ($st->payment[1]->id == $payment->id)
                                    <td class="text-right">{{ $st->total_transaksi - $st->payment[0]->jumlah_pembayaran - $st->payment[1]->jumlah_pembayaran }}</td>
                                    @endif
                                    <td>{{ $payment->keterangan }}</td>
                                </tr>
                                @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>    
                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection
