@extends('layouts.app', [
    'namePage' => 'Laporan Distributor',
    'class' => 'sidebar-mini ',
    'activePage' => 'distributor',
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
            <div class="row">
              <div class="col-6">
                <span class="float-left"><h5 class="card-title">{{ __('Data Distributor Per Provinsi') }}</h5>
              </div>
              <div class="col-6"> </div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                </div>
            </div>
          </div>
          {{-- LIST OF DISTRIBUTORS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Kabupaten/Kota</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Jumlah Distributor</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($provinces as $p)
                    <tr>
                        <td>{{ $p->nama_provinsi }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <a href="distributor/show/{{$p->id}}"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                        </td>
                    </tr>
                    @foreach ($p->city as $c)
                    <tr>
                        <td>{{ $p->nama_provinsi }}</td>
                        <td>{{ $c->nama_kab_kota }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($c->district as $d)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $d->nama_kecamatan }}</td>
                        <td class="text-center">{{ $d->distributor->count() }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endforeach
                    <tr>
                        <td colspan="3">Total Distributor</td>
                        <td class="text-center">{{ $distributors->count() }}</td>
                        <td>
                          <a href="{{ route('admin.distributor.show', ['action'=>'show']) }}"><button type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                        </td>
                    </tr>
                </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection