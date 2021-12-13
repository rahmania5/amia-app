@extends('layouts.app', [
    'namePage' => 'Pengelolaan Produksi',
    'class' => 'sidebar-mini',
    'activePage' => 'production'
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Informasi Produksi') }}</h5>
                    </div>
                    
                    {{ Form::open(['route' => ['production.addItem'], 'method' => 'post']) }}
                    {{ csrf_field() }}
                    <div class="card-body">
                    {{ Form::model($production, []) }}

                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">Tanggal Produksi</p>
                            <div class="col-sm-10">
                            {{ Form::text('tanggal_produksi', null, ['class' => 'form-control-plaintext', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Detail Data Produksi') }}</h5>
                    </div>
                    <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        </div>
                    @endif
                    @include('admin.production.addItem_form')                
                        <div class="col-10">
                            <input type="submit" value="Tambah Barang" class="btn btn-primary btn-round float-right mb-3"/>
                        </div>
                    {{ Form::close() }}

                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="float-right">
                            {{ $productionDetails->links() }}
                            </div>
                        </div>
                    </div>
                    {{-- LIST OF PRODUCTION DETAILS --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Qty Barang Jadi</th>
                                    <th scope="col">Qty Barang Rusak</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($productionDetails as $pd)
                                    <tr>
                                        <td>{{ $loop->iteration + $productionDetails->firstItem() - 1 }}</td>
                                        <td>{{ $pd->goods->nama_barang }}</td>
                                        <td>{{ $pd['qty_barang_jadi'] }}</td>
                                        <td>{{ $pd['qty_barang_rusak'] }}</td>
                                        <td>
                                            <form method="POST" action="{{$pd->id}}/remove">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirmDelete()"><span class="fas fa-trash"></span></button>       
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="{{$production->id}}/produce">
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-round" onclick="return confirmProduce()"></button>    
                        </div>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
  <script>
    function confirmProduce() {
        var result = confirm("Pastikan data yang dimasukkan sudah benar. Yakin ingin menyimpan data?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }

    function confirmDelete() {
        var result = confirm("Yakin ingin menghapus data?");
        if (result) {
            return true;
        }
        else {
            return false;
        }
    }
  </script>
@endpush
