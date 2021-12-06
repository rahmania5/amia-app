<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Tanggal Transaksi</p>
    <div class="col-sm-5">
    {{ Form::date('tanggal_transaksi', now(), ['class' => 'form-control', 'name' => 'tanggal_transaksi']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Jenis Pembayaran</p>
    <div class="col-sm-5">
    {{ Form::select('jenis_pembayaran', $jenisPembayaran, null, ['class' => 'form-control', 'name' => 'jenis_pembayaran', 'placeholder' => 'Pilih Jenis Pembayaran']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Tanggal Kirim</p>
    <div class="col-sm-5">
    {{ Form::date('tanggal_kirim', now(), ['class' => 'form-control', 'name' => 'tanggal_kirim']) }}
    </div>
    <div class="col-sm-2"></div>
</div>