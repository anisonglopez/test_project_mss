<script>
    let MaterialDataTable = $('#MaterialdataTable').DataTable({
        "paging":false,
        "searching":false,
        "stateSave": true,
        //  destroy:true,
        "columnDefs": [
            {
            "targets": [0,1,2,3,4,5,6,7],
            "className": "text-center",
        },
        ],
    });
    let AssetDataTable = $('#AssetdataTable').DataTable({
        "paging":false,
        //  destroy:true,
        "columnDefs": [
            // { "width": "15%", "targets": 0 },
            // { "width": "15%", "targets": 1 },
            // { "width": "15%", "targets": 2 },
            {
            "targets": [0,1,2,3],
            "className": "text-center",
        },
        ],
    });
    //  ------  btn onclick area  --------
$('#search_location_btn').click(function () {
    event.preventDefault(); 
    $.ajax({
        type: "POST",
        url: "{{url('joborder_getlocation') }}",
        data: { _token: "{{csrf_token()}}"}, // serializes the form's elements.
        success: function(data)
        {
            console.log(data)
            response_modal(data)
        }
      });  
});
$(document).ready(function(){

$('#search_asset_owner_dep_id_btn').click(function () {
    event.preventDefault(); 
    $.ajax({
        type: "POST",
        url: "{{url('phonebook_getdata') }}",
        data: { _token: "{{csrf_token()}}"}, // serializes the form's elements.
        success: function(data)
        {
            $('#joborder_phonebook_Modal').modal('show'); 
            $('#joborder_phonebook_Modal-title').html('แสดงรายชื่อผู้แจ้ง');
            $('#joborder_phonebook_Modal-detail').html(data);
            var  request_by_text = $('#request_by_text').val();
        //  phonebookdataTable.search( request_by_text).draw();
         var phonebookdataTable =   $('#phonebookdataTable').DataTable({
        "order": [[ 0, "desc" ]],
        "pageLength": 10,
        "processing": true,
        "destroy": true,
        "serverSide": true,
        "stateSave": true,
        "ajax": {
            "url" : "{{url('phonebook_getdata') }}",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}" },
            "dataSrc":function(json) {
                console.log(json)
                try{
                            var return_data = new Array();                                   
                          for(var i=0;i< json.data.length; i++){ 
                            var actions = '<a id="btnadd_request"' +
                             'data-name="'+json.data[i]["name"]+'" ' +
                             'data-tel="'+json.data[i]["phone_number"]+'"' +
                             'data-division_name="'+json.data[i]["division_name"]+'"' +
                             'data-department_name="'+json.data[i]["department_name"]+'"' +
                            'href="#"  class="btn btn-sm btn-outline-success btnadd_request"><span class="fas fa-edit fa-fw"></span>เลือก</a>' 
                          return_data.push({ 
                              'com_name'  : json.data[i]["com_name"],
                              'name'  : json.data[i]["name"],
                              'employee_code'  : json.data[i]["employee_code"],
                              'division_id'  : json.data[i]["division_id"],
                              'division_name'  : json.data[i]["division_name"],
                              'department_name'  : json.data[i]["department_name"],
                              'section_name'  : json.data[i]["section_name"],
                              'usage_status'  : json.data[i]["usage_status"],
                              'phone_number'  : json.data[i]["phone_number"],
                              'actions'  : actions,
                          })
                      }
                    console.log(return_data);
                    return return_data;
                } catch(err) {
                        console.log(err.message)
                        console.log('error')
                    }
              }
          },
        "columns":[
                { "data": "com_name" },
                { "data": "name" },
                { "data": "division_name" },
                { "data": "department_name" },
                { "data": "section_name" },
                { "data": "phone_number" },
                { "data": "actions" }

            ],
        'columnDefs': [
                {
                  "targets": [0,1,2,3,4,5],
                  "className": "text-center",
                },
                { "orderable": false, "targets": 6 },
            ],   
         })
         .search(request_by_text).draw();
        }
      });  

});

$(document).ajaxError(function(event, jqxhr, settings, exception){
          console.log(event, jqxhr, settings, exception)
        if ( jqxhr.status== "500" ) {
            alert("พบปัญหา ไม่สามารถเชื่อมต่อข้อมูลได้ กรุณาระบุข้อมูลแบบ Manual");
        }
 });

$('#phonebookdataTable tbody').on( 'click', '.btnadd_request', function () {
        event.preventDefault();
        var name = $(this).data('name');
        var tel = $(this).data('tel');
        var division_name = $(this).data('division_name');
        var department_name = $(this).data('department_name');
        $('#request_by_text').val(name);
        $('#request_tel').val(tel);
        $('#request_dep').val(division_name);
        $('#request_sub_dep').val(department_name);
        $('#joborder_phonebook_Modal').modal('hide'); 
        // alert(name)
});

$('#search_assign_as_btn').click(function () {
    event.preventDefault(); 
    let branch_id = $('#branch').val();
    $.ajax({
        type: "POST",
        url: "{{url('joborder_getassign_as') }}",
        data: { _token: "{{csrf_token()}}", branch_id : branch_id}, // serializes the form's elements.
        success: function(data)
        {
            console.log(data)
            response_modal(data)
        }
      });  
});

$('#search_assignee_btn').click(function () {
    event.preventDefault(); 
    let branch_id = $('#branch').val();
    $.ajax({
        type: "POST",
        url: "{{url('joborder_getassignee') }}",
        data: { _token: "{{csrf_token()}}", branch_id : branch_id}, // serializes the form's elements.
        success: function(data)
        {
            
            console.log(data)
            response_modal(data)
        }
      });  
});

$('#add_material_btn').click(function () {
    event.preventDefault(); 
    let branch_id = $('#branch').val();
    console.log("branch "+ branch_id)
    if(branch_id == null || branch_id == ""){
        alert("กรุณาระบุบริษัท")
        return;
    }
    $.ajax({
        type: "POST",
        url: "{{url('joborder_getmaterial') }}",
        data: { _token: "{{csrf_token()}}" , branch_id : branch_id}, // serializes the form's elements.
        success: function(data)
        {
            console.log(data)
            response_modal(data)
        }
        
      });  
    });

$('#add_asset_btn').click(function () {
    event.preventDefault(); 
    let branch_id = $('#branch').val();
    $.ajax({
        type: "POST",
        url: "{{url('joborder_getasset') }}",
        data: { _token: "{{csrf_token()}}" , branch_id : branch_id}, // serializes the form's elements.
        success: function(data)
        {
            
            console.log(data)
            response_modal(data)
        }
        
      });  
    });
});
    //  ------  when ajax return area  --------
