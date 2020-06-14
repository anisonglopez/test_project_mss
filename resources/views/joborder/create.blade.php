@extends('layout.template')
{{-- For  Content . Blade --}}
@section('content')
@include('components.alertbox')
<style>
.form-group {
    margin-bottom: 0.6rem;
}
</style>
       <!-- Default Card Example -->
<form method="POST" action="{{url('joborder')}}">
@csrf
    <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 font-weight-bold">
                <h3>สร้างงานซ่อมบำรุง</h3> 
            </div>
            
            <div class="col-md-6 text-right">
                    <a href="{{url('joborder')}}" class="btn btn-outline-primary btn-sm">กลับ</a>
                 {{-- <a href="#">พิมพ์</a> --}}
                    <button type="submit" class="btn btn-success btn-sm" id="btnsave"><span class="fa fa-save"></span> {{ __('บันทึก') }} </button>
           
                </div>
          </div>        
        </div>
      
      <!-- end card header -->
        <div class="card-body">
            <div style="height:580px;width:100%; overflow:auto; mb-4">    
                <div class="row" class="h-25 d-inline-block" >
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสใบงาน') }}<span class="text-danger">*</span></label>
                            <div class="col-md-3"> 
                                <input id="job_no" type="text" class="form-control form-control-sm" name="job_no" required  disabled>
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('วันที่เริ่มงาน') }}</label>
                            <div class="col-md-3 "> 
                                <input id="request_date_onshow" type="text" class="form-control form-control-sm" name="request_date_onshow" autocomplete="off" disabled >
                                <input id="request_date" type="hidden" class="form-control form-control-sm" name="request_date" autocomplete="off"  >
                            </div>
                        </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เลขที่อ้างอิง') }}</label>
                        <div class="col-md-3"> 
                            <input id="ma_no" type="text" class="form-control form-control-sm" name="ma_no">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('สถานะงาน') }}<span class="text-danger">*</span></label>
                        <div class="col-md-3">
                        <select name="job_status_id" id="job_status_id" required class="form-control form-control-sm">
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
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ชื่องาน') }}<span class="text-danger">*</span></label>
                            <div class="col-md-8"> 
                                <input id="job_title" type="text" class="form-control form-control-sm" name="job_title" required>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ประเภทงาน') }}<label class="text-danger">*</label></label>
                        <div class="col-md-3">
                        <select name="job_type_id" id="job_type_id" required class="form-control form-control-sm">
                            <option value="">Select</option>
                                @foreach($data3 as $row)
                                    <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                @endforeach
                        </select>
                        </div>
    
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ความสำคัญ') }}<label class="text-danger">*</label></label>
                        <div class="col-md-3">
                        <select name="priority_id" id="priority_id" required class="form-control form-control-sm">
                            <option value="">Select</option>
                                @foreach($data6 as $row)
                                    <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                @endforeach
                        </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('บริษัท') }}<label class="text-danger">*</label> </label>
                        
                        <div class="col-md-3">
                        <select name="branch_id" id="branch" class="form-control form-control-sm" required>
                            <option value="">Select</option>
                                @foreach($data5 as $row)
                                    <option value="{{$row['id']}}"> {{$row['short_name']}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    </div>   
                    <div class="col-md-12">
                        <div class="form-group row">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h4 for="desc" class="col-md-3 text-md-left">{{ __('ฝ่ายงานผู้รับผิดชอบทรัพย์สิน') }}</h4>
                            </div>
                         
                        </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ผู้แจ้ง') }}<label class="text-danger">*</label> </label>
                        <div class="col-md-3 input-group input-group-sm mb-3"> 
                                <input id="request_by" type="hidden" required class="form-control form-control-sm" name="request_by" >
                                <input id="request_by_text" type="text" class="form-control form-control-sm" name="request_by_text"  required autocomplete="off">
                                <div class="input-group-append">
                                    <a id="search_asset_owner_dep_id_btn" href="#" class="btn btn-outline-info"><span class="fa fa-search"></span></a>
                                </div>
                        </div>
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เบอร์โทรติดต่อ') }}</label>  
                            <div class="col-md-3 input-group"> 
                                    <input id="request_tel" type="text" class="form-control form-control-sm" name="request_tel" >                                                   
                            </div>      
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('หน่วยงาน / แผนก') }} </label>
                            <div class="col-md-3">
                                <input id="request_dep" type="text" class="form-control form-control-sm" name="request_dep" > 
                            </div>
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('ฝ่าย') }}</label>
                            <div class="col-md-3">
                                <input id="request_sub_dep" type="text" class="form-control form-control-sm" name="request_sub_dep" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ได้ส่งมอบ') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="asset_send" type="text" class="form-control form-control-sm" name="asset_send" >                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ยี่ห้อ') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="asset_brand" type="text" class="form-control form-control-sm" name="asset_brand" >                                                   
                        </div>  
                    </div> 
                    </div> 
                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รุ่น') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="asset_model" type="text" class="form-control form-control-sm" name="asset_model" >                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('S/N เลขทะเบียน') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="asset_serial" type="text" class="form-control form-control-sm" name="asset_serial" >                                                   
                        </div>  
                    </div> 
                    </div> 
                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสทรัพย์สิน') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="asset_no" type="text" class="form-control form-control-sm" name="asset_no" >                                                   
                        </div>
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('สถานที่') }}</label><label class="text-danger">*</label>  
                        <div class="col-md-3 input-group">
                            <input id="location_name" type="text" class="form-control form-control-sm" name="location_name" required>                                                   
                        </div>
                    </div> 
                    </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>  
                                <div class="col-md-8"> 
                                    <textarea name="asset_desc" id="asset_desc" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>     
                        <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ผู้ได้รับมอบหมาย') }}</label>
                        <div class="col-md-3 input-group input-group-sm mb-3">
                            <input id="assign_as" type="hidden" class="form-control form-control-sm" name="assign_as" >
                            <input id="assign_as_text" type="text" class="form-control form-control-sm readonly" name="assign_as_text"  disabled>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h4 for="desc" class="col-md-3 l text-md-left">{{ __('ฝ่ายงานผู้มีหน้าที่ซ่อมบำรุง') }}</h4>
                            </div>
                               
                            </div>
                        </div>
            
                    <div class="col-md-12">
                            <div class="form-group row">
                                <label for="remark" class="col-md-2 col-form-label text-md-right">{{ __('ความเห็นผู้ตรวจเช็ค') }}</label>  
                                <div class="col-md-8 input-group"> 
                                        <textarea name="ma_desc" id="ma_desc" cols="30" rows="3" class="form-control form-control-sm"></textarea>                                         
                                </div>   
                        </div> 
                     </div>
                     <div class="col-md-12">
                        <div class="form-group row ml-3">
                            <h4 for="desc" class="col-md-5  text-md-left">{{ __('ข้อเสนอแนะของฝ่ายงานผู้ทำหน้าที่ซ่อมบำรุง') }}</h4>
                        </div>
                    </div>
                    <!-- Material unchecked -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="remark" class="col-md-2 col-form-label text-md-right"></label>
                            <div class="col-md-8 input-group">
                            <div class="form-check ">
                                <input type="radio" class="form-check-input checkbox" name="ma_type"  id="ma_type" value="ma_in" required>
                                <label class="form-check-label" for="ma_type">ซ่อมภายใน</label>
                            </div>
                            <label for="remark" class="col-md-1 col-form-label text-md-right"></label>
                            <div class="form-check ">
                                <input type="radio" class="form-check-input" name="ma_type" id="ma_type" value="ma_out" required>
                                <label class="form-check-label" for="ma_type">ซ่อมภายนอก</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="recommend" class="col-md-2  text-md-right">{{ __('ข้อเสนอแนะ') }}</label>  
                            <div class="col-md-8 input-group"> 
                                    <textarea name="recommend" id="recommend" cols="30" rows="3" class="form-control form-control-sm"></textarea>                                         
                            </div>      
                        </div> 
                    </div>
                </div>
                <div class="col-xl-12 col-md-6 mb-4 mt-4">
                    <div class="card  h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-12">     
                                <div class="form-group row mt-4">
                                    <div class="col-md-6 font-weight-bold text-primary">
                                        รายการวัสดุอุปกรณ์
                                    </div>
                                    <div class="col-md-6 text-right">
                                             <a id="add_material_btn" href="#" class="btn btn-sm btn-success btn-icon-split">
                                                    <span class="icon text-white-50">
                                                      <i class="fas fa-plus"></i>
                                                    </span>
                                                    <span class="text">เพิ่มวัสดุอุปกรณ์</span>
                                             </a>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12 mb-5">
                                    <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm small " id="MaterialdataTable">
                                                <thead class="text-center bg-primary text-white">
                                                    <tr>
                                                        <th>รหัส วัสดุอุปกรณ์</th>
                                                        <th>ประเภท วัสดุอุปกรณ์</th>
                                                        <th>ชนิด วัสดุอุปกรณ์</th>  
                                                        <th>ชื่อ วัสดุอุปกรณ์</th> 
                                                        <th>สถานะเบิก-รับ</th> 
                                                        <th>จำนวนเบิกออกไปใช้</th>
                                                        <th>จำนวนรับคืน</th>       
                                                        <th>คงเหลือ ณ ปัจจุบัน</th>
                                                        <th>เหตุผล</th>
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
                    </div>
                  </div>
                


          </div>
      </div>
    </div>
    </form>


      
