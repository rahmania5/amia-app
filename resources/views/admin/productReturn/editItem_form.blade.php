<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Nama Barang</p>
    <div class="col-sm-5">
    {{ Form::text('goods_id', $returnDetail->sales_transaction_detail->goods->nama_barang, ['class' => 'form-control', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Harga Barang</p>
    <div class="col-sm-5">
    {{ Form::text('harga_barang', $returnDetail->sales_transaction_detail->goods->harga_barang, ['class' => 'form-control', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Qty Barang Return</p>
    <div class="col-sm-5">
    {{ Form::number('qty_return', $returnDetail->qty_return, ['class' => 'form-control', 'name' => 'qty_return', 'placeholder' => 'ex: 100']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Alasan Return</p>
    <div class="col-sm-5">
    {{ Form::text('alasan_return', $returnDetail->alasan_return, ['class' => 'form-control', 'name' => 'alasan_return', 'placeholder' => 'Alasan Return']) }}
    </div>
    <div class="col-sm-2"></div>
</div>