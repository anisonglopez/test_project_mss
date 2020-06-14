<script>
            let MaterialDataTable = $('#MaterialdataTable').DataTable({
                    "paging":false,
                    //  destroy:true,
                    "columnDefs": [
                        // { "width": "15%", "targets": 0 },
                        // { "width": "50%", "targets": 1 },
                        // { "width": "15%", "targets": 2 },
                        // { "width": "15%", "targets": 3 },
                        {
                      "targets": [0,1,3],
                      "className": "text-center",
                    },
                    ],
                });
            let AssetDataTable = $('#AssetdataTable').DataTable({
                    "paging":false,
                    //  destroy:true,
                    "columnDefs": [
                        { "width": "15%", "targets": 0 },
                        { "width": "15%", "targets": 1 },
                        { "width": "15%", "targets": 2 },
                        { "width": "15%", "targets": 3 },
                        { "width": "15%", "targets": 4 },
                        { "width": "15%", "targets": 5 },
                        { "width": "15%", "targets": 6 },
                        {
                        "targets": [0,1,2,3,5,6],
                        "className": "text-center",
                    },
                    ],
                });
    //  ------  btn onclick area  --------
$(document).ready(function(){
  $(document).ajaxError(function(){
    alert("กรุณาเลือกหน่วยงานก่อนดำเนินการต่อ");
  });    
$('#add_material_btn').click(function () {
    event.preventDefault(); 
    let branch_id = $('#branch').val();
    $.ajax({
        type: "POST",
        url: "{{url('receive_getmaterial') }}",
        data: { _token: "{{csrf_token()}}", branch_id : branch_id}, // serializes the form's elements.
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
        url: "{{url('receive_getasset') }}",
        data: { _token: "{{csrf_token()}}", branch_id : branch_id}, // serializes the form's elements.
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
    $('#material_component_Modal').modal('show'); 
    $('#material_component_Modal-title').html(data.title);
    $('#material_component_Modal-detail').html(data.table);
          document.getElementById("modalCreateFrm").name = data.frmAction;
            let frmAction = data.frmAction;
            let table = $('#component_datatable_modal').DataTable({});
                $('#component_datatable_modal tbody').on( 'click', '.btnmodal_add', function () {
                    let data_value =this.getAttribute('data-value');
                    let data_id =this.getAttribute('data-id');
                    let RowIndex = $(this).closest('tr')
                    let dataRow = table.row(RowIndex).data()
                    console.log(dataRow)
                    modal_embed_data(frmAction,data_id, data_value, dataRow);
                });
}
    //  ------   manage form action  area  --------
    function modal_embed_data(frmAction,data_id, data_value ,dataRow) {
    event.preventDefault(); 
    console.log(frmAction)
    switch(frmAction) {
        case "formMaterial":
                // $('#material_name').val(data_value); 
                let _id =  data_id
                let material_no = dataRow[1]
                let material_group = dataRow[2]
                let material_name = dataRow[3]
                let material_type = dataRow[4]
                let qty_balance = dataRow[5]
                 if (qty_balance == ''){qty_balance=0}
                var chk_flag = ""
                var chk_msg = ""
               $('#MaterialdataTable > tbody  > tr').each(function(index, tr) { 
                     var chk_m_id = ($(this).find(".m_id").val());
                     
                     var chk_m_no = ($(this).find(".m_no").val());
                     if(chk_m_id == _id){
                        chk_flag =  "duplicate";
                        chk_msg = chk_msg + "รหัส Material " + chk_m_no
                     }
                     console.log(chk_m_id)
                });
                if(chk_flag == "duplicate"){
                    alert("พบรายการวัสดุอุปกรณ์ซ้ำ.. !\r\n"  + chk_msg);
                    return;
                }
                    MaterialDataTable.row.add([
                        material_no + '<input type="hidden" class="m_no" name="m_no[]" value="'+material_no+'"/>' ,
                        '<input type="hidden" name="_id[]" value=""/>'+material_group + '<input type="hidden" class="m_id" name="m_id[]" value="'+_id+'"/>' + '<input type="hidden" name="stock_transaction" value="in"/>',
                        material_name,
                        material_type,
                        '<input type="number" class="qty_in form-control form-control-sm border border-success" name="qty_in[]" value="0" min="0" step="1" style="text-align:right;"/>',
                        qty_balance + '<input type="hidden" name="qty_balance_as[]" value="'+qty_balance+'"/>',
                        '<input type="text" class="remark form-control form-control-sm border border-success" name="remark[]" value="" style="text-align:right;"/>',
                        '<button  href="#" class="btn btn-outline-danger btn-sm tempbtndelete"><span class="fas fa-trash fa-fw"></span></button>',
                    ]).draw(false)
                
        break;
        case "formAsset":
            let asset_id = dataRow[0]
            let asset_owner = dataRow[1]
            let asset_status = dataRow[2]
            let asset_no = dataRow[3]
            let asset_m_no = dataRow[4]
            let serial_no = dataRow[5]
            let qty_balances = dataRow[6]
            AssetDataTable.row.add([
                  // '<input type="hidden" name="asset_id[]" value=""/>'+asset_owner + '<input type="hidden" class="a_id" name="a_id[]" value="'+asset_id+'"/>' + '<input type="hidden" name="asset_transaction" value="in"/>',
                  asset_id,
                  asset_owner,
                  asset_status,
                  asset_no,
                  asset_m_no,
                  serial_no,
                  qty_balances + '<input type="hidden" name="qty_balance_as[]" value="0"/>',
                  '<button  href="#" class="btn btn-outline-danger btn-sm tempbtndelete"><span class="fas fa-trash fa-fw"></span></button>',
              ]).draw(false)
          console.log("hello")
            break;
    //  case y:
    //      code block
    //  break;
    }
    $('#joborder_component_Modal').modal('hide');
}

//---------- Delete Event ---------
  $('#MaterialdataTable tbody').on( 'click', '.tempbtndelete', function (event) {
    event.preventDefault();
      var result = confirm("ยืนยันการลบข้อมูล");   if (result) {
      var _id = $(this).data('id');
      console.log(_id);
      var RowIndex = $(this).closest('tr');
        MaterialDataTable
      .row( $(this).parents('tr') )
      .remove()
      .draw();
      $.ajax({
        type: "POST",
        url: "{{url('receive')}}" + '/' + _id + '/delete',
        data: { _token: "{{csrf_token()}}"}, // serializes the form's elements.
        success: function(data)
        {
             console.log(data)
        }
      });  
      }
});
</script>