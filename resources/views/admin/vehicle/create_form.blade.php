<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Nomor Polisi</p>
    <div class="col-sm-6">
    {{ Form::text('no_polisi', null, ['class' => 'form-control', 'name' => 'no_polisi', 'placeholder' => 'ex: BA 1456 PQR']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Jenis Kendaraan</p>
    <div class="col-sm-6">
    {{ Form::text('jenis_kendaraan', null, ['class' => 'form-control', 'name' => 'jenis_kendaraan', 'placeholder' => 'ex: Daihatsu Hi Max']) }}
    </div>
    <div class="col-sm-2"></div>
</div>