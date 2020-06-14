{{-- @extends('layouts.app') --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ config('app.name', 'Laravel') }}</title>
<!-- icon -->
  <!-- Custom fonts for this template-->
  <link href="{{asset('build/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <link href="{{asset('build/css/login-page.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="admin_login_bg"></div>

<div class="container container-fluid ">
        <div class="row">
        <div class="col-md-6">   
        <div class="login animated   text-center" style="color:rgb(0, 0, 0);"> 
          <div class="row">
            <div class="col-md-12">
          <img src="{{asset('build/img/logoch7hd.png')}}" class="img-profile" style="max-width: 150px;" />
        <div class="text-center"><h1 class="active h2_login">Maintenance Service System </h1></div>
        <label class="">ระบบซ่อมบำรุง</label>

        <form method="POST" action="{{ route('login') }}" class="form_login">
         @csrf
         <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  autofocus placeholder="ระบุชื่อผู้ใช้งาน">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          </div>
        </div>
  
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="ระบุรหัสผ่าน">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <button type="submit" class="btn btn-outline-primary  signin">
          {{ __('ลงชื่อเข้าใช้งานระบบ') }}
        </button>
        {{-- <a href="#" class="small mt-4">ลืมรหัสผ่านใช่หรือไม่ ??</a> --}}
          </div>
          {{-- End div col-md-6 --}}

          {{-- <div class="col-md-6">

            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card h-100 py-2 shadow">
                <div class="card-body">
                  <div class="row no-gutters  align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800 ">ดาวน์โหลดใบแจ้งซ่อมบำรุง</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

          

          </form>
        </div>
      </div>

      </div>
      </div>
      
        </div>
      
      </div>

      <footer class="sticky-footer bg-gray-100 shadow-sm fixed-bottom" style="z-index:99;     padding: 0.4rem 0;">
        <div class="container my-auto">
          <div class="row">
            <div class="col-md-8">
                <div class="copyright text-left my-auto text-black-50">
                  <span class="small">Version: {{config('app_version.version', '1.0')}}  Copyright &copy; {{now()->year}} บริษัท กรุงเทพโทรทัศน์และวิทยุ จำกัด (ช่อง 7HD)</span>
                  {{-- <img src="{{asset('build/img/itbc-logo-png.png')}}" class="img-profile" style="max-width: 30px;" /> --}}
                </div>
          </div>
          <div class="col-md-4">
            <div class="copyright text-right my-auto">
            
            </div>
          </div>
        </div>
        </div>
      </footer>
          
      {{-- <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}
      {{-- <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
    </body>
{{-- @endsection --}}
