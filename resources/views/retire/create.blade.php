@extends('layout.template')

{{-- For  Content . Blade --}}
@section('content')
    
       <!-- Default Card Example -->
<form method="POST" action="{{url('retire')}}">
@csrf 
<div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 font-weight-bold text-primary">
              <h3>สร้างรายการจำหน่ายออก</h3>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{url('retire')}}"><button  class="btn btn-facebook" type="button" data-dismiss="modal"><span class="fa fa-undo"></span> กลับ</button></a>
              <button type="submit" class="btn btn-success" id="btnsave"><span class="fa fa-w fa-save"></span> {{ __('บันทึก') }} </button>
            </div>
          </div>        
        </div>
      
      <!-- end card header -->
        <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('หน่วยงาน') }}</label><label class="text-danger">*</label> 
                          <div class="col-md-3">
                          <select name="branch_id" id="branch_name" class="form-control" required>
                              <option value="">Select</option>
                                  @foreach($data1 as $row)
                                      <option value="{{$row['id']}}"> {{$row['short_name']}}</option>
                                  @endforeach
                          </select>
                          </div>

                          <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('เลือกประเภทจำหน่ายออก') }}</label><label class="text-danger">*</label> 
                          <div class="col-md-3">
                          <select name="outtype_id" id="outtype" class="form-control" required>
                              <option value="">Select</option>
                                  @foreach($data2 as $row)
                                      <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                  @endforeach
                          </select>
                          </div>
                        </div>
                    </div>   

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เลขที่ตัดจำหน่าย') }}</label><label class="text-danger">*</label>
                            <div class="col-md-3"> 
                                <input id="retire_no" type="text" class="form-control" name="retire_no" required readonly>
                            </div>
                         <input id="retire_by" type="hidden" class="form-control" name="retire_by" required readonly value="{{Auth::user()->id}}">
                        </div>
                    </div>    


                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __(' รายละเอียด') }}</label><label class="text-danger">*</label>
                            <div class="col-md-8"> 
                                <textarea name="desc" id="desc" cols="30" rows="3" class="form-control form-control-sm" required></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
         <div class="row mb-4">
          <div class="col-md-6 font-weight-bold text-primary">
                  รายการตัดจำหน่าย
          </div>
          <div class="col-md-6 text-right">
            <a  id="add_material_btn" href="#" class=" btn btn-sm btn-outline-danger btn-icon-split">
                   <span class="icon text-black-50">
                     <i class="fas fa-plus"></i>
                   </span>
                   <span class="text">เพิ่มวัสดุอุปกรณ์</span>
            </a>
        </div>
      </div>

          <div class="col-md-12">
            <div class="table-responsive">
                    <table class="table table-bordered table-sm small " id="MaterialdataTable">
                        <thead class="text-center bg-primary text-white ">
                            <tr>
                                <th>รหัส วัสดุอุปกรณ์</th>
                                <th>ประเภท วัสดุอุปกรณ์</th>
                                <th>ชนิด วัสดุอุปกรณ์</th>
                                <th>ชื่อ วัสดุอุปกรณ์</th>
                                <th>จำนวนตัดจำหน่ายออก</th>
                                <th>คงเหลือ</th>
                                <th>หมายเหตุ</th>
                                <th>#</th>
                            </tr>
                         </thead>
                         <tbody>
             
                         </tbody>
                    </table>
            </div>
            </div>
            

          </div>

        </div>
   
    </form>

@endsection 
@section('js')
@include('retire.js.js')
<script>
    $('#retire_date').daterangepicker(DRP_singleOptions);
    
</script>

@endsection

{{-- For  Modal --}}
@section('modal')
@include('modals.stock.material_modal')
@endsection