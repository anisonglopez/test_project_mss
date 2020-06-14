@extends('layout.template')

@section('content')
@include('components.alertbox')
    
       <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 font-weight-bold text-primary">
        <h3>ประเภทสถานะงาน</h3>
      </div>
      <div class="col-md-6 text-right">
        @if (in_array( 'jobstatus.create', $Permissions))
            <a href="#"  class="btn btn-facebook" id="create">สร้าง</a>
        @endif
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
    <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-sm " id="dataTable">
                <thead class="text-center bg-primary text-white small">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
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

@section('js')
<script>
$(document).ready(function() {
         $('#dataTable').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url" : "{{url('jobstatus_getdata') }}",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"},
                "dataSrc":function(json) {
                    console.log(json)
                    try{
                        var return_data = new Array();           
                          var EditPermission = ' d-none '
                          var DeletePermission = ' d-none '
                          @if (in_array( 'jobstatus.edit', $Permissions))
                          EditPermission = 'd-inline';
                          @endif
                          @if (in_array( 'jobstatus.delete', $Permissions))
                          DeletePermission = 'd-inline';
                          @endif
                          for(var i=0;i< json.data.length; i++){       
                          var actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#"  class="btn btn-sm btn-outline-warning btnedit '+EditPermission+'"><span class="fas fa-edit fa-fw"></a>' +
                          '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete '+DeletePermission+'"><span class="fas fa-trash fa-fw"></a>';
                             
                              return_data.push({
                                  'name'  : json.data[i]["name"],
                                  'desc'   : json.data[i]["desc"],
                                  'code'   : json.data[i]["code"],
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
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "desc" },
                    { "data": "actions" },      
                ],
            'columnDefs': [
                    {
                      "targets": [0,1,3],
                      "className": "text-center",
                    },
                    { "orderable": false, "targets": 3 },
                ],
                
         });
        });
    $('#create').click(function () {
      document.getElementById('modal-title').innerHTML = 'สร้างข้อมูลประเภทสถานะงาน';
      $('#_method').val("");
        $('#modalCreateFrm').trigger("reset");
        $('#JobstatusModal').modal('show');
        document.getElementById("modalCreateFrm").action = "{{url('jobstatus')}}";
        $("#code").prop('disabled', false);
    });

     $('#dataTable tbody').on( 'click', '.btnedit', function () {
      event.preventDefault();
      var _id = $(this).data('id');
      $.get('jobstatus/' + _id + '/edit', function (data) {
        console.log(data)
        document.getElementById('modal-title').innerHTML = 'แก้ไขข้อมูลประเภทสถานะงาน';
        $('#JobstatusModal').modal('show');
          $('#name').val(data.name);
          $('#desc').val(data.desc);
          $('#code').val(data.code).prop('disabled', true);
          document.getElementById("modalCreateFrm").action = "{{url('jobstatus')}}" + '/' + _id
          $('#_method').val("PATCH");
      })
     });

$('#dataTable tbody').on( 'click', '.btndelete', function () {
        event.preventDefault();
        var _id = $(this).data('id');
        $('#deleteModal').modal('show');
        document.getElementById("daleteFrm").action = "{{url('jobstatus')}}" + '/' + _id
});
</script>
@endsection
@section('modal')
@include('modals.jobstatus.jobstatusmodal')
@include('modals.component.delete')
@endsection