<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">ID Transaksi</p>
    <div class="col-sm-5">
    {{ Form::text('sales_transaction_id', $salesTransaction->id, ['class' => 'form-control-plaintext', 'name' => 'sales_transaction_id', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Tanggal Pembayaran</p>
    <div class="col-sm-5">
    {{ Form::date('tanggal_pembayaran', now(), ['class' => 'form-control', 'name' => 'tanggal_pembayaran']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Metode Pembayaran</p>
    <div class="col-sm-5">
    {{ Form::select('metode_pembayaran', $metodePembayaran, null, ['class' => 'form-control', 'name' => 'metode_pembayaran', 'placeholder' => 'Pilih Metode Pembayaran']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@if ($salesTransaction->jenis_pembayaran == "Utang" && $salesTransaction->sisa_utang < $salesTransaction->total_transaksi)
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Jumlah Pembayaran</p>
    <div class="col-sm-5">
    {{ Form::number('jumlah_pembayaran', $salesTransaction->sisa_utang, ['class' => 'form-control', 'name' => 'jumlah_pembayaran', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@elseif ($salesTransaction->jenis_pembayaran == "Lunas")
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Jumlah Pembayaran</p>
    <div class="col-sm-5">
    {{ Form::number('jumlah_pembayaran', $salesTransaction->total_transaksi, ['class' => 'form-control', 'name' => 'jumlah_pembayaran', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@else
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Jumlah Pembayaran</p>
    <div class="col-sm-5">
    {{ Form::number('jumlah_pembayaran', $salesTransaction->total_transaksi, ['class' => 'form-control', 'name' => 'jumlah_pembayaran', 'placeholder' => 'ex: 1000000']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@endif
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Keterangan</p>
    <div class="col-sm-5">
    {{ Form::text('keterangan', null, ['class' => 'form-control', 'name' => 'keterangan', 'placeholder' => 'ex: Pembayaran pertama']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Bukti Pembayaran</p>
    <div class="col-sm-5">
        <div class="control-group">
            <input type="file" name="bukti_pembayaran">
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>
