<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">ID Produksi</p>
    <div class="col-sm-5">
    {{ Form::text('production_id', $production->id, ['class' => 'form-control-plaintext', 'name' => 'production_id', 'readonly' => 'readonly']) }}
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
    <p class="col-sm-3 col-form-label">Qty Barang Jadi</p>
    <div class="col-sm-5">
    {{ Form::number('qty_barang_jadi', null, ['class' => 'form-control', 'name' => 'qty_barang_jadi', 'placeholder' => 'ex: 100']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Qty Barang Rusak</p>
    <div class="col-sm-5">
    {{ Form::number('qty_barang_rusak', null, ['class' => 'form-control', 'name' => 'qty_barang_rusak', 'placeholder' => 'ex: 15']) }}
    </div>
    <div class="col-sm-2"></div>
</div>