<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Nama Barang</p>
    <div class="col-sm-5">
    {{ Form::text('goods_id', $deliveryDetail->sales_transaction_detail->goods->nama_barang, ['class' => 'form-control', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Qty Barang Dikirim</p>
    <div class="col-sm-5">
    {{ Form::number('qty_barang_dikirim', $deliveryDetail->qty_barang_dikirim, ['class' => 'form-control', 'name' => 'qty_barang_dikirim', 'placeholder' => 'ex: 100']) }}
    </div>
    <div class="col-sm-2"></div>
</div>