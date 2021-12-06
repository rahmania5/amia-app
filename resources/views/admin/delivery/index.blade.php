@extends('layouts.app', [
    'namePage' => 'Pengelolaan Pengantaran',
    'class' => 'sidebar-mini ',
    'activePage' => 'delivery',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Pengantaran') }}</h5>
              </div>
              <div class="col-6"></div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $deliveries->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF DELIVERIES --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Pengantaran</th>
                        <th scope="col">Nama Driver</th>
                        <th scope="col">No. Kendaraan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($deliveries as $d)
                        <tr>
                            <td> {{ $loop->iteration + $deliveries->firstItem() - 1 }} </td>
                            <td>{{ $d['tanggal_pengantaran'] }}</td>
                            <td>{{ $d->driver->nama_driver}}</td>
                            <td>{{ strtoupper($d->vehicle->no_polisi) }}</td>
                            <td>
                                <form method="POST" action="delivery/{{$d->id}}">
                                <a href="delivery/{{$d->id}}/show"><button  type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                                <a href="delivery/{{$d->id}}/edit"><button type="button" class="btn btn-outline-warning"><span class="fas fa-edit"></span></button></a>
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
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
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