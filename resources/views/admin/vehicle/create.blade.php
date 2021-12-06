@extends('layouts.app', [
    'namePage' => 'Pengelolaan Kendaraan',
    'class' => 'sidebar-mini',
    'activePage' => 'vehicle'
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
                        <h5 class="card-title">{{ __('Insert Data Kendaraan') }}</h5>
                    </div>
                    
                    {{ Form::open(['route' => 'vehicle.store', 'method' => 'post']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.vehicle.create_form')                
                        <div class="col-10">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-round float-right mb-3"/>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection