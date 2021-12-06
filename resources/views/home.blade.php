@extends('layouts.app', [
    'namePage' => 'Home',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
          <h3 class="card-title text-center mt-4 mb-2">{{ 'Selamat Datang di Sistem Informasi Distribusi AMIA' }}</h2>
          <p class="text-center mt-2 mb-4">{{ 'Anda login sebagai '.$user->name }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection