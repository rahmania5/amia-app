@extends('layouts.app', [
    'namePage' => 'Pengelolaan Kendaraan',
    'class' => 'sidebar-mini ',
    'activePage' => 'vehicle',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Kendaraan') }}</h5>
              </div>
              <div class="col-6">
                <a href="vehicle/create"><button type="button" class="btn btn-primary btn-round float-right">
                <span class="fas fa-plus-circle"></span> Insert Data</button></a>
              </div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $vehicles->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF VEHICLES --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Polisi</th>
                        <th scope="col">Jenis Kendaraan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($vehicles as $v)
                        <tr>
                            <td> {{ $loop->iteration + $vehicles->firstItem() - 1 }} </td>
                            <td>{{ strtoupper($v['no_polisi']) }}</td>
                            <td>{{ $v['jenis_kendaraan'] }}</td>
                            <td>
                                <form method="POST" action="vehicle/{{$v->id}}">
                                <a href="vehicle/{{$v->id}}/edit"><button type="button" class="btn btn-outline-warning"><span class="fas fa-edit"></span></button></a>
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