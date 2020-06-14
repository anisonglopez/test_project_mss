@extends('layout.template')
@include('components.alertbox')

{{-- For  Content . Blade --}}
@section('content')
    
       <!-- Default Card Example -->
<form method="POST" action="{{url('m_stock')}}">
@csrf 


      <!-- Default Card Example -->
<div class="card mb-4">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6 font-weight-bold text-primary">
          <h3>แสดงจำนวนวัสดุอุปกรณ์</h3>
                รายการรับวัสดุอุปกรณ์เข้าระบบ
        </div>
      </div>        
    </div>
      
      <!-- end card header -->
      <div class="card-body">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm " id="dataTable">
                <thead class="text-center bg-primary text-white small">
                    <tr> 
                        <th>หน่วยงาน</th>
                        <th>ประเภท</th>
                        <th>ชนิด</th>
                        <th>รหัสวัสดุอุปกรณ์</th>     
                        <th>ชื่อวัสดุอุปกรณ์</th>                  
                        <th>Min</th>
                        <th>Max</th>
                        <th>คงเหลือ</th>
                        <th>หน่วยนับ</th>
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

    <!--<h3>แสดงจำนวนทรัพย์สิน</h3>
        Default Card Example 
{{-- <form method="POST" action="{{url('asset')}}">
@csrf  --}}


       Default Card Example 
<div class="card mb-4">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6 font-weight-bold text-primary">
                รายการรับทรัพย์สินเข้าระบบ
        </div>
      </div>        
    </div>
      
      end card header 
      <div class="card-body">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm " id="assetdataTable">
                <thead class="text-center bg-primary text-white small">
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
                  </tbody>
            </table>
        </div>
        </div>
      </div>
</div>
    </form>
        Default Card Example -->


      
@endsection
{{-- For Script Javascript --}}
@section('js')
{{-- @include('receive.js.js') --}}
<script>
    $(document).ready(function() {
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
            "pageLength": 50,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url" : "{{url('m_stock_getdata') }}",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"},
                "dataSrc":function(json) {
                    console.log(json)
                    try{
                        var return_data = new Array();
                          for(var i=0;i< json.data.length; i++){               
                              const actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-sm btn-outline-warning btnedit"><span class="fas fa-edit fa-fw"></a>' +
                                              '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete"><span class="fas fa-trash fa-fw"></a>'
                              const nulldesc = '-';
                              return_data.push({
                                  'b_name'  : json.data[i]["b_name"],
                                  'name'  : json.data[i]["name"],
                                  'm_g_name'   : json.data[i]["m_g_name"],
                                  'm_t_name'   : json.data[i]["m_t_name"],
                                  'm_no'   : json.data[i]["m_no"],
                                  'max'   : json.data[i]["max"],      
                                  'min'   : json.data[i]["min"],
                                  'u_name'   : json.data[i]["u_name"],
                                  'status'   : json.data[i]["status"],
                                  'desc'   : json.data[i]["desc"],
                                  'qty_balance'   : json.data[i]["qty_balance"],
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
                    { "data": "m_g_name" },
                    { "data": "m_t_name" },
                    { "data": "m_no" },
                    { "data": "name" },
                  
                    { "data": "min" },
                    { "data": "max" },
                    { "data": "qty_balance" },
                    { "data": "u_name" },        
                ],
            'columnDefs': [
                    {
                      "targets": [0,1,2,3,5,6,7],
                      "className": "text-center",
                    },
                    
                ],
                
         });
        });

        $(document).ready(function() {
         $('#assetdataTable').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url" : "{{url('asset_getdata') }}",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"},
                "dataSrc":function(json) {
                    console.log(json)
                    try{
                        var return_data = new Array();
                          for(var i=0;i< json.data.length; i++){               
                              const actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-sm btn-outline-warning btnedit"><span class="fas fa-edit fa-fw"></a>' +
                                              '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete"><span class="fas fa-trash fa-fw"></a>'
                              return_data.push({
                                  'b_name'  : json.data[i]["b_name"],
                                  'asset_no'  : json.data[i]["asset_no"],
                                  'a_name'   : json.data[i]["a_name"],
                                  'serial_no'   : json.data[i]["serial_no"],      
                                  'refer_doc'   : json.data[i]["refer_doc"],
                                  'acqu_date'   : json.data[i]["acqu_date"],
                                  'deac_date'   : json.data[i]["deac_date"],
                                  'asset_value'   : json.data[i]["asset_value"],
                                  'd_name'   : json.data[i]["d_name"],
                                  'c_name'   : json.data[i]["c_name"],
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
                    { "data": "d_name" },
                    { "data": "c_name" },
                    { "data": "asset_no" },
                    { "data": "a_name" },
                    { "data": "serial_no" },  
                ],
            "columnDefs": [
                    {
                      "targets": [0,1,2,3,4],
                      "className": "text-center",
                    },
                ],  
         });
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

@endsection

{{-- For  Modal --}}
@section('modal')
@include('modals.component.delete')
@endsection