<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Nama Barang</p>
    <div class="col-sm-6">
    {{ Form::text('nama_barang', null, ['class' => 'form-control', 'name' => 'nama_barang', 'placeholder' => 'Nama Barang']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Stok Barang</p>
    <div class="col-sm-6">
    {{ Form::number('stok_barang', null, ['class' => 'form-control', 'name' => 'stok_barang', 'placeholder' => 'ex: 100']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Harga Barang</p>
    <div class="col-sm-6">
    {{ Form::number('harga_barang', null, ['class' => 'form-control', 'name' => 'harga_barang', 'placeholder' => 'ex: 25000']) }}
    </div>
    <div class="col-sm-2"></div>
</div>