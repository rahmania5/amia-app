@extends('layouts.app', [
    'namePage' => 'Pengelolaan Driver',
    'class' => 'sidebar-mini',
    'activePage' => 'driver'
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Edit Data Driver') }}</h5>
                    </div>
                    
                    {{ Form::model($driver, ['route' => ['driver.update', $driver->id], 'method' => 'patch']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.driver.edit_form')                
                        <div class="col-10">
                            <input type="submit" value="Simpan Perubahan" class="btn btn-primary btn-round float-right mb-3"/>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection