<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Tanggal Produksi</p>
    <div class="col-sm-6">
    {{ Form::date('tanggal_produksi', now(), ['class' => 'form-control', 'name' => 'tanggal_produksi']) }}
    </div>
    <div class="col-sm-2"></div>
</div>