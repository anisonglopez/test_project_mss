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
<form method="POST" action="{{url('ma_approved')}}">
@csrf
    <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 font-weight-bold">
                <h3>สร้างใบอนุมัติซ่อมบำรุง</h3> 
            </div>
            
            <div class="col-md-6 text-right">
                    <a href="{{url('ma_approved')}}">กลับ</a>
                 <a href="#">พิมพ์</a>
                    <button type="submit" class="btn btn-success" id="btnsave"><span class="fa fa-save"></span> {{ __('บันทึก') }} </button>
           
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
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสใบงาน') }}</label>
                            <div class="col-md-3"> 
                                <input id="job_id" type="text" class="form-control form-control-sm" name="job_id"   >
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
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เลขใบแจ้งซ่อม') }}</label>
                        <div class="col-md-3"> 
                            <input id="ap_ma_no" type="text" class="form-control form-control-sm" name="ap_ma_no">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('สถานะงาน') }}</label>
                        <div class="col-md-3">
                        <select name="job_status_id" id="job_status_id" class="form-control form-control-sm">
                            <option value="">Select</option>
                            <option value="s">ss</option>
                                {{-- @foreach($data2 as $row)
                                    <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                @endforeach --}}
                        </select>
                        </div>
                    </div>
                </div>
                    
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ชื่องาน') }}</label>
                            <div class="col-md-8"> 
                                <input id="" type="text" class="form-control form-control-sm" name="" >
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ประเภทงาน') }}</label>
                        <div class="col-md-3">
                        <select name="job_type_id" id="job_type_id"  class="form-control form-control-sm">
                            <option value="">Select</option>
                            <option value="ss">ss</option>
                                {{-- @foreach($data3 as $row)
                                    <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                @endforeach --}}
                        </select>
                        </div>
    
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ความสำคัญ') }}</label>
                        <div class="col-md-3">
                        <select name="priority_id" id="priority_id"  class="form-control form-control-sm">
                            <option value="">Select</option>
                            <option value="ss">ss</option>
                                {{-- @foreach($data6 as $row)
                                    <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                @endforeach --}}
                        </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('บริษัท') }}</label>
                        
                        <div class="col-md-3">
                        <select name="branch_id" id="branch" class="form-control form-control-sm" >
                            <option value="">Select</option>
                            <option value="ss">ss</option>
                                {{-- @foreach($data5 as $row)
                                    <option value="{{$row['id']}}"> {{$row['short_name']}}</option>
                                @endforeach --}}
                        </select>
                        </div>
                    </div>
                    </div>   
                    <div class="col-md-12">
                        <div class="form-group row">
                            <h4 for="desc" class="col-md-4 text-md-right">{{ __('ฝ่ายงานผู้รับผิดชอบการซ่อมบำรุง') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ข้าพเจ้า') }}</label>
                            <div class="col-md-3 input-group input-group-sm mb-3"> 
                                    <input id="approved_by" type="text"  class="form-control form-control-sm" name="approved_by" >
                                    {{-- <input id="approved_by_text" type="text" class="form-control form-control-sm" name="approved_by_text" readonly  autocomplete="off"> --}}
                                    <div class="input-group-append">
                                        <a id="search_asset_owner_dep_id_btn" href="#" class="btn btn-outline-info"><span class="fa fa-search"></span></a>
                                    </div>
                            </div>
                                <label  class="col-md-2 col-form-label text-md-right">{{ __('ฝ่าย') }}</label>
                                <div class="col-md-3">
                                <select name="approved_dep" id="approved_dep"  class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <option value="ss">ss</option>
                                        {{-- @foreach($data2 as $row)
                                            <option value="{{$row['id']}}"> {{$row['name']}}</option>
                                        @endforeach --}}
                                </select>
                                </div>    
                        </div> 
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ผู้รับผิดชอบงานซ่อมบำรุงรักษาทรัพย์สิน') }}</label>  
                            <div class="col-md-3 input-group"> 
                                    <input id="ap_asset_send" type="text" class="form-control form-control-sm" name="ap_asset_send" >                                                   
                            </div>  
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ยี่ห้อ') }}</label>  
                            <div class="col-md-3 input-group"> 
                                    <input id="ap_asset_brand" type="text" class="form-control form-control-sm" name="ap_asset_brand" >                                                   
                            </div>      
                        </div> 
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รุ่น') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_asset_model" type="text" class="form-control form-control-sm" name="ap_asset_model" >                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('S/N เลขทะเบียน') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_asset_serial" type="text" class="form-control form-control-sm" name="ap_asset_serial" >                                                   
                        </div>  
                    </div> 
                    </div> 

                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสทรัพย์สิน') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_asset_no" type="text" class="form-control form-control-sm" name="ap_asset_no" >                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ของหน่วยงาน / แผนก') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_request_by" type="text" class="form-control form-control-sm" name="ap_request_by" >                                                   
                        </div>  
                    </div> 
                    </div> 

                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ฝ่าย') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_request_dep" type="text" class="form-control form-control-sm" name="ap_request_dep" >                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัส Cost Center') }}</label>  
                        <div class="col-md-1 input-group"> 
                            <input id="cost_c_no" type="text" class="form-control form-control-sm" name="cost_c_no" >                                                   
                        </div>  
                    <label for="desc" class="col-md-1 col-form-label text-md-right">{{ __('จำนวน') }}</label>
                        <div class="col-md-1 input-group"> 
                            <input id="cost_qty" type="text" class="form-control form-control-sm" placeholder="0" name="cost_qty" >                                                   
                        </div>
                    </div> 
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-3 col-form-label text-md-right">{{ __('ข้อเสนอแนะของฝ่ายงานผู้ทำหน้าที่ซ่อมบำรุง') }}</label>
                        </div>
                    </div>
                    <!-- Material unchecked -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="remark" class="col-md-2 col-form-label text-md-right"></label>
                            <div class="col-md-8 input-group">
                            <div class="form-check ">
                                <input type="radio" class="form-check-input checkbox" name="ap_ma_type"  id="ap_ma_type" value="ma_in" >
                                <label class="form-check-label" for="ap_ma_type">ซ่อมภายใน</label>
                            </div>
                            <label for="remark" class="col-md-1 col-form-label text-md-right"></label>
                            <div class="form-check ">
                                <input type="radio" class="form-check-input" name="ap_ma_type" id="ap_ma_type" value="ma_out" >
                                <label class="form-check-label" for="ap_ma_type">ซ่อมภายนอก</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ให้กับบริษัท') }}<span class="text-danger"> *</span></label>
                            <div class="col-md-4"> 
                                <input id="vendor_name" type="text" class="form-control form-control-sm" name="vendor_name" placeholder="บริษัท" >
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12">
                            <div class="form-group row">
                                <label for="remark" class="col-md-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>  
                                <div class="col-md-8 input-group"> 
                                        <textarea name="ap_asset_desc" id="ap_asset_desc" cols="30" rows="3" class="form-control form-control-sm" placeholder="รายละเอียด"></textarea>                                         
                                </div>      
                        </div> 
                     </div>
                     <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-3 col-form-label text-md-right">{{ __('ค่าใช้จ่ายในการซ่อมบำรุงทั้งสิ้น จำนวน') }}</label>
                            <div class="col-md-1"> 
                                <input id="cost_ma" type="text" class="form-control form-control-sm" name="cost_ma" placeholder="0.00" >
                            </div>
                            <label for="desc" class="col-md-2 col-form-label text-md-left">{{ __('(บาท)') }}</label>
                        </div>
                    </div> 
                </div>
                {{-- <div class="col-md-12">
                <div class="form-group row mt-4">
                    <div class="col-md-6 font-weight-bold text-primary">
                        รายการวัสดุอุปกรณ์
                    </div>
                    {{-- <div class="col-md-6 text-right">
                             <a id="add_material_btn" href="#" class="btn btn-sm btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                      <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">เพิ่มวัสดุอุปกรณ์</span>
                             </a>
                    </div> --}}
               {{--</div>
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
                                        <th>จำนวนเบิกออกไปใช้</th>
                                        <th>คงเหลือ ณ ปัจจุบัน</th>
                                        <th>เหตุผล</th>
                                        <th>#</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                     
                                 </tbody>
                            </table>
                    </div>
                </div> --}}

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
{{-- @include('modals.stock.material_modal') --}}
@endsection