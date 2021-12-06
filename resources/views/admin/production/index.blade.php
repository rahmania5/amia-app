@extends('layouts.app', [
    'namePage' => 'Pengelolaan Stok',
    'class' => 'sidebar-mini ',
    'activePage' => 'production',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data Riwayat Produksi') }}</h5>
              </div>
              <div class="col-6">
                <a href="production/create"><button type="button" class="btn btn-primary btn-round float-right">
                <span class="fas fa-plus-circle"></span> Insert Data</button></a>
              </div>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="float-right">
                {{ $productions->links() }}
                </div>
            </div>
          </div>
          {{-- LIST OF PRODUCTIONS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Produksi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($productions as $p)
                        <tr>
                            <td> {{ $loop->iteration + $productions->firstItem() - 1 }} </td>
                            <td>{{ $p['tanggal_produksi'] }}</td>
                            <td>
                                <form method="POST" action="production/{{$p->id}}">
                                <a href="production/{{$p->id}}"><button  type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
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