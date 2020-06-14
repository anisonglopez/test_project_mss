<script>
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
            var  approved_by_text = $('#approved_by_text').val();
        //  phonebookdataTable.search( request_by_text).draw();
         var phonebookdataTable = $('#phonebookdataTable').DataTable({
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
                  "targets": [0,1,2,3,4,5,6],
                  "className": "text-center",
                },
                { "orderable": false, "targets": 6 },
            ],   
         })
         .search(approved_by_text).draw();
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
        $('#approved_by_text').val(name);
        $('#request_tel').val(tel);
        $('#approved_dep').val(division_name);
        $('#request_sub_dep').val(department_name);
        $('#joborder_phonebook_Modal').modal('hide'); 
        // alert(name)
});

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
function modal_embed_data(frmAction, data_value, data_id, dataRow) {
    event.preventDefault(); 
    console.log(frmAction)
    switch(frmAction) {
        
        case "formApproved_by":
                $('#approved_by').val(data_id); 
                $('#approved_by_text').val(data_value); 
            break;
        
    }
    $('#joborder_component_Modal').modal('hide');
}
});

</script>