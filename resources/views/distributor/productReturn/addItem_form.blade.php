{{ Form::hidden('sales_transaction_id', $salesTransaction->id, ['class' => 'form-control-plaintext', 'name' => 'sales_transaction_id']) }}
{{ Form::hidden('product_return_id', $return->id, ['class' => 'form-control-plaintext', 'name' => 'product_return_id']) }}

<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Nama Barang</p>
    <div class="col-sm-5">
    {{ Form::select('goods_id', $goods, null, ['class' => 'form-control', 'name' => 'goods_id', 'placeholder' => 'Pilih Barang Return']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Qty Barang Return</p>
    <div class="col-sm-5">
    {{ Form::number('qty_return', null, ['class' => 'form-control', 'name' => 'qty_return', 'placeholder' => 'ex: 100']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Alasan Return</p>
    <div class="col-sm-5">
    {{ Form::text('alasan_return', null, ['class' => 'form-control', 'name' => 'alasan_return', 'placeholder' => 'Alasan Return']) }}
    </div>
    <div class="col-sm-2"></div>
</div>