@extends('layout.template')

{{-- For  Content . Blade --}}
@section('content')
@include('components.alertbox')
{{-- <nav class="navbar  topbar mb-4 static-top shadow nav-bar-custom">
</nav> --}}
       <!-- Default Card Example -->
<style>
    .col-form-label {
    line-height: 0.5;
}
.timeline {
        line-height: 1.4em;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
        h1, h2, h3, h4, h5, h6 {
            line-height: inherit;
        }
    }

    /*----- TIMELINE ITEM -----*/

    .timeline-item {
        padding-left: 40px;
        position: relative;
        &:last-child {
            padding-bottom: 0;
        }
    }

    /*----- TIMELINE INFO -----*/

    .timeline-info {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        margin: 0 0 .5em 0;
        text-transform: uppercase;
        white-space: nowrap;
    }
</style>
@php
$viewonly_style = "";
     if (isset($_GET['viewonly'])){
           $viewonly_style = "element-hidden";
    };
@endphp
<form method="POST" id="joborder_frm" action="{{url('joborder')}}/{{$data->id}}">
    @csrf   
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="job_flg" class="job_flg" value="">
<div class="card mb-4">
<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
          <div class="row">
            <div class="col-md-6">
            <h3>แก้ไขงานซ่อมบำรุง - {{$data->job_no}}</h3> 
            </div> 
            
            <div class="col-md-6 text-right">
                <a href="{{url('joborder')}}" class="btn btn-outline-primary btn-sm {{$viewonly_style}}">กลับ</a>
                @if(isset($_GET['viewonly']))
                         <a href="{{url('/')}}" class="btn btn-outline-primary btn-sm">กลับ</a>
                @endif
                <button type="submit" class="btn btn-success btn-sm  {{$viewonly_style}}" id="btnsave"> {{ __('ปรับปรุง') }} </button>
                @if (in_array( 'joborder.confirm', $Permissions))
                <a href="#"  class="btn btn-facebook btn-sm {{$viewonly_style}}" id="btnconfirm">ยืนยันการเบิก-รับอุปกรณ์</a>
                 @endif
                @if (in_array( 'joborder.print_frm01', $Permissions))
                    <a target="_blank" href="{{url('joborder/'.$data->id.'/print_frm01')}}" class=" btn btn-sm btn-outline-info {{$viewonly_style}}"><span class="fa fa-print"></span> พิมพ์ใบซ่อมบำรุง</a>
                @endif
                @if (in_array( 'joborder.send_ap', $Permissions))
                    <a id="btn-sendtoapproved" href="#" class="btn  {{($data->status_approved == 1 ? 'btn-success ' : 'btn-outline-success') }}   btn-sm btn-sendtoapproved {{$viewonly_style}}">
                            {{($data->status_approved == 1 ? 'ส่งอนุมัติซ่อมบำรุง แล้ว ' : 'ส่งอนุมัติซ่อมบำรุง') }} 
                    </a>
                @endif
            </div>
          </div>        
        </div>
        
                
      <!-- end card header -->
        <div class="card-body" style="line-height: 1.6;">
            <div style="height:580px;width:100%; overflow:auto; mb-4">    
                <ul class="nav nav-tabs mb-4 bg-gray-100" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="job-tab" data-toggle="tab" href="#jobtab" role="tab" aria-controls="jobtab" aria-selected="true">ข้อมูลใบซ่อมบำรุง</a>
                    </li>
                    {{-- <li class="nav-item">
                      <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">Log History</a>
                    </li> --}}
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="jobtab" role="tabpanel" aria-labelledby="job-tab">
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-md-6">
                                </div>
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสใบงาน') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-3"> 
                                        <input id="job_no" type="text" class="form-control form-control-sm" name="job_no" required  value="{{$data->job_no}}" disabled>
                                    </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-md-6">
                                </div>
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('วันที่เริ่มงาน') }}</label>
                                    <div class="col-md-3 "> 
                                        <input id="request_date_onshow" type="text" class="form-control form-control-sm" name="request_date_onshow" autocomplete="off" value="{{date("d/m/Y",strtotime($data->job_date))}}"  disabled >
                                        <input id="request_date" type="hidden" class="form-control form-control-sm" name="request_date"  autocomplete="off"  >
                                    </div>
                                </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                </div>
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เลขที่อ้างอิง') }}</label>
                                <div class="col-md-3"> 
                                    <input id="ma_no" type="text" class="form-control form-control-sm" name="ma_no" value="{{$data->ma_no}}">
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
                                            <option value="{{$row['id']}}" {{ $data->job_status_id == $row->id ? 'selected' : '' }}> {{$row['name']}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ชื่องาน') }}<span class="text-danger">*</span></label>
                                <div class="col-md-8"> 
                                    <input id="job_title" type="text" class="form-control form-control-sm" name="job_title" value="{{$data->job_title}}" required>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="form-group row">
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('ประเภทงาน') }}<label class="text-danger">*</label></label>
                            <div class="col-md-3">
                            <select name="job_type_id" id="job_type_id" required class="form-control form-control-sm" disabled>
                                <option value="">Select</option>
                                    @foreach($data3 as $row)
                                        <option value="{{$row['id']}}" {{ $data->job_type_id == $row->id ? 'selected' : '' }}> {{$row['name']}}</option>
                                    @endforeach
                            </select>
                            </div>
        
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('ความสำคัญ') }}<label class="text-danger">*</label></label>
                            <div class="col-md-3">
                            <select name="priority_id" id="priority_id" required class="form-control form-control-sm">
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
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('บริษัท') }}<label class="text-danger">*</label> </label>
                            <div class="col-md-3">
                            <select name="branch_id" id="branch" class="form-control form-control-sm" required disabled>
                                <option value="">Select</option>
                                    @foreach($data5 as $row)
                                        <option value="{{$row['id']}}" {{ $data->branch_id == $row->id ? 'selected' : '' }}> {{$row['short_name']}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        </div>   
                            
                        <div class="col-md-12">
                            <div class="form-group row">
                                <h4 for="desc" class="col-md-3 text-md-right">{{ __('ฝ่ายงานผู้รับผิดชอบทรัพย์สิน') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group row">
                            <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ผู้แจ้ง') }}<label class="text-danger">*</label> </label>
                            <div class="col-md-3 input-group input-group-sm mb-3"> 
                                        <input id="request_by" type="hidden" required class="form-control form-control-sm" name="request_by" >
                                        <input id="request_by_text" type="text" class="form-control form-control-sm" name="request_by_text" value="{{$data->request_by}}"  required autocomplete="off">
                                    <div class="input-group-append">
                                        <a id="search_asset_owner_dep_id_btn" href="#" class="btn btn-outline-info"><span class="fa fa-search"></span></a>
                                    </div>
                            </div>
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('เบอร์โทรติดต่อ') }}</label>  
                                <div class="col-md-3 input-group"> 
                                        <input id="request_tel" type="text" class="form-control form-control-sm" name="request_tel" value="{{$data->request_tel}}">                                                   
                                </div>      
                        </div> 
                        </div>
                        <div class="col-md-12">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('หน่วยงาน / แผนก') }} </label>
                            <div class="col-md-3">
                                <input id="request_dep" type="text" class="form-control form-control-sm" name="request_dep" value="{{$data->request_dep}}" > 
                            </div>
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('ฝ่าย') }}</label>
                            <div class="col-md-3">
                                <input id="request_sub_dep" type="text" class="form-control form-control-sm" name="request_sub_dep" value="{{$data->request_sub_dep}}" >
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group row">
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ได้ส่งมอบ') }}</label>  
                            <div class="col-md-3 input-group"> 
                                <input id="asset_send" type="text" class="form-control form-control-sm" name="asset_send" value="{{$data->asset_send}}">                                                   
                            </div>   
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('ยี่ห้อ') }}</label>  
                            <div class="col-md-3 input-group"> 
                                <input id="asset_brand" type="text" class="form-control form-control-sm" name="asset_brand" value="{{$data->asset_brand}}">                                                   
                            </div>  
                        </div> 
                        </div> 
                        <div class="col-md-12">
                        <div class="form-group row">
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รุ่น') }}</label>  
                            <div class="col-md-3 input-group"> 
                                <input id="asset_model" type="text" class="form-control form-control-sm" name="asset_model" value="{{$data->asset_model}}">                                                   
                            </div>   
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('S/N เลขทะเบียน') }}</label>  
                            <div class="col-md-3 input-group"> 
                                <input id="asset_serial" type="text" class="form-control form-control-sm" name="asset_serial" value="{{$data->asset_serial}}">                                                   
                            </div>  
                        </div> 
                        </div> 
                        <div class="col-md-12">
                        <div class="form-group row">
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รหัสทรัพย์สิน') }}</label>  
                            <div class="col-md-3 input-group"> 
                                <input id="asset_no" type="text" class="form-control form-control-sm" name="asset_no" value="{{$data->asset_no}}">                                                   
                            </div>   
                        <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('สถานที่') }}</label><label class="text-danger">*</label>  
                            <div class="col-md-3 input-group">
                                <input id="location_name" type="text" class="form-control form-control-sm" name="location_name" value="{{$data->location_name}}" required>                                                   
                            </div> 
                        </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="desc" class="col-md-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>  
                                <div class="col-md-8"> 
                                    <textarea name="asset_desc" id="asset_desc" cols="30" rows="3" class="form-control form-control-sm">{{$data["asset_desc"]}}</textarea>
                                </div>
                            </div>
                        </div>     
                        <div class="col-md-12">
                            <div class="form-group row">
                            <label  class="col-md-2 col-form-label text-md-right">{{ __('ผู้ได้รับมอบหมาย') }}</label>
                            <div class="col-md-3 input-group input-group-sm mb-3">
                                <input id="assign_as" type="hidden" class="form-control form-control-sm" name="assign_as" value="{{$data->assign_as}}">
                            <input id="assign_as_text" type="text" class="form-control form-control-sm readonly" name="assign_as_text"  disabled value="{{$data->f_name}} {{$data->l_name}}">
                            </div>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <h4 for="desc" class="col-md-3 l text-md-right">{{ __('ฝ่ายงานผู้มีหน้าที่ซ่อมบำรุง') }}</h4>
                                </div>
                            </div>
        
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="remark" class="col-md-2 col-form-label text-md-right">{{ __('ความเห็นผู้ตรวจเช็ค') }}</label>  
                                <div class="col-md-8 input-group"> 
                                        <textarea name="ma_desc" id="ma_desc" cols="30" rows="3" class="form-control form-control-sm">{{$data["ma_desc"]}}</textarea>                                         
                                </div>      
                            </div> 
                        </div>
                        <div class="col-md-12 ml-5">
                            <h4 for="desc">{{ __('ข้อเสนอแนะของฝ่ายงานผู้ทำหน้าที่ซ่อมบำรุง') }}</h4>
                        </div>
                     
                        <!-- Material unchecked -->
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="remark" class="col-md-2 col-form-label text-md-right"></label>
                                <div class="col-md-8 input-group">
                                <div class="form-check ">
                                    <input type="radio" class="form-check-input checkbox" name="ma_type"  id="ma_type" value="ma_in" {{ $data->ma_type == "ma_in" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="ma_type">ซ่อมภายใน</label>
                                </div>
                                <label for="remark" class="col-md-1 col-form-label text-md-right"></label>
                                <div class="form-check ">
                                    <input type="radio" class="form-check-input" name="ma_type" id="ma_type" value="ma_out"{{ $data->ma_type == "ma_out" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="ma_type">ซ่อมภายนอก</label>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="recommend" class="col-md-2  text-md-right">{{ __('ข้อเสนอแนะ') }}</label>  
                                <div class="col-md-8 input-group"> 
                                        <textarea name="recommend" id="recommend" cols="30" rows="3" class="form-control form-control-sm">{{$data["recommend"]}}</textarea>                                         
                                </div>      
                            </div> 
                        </div>
        
                        </div>

                        <div class="card  h-100 py-2 ">
                            <div class="card-body">
                <div class="col-md-12">
                    <div class="row mb-4">
                        <div class="col-md-6 font-weight-bold text-primary">
                            รายการวัสดุอุปกรณ์
                        </div>
                        <div class="col-md-6 text-right">
                                <button id="add_material_btn" href="#" class=" btn btn-sm btn-outline-danger btn-icon-split">
                                        <span class="icon text-black-50">
                                        <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">เพิ่มวัสดุอุปกรณ์</span>
                                </button>
                        </div>
                    </div>     
                </div>
              <!-- end card header -->
            
                        <div class="col-md-12 mb-5">
                                <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-sm small  " id="MaterialdataTable">
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
                                             @foreach ($data8 as $item)
                                             @php
                                                 $flg_style = "";
                                                 $in_disabled = "";
                                                 $out_disabled = "";
                                                 $delete_style  = "";
                                                 $status_text = "";
                                                 if($item->m_flag == "waitout"){
                                                    $in_disabled = "readonly";
                                                    $status_text = '<label class="bg-danger text-white">&nbsp;รอยืนยันเบิก&nbsp;</label>';
                                                 }elseif($item->m_flag == "confirmout"){
                                                    $out_disabled = "readonly";
                                                    $status_text = '<label class=" bg-warning">&nbsp;เบิกอุปกรณ์แล้ว / รอรับคืน&nbsp;</label>';
                                                    $delete_style = "visibility: hidden;";
                                                 }elseif($item->m_flag == "confirmin"){
                                                    $in_disabled = "readonly";
                                                    $out_disabled = "readonly";
                                                    $delete_style = "visibility: hidden;";
                                                    $status_text = '<label class="text-white bg-success">&nbsp;รับคืนอุปกรณ์แล้ว&nbsp;</label>';
                                                 }
                                             @endphp
                                                <tr>
                                                <td class="text-center">{{$item->m_no}}  
                                                    <input type="hidden" class="m_flag" name="m_flag[]" value="{{$item->m_flag}}"/>
                                                    <input type="hidden" class="stock_transaction" name="stock_transaction[]" value="out"/>
                                                    <input type="hidden" name="_id[]" value="{{$item->id}}"/>
                                                    <input type="hidden" name="m_id[]" value="{{$item->m_id}}" class="m_id"/>
                                                    <input type="hidden" name="m_no[]" value="{{$item->m_no}}" class="m_no"/>
                                                </td>
                                                  <td class="text-center">{{$item->mg_name}}</td>
                                                  <td class="text-center">{{$item->mt_name}}</td>         
                                                  <td class="text-center">{{$item->m_name}}</td>       
                                                  <td class="text-center">@php echo $status_text @endphp</label></td>       
                                                  <td class="text-center">
                                                    <input type="number"  class="qty_out form-control form-control-sm "
                                                     name="qty_out[]" value="{{$item->qty_out}}" min="1"  step="1" style="text-align:right;" {{$out_disabled}} max="{{$item->qty_balance_as}}" required/>
                                                  </td>
                                                  {{-- @if($data->joborder_status == 'confirmout' || $data->joborder_status == 'confirmin' ) --}}
                                                  <td class="text-center">                                   
                                                    <input type="number"  class="qty_in form-control form-control-sm  " {{$in_disabled}}
                                                  name="qty_in[]" value="{{$item->qty_in}}" min="0"  step="1" style="text-align:right;" required max="{{$item->qty_out}}"/>
                                                    </td>
                                                  {{-- @endif --}}
                  
                                                  <td class="text-center">{{$item->qty_balance_as}} <input type="hidden" name="stock_balance_as[]" value="{{$item->qty_balance_as}}"/></td>
                                                  <td class="text-center">
                                                    <input type="text"  class="reason form-control form-control-sm  " name="reason[]" value="{{$item->reason}}"/>
                                                    </td>
                                                  <td class="text-center">
                                                  <button data-id="{{$item->id}}" class="btn btn-outline-danger btn-sm tempbtndelete" style="{{$delete_style}}"><span class="fas fa-trash fa-fw"></span></button>
                                                  </td>
                                                </tr> 
                                             @endforeach
                                             </tbody>
                                        </table>
                                </div>
                                </div>
                </div>
              </div>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                            <label><u>ประวัติการแก้ไขข้อมูล</u></label>
                            <ul class="timeline small">
                                @foreach ($data_log as $item_log)
                                <li class="timeline-item">
                                <div class="timeline-info"> 
                                <span>{{date("d/m/Y",strtotime("+543 year",strtotime($item_log->created_at)))}} {{date("H:i",strtotime("+7 hours",strtotime($item_log->created_at)))}}</span>
                                </div>
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                <h5 class="timeline-title">{{strtoupper($item_log->action)}} </h5>
                                <p>{{$item_log->desc}}  ปรับปรุงข้อมูลโดย: ({{$item_log->user}})</p>
                                <hr>
                                </div>
                                </li>
                                @endforeach                   
                        </ul>
                    </div>
                  </div> 
                  {{-- End div tab --}}
                  

           
          </div>
        </div>
</div> 
</div> 
</div>
      <!-- Default Card Example -->
          
    </form>
       <!-- Default Card Example -->


@endsection
{{-- For Script Javascript --}}
@section('js')
@include('joborder.js.js')

<script>
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
    
    function branchSelected(_id, dep_id){
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
                                            $('#dep').val(dep_id);
                                        }
                                }
                    });
                }
          };

