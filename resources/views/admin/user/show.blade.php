@extends('layouts.app', [
    'namePage' => 'Pengelolaan User',
    'class' => 'sidebar-mini',
    'activePage' => 'user'
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Informasi User') }}</h5>
                    </div>

                    <div class="card-body">
                    {{ Form::model($user, []) }}

                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Nama</p>
                            <div class="col-sm-9">
                            {{ Form::text('name', null, ['class' => 'form-control-plaintext', 'name' => 'name', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Email</p>
                            <div class="col-sm-9">
                            {{ Form::text('email', null, ['class' => 'form-control-plaintext', 'name' => 'email', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Role</p>
                            <div class="col-sm-9">
                            {{ Form::text('role', null, ['class' => 'form-control-plaintext', 'name' => 'role', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @if (isset($user->distributor))
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">NIK</p>
                            <div class="col-sm-9">
                            {{ Form::text('nik', $user->distributor->nik, ['class' => 'form-control-plaintext', 'name' => 'nik', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Provinsi</p>
                            <div class="col-sm-9">
                            {{ Form::text('province', $user->distributor->district->city->province->nama_provinsi, ['class' => 'form-control-plaintext', 'name' => 'province', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Kabupaten/Kota</p>
                            <div class="col-sm-9">
                            {{ Form::text('city', $user->distributor->district->city->nama_kab_kota, ['class' => 'form-control-plaintext', 'name' => 'city', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Kecamatan</p>
                            <div class="col-sm-9">
                            {{ Form::text('district_id', $user->distributor->district->nama_kecamatan, ['class' => 'form-control-plaintext', 'name' => 'district_id', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Alamat</p>
                            <div class="col-sm-9">
                            {{ Form::text('alamat', $user->distributor->alamat, ['class' => 'form-control-plaintext', 'name' => 'alamat', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">No. HP</p>
                            <div class="col-sm-9">
                            {{ Form::text('no_telepon', $user->distributor->no_telepon, ['class' => 'form-control-plaintext', 'name' => 'no_telepon', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-3 col-form-label">Sisa Uang Return</p>
                            <div class="col-sm-9">
                            {{ Form::text('sisa_uang_return', $user->distributor->sisa_uang_return, ['class' => 'form-control-plaintext', 'name' => 'no_telepon', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                        @endif
                    {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
