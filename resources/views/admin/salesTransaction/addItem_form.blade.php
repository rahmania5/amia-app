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
    <p class="col-sm-3 col-form-label">Nama Barang</p>
    <div class="col-sm-5">
    {{ Form::select('goods_id', $goods, null, ['class' => 'form-control', 'name' => 'goods_id', 'placeholder' => 'Pilih Barang']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Qty</p>
    <div class="col-sm-5">
    {{ Form::number('qty', null, ['class' => 'form-control', 'name' => 'qty', 'placeholder' => 'ex: 100']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Keterangan</p>
    <div class="col-sm-5">
    {{ Form::text('keterangan', null, ['class' => 'form-control', 'name' => 'keterangan', 'placeholder' => 'Keterangan']) }}
    </div>
    <div class="col-sm-2"></div>
</div>