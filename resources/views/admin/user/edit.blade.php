@extends('layouts.app', [
    'namePage' => 'Pengelolaan User',
    'class' => 'sidebar-mini',
    'activePage' => 'user'
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
                        <h5 class="card-title">{{ __('Edit Data User') }}</h5>
                    </div>
                    
                    {{ Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch']) }}
                    {{ csrf_field() }}

                    <div class="card-body">
                        @include('admin.user.edit_form')                
                        <div class="col-10">
                            <input type="submit" value="Simpan Perubahan" class="btn btn-primary btn-round float-right mb-3"/>
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
    jQuery(document).ready(function() {
      jQuery('select[name="province"]').on('change', function(){
        var province_id = jQuery(this).val();
        if(province_id)
        {
          jQuery.ajax({
          url: "{{ route('user.select_city') }}/" +province_id,
          type : "GET",
          dataType : "json",
          success:function(data)
          {
            console.log(data);
            jQuery('select[name="city"]').empty();
            jQuery.each(data, function(province_key,province_value){
              $('select[name="city"]').append('<option value="'+ province_key +'">'+ province_value +'</option>');
            });
          }
          });
        }
        else
        {
          $('select[name="city"]').empty();
        }
      });

      jQuery('select[name="city"]').on('change', function(){
        var city_id = jQuery(this).val();
        if(city_id)
        {
          jQuery.ajax({
          url : "{{ route('user.select_district') }}/" +city_id,
          type : "GET",
          dataType : "json",
          success:function(data)
          {
            console.log(data);
            jQuery('select[name="district_id"]').empty();
            jQuery.each(data, function(city_key,city_value){
              $('select[name="district_id"]').append('<option value="'+ city_key +'">'+ city_value +'</option>');
            });
          }
          });
        }
        else
        {
          $('select[name="district_id"]').empty();
        }
      });
    });
  </script>
@endpush