@endsection
{{-- For Script Javascript --}}
@section('js')
@include('joborder.js.js')
{{-- <script src="{{asset('js/joborder/joborder.js')}}"></script> --}}
<script type="text/javascript">
 $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
    $(function () {
        $('#request_time').datetimepicker({
            format: 'HH:mm'
        });
        $('#schedule_start_time').datetimepicker({
            format: 'HH:mm'
        });
        $('#schedule_end_time').datetimepicker({
            format: 'HH:mm'
        });
    });
    $('#request_date_onshow').daterangepicker(DRP_singleOptions);
    $('#request_date').daterangepicker(DRP_singleOptions);
    $('#schedule_start_date').daterangepicker(DRP_singleOptions);
    $('#schedule_end_date').daterangepicker(DRP_singleOptions);

    $('#branch').change(function () {
        $("#dep").empty();
        $("#dep").append('<option value="">Select</option>');
        var _id = $(this).val();
        console.log(_id)
        if(_id){
            $.ajax({
                type:"get",
                url:"{{url('/get_dep_from_branch')}}/"+_id,
                success:function(res)
                {       
                console.log(res)
                    if(res)
                    {
                        $("#dep").empty();
                        $("#dep").append('<option value="">Select</option>');
                        $.each(res,function(key,value){
                            $("#dep").append('<option value="'+value["id"]+'">'+value["name_th"]+'</option>');
                        });
                        $("#asset_owner_dep_id").empty();
                        $("#asset_owner_dep_id").append('<option value="">Select</option>');
                        $.each(res,function(key,value){
                            $("#asset_owner_dep_id").append('<option value="'+value["id"]+'">'+value["name_th"]+'</option>');
                        });
                        
                    }
                }
            });
        }
    });
</script>
@endsection
{{-- For  Modal --}}
@section('modal')
@include('modals.joborder.joborder_component_modal')
@include('modals.joborder.joborder_phonebook_modal')
{{-- @include('modals.stock.material_modal') --}}
@endsection