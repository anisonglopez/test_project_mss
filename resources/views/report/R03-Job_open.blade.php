@extends('layout.template')
@include('components.alertbox')

{{-- For  Content . Blade --}}
@section('content')
    <h3>R03 - รายงานนำเข้าอุปกรณ์</h3>
       <!-- Default Card Example -->
<form method="POST" action="{{url('report')}}">
@csrf 


      <!-- Default Card Example -->
<div class="card mb-4">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6 font-weight-bold text-primary">
                รายงานรับวัสดุอุปกรณ์เข้าระบบ
        </div>
      </div>        
    </div>
      
      <!-- end card header -->
      <div class="card-body">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm " id="dataTable" class="reportdt">
                <thead class="text-center bg-primary text-white small">
                    <tr> 
                        <th>ลำดับ</th>
                        <th>หน่วยงาน</th>
                        <th>รหัสวัสดุอุปกรณ์</th>
                        <th>ชื่อวัสดุอุปกรณ์</th>
                        <th>จำนวน</th>
                        <th>รับเข้าโดย</th>
                        <th>สถานะ</th>
                        <th>วันที่แจ้ง</th>
                    </tr>
                  </thead>
                  <tbody class="small">
                    {{-- @foreach ($data1 as $item)
                        <tr>
                            <td class="text-center">{{$item->b_name}}</td>
                            <td class="text-center">{{$item->name}}</td>
                            <td class="text-center">{{$item->m_g_id}}</td>
                            <td class="text-center">{{$item->max}}</td>
                            <td class="text-center">{{$item->min}}</td>
                            <td class="text-center"></td>
                            <td class="text-center">{{$item->unit_id}}</td>
                        </tr>
                    @endforeach --}}
                  </tbody>
            </table>
        </div>
        </div>
      </div>
