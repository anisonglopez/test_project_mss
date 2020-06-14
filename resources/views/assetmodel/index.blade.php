@extends('layout.template')

@section('content')
@include('components.alertbox')

       <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 font-weight-bold text-primary">
        <h3>ประเภททรัพย์สิน</h3>
      </div>
      <div class="col-md-6 text-right">
            <a href="#"  class="btn btn-facebook" id="create">Create</a>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
    <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-sm " id="dataTable">
                <thead class="text-center bg-primary text-white ">
                    <tr>
                        <th>Branch</th>
                        <th>Asset Model No.</th>
                        <th>Asset Group Name</th>
                        <th>Name TH</th>
                        <th>Description</th>
                        <th>#</th>
                    </tr>
                 </thead>
                 <tbody>

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
                "url" : "{{url('assetmodel_getdata') }}",
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
                                  'as_name'  : json.data[i]["as_name"],
                                  'asset_m_no'   : json.data[i]["asset_m_no"],
                                  'desc'   : json.data[i]["desc"],
                                  'name_th'   : json.data[i]["name_th"],
                                  'name_en'   : json.data[i]["name_en"],
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
                    { "data": "asset_m_no" },
                    { "data": "as_name" },
                    { "data": "name_th" },
                    { "data": "desc" },
                    { "data": "actions" },      
                ],
            'columnDefs': [
                    {
                      "targets": [0,1,2,3,5],
                      "className": "text-center",
                    },
                    { "orderable": false, "targets": 5 },
                ],
                
         });
        });

    $('#create').click(function () {
      document.getElementById('modal-title').innerHTML = 'สร้างข้อมูลประเภททรัพย์สิน';
      $('#_method').val("");
        $('#modalCreateFrm').trigger("reset");
        $('#AssetmodelModal').modal('show');
        document.getElementById("modalCreateFrm").action = "{{url('assetmodel')}}";
    });

     $('#dataTable tbody').on( 'click', '.btnedit', function () {
      event.preventDefault();
      var _id = $(this).data('id');
      $.get('assetmodel/' + _id + '/edit', function (data) {
        console.log(data)
        document.getElementById('modal-title').innerHTML = 'แก้ไขข้อมูลประเภททรัพย์สิน';
        $('#AssetmodelModal').modal('show');
          $('#branch_id').val(data.branch_id);
          $('#asset_m_no').val(data.asset_m_no);
          $('#a_g_id').val(data.a_g_id);
          $('#name_th').val(data.name_th);
          $('#name_en').val(data.name_en);
          $('#desc').val(data.desc);
          document.getElementById("modalCreateFrm").action = "{{url('assetmodel')}}" + '/' + _id
          $('#_method').val("PATCH");
      })
     });

$('#dataTable tbody').on( 'click', '.btndelete', function () {
        event.preventDefault();
        var _id = $(this).data('id');
        $('#deleteModal').modal('show');
        document.getElementById("daleteFrm").action = "{{url('assetmodel')}}" + '/' + _id
});
</script>
@endsection
@section('modal')
@include('modals.assetmodel.assetmodelmodal')
@include('modals.component.delete')
@endsection