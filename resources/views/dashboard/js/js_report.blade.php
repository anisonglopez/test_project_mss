
<script>
    $(document).ready(function() {
        
      $('#joborderdataTable').DataTable({
         "order": [[ 0, "desc" ]],
         "pageLength": 10,
         "processing": true,
         "serverSide": true,
         "stateSave": true,
         "ajax": {
             "url" : "{{url('dashboard_getdatajoborder') }}",
             "type": "POST",
             "data":{ _token: "{{csrf_token()}}"},
             "dataSrc":function(json) {
                console.log('sss')
                 console.log(json)
                 try{
                     var return_data = new Array();
                       for(var i=0;i< json.data.length; i++){               
                           const actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-sm btn-outline-warning btnedit"><span class="fas fa-edit fa-fw"></a>' +
                                           '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete"><span class="fas fa-trash fa-fw"></a>'
                           const nulldesc = '-';
                           return_data.push({
                               'b_name'  : json.data[i]["b_name"],
                               'j_name'  : json.data[i]["j_name"],
                               'actions' : actions,
                               'nulldesc' : nulldesc,
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
                 { "data": "j_name" },
                 { "data": "nulldesc" },
                 { "data": "nulldesc" },
             ],
         'columnDefs': [
                 {
                   "targets": [0,1,2],
                   "className": "text-center",
                 },
                 
             ],
             
      });
     });
  
    </script>