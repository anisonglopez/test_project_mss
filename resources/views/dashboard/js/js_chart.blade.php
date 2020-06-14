<script type="text/javascript">
    let StartDatetime = dateRangeFormat(-30);
    let EndDatetime = dateRangeFormat(0);
    console.log(StartDatetime);
          $(document).ready(function() {
            
            var DRP_Lastmonths = Object.assign({},DRP_rangeOptions);
            DRP_Lastmonths.StartDatetime = moment().subtract('days', 30);
            DRP_Lastmonths.EndDatetime = moment();
              LoadDataTable(StartDatetime, EndDatetime)
              $('#searchdate2').daterangepicker(
                DRP_Lastmonths,
                function (starts, ends) {
                    console.log('sssss');
                console.log('New date range selected: ' + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY','HH/mm/ss'));
                StartDatetime = starts.format('YYYY-MM-DD');
                EndDatetime = ends.format('YYYY-MM-DD');
              });
    
        function LoadDataTable(StartDatetime, EndDatetime){
             $('#chart_line_dataTable').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 10,
            "processing": true,
            "searching": false,
            "destroy": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url" : "{{url('joborder_getdata') }}",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}",StartDatetime:StartDatetime,EndDatetime,EndDatetime },
                "dataSrc":function(json) {
                    console.log(json)
                    // try{
                    //     var return_data = new Array();         
                    //         var EditPermission = ' d-none '
                    //           var DeletePermission = ' d-none '
                    //           @if (in_array( 'joborder.edit', $Permissions))
                    //           EditPermission = 'd-inline';
                    //           @endif
                    //           @if (in_array( 'joborder.delete', $Permissions))
                    //           DeletePermission = 'd-inline';
                    //           @endif
                    //           for(var i=0;i< json.data.length; i++){ 
                    //             var status = json.data[i]["joborder_status"];    
                    //             if (status == 'new'){
                    //               status =  '<span class="badge badge-info">กำลังดำเนินการ</span>'
                    //             }else if (status == 'confirmout'){
                    //               status =    '<span class="badge badge-secondary">ยืนยันการเบิก</span>' 
                    //             }else if (status == 'confirmin'){
                    //               status =    '<span class="badge badge-success">ยืนยันการรับเข้า</span>' 
                    //             }
    
                    //           var actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#"  class="btn btn-sm btn-outline-warning btnedit '+EditPermission+'"><span class="fas fa-edit fa-fw"></a>' + 
                    //             '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete '+DeletePermission+'"><span class="fas fa-trash fa-fw"></a>';
                                
                    //           return_data.push({ 
                    //               'job_no'  : json.data[i]["job_no"],
                    //               'job_title'   : json.data[i]["job_title"],
                    //               'ma_no'   : json.data[i]["ma_no"],
                    //               'request_date'   : dateFormatddmmyyyy(json.data[i]["request_date"]),
                    //               'request_time'   : json.data[i]["request_time"].substring(0, 5),
                    //               'requester_name'   : json.data[i]["requester_name"],
                    //               'desc'   : json.data[i]["desc"],
                    //               'asset_owner_dep_id'   : json.data[i]["asset_owner_dep_id"],
                    //               'location_name'   : json.data[i]["location_name"],
                    //               'dep_name'   : json.data[i]["dep_name"],
                    //               'tel'   : json.data[i]["tel"],
                    //               'e_name'   : json.data[i]["e_name"],
                    //               'assignee'   : json.data[i]["assignee"],
                    //               'jt_name'   : json.data[i]["jt_name"],
                    //               'remark'   : json.data[i]["remark"],
                    //               'b_name'   : json.data[i]["b_name"],
                    //               'js_name'   :json.data[i]["js_name"],
                    //               'created_by'   : json.data[i]["created_by"],
                    //               'p_name'   : '<span class=" badge badge-success " style="background-color:'+json.data[i]["color_name"]+'"> '  + json.data[i]["p_name"] + '</span>',
                    //               'schedule_start_date'   : json.data[i]["schedule_start_date"],
                    //               'schedule_start_time'   : json.data[i]["schedule_start_time"],
                    //               'schedule_end_date'   : json.data[i]["schedule_end_date"],
                    //               'schedule_end_time'   : json.data[i]["schedule_end_time"],
                    //               'joborder_status' : status,
                    //               'actions' : actions,
                    //           })
                    //       }
                          
                    //     console.log(return_data);
                    //     return return_data;
                    // } catch(err) {
                            // console.log(err.message)
                            // console.log('error')
                        // }
                  },
              },
            // "columns":[
            //         { "data": "b_name" },  
            //         { "data": "job_no" },
            //         { "data": "ma_no" },
            //         { "data": "job_title" },   
            //         { "data": "request_date" },  
            //         { "data": "request_time" },  
            //         { "data": "requester_name" },
            //         { "data": "dep_name" },  
            //         { "data": "e_name" },
            //         { "data": "js_name" },   
            //         { "data": "p_name" },   
            //         { "data": "joborder_status" },     
            //         { "data": "actions" }, 
            //     ],
            // 'columnDefs': [
            //         {
            //           "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12],
            //           "className": "text-center",
            //         },
            //         { "orderable": false, "targets": 12 },
            //     ],   
             });
          } //end function load dataTable
          $('#searchdate_btn2').click(function () {
                  let searchDateBetweens =  document.getElementById('searchdate2').value
                  
                  LoadDataTable(StartDatetime, EndDatetime, dep, branch )
                  console.log(branch)
          });
        });
        </script>