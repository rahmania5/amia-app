@extends('layouts.app', [
    'namePage' => 'Pengelolaan User',
    'class' => 'sidebar-mini ',
    'activePage' => 'user',
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
                <span class="float-left"><h5 class="card-title">{{ __('Data User') }}</h5>
              </div>
              <div class="col-6">
                <a href="user/create"><button type="button" class="btn btn-primary btn-round float-right">
                <span class="fas fa-plus-circle"></span> Insert Data</button></a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-9"></div>
              <div class="col-3">
              <form method="GET" action="{{ url()->current() }}">
                <div class="input-group no-border">
                  <input name="keyword" type="text" value="{{ request('keyword') }}" class="form-control" placeholder="Search...">
                  <div class="input-group-append">
                    <div class="input-group-text" style="padding: 5px 5px 5px 0px;">
                      <button class="btn btn-fab btn-icon btn-round btn-primary" style="margin: 0px;" type="submit">
                      <i class="now-ui-icons ui-1_zoom-bold"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
            </div>
            <div class="row">
              <div class="col-2"></div>
              <div class="col-10">
                  <div class="float-right">
                  {{ $users->links() }}
                  </div>
              </div>
            </div>
          {{-- LIST OF USERS --}}
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td> {{ $loop->iteration + $users->firstItem() - 1 }} </td>
                            <td>{{ $u['name'] }}</td>
                            <td>{{ $u['email'] }}</td>
                            <td>{{ $u['role'] }}</td>
                            <td>
                                <form method="POST" action="user/{{$u->id}}">
                                <a href="user/{{$u->id}}"><button  type="button" class="btn btn-outline-info"><span class="fas fa-eye"></span></button></a>
                                <a href="user/{{$u->id}}/edit"><button type="button" class="btn btn-outline-warning"><span class="fas fa-edit"></span></button></a>
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