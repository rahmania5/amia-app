<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Tanggal Pengantaran</p>
    <div class="col-sm-5">
    {{ Form::date('tanggal_pengantaran', now(), ['class' => 'form-control', 'name' => 'tanggal_pengantaran']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Driver</p>
    <div class="col-sm-5">
    {{ Form::select('driver_id', $drivers, null, ['class' => 'form-control', 'name' => 'driver_id', 'placeholder' => 'Pilih Driver']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Kendaraan</p>
    <div class="col-sm-5">
    {{ Form::select('vehicle_id', $vehicles, null, ['class' => 'form-control', 'name' => 'vehicle_id', 'placeholder' => 'Pilih Kendaraan']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Jam Berangkat</p>
    <div class="col-sm-5">
    {{ Form::time('jam_berangkat', null, ['class' => 'form-control', 'name' => 'jam_berangkat']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-3 col-form-label">Jam Diterima</p>
    <div class="col-sm-5">
    {{ Form::time('jam_diterima', null, ['class' => 'form-control', 'name' => 'jam_diterima']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
