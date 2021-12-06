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
    <p class="col-sm-3 col-form-label">Total Return</p>
    <div class="col-sm-5">
    {{ Form::text('total_return', 0, ['class' => 'form-control-plaintext', 'name' => 'total_return', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Status Return</p>
    <div class="col-sm-5">
    {{ Form::text('status_return', 'Belum diajukan', ['class' => 'form-control-plaintext', 'name' => 'status_return', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>