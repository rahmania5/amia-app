@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'User Profile',
    'activePage' => 'profile',
    'activeNav' => '',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Profile")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" Email address")}}</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                      @include('alerts.feedback', ['field' => 'email'])
                    </div>
                  </div>
                </div>
                @if (auth()->user()->role == 'Distributor')
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" NIK")}}</label>
                      <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ old('nik', auth()->user()->distributor->nik) }}">
                      @include('alerts.feedback', ['field' => 'nik'])
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" Provinsi")}}</label>
                      <select class="form-control" id="province" name="province" value="{{ old('province') }}">
                          <option selected>{{ auth()->user()->distributor->district->city->province->nama_provinsi }}</option>    
                          @foreach ($provinces as $province_key => $province_value)
                          <option value="{{ $province_key }}">{{ $province_value }}</option>
                          @endforeach 
                      </select>  
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" Kabupaten/Kota")}}</label>
                      <select class="form-control" id="city" name="city" value="{{ old('city') }}">
                          <option selected>{{ auth()->user()->distributor->district->city->nama_kab_kota }}</option>  
                      </select> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" Kecamatan")}}</label>
                      <select class="form-control" id="district" name="district_id" value="{{ old('district_id') }}">
                          <option selected>{{ auth()->user()->distributor->district->nama_kecamatan }}</option>  
                      </select>
                      @include('alerts.feedback', ['field' => 'district_id'])
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" Alamat")}}</label>
                      <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ old('alamat', auth()->user()->distributor->alamat) }}">
                      @include('alerts.feedback', ['field' => 'alamat'])
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label>{{__(" Nomor Telepon")}}</label>
                      <input type="text" name="no_telepon" class="form-control" placeholder="Nomor Telepon" value="{{ old('no_telepon', auth()->user()->distributor->no_telepon) }}">
                      @include('alerts.feedback', ['field' => 'no_telepon'])
                    </div>
                  </div>
                </div>
                @endif
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
          <div class="card-header">
            <h5 class="title">{{__("Password")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
              @csrf
              @method('put')
              @include('alerts.success', ['key' => 'password_status'])
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" Current Password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" placeholder="{{ __('Current Password') }}" type="password"  required>
                    @include('alerts.feedback', ['field' => 'old_password'])
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" New password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password" required>
                    @include('alerts.feedback', ['field' => 'password'])
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm New Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="{{asset('assets')}}/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
                <img class="avatar border-gray" src="{{asset('assets')}}/img/default-avatar.png" alt="...">
                <h5 class="title text-primary">{{ auth()->user()->name }}</h5>
              <p class="description">
                  {{ auth()->user()->email }}
              </p>
            </div>
          </div>
          @if (auth()->user()->role == 'Distributor' && $countLoan > 0)
          <hr>
          <div class="button-container">
            <a href="{{ route('distributor.loan.show', auth()->user()->distributor->id) }}" target="blank">
            <button class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fas fa-print" data-toggle="tooltip" title="Print Kartu Piutang"></i>
            </button>
            </a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    jQuery(document).ready(function() {
      jQuery('[data-toggle="tooltip"]').tooltip({'placement': 'bottom'});
      
      jQuery('select[name="province"]').on('change', function(){
        var province_id = jQuery(this).val();
        if(province_id)
        {
          jQuery.ajax({
          url: "{{ route('profile.select_city') }}/" +province_id,
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
          url : "{{ route('profile.select_district') }}/" +city_id,
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