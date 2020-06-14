@extends('layout.template')
{{-- For  Content . Blade --}}
@section('content')
@include('components.alertbox')
    
       <!-- Default Card Example -->
<form method="POST" id="ma_approved_frm" action="{{url('ma_approved')}}/{{$data->id}}">

@csrf
    <input type="hidden" name="_method" value="PATCH"> 
    <input type="hidden" name="confirm" class="confirm" value="">
    <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 font-weight-bold">
              <h3>แก้ไขรายการอนุมัติซ่อมบำรุง - {{$data->job_no}}</h3>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{url('ma_approved')}}"><button href="{{url('ma_approved')}}" class="btn btn-danger btn-sm" type="button" data-dismiss="modal">กลับ</button></a>
              <button type="submit" class="btn btn-success btn-sm" id="btnsave"> {{ __('ปรับปรุง') }} </button>
              {{-- <button href="#"  class="btn btn-facebook" id="btnsave">ยืนยัน</button> --}}
            @if (in_array( 'ma_approved.print_frm02', $Permissions))
                <a target="_blank" href="{{url('ma_approved/'.$data->id.'/print_frm02')}}" class=" btn btn-sm btn-outline-info"><span class="fa fa-print"></span> พิมพ์ใบอนุมัติซ่อมบำรุง</a>
            @endif
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
                                <input id="job_no" type="text" class="form-control form-control-sm" name="job_no"  value="{{$data->job_no}}"  readonly>
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('วันที่เริ่มงาน') }}</label>
                            <div class="col-md-3 "> 
                                <input id="request_date_onshow" type="text" class="form-control form-control-sm" name="request_date_onshow" autocomplete="off" disabled value="{{date("d/m/Y",strtotime($data->job_date))}}">
                                <input id="request_date" type="hidden" class="form-control form-control-sm" name="request_date" autocomplete="off" >
                            </div>
                        </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เลขที่อ้างอิง') }}</label>
                        <div class="col-md-3"> 
                            <input id="ap_ma_no" type="text" class="form-control form-control-sm" name="ap_ma_no" value="{{$data->ap_ma_no}}" >
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                        </div>
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('สถานะงาน') }}</label>
                        <div class="col-md-3">
                        <select name="job_status_id" id="job_status_id" class="form-control form-control-sm" value="{{$data->job_status_id}}">
                            <option value="">Select</option>
                                @foreach($data2 as $row)
                                    <option value="{{$row['id']}}" {{ $data->job_status_id == $row->id ? 'selected' : '' }}> {{$row['name']}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                    
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ชื่องาน') }}</label>
                            <div class="col-md-8"> 
                            <input id="job_title" type="text" class="form-control form-control-sm" name="job_title" value="{{$data->job_title}}" readonly>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ประเภทงาน') }}</label>
                        <div class="col-md-3">
                        <select name="job_type_id" id="job_type_id"  class="form-control form-control-sm" value="{{$data->job_type_id}}" disabled>
                            <option value="" readonly>Select</option>
                                @foreach($data3 as $row)
                                    <option value="{{$row['id']}}" {{ $data->job_type_id == $row->id ? 'selected' : '' }}> {{$row['name']}}</option>
                                @endforeach
                        </select>
                        </div>
    
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('ความสำคัญ') }}</label>
                        <div class="col-md-3">
                        <select name="priority_id" id="priority_id"  class="form-control form-control-sm" value="{{$data->priority_id}}" disabled>
                            <option value="">Select</option>
                                @foreach($data6 as $row)
                                    <option value="{{$row['id']}}" {{ $data->priority_id == $row->id ? 'selected' : '' }}> {{$row['name']}}</option>
                                @endforeach
                        </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                        <label  class="col-md-2 col-form-label text-md-right">{{ __('บริษัท') }}</label>
                        
                        <div class="col-md-3">
                        <select name="branch_id" id="branch" class="form-control form-control-sm" value="{{$data->branch_id}}" disabled>
                            <option value=""  >Select</option>
                                @foreach($data5 as $row)
                                    <option value="{{$row['id']}}" {{ $data->branch_id == $row->id ? 'selected' : '' }}> {{$row['short_name']}}</option>
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
                            <h4 for="desc" class="col-md-4 text-md-right">{{ __('ฝ่ายงานผู้รับผิดชอบการซ่อมบำรุง') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ข้าพเจ้า') }}<span class="text-danger"> *</span></label>
                            <div class="col-md-3 input-group input-group-sm mb-3"> 
                                    <input id="approved_by" type="hidden"  class="form-control form-control-sm" name="approved_by" >
                                    <input id="approved_by_text" type="text" class="form-control form-control-sm" name="approved_by_text" value="{{$data->approved_by}}" required autocomplete="off">
                                    <div class="input-group-append">
                                        <a id="search_asset_owner_dep_id_btn" href="#" class="btn btn-outline-info"><span class="fa fa-search"></span></a>
                                    </div>
                            </div>
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ฝ่าย') }}</label>  
                                    <div class="col-md-3 input-group"> 
                                        <input id="approved_dep" type="text" class="form-control form-control-sm" name="approved_dep" value="{{$data->approved_dep}}">                                                   
                                    </div>    
                        </div> 
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ผู้รับผิดชอบงานซ่อมบำรุงรักษาทรัพย์สิน') }}</label>  
                            <div class="col-md-3 input-group"> 
                                    <input id="ap_asset_send" type="text" class="form-control form-control-sm" name="ap_asset_send" value="{{$data->ap_asset_send}}">                                                   
                            </div>  
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ยี่ห้อ') }}</label>  
                            <div class="col-md-3 input-group"> 
                                    <input id="ap_asset_brand" type="text" class="form-control form-control-sm" name="ap_asset_brand" value="{{$data->ap_asset_brand}}">                                                   
                            </div>      
                        </div> 
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รุ่น') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_asset_model" type="text" class="form-control form-control-sm" name="ap_asset_model" value="{{$data->ap_asset_model}}">                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('S/N เลขทะเบียน') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_asset_serial" type="text" class="form-control form-control-sm" name="ap_asset_serial" value="{{$data->ap_asset_serial}}">                                                   
                        </div>  
                    </div> 
                    </div> 

                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสทรัพย์สิน') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_asset_no" type="text" class="form-control form-control-sm" name="ap_asset_no" value="{{$data->ap_asset_no}}">                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ของหน่วยงาน / แผนก') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_request_dep" type="text" class="form-control form-control-sm" name="ap_request_dep" value="{{$data->ap_request_dep}}">                                                   
                        </div>  
                    </div> 
                    </div> 

                    <div class="col-md-12">
                    <div class="form-group row">
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ฝ่าย') }}</label>  
                        <div class="col-md-3 input-group"> 
                            <input id="ap_request_sub_dep" type="text" class="form-control form-control-sm" name="ap_request_sub_dep" value="{{$data->ap_request_sub_dep}}">                                                   
                        </div>   
                    <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัส Cost Center') }}</label>  
                        <div class="col-md-1 input-group"> 
                            <input id="cost_c_no" type="text" class="form-control form-control-sm" name="cost_c_no" value="{{$data->cost_c_no}}">                                                   
                        </div>  
                    <label for="desc" class="col-md-1 col-form-label text-md-right">{{ __('จำนวน') }}</label>
                        <div class="col-md-1 input-group"> 
                            <input id="cost_qty" type="text" class="form-control form-control-sm" placeholder="0" name="cost_qty" value="{{$data->cost_qty}}">                                                   
                        </div>
                    </div> 
                    </div> 
                    <div class="col-md-12">
                            <div class="form-group row">
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('สร้างโดย') }}</label>
                            <div class="col-md-3 input-group input-group-sm mb-3">
                                <input id="created_by" type="hidden" class="form-control form-control-sm" name="created_by" value="{{$data->created_by}}">
                            <input id="created_by_text" type="text" class="form-control form-control-sm readonly" name="created_by_text"  disabled value="{{$data->f_name}} {{$data->l_name}}">
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
                                <input type="radio" class="form-check-input checkbox" name="ap_ma_type"  id="ap_ma_type" value="ma_in" {{ $data->ap_ma_type == "ma_in" ? 'checked' : '' }}>
                                <label class="form-check-label" for="ap_ma_type">ซ่อมภายใน</label>
                            </div>
                            <label for="remark" class="col-md-1 col-form-label text-md-right"></label>
                            <div class="form-check ">
                                <input type="radio" class="form-check-input" name="ap_ma_type" id="ap_ma_type" value="ma_out" {{ $data->ap_ma_type == "ma_out" ? 'checked' : '' }}>
                                <label class="form-check-label" for="ap_ma_type">ซ่อมภายนอก</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ให้กับบริษัท') }}</label>
                            <div class="col-md-4"> 
                                <input id="vendor_name" type="text" class="form-control form-control-sm" name="vendor_name"  value="{{$data->vendor_name}}">
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12">
                            <div class="form-group row">
                                <label for="remark" class="col-md-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>  
                                <div class="col-md-8 input-group"> 
                                        <textarea name="ap_asset_desc" id="ap_asset_desc" cols="30" rows="3" class="form-control form-control-sm" placeholder="รายละเอียด">{{$data["ap_asset_desc"]}}</textarea>                                         
                                </div>      
                        </div> 
                     </div>
                     <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-3 col-form-label text-md-right">{{ __('ค่าใช้จ่ายในการซ่อมบำรุงทั้งสิ้น จำนวน') }}</label>
                            <div class="col-md-1"> 
                                <input id="cost_ma" type="text" class="form-control form-control-sm" name="cost_ma"  placeholder="0.00" value="{{number_format($data->cost_ma,2).""}}">
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

      <!-- Default Card Example -->

    </form>
       <!-- Default Card Example -->

      
@endsection
{{-- For Script Javascript --}}
@section('js')
@include('ma_approved.js.js')
<script type="text/javascript">
    $('#btnconfirm').click(function () {
     let stock_transaction = $('.stock_transaction').val()
     if (stock_transaction == null){
        return false;
     }
    event.preventDefault(); 
    var r = confirm("ยืนยันการรับเข้าระบบ");
     if (r == true) {
        $('.confirm').val("confirm")
        $('#ma_approved_frm').submit()
    }
});
    

    $('#request_date_onshow').daterangepicker(DRP_singleOptions);
    $('#request_date').daterangepicker(DRP_singleOptions);

</script>

@endsection

{{-- For  Modal --}}
@section('modal')
@include('modals.joborder.joborder_component_modal')
@include('modals.joborder.joborder_phonebook_modal')
@include('modals.stock.material_modal')
@endsection