$(document).ready(function (){
    $.ajax({
                type:"get",
                url:"{{url('/get_dep_from_branch')}}/"+ $('#branch').val(),
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
                        $("#asset_owner_dep_id").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#asset_owner_dep_id").append('<option value="'+value["id"]+'">'+value["name_th"]+'</option>');
                        });
                        getjoborder( {!! json_encode($data->id) !!});
                    }
                }
            });

            function getjoborder(id){
            $.ajax({
                type:"get",
                url:"{{url('/get_job_order')}}/"+ id,
                success:function(res)
                {       
                console.log(res)
                    if(res)
                    {
                        $('#dep').val(res[0].request_dep_id);
                        $('#asset_owner_dep_id').val(res[0].asset_owner_dep_id);
                    }
                }
            });
            }
});
var confirm_flg = 0;
$('#btnconfirm').click(function () {
     let stock_transaction = $('.stock_transaction').val()
     if (stock_transaction == null){
         alert('กรุณาเพิ่มรายการ')
        return true;
     }
     event.preventDefault(); 
     var r = confirm("ยืนยันการเบิก-รับอุปกรณ์");
            if (r == true) {
                $('.job_flg').val("confirm")
                // $('#joborder_frm').submit();
                $('#btnsave').click();
                $('.job_flg').val("")
            } 
    // if (confirm_flg == 0){
    //         var r = confirm("ยืนยันการเบิก-รับอุปกรณ์");
    //         if (r == true) {
    //             $('.job_flg').val("confirm")
    //             $('#joborder_frm').submit()
    //         } 
    // }
    // else if(confirm_flg == 1){
    //         var r = confirm("ยืนยันการรับเข้า");
    //         if (r == true) {
    //             $('.job_flg').val("confirm")
    //             $('#joborder_frm').submit()
    //         } 
    // }
   
});
    let joborder_status = '{{$data->joborder_status}}'
    if (joborder_status == 'confirmout'){
        $('.job_flg').val("saveconfirm")
        // $("input").prop('disabled', true);
        // $("select").prop('disabled', true);
        // $("textarea").prop('disabled', false);
        // $('#btnsave').prop('disabled', true);
        confirm_flg = 1;
        // $('#btnconfirm').text('ยืนยันการรับเข้า');
        // $('#add_material_btn').prop('disabled', true);
        $('#job_title').prop('readonly', true);
        $('#ma_no').prop('readonly', true);
        $('#request_date').prop('readonly', true);
        // $('#request_time').prop('readonly', true);

        // $('#search_location_btn').prop('disabled', true);
        // $('#search_assignee_btn').prop('disabled', true);
        // $('#search_assign_as_btn').prop('disabled', true);
        // $('#schedule_end_date').prop('disabled', false);
        // $('#job_status_id').prop('disabled', false);
        // $('.schedule_end_time').prop('disabled', false);
        $('.qty_out').prop('readonly', true);
        // $('.reason').prop('disabled', false);
        $('.tempbtndelete').prop('disabled', true);
    }
    if (joborder_status == 'confirmin'){
        $('.job_flg').val("save_affter_in")
        $('#btnconfirm').hide();
        $('#add_material_btn').prop('disabled', true);
        $('#job_title').prop('readonly', true);
        $('#ma_no').prop('readonly', true);
        $('#request_date').prop('readonly', true);
        // $('#request_time').prop('readonly', true);
        $('.qty_out').prop('readonly', true);
        $('.tempbtndelete').prop('disabled', true);
        $('.qty_in').prop('readonly', true);
    }
    console.log(joborder_status)

    // $('#receive_date').daterangepicker(DRP_singleEditOptions);

</script>

@endsection

{{-- For  Modal --}}
@section('modal')
@include('modals.joborder.joborder_component_modal')
@include('modals.joborder.joborder_phonebook_modal')
@include('modals.joborder.joborder_sendtoapproved_modal')
{{-- @include('modals.stock.material_modal') --}}
@endsection