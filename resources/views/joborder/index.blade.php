@extends('layout.template')

{{-- For  Content . Blade --}}
@section('content')
@include('components.alertbox')
@php

@endphp


       <!-- Default Card Example -->
<div class="card mb-4">
        <div class="card-header bg-white">
          <div class="row">
            <div class="col-md-10 font-weight-bold   form-inilne small">
                <h3>ค้นหางานซ่อมบำรุง</h3>
            </div>
            <div class="col-md-2 text-right">
            @if (in_array( 'joborder.create', $Permissions))
              <a href="{{url('jobordercreate')}}"  class="btn btn-facebook" id="create">สร้าง</a>
            @endif
            </div>

            <div class="col-md-5 font-weight-bold   form-inilne ">
              <div class="form-group row small">
                <label for="desc" class="col-md-3 col-form-label text-right">{{ __('ช่วงวันที่') }}</label>  
                <div class="col-md-6  input-group"> 
                  <input id="searchdate" type="text" class="form-control form-control-sm" name="searchdate" >
                  <div class="input-group-append">
                      <a id="searchdate_btn" href="#" class="btn btn-outline-info btn-sm"><span class="fa fa-search"></span></a>
                  </div>
                </div>
              </div>
            </div>

            {{-- <div class="col-md-3 font-weight-bold   form-inilne ">
              <div class="form-group row small">
                <label for="desc" class="col-md-3 col-form-label text-right">{{ __('หน่วยงาน') }}</label>  
                <div class="col-md-9 "> 
                  <input id="search_jobno" type="hidden" class="form-control form-control-sm" name="searchdate" >
                  <select name="branch_id" id="branch" class="form-control form-control-sm" required>
                    <option value="">Select</option>
                        @foreach($data5 as $row)
                            <option value="{{$row['id']}}"> {{$row['short_name']}}</option>
                        @endforeach
                </select>
                </div>      
              </div>
            </div> --}}



          </div>        
        </div>
      
      <!-- end card header -->
        <div class="card-body">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-sm table-striped small" id="dataTable">
                <thead class="text-center bg-primary text-white">
                  <tr>
                    <th>หน่วยงาน</th>
                    <th>รหัสใบงาน</th>
                    <th>ประเภทการซ่อม</th>
                    <th>เลขที่อ้างอิง</th>
                    <th>ชื่องาน</th>
                    <th>วันที่เริ่มงาน</th>
                    <th>ผู้แจ้ง</th>  
                    <th>แผนก</th>
                    <th>ผู้ได้รับมอบหมาย</th>
                    <th>สถานะใบงาน</th>
                    <th>ระดับความสำคัญ</th>
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
@endsection
{{-- For Script Javascript --}}
@section('js')
<script type="text/javascript">
 var branch = $('#branch').val();
 $('#searchdate').daterangepicker();
let startDate = dateRangeFormat(-30);
let endDate = dateRangeFormat(0);
console.log(startDate);
      $(document).ready(function() {
        
        var DRP_lastmonth = Object.assign({},DRP_rangeOptions);
        DRP_lastmonth.startDate = moment().subtract('days', 30);
        DRP_lastmonth.endDate = moment();
          LoadDataTable(startDate, endDate)
          $('#searchdate').daterangepicker(
            DRP_lastmonth,
            function (start, end) {
            console.log('New date range selected: ' + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY','HH/mm/ss'));
            startDate = start.format('YYYY-MM-DD');
            endDate = end.format('YYYY-MM-DD');
          });

    function LoadDataTable(startDate, endDate){
         $('#dataTable').DataTable({
          dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [[ 0, "desc" ]],
        "pageLength": 10,
        "processing": true,
        "destroy": true,
        "serverSide": true,
        "stateSave": true,
        "ajax": {
            "url" : "{{url('joborder_getdata') }}",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}",startDate:startDate,endDate,endDate },
            "dataSrc":function(json) {
                console.log(json)
                try{
                    var return_data = new Array();         
                        var EditPermission = ' d-none '
                          var DeletePermission = ' d-none '
                          @if (in_array( 'joborder.edit', $Permissions))
                          EditPermission = 'd-inline';
                          @endif
                          @if (in_array( 'joborder.delete', $Permissions))
                          DeletePermission = 'd-inline';
                          @endif
                          for(var i=0;i< json.data.length; i++){ 
                            var status = json.data[i]["joborder_status"];    
                            if (status == 'new'){
                              status =  '<span class="badge badge-info">กำลังดำเนินการ</span>'
                            }else if (status == 'confirmout'){
                              status =    '<span class="badge badge-secondary">ยืนยันการเบิก</span>' 
                            }else if (status == 'confirmin'){
                              status =    '<span class="badge badge-success">ยืนยันการรับเข้า</span>' 
                            }

                          var actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#"  class="btn btn-sm btn-outline-warning btnedit '+EditPermission+'"><span class="fas fa-edit fa-fw"></a>' + 
                            '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete '+DeletePermission+'"><span class="fas fa-trash fa-fw"></a>';
                          
                          var ma_type = json.data[i]["ma_type"] == "ma_in" ? 
                            '<span>ซ่อมภายใน</span>' : 
                            '<span>ซ่อมภายนอก</span>' ; 

                          return_data.push({ 
                              'job_no'  : json.data[i]["job_no"],
                              'job_title'   : json.data[i]["job_title"],
                              'ma_no'   : json.data[i]["ma_no"],
                              'job_date'   : dateFormatddmmyyyy(json.data[i]["job_date"]),
                              'ma_type'   : ma_type,
                              'request_by'   : json.data[i]["request_by"],
                              'recommend'   : json.data[i]["recommend"],
                              'request_dep'   : json.data[i]["request_dep"],
                              'request_tel'   : json.data[i]["request_tel"],
                              'asset_model'   : json.data[i]["asset_model"],
                              'request_sub_dep'   : json.data[i]["request_sub_dep"],
                              'asset_brand'   : json.data[i]["asset_brand"],
                              'asset_serial'   : json.data[i]["asset_serial"],
                              'asset_no'   : json.data[i]["asset_no"],
                              'assign_as'   : json.data[i]["assign_as"],
                              'asset_desc'   : json.data[i]["asset_desc"],
                              'jt_name'   : json.data[i]["jt_name"],
                              'created_by'   : json.data[i]["created_by"],
                              'f_name'   : json.data[i]["f_name"] +'  '+ json.data[i]["l_name"],
                              'b_name'   : json.data[i]["b_name"],
                              'js_name'   :json.data[i]["js_name"],
                              'created_by'   : json.data[i]["created_by"],
                              'p_name'   : '<span class=" badge badge-success " style="background-color:'+json.data[i]["color_name"]+'"> '  + json.data[i]["p_name"] + '</span>',
                              
                              'joborder_status' : status,
                              'actions' : actions,
                          })
                      }
                    console.log(return_data);
                    return return_data;
                } catch(err) {
                        console.log(err.message)
                        console.log('error')
                    }
              },
          },
        "columns":[
                { "data": "b_name" },  
                { "data": "job_no" },
                { "data": "ma_type" }, 
                { "data": "ma_no" },
                { "data": "job_title" },   
                { "data": "job_date" },   
                { "data": "request_by" },
                { "data": "request_dep" },  
                { "data": "f_name" },
                { "data": "js_name" },   
                { "data": "p_name" },      
                { "data": "actions" }, 
            ],
        'columnDefs': [
                {
                  "targets": [0,1,2,3,4,5,6,7,8,9,10,11],
                  "className": "text-center",
                },
                { "orderable": false, "targets": 11 },
            ],   
         });
      } //end function load dataTable
            $('#searchdate_btn').click(function () {
              let searchDateBetween =  document.getElementById('searchdate').value
              console.log(branch)
              LoadDataTable(startDate, endDate )
         
      });

    }); //Ready Function
    $('#dataTable tbody').on( 'click', '.btnedit', function () {
      event.preventDefault();
      var _id = $(this).data('id');
      window.location = 'joborder/' + _id + '/edit';
      console.log(data)
      // $.get('joborder/' + _id + '/edit', function (data) {
      //   console.log(data)
      //   document.getElementById('modal-title').innerHTML = 'แก้ไขข้อมูลพนักงาน';
      //     $('#emp_code').val(data.emp_code);
      //     $('#title').val(data.title);
      //     $('#f_name').val(data.f_name);
      //     $('#l_name').val(data.l_name);
      //     $('#nickname').val(data.nickname);
      //     $('#remark').val(data.remark);
      //     $('#branch').val(data.branch_id);
      //     branchSelected(data.branch_id, data.dep_id);
          // document.getElementById("modalCreateFrm").action = "{{url('joborderedit')}}" + '/' + _id
          // $('#_method').val("PATCH");
      // })
     });

$('#dataTable tbody').on( 'click', '.btndelete', function () {
        event.preventDefault();
        var _id = $(this).data('id');
        $('#deleteModal').modal('show');
        document.getElementById("daleteFrm").action = "{{url('joborder')}}" + '/' + _id
});
// $('#branch').change(function () {
//         $("#dep").empty();
//         $("#dep").append('<option value="">Select</option>');
//         var _id = $(this).val();
//         console.log(_id)
//         if(_id){
//             $.ajax({
//                 type:"get",
//                 url:"{{url('/get_dep_from_branch')}}/"+_id,
//                 success:function(res)
//                 {       
//                 console.log(res)
//                     if(res)
//                     {
//                         $("#dep").empty();
//                         $("#dep").append('<option value="">Select</option>');
//                         $.each(res,function(key,value){
//                             $("#dep").append('<option value="'+value["id"]+'">'+value["name_th"]+'</option>');
//                         });
                        
//                     }
//                 }
//             });
//         }
//     });
  
  
</script>
@endsection

{{-- For  Modal --}}
@section('modal')
@include('modals.component.delete')
@endsection