</div>
    </form>

    {{-- <h3>แสดงจำนวนทรัพย์สิน</h3>
       <!-- Default Card Example -->
<form method="POST" action="{{url('asset')}}">
@csrf 


      <!-- Default Card Example -->
<div class="card mb-4">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6 font-weight-bold text-primary">
                รายการรับทรัพย์สินเข้าระบบ
        </div>
      </div>        
    </div>
      
      <!-- end card header -->
      <div class="card-body">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm " id="assetdataTable">
                <thead class="text-center small">
                    <tr> 
                        <th>สาขา</th>
                        <th>เจ้าของทรัพย์สิน</th>
                        <th>สถานะทรัพย์สิน</th>
                        <th>รหัสทรัพย์สิน</th>
                        <th>โมเดลสินทรัพย์</th>
                        <th>หมายเลขซีเรียล</th>
                    </tr>
                  </thead>
                  <tbody class="small">
                    {{-- @foreach ($data1 as $item)
                        <tr>
                            <td class="text-center">{{$item->b_name}}</td>
                            <td class="text-center">{{$item->name}}</td>
                            <td class="text-center">{{$item->m_g_id}}</td>
                            <td class="text-center">{{$item->max}}</td>
                            <td class="text-center">{{$item->min}}</td>
                            <td class="text-center"></td>
                            <td class="text-center">{{$item->unit_id}}</td>
                        </tr>
                    @endforeach --}}
                  {{-- </tbody>
            </table>
        </div>
        </div>
      </div>
</div>
    </form>  --}}
       <!-- Default Card Example -->


      
@endsection
{{-- For Script Javascript --}}
@section('js')
{{-- @include('receive.js.js') --}}
<script type="text/javascript">
  $('#searchdate').daterangepicker();
let startDate = dateRangeFormat(0);
let endDate = dateRangeFormat(+30);
    $(document).ready(function() {
      
        LoadDataTable(startDate, endDate)
        $('#searchdate').daterangepicker(DRP_rangeOptions,
        function (start, end) {
         console.log('New date range selected: ' + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY'));
         startDate = start.format('YYYY-MM-DD');
         endDate = end.format('YYYY-MM-DD');
        });

  function LoadDataTable(startDate, endDate){
    console.log(startDate, endDate)
       $('#dataTable').DataTable({
        //  Export Start
        dom: 'Bfrtip',
        buttons: [
          {
                extend: 'pdfHtml5',
                text: 'ส่งออกข้อมูล PDF',
                orientation: 'landscape',
                pageSize: 'A4',
                title:'R03 - รายงานใบงานที่ยังไม่ปิด' + '\n' + '<Search Date>',
                customize: function (doc) {
                  var now = new Date();
					      	var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                  doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  var objLayout = {};
          objLayout['hLineWidth'] = function(i) {
            return 0.5;
          };
          objLayout['vLineWidth'] = function(i) {
            return 0.5;
          };
          objLayout['hLineColor'] = function(i) {
            return '#000000 ';
          };
          objLayout['vLineColor'] = function(i) {
            return '#000000 ';
          };
          objLayout['paddingLeft'] = function(i) {
            return 4;
          };
          objLayout['paddingRight'] = function(i) {
            return 4;
          };
          doc.content[1].layout = objLayout;
                  doc.styles.tableHeader = {
                        color: 'black',
                        fontWeight: '800',
                        bold: true,
                        fontSize: 12,
                        alignment: 'center',
                        fillColor:'#9ACBFC'
                    }
                  doc['header']=(function() {
							return {
								columns: [
									{
										alignment: 'left',
										italics: true,
										text: 'dataTables',
										fontSize: 18,
										margin: [10,0]
									},
									{
										alignment: 'right',
										fontSize: 12,
										text: 'พิม์โดย'
									}
								],
								margin: 20
							}
            });
            
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['พิมพ์วันที่  ', { text: jsDate.toString() }]
									},
									{
										alignment: 'right',
										text: ['หน้าที่ ', { text: page.toString() },	' จาก ',	{ text: pages.toString() }]
									}
								],
								margin: 20
							}
						});

			
      }
            },{
              extend: 'excelHtml5',
            text: 'Export to Excel',
            title:'R03 - รายงานใบงานที่ยังไม่ปิด',
            messageTop: '<Search Date>',
            exportOptions: {
                  columns: ':not(.notexport)'
            }
        }],
          //  End Export 
      "order": [[ 0, "desc" ]],
      "processing": true,
      "destroy": true,
      "serverSide": true,
       "stateSave": true,
      "ajax": {
          "url" : "{{url('receive_getdata')}}",
          "type": "POST",
          "data":{ _token: "{{csrf_token()}}",startDate:startDate,endDate,endDate },
          "dataSrc":function(json) {
              console.log(json)
              try{
                  var return_data = new Array();         
                        var EditPermission = ' d-none '
                        var DeletePermission = ' d-none '
                        
                        @if (in_array( 'receive.edit', $Permissions))
                        EditPermission = 'd-inline';
                        @endif
                        @if (in_array( 'receive.delete', $Permissions))
                        DeletePermission = 'd-inline';
                        @endif
                        
                        for(var i=0;i< json.data.length; i++){     
                          var status   = json.data[i]["receive_status"];      
                           if (status == "confirm"){
                              DeletePermission = ' d-none '
                           }
                           else{
                            DeletePermission = ' d-inline '
                           }
                           
                          var actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#"  class="btn btn-sm btn-outline-warning btnedit '+EditPermission+'"><span class="fas fa-edit fa-fw"></a>' +
                          '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete '+DeletePermission+'"><span class="fas fa-trash fa-fw"></a>';
                          
                          
                        return_data.push({ 
                            'receive_no'  : json.data[i]["receive_no"],
                            'in_name'   : json.data[i]["in_name"],
                            'id'   : json.data[i]["id"],
                            'receive_date'   : dateFormatddmmyyyy(json.data[i]["receive_date"]),
                            'receive_by'   : json.data[i]["receive_by"],
                            'b_name'   : json.data[i]["b_name"],
                            'm_name'   : json.data[i]["m_name"],
                            'm_no'   : json.data[i]["m_no"],
                            'q_in'   : json.data[i]["q_in"],
                            'actions' : actions,
                            'receive_status' : '<span class="badge badge-success">'+json.data[i]["receive_status"]+'</span>',
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
              { "data": "id" }, 
              { "data": "b_name" },
              { "data": "m_no" },
              { "data": "m_name" },   
              { "data": "q_in" }, 
              { "data": "receive_by" },  
              { "data": "receive_status" }, 
              { "data": "receive_date" }, 
          ],
      'columnDefs': [
              {
                "targets": [0,1,2,3,4,5,6,7],
                "className": "text-center",
              },
              { "orderable": false, "targets": 7 },
          ],   
       });
    }
        });
</script>
 <!-- Export -->
 <script src="{{asset('vendor/datatable_export/buttons/1.6.0/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('vendor/datatable_export/buttons/1.6.0/js/buttons.flash.min.js')}}"></script>
 <script src="{{asset('vendor/datatable_export/ajax/jszip/3.1.3/jszip.min.js')}}"></script>
 <script src="{{asset('vendor/datatable_export/buttons/1.6.0/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('vendor/datatable_export/buttons/1.6.0/js/buttons.print.min.js')}}"></script>
 <script src="{{asset('vendor/datatable_export/buttons/1.6.0/js/buttons.colVis.min.js')}}"></script>
 <script src="{{asset('vendor/datatable_export/ajax/pdfmake/0.1.53/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/datatable_export/ajax/pdfmake/0.1.53/vfs_fonts.js')}}"></script>
 
 <script>
 </script>
@endsection

{{-- For  Modal --}}
@section('modal')
@include('modals.component.delete')
@endsection