@extends('layouts.app', [
    'namePage' => 'Pengelolaan Return',
    'class' => 'sidebar-mini',
    'activePage' => 'return'
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
                        <h5 class="card-title">{{ __('Insert Data Return') }}</h5>
                    </div>
                    
                    {{ Form::open(['route' => 'admin.return.store', 'method' => 'post']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.productReturn.create_form')                
                        <div class="col-10">
                            <input type="submit" value="Lanjut" class="btn btn-info btn-round float-right mb-3" onclick="return confirmSubmit()"/>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
  <script>
    function confirmSubmit() {
        var result = confirm("Yakin ingin melanjutkan proses return barang?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush