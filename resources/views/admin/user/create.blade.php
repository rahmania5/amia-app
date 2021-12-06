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
                        <h5 class="card-title">{{ __('Insert Data User') }}</h5>
                    </div>
                    
                    {{ Form::open(['route' => 'user.store', 'method' => 'post']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.user.create_form')                
                        <div class="col-10">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-round float-right mb-3" onclick="return confirmPayment()"/>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection