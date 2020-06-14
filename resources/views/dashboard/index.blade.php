@extends('layout.template')
{{-- For  Content . Blade --}}
@section('content')
@include('components.alertbox')
   <!-- Page Heading -->
   {{-- <h2 class="repalceh1">Dashboard</h2> --}}
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
     <li class="breadcrumb-item">
     <a href="{{url('/')}}" class="zoom btn btn-outline-info btn-sm active">Dashboard 1</a>
     </li>
     <li class="breadcrumb-item ">
       <a href="{{url('/dashboard2')}}"  class="zoom btn btn-outline-info btn-sm ">Dashboard 2</a> 
      </li>
   </ol>


      <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 font-weight-bold ">
        <h3>รายงานใบงาน</h3>
        {{-- <div class="form-group row small">
          <label for="desc" class="col-md-2 col-form-label text-right">{{ __('ช่วงวันที่') }}</label>  
          <div class="col-md-5  input-group"> 
            <input id="searchdate" type="text" class="form-control form-control-sm" name="searchdate" >
            <div class="input-group-append">
                <a id="searchdate_btn" href="#" class="btn btn-outline-info btn-sm"><span class="fa fa-search"></span></a>
            </div>
          </div>
        </div> --}}
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <ul>
      <li><span class="fa fa-w fa-square tr-expired-warning-text border"></span> ครบกำหนดวันนี้</li>
      <li><span class="fa fa-w fa-square tr-expired-danger-text border"></span> เลยกำหนดแล้ว</li>
      <li><span class="fa fa-w fa-square tr-expired-normal-text border"></span> ปกติ</li>
    </ul>
    <div class="col-md-12">
      
    <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-sm " id="dataTable">
                <thead class="text-center bg-primary text-white small">
                    <tr>
                      <th>หน่วยงาน</th>
                      <th>รหัสใบงาน</th>
                      <th>ประเภทการซ่อม</th>
                      <th>เลขที่ใบอนุมัติซ่อม</th>
                      <th>ชื่องาน</th>
                      <th>วันที่เริ่มงาน</th>
                      <th>ผู้แจ้ง</th>  
                      <th>แผนก</th>
                      <th>ผู้ได้รับมอบหมาย</th>
                      <th>ระดับความสำคัญ</th>
                      <th>สถานะใบงาน</th>                  
                      <th>#</th>               
                    </tr>
                 </thead>
                 <tbody class="small">
              
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
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy ;
           $('#dataTable').DataTable({
          "order": [[ 0, "desc" ]],
          "paging": false,
          // "pageLength": "แสดงทั้งหมด",
          // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "แสดงทั้งหมด"]],
          "processing": true,
          "destroy": true,
          "serverSide": true,
          "stateSave": true,
          "ajax": {
              "url" : "{{url('dashboard_getdatajoborder') }}",
              "type": "POST",
              "data":{ _token: "{{csrf_token()}}",startDate:startDate,endDate,endDate },
              "dataSrc":function(json) {
                  console.log(json)
                  try{
                      var return_data = new Array();         
                            for(var i=0;i< json.data.length; i++){ 
                              var status = json.data[i]["joborder_status"];    
                              if (status == 'new'){
                                status =  '<span class="badge badge-info">กำลังดำเนินการ</span>'
                              }else if (status == 'confirmout'){
                                status =    '<span class="badge badge-secondary">ยืนยันการเบิก</span>' 
                              }else if (status == 'confirmin'){
                                status =    '<span class="badge badge-success">ยืนยันการรับเข้า</span>' 
                              }
                            
                            var job_date_expired = new Date(json.data[i]["job_date"]) ;  
                            var expire_date = json.data[i]["expire_date"];
                            job_date_expired.setDate(job_date_expired.getDate() + expire_date);
                            var dd = String(job_date_expired.getDate()).padStart(2, '0');
                            var mm = String(job_date_expired.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = job_date_expired.getFullYear();
                            job_date_expired = mm + '/' + dd + '/' + yyyy ;
                            const date1 = new Date(today);
                            const date2 = new Date(job_date_expired);
                            const diffTime = Math.ceil(date2 - date1);
                            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

                            var viewonly = '<a href="#" target="_blank" data-id="'+json.data[i]["id"]+'" class="btn btn-outline-info btn-sm btn-view-info"><span class="fa fa-file"></span></a>';
                                                  
                            var ma_type = json.data[i]["ma_type"] == "ma_in" ? 
                              '<span>ซ่อมภายใน</span>' : 
                              '<span>ซ่อมภายนอก</span>' ; 
  
                            return_data.push({ 
                                'diffDays'  :diffDays,
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
                                'asset_desc'   : json.data[i]["asset_desc"],
                                'jt_name'   : json.data[i]["jt_name"],
                                'created_by'   : json.data[i]["created_by"],
                                'f_name'   : json.data[i]["f_name"] +'  '+ json.data[i]["l_name"],
                                'b_name'   : json.data[i]["b_name"],
                                'js_name'   :json.data[i]["js_name"],
                                'created_by'   : json.data[i]["created_by"],
                                'p_name'   : '<span class=" badge badge-success " style="background-color:'+json.data[i]["color_name"]+'"> '  + json.data[i]["p_name"] + '</span>',
                                'viewonly' : viewonly,
                                'joborder_status' : status,
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
                { "data": "p_name" },   
                { "data": "js_name" },   
                { "data": "viewonly" },   
              ],
          'columnDefs': [
                  {
                    "targets": [0,1,2,3,5,6,8,9,10,11],
                    "className": "text-center",
                  },
                  { "orderable": false, "targets": 11 },
              ],   
              "createdRow": function( row, data, dataIndex){
                if( data['diffDays'] ==  0){
                    $(row).addClass('tr-expired-warning');
                } else if ( data['diffDays'] <  0){
                  $(row).addClass('tr-expired-danger');
                }
              }
           });
        } //end function load dataTable
        $('#searchdate_btn').click(function () {
                let searchDateBetween =  document.getElementById('searchdate').value
                
                LoadDataTable(startDate, endDate )
                console.log(branch)
        });
  
      }); //Ready Function
      $('#dataTable tbody').on( 'click', '.btn-view-info', function () {
        event.preventDefault();
        var _id = $(this).data('id');
        window.location = 'joborder/' + _id + '/edit?viewonly';
        console.log(data)
       });
  
  </script>
@endsection

{{-- For  Modal --}}
@section('modal')

@endsection