@extends('layouts.app', [
    'namePage' => 'Pengelolaan Barang',
    'class' => 'sidebar-mini',
    'activePage' => 'goods'
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
                        <h5 class="card-title">{{ __('Insert Data Barang') }}</h5>
                    </div>
                    
                    {{ Form::open(['route' => 'goods.store', 'method' => 'post']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.goods.create_form')                
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