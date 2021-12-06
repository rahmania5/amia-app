<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Nama</p>
    <div class="col-sm-6">
    {{ Form::text('name', null, ['class' => 'form-control', 'name' => 'name', 'placeholder' => 'Nama']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Email</p>
    <div class="col-sm-6">
    {{ Form::email('email', null, ['class' => 'form-control', 'name' => 'email', 'placeholder' => 'Email']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@if (isset($roles))
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Role</p>
    <div class="col-sm-6">
    {{ Form::select('role', $roles, null, ['class' => 'form-control', 'name' => 'role', 'placeholder' => 'Pilih Role User']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@elseif (isset($distributor))
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">NIK</p>
    <div class="col-sm-6">
    {{ Form::text('nik', $distributor->nik, ['class' => 'form-control', 'name' => 'nik', 'placeholder' => 'NIK']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Role</p>
    <div class="col-sm-6">
    {{ Form::text('role', null, ['class' => 'form-control', 'name' => 'role', 'readonly' => 'readonly']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Provinsi</p>
    <div class="col-sm-6">
    <select class="form-control" id="province" name="province" value="{{ old('province') }}">
        <option selected>{{ $distributor->district->city->province->nama_provinsi }}</option>    
        @foreach ($provinces as $province_key => $province_value)
        <option value="{{ $province_key }}">{{ $province_value }}</option>
        @endforeach 
    </select>     
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Kabupaten/Kota</p>
    <div class="col-sm-6">
    <select class="form-control" id="city" name="city" value="{{ old('city') }}">
        <option selected>{{ $distributor->district->city->nama_kab_kota }}</option>  
    </select> 
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Kecamatan</p>
    <div class="col-sm-6">
    <select class="form-control" id="district" name="district_id" value="{{ old('district_id') }}">
        <option selected>{{ $distributor->district->nama_kecamatan }}</option>  
    </select> 
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Alamat</p>
    <div class="col-sm-6">
    {{ Form::text('alamat', $distributor->alamat, ['class' => 'form-control', 'name' => 'alamat', 'placeholder' => 'Alamat']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">No. HP</p>
    <div class="col-sm-6">
    {{ Form::text('no_telepon', $distributor->no_telepon, ['class' => 'form-control', 'name' => 'no_telepon', 'placeholder' => 'ex: 081234567890']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
@endif