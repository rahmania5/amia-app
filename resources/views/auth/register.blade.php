@extends('layouts.app', [
    'namePage' => 'Register page',
    'activePage' => 'register',
    'backgroundImage' => asset('assets') . "/img/bgamia.jpg",
])

@section('content')
  <div class="content">
    <div class="container">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="card card-signup text-center">
            <div class="card-header ">
              <h4 class="card-title">{{ __('Register') }}</h4>
            </div>
            <div class="card-body ">
              <form method="POST" action="{{ route('register') }}">
                @csrf
              <div class="row">
                <!--Begin input name -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </div>
                  </div>
                  <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <!--Begin input nik -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons business_badge"></i>
                    </div>
                  </div>
                  <input class="form-control {{ $errors->has('nik') ? ' is-invalid' : '' }}" placeholder="{{ __('NIK') }}" type="text" name="nik" value="{{ old('nik') }}" required>
                  @if ($errors->has('nik'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                      <strong>{{ $errors->first('nik') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="row">
                <!--Begin input province -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons location_pin"></i>
                    </div>
                  </div>
                  <select class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                    <option selected>Pilih Provinsi</option>
                    @foreach ($provinces as $province_key => $province_value)
                    <option value="{{ $province_key }}">{{ $province_value }}</option>
                    @endforeach 
                  </select> 
                </div>
                <!--Begin input city -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons location_pin"></i>
                    </div>
                  </div>
                  <select class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                    <option selected>Pilih Kabupaten/Kota</option>
                  </select> 
                </div>
              </div>  
              <div class="row">
                <!--Begin input district -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons location_pin"></i>
                    </div>
                  </div>
                  <select class="form-control" id="district" name="district_id" value="{{ old('district_id') }}" required>
                    <option selected>Pilih Kecamatan</option>
                  </select> 
                  @if ($errors->has('district_id'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                      <strong>{{ $errors->first('district_id') }}</strong>
                    </span>
                  @endif
                </div>
                <!--Begin input address -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons shopping_shop"></i>
                    </div>
                  </div>
                  <input class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" name="alamat" value="{{ old('alamat') }}" required>
                  @if ($errors->has('alamat'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                      <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="row">
                <!--Begin input phone number -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons tech_mobile"></i>
                    </div>
                  </div>
                  <input class="form-control {{ $errors->has('no_telepon') ? ' is-invalid' : '' }}" placeholder="{{ __('Nomor Telepon') }}" type="text" name="no_telepon" value="{{ old('no_telepon') }}" required>
                  @if ($errors->has('no_telepon'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                      <strong>{{ $errors->first('no_telepon') }}</strong>
                    </span>
                  @endif
                </div>
                <!--Begin input email -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons ui-1_email-85"></i>
                    </div>
                  </div>
                  <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                 </div>
              </div>
              <div class="row">
                <!--Begin input password -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i>
                    </div>
                  </div>
                  <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                <!--Begin input confirm password -->
                <div class="col-md-5 ml-auto mr-auto input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i></i>
                    </div>
                  </div>
                  <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round btn-lg">{{__('Sign Up')}}</button>
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
    jQuery(document).ready(function() {
      demo.checkFullPageBackgroundImage();
      jQuery('select[name="province"]').on('change', function(){
        var province_id = jQuery(this).val();
        if(province_id)
        {
          jQuery.ajax({
          url : 'register/cities/' +province_id,
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
          url : 'register/districts/' +city_id,
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
