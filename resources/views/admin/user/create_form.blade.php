<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Role</p>
    <div class="col-sm-6">
    {{ Form::select('role', $roles, null, ['class' => 'form-control', 'name' => 'role', 'placeholder' => 'Pilih Role User']) }}
    </div>
    <div class="col-sm-2"></div>
</div>
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
<div class="form-group row">
    <div class="col-sm-2"></div>
    <p class="col-sm-2 col-form-label">Password</p>
    <div class="col-sm-6">
    <input class="form-control" name="password" type="password" placeholder="Password">
    </div>
    <div class="col-sm-2"></div>
</div>