@extends('layouts.app', [
    'namePage' => 'Pengelolaan Transaksi',
    'class' => 'sidebar-mini',
    'activePage' => 'sales_transaction'
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
        @elseif (session('success'))
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
                        <h5 class="card-title">{{ __('Insert Data Transaksi') }}</h5>
                    </div>
                    
                    {{ Form::open(['route' => 'admin.sales_transaction.store', 'method' => 'post']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.salesTransaction.create_form')                
                        <div class="col-10">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-round float-right mb-3" onclick="return confirmSubmit()"/>
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
        var result = confirm("Pastikan data yang dimasukkan sudah benar. Yakin ingin menyimpan data?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush