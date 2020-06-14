<!-- Default Card Example -->

<div class="card mb-4 ">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-10 font-weight-bold ">
                แสดงรายการจำนวนวัสดุอุปกรณ์ คงเหลือน้อยกว่าที่กำหนด
        </div>
        <div class="col-md-2 text-right">
        </div>
      </div>        
    </div>
  <!-- end card header -->
    <div class="card-body ">
      <div class="col-md-12">
      <div class="table-responsive">
              <table class="table table-bordered table-hover table-sm " id="outstockdataTable">
                  <thead class="text-center bg-primary text-white small ">
                      <tr>
                          <th>สาขา</th>
                          <th>ประเภท</th>
                          <th>ชนิด</th>
                          <th>รหัสวัสดุอุปกรณ์</th>
                          <th>ชื่อวัสดุอุปกรณ์</th>
                          <th>Min</th>
                          <th>Max</th>
                          <th>คงเหลือ</th>
                      </tr>
                   </thead>
                   <tbody class="small">
                     
                   </tbody>
              </table>
      </div>
      </div>
      </div>
  </div>
  
<script>
  $(document).ready(function() {
      
    $('#outstockdataTable').DataTable({
       "order": [[ 0, "desc" ]],
       "pageLength": 10,
       "processing": true,
       "serverSide": true,
       "stateSave": true,
       "ajax": {
           "url" : "{{url('dashboard_getdataoutstock') }}",
           "type": "POST",
           "data":{ _token: "{{csrf_token()}}"},
           "dataSrc":function(json) {
              console.log('ss')
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
                             'min'   : json.data[i]["min"],
                             'max'   : json.data[i]["max"],
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
           ],
       'columnDefs': [
               {
                 "targets": [0,1,2,3,5,6,7],
                 "className": "text-center",
               },
               
           ],
           
    });
   });

  </script>