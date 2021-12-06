@extends('layouts.app', [
    'namePage' => 'Pengelolaan Piutang',
    'class' => 'sidebar-mini ',
    'activePage' => 'loan',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Pembayaran Piutang') }}</h5>
              </div>
              <div class="col-6"></div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $loans->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF LOAN PAYMENTS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Distributor</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($loans as $l)
                        <tr>
                            <td> {{ $loop->iteration + $loans->firstItem() - 1 }} </td>
                            <td>{{ $l->name }}</td>
                            <td>{{ $l->alamat}}</td>
                            <td>
                                <a href="loan/{{$l->id}}/show"><button  type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection