@extends('layout.template')
{{-- For  Content . Blade --}}
@section('content')
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
@include('components.alertbox')
   <!-- Page Heading -->
   {{-- <h4 class="repalceh1">Dashboard</h4> --}}
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="{{url('/')}}" class="zoom btn btn-outline-info btn-sm ">Dashboard 1</a>
    </li>
    <li class="breadcrumb-item ">
      <a href="{{url('/dashboard2')}}"  class="zoom btn btn-outline-info btn-sm active ">Dashboard 2</a> 
     </li>
  </ol>
  
<div class="row">
  <div class="col-md-8">
    @include('dashboard.outstock')  
  </div>
  <div class="col-md-4">
    @include('dashboard.jobreport')    
  </div>
</div>

@endsection
{{-- For Script Javascript --}}
@section('js')

@endsection
{{-- For  Modal --}}
@section('modal')

@endsection