function response_modal(data){
    $('#joborder_component_Modal').modal('show'); 
    $('#joborder_component_Modal-title').html(data.title);
    $('#joborder_component_Modal-detail').html(data.table);
          document.getElementById("modalCreateFrm").name = data.frmAction;
          let frmAction = data.frmAction;
          let table = $('#component_datatable_modal').DataTable({});
                $('#component_datatable_modal tbody').on( 'click', '.btnmodal_add', function () {
                    let data_value =this.getAttribute('data-value');
                    let data_id =this.getAttribute('data-id');
                    let RowIndex = $(this).closest('tr')
                    let dataRow = table.row(RowIndex).data()
                    console.log(dataRow)
                    modal_embed_data(frmAction, data_value, data_id, dataRow);
                });
}

    //  ------   manage form action  area  --------
    function modal_embed_data(frmAction, data_value, data_id, dataRow) {
    event.preventDefault(); 
    console.log(frmAction)
    switch(frmAction) {
        
        case "formLocation":
                $('#location_name').val(data_value); 
            break;
        case "formRequest_by":
                $('#request_by').val(data_id); 
                $('#request_by_text').val(data_value); 
            break;
        case "formAssign_as":
                $('#assign_as').val(data_id); 
                $('#assign_as_text').val(data_value); 

            break;
        case "formAssignee":
                $('#assignee').val(data_id); 
                $('#assignee_text').val(data_value); 
            break;
        case "formMaterial":
                // $('#material_name').val(data_value); 
                let _id =  data_id
                let material_no = dataRow[1]
                let material_group = dataRow[2]
                let material_type = dataRow[3]
                let material_name = dataRow[4]
                let qty_balance = dataRow[5]
                if (qty_balance == ''){qty_balance=0}
                var chk_flag = ""
                var chk_msg = ""
               $('#MaterialdataTable > tbody  > tr').each(function(index, tr) { 
                     var chk_m_id = ($(this).find(".m_id").val());
                     var chk_m_flag = ($(this).find(".m_flag").val());
                     var chk_m_no = ($(this).find(".m_no").val());
                     if(chk_m_id == _id &&  chk_m_flag == "waitout" ){
                        chk_flag =  "duplicate";
                        chk_msg = chk_msg + "รหัส Material " + chk_m_no
                     }
                     console.log(chk_m_id + chk_m_flag )
                });
                if(chk_flag == "duplicate"){
                    alert("พบรายการวัสดุอุปกรณ์ซ้ำ.. ! สถานะรอยืนยันเบิก \r\n"  + chk_msg);
                    return;
                }
                    MaterialDataTable.row.add([
                       material_no + '<input type="hidden" class="m_no" name="m_no[]" value="'+material_no+'"/>' ,
                        '<input type="hidden" name="_id[]" value=""/>'+material_group + '<input type="hidden" class="m_id" name="m_id[]" value="'+_id+'"/>' + '<input type="hidden" name="stock_transaction" value="out"/>',
                        material_type,
                        material_name,
                        '<label class="bg-danger text-white">&nbsp;รอยืนยันเบิก&nbsp;</label>',
                        '<input type="number" class="qty_out form-control form-control-sm border border-success " name="qty_out[]" value="0" min="1" max="'+qty_balance+'" step="1" style="text-align:right;" required/>',
                        '<input type="number" class="qty_in form-control form-control-sm border border-success " name="qty_in[]" value="0" min="0" readonly max="'+qty_balance+'" step="1" style="text-align:right;" required/>',
                        qty_balance + '<input type="hidden" name="stock_balance_as[]" value="'+qty_balance+'"/>',
                        '<input type="text" class="reason form-control form-control-sm border border-success " name="reason[]" value=""/>'+
                        '<input type="hidden" class="m_flag" name="m_flag[]" value="waitout"/>',
                        '<button class="btn btn-outline-danger btn-sm tempbtndelete"><span class="fas fa-trash fa-fw"></span></button>',
                    ]).draw(false)
            break;

        case "formAsset":
            let asset_id = dataRow[0]
            let asset_owner = dataRow[1]
            let asset_status = dataRow[2]
            let asset_no = dataRow[3]
            let asset_m_no = dataRow[4]
            let serial_no = dataRow[5]
            AssetDataTable.row.add([
                  asset_no,
                  asset_m_no,
                  asset_status,
                  serial_no,
                  '<button  href="#" class="btn btn-outline-danger btn-sm tempbtndelete"><span class="fas fa-trash fa-fw"></span></button>',
              ]).draw(false)
            break;
        // case y:
        //     // code block
        //     break;
    }
    // $('#joborder_component_Modal').modal('hide');
}
//---------- Delete Event ---------
$('#MaterialdataTable tbody').on( 'click', '.tempbtndelete', function (event) {
    event.preventDefault();
      var result = confirm("Want to delete?");   if (result) {
      var _id = $(this).data('id');
      console.log(_id);
      var RowIndex = $(this).closest('tr');
        MaterialDataTable
      .row( $(this).parents('tr') )
      .remove()
      .draw();
      $.ajax({
        type: "POST",
        url: "{{url('joborder')}}" + '/' + _id + '/delete',
        data: { _token: "{{csrf_token()}}"}, // serializes the form's elements.
        success: function(data)
        {
             console.log(data)
        }
      });  
      }
});

$('#AssetdataTable tbody').on( 'click', '.tempbtndelete', function (event) {
    event.preventDefault();
      var result = confirm("Want to delete?");   if (result) {
      var _id = $(this).data('id');
      console.log(_id);
      var RowIndex = $(this).closest('tr');
      AssetDataTable
      .row( $(this).parents('tr') )
      .remove()
      .draw();
      $.ajax({
        type: "POST",
        url: "{{url('joborder')}}" + '/' + _id + '/delete',
        data: { _token: "{{csrf_token()}}"}, // serializes the form's elements.
        success: function(data)
        {
             console.log(data)
        }
      });  
      }
});


$('#btn-sendtoapproved').click(function () {
            $('#joborder_sendtoapproved_Modal').modal('show'); 
            $('#joborder_sendtoapproved_Modal-title').html('ยืนยันการส่งอนุมัติซ่อมบำรุง');
            // $('#joborder_sendtoapproved_Modal-detail').html(data);
});
</script>