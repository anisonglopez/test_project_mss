@extends('layout.template')
@section('content')
@include('components.alertbox')
    
       <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 font-weight-bold text-primary">
        <h3>หน่วยนับ</h3>
      </div>
      <div class="col-md-6 text-right">
        @if (in_array( 'unit.create', $Permissions))
            <a href="#"  class="btn btn-facebook" id="create">สร้าง</a>
        @endif
      </div>
    </div>        
  </div>

<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
    <div class="table-responsive">
        {{-- {{Auth::user()->isAdmin()}} --}}
        {{-- @if($user->status =='waiting') @endif --}}
            <table class="table table-bordered table-striped table-hover table-sm " id="dataTable">
                <thead class="text-center bg-primary text-white small">
                    <tr>
                            <th>หน่วยนับภาษาไทย</th>
                            <th>หน่วยนับภาษาอังกฤษ</th>
                            <th>#</th>
                    </tr>
                 </thead>
                 <tbody class="small">
                 {{-- @foreach($data as $row)
                 <tr>              
                            <td class="text-center">{{$row['name_th']}}</td>
                            <td class="text-center">{{$row['name_en']}}</td>
                            <td class="text-center">
                                <a id="btn_edit" data-id="{{$row['id']}}" href="#" class="btn btn-sm btn-outline-warning btnedit"><span class="fas fa-edit fa-fw"></a>
                                <a id="btn_delete" data-id="{{$row['id']}}" href="#" class="btn btn-outline-danger btn-sm btndelete"><span class="fas fa-trash fa-fw"></a>
                            </td>
                    </tr>
                    @endforeach --}}
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
          "url" : "{{url('unit_getdata') }}",
          "type": "POST",
          "data":{ _token: "{{csrf_token()}}"},
          "dataSrc":function(json) {
              console.log(json)
              try{
                  var return_data = new Array();             
                          var EditPermission = ' d-none '
                          var DeletePermission = ' d-none '
                          @if (in_array( 'unit.edit', $Permissions))
                          EditPermission = 'd-inline';
                          @endif
                          @if (in_array( 'unit.delete', $Permissions))
                          DeletePermission = 'd-inline';
                          @endif
                          for(var i=0;i< json.data.length; i++){       
                          var actions = '<a id="btn_edit" data-id="'+json.data[i]["id"]+'" href="#"  class="btn btn-sm btn-outline-warning btnedit '+EditPermission+'"><span class="fas fa-edit fa-fw"></a>' +
                          '<a id="btn_delete" data-id="'+json.data[i]["id"]+'" href="#" class="btn btn-outline-danger btn-sm btndelete '+DeletePermission+'"><span class="fas fa-trash fa-fw"></a>';
                        return_data.push({
                            'name_th'  : json.data[i]["name_th"],
                            'name_en'  : json.data[i]["name_en"],
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
              { "data": "name_th" },
              { "data": "name_en" },
              { "data": "actions" },      
          ],
      'columnDefs': [
              {
                "targets": [0,1,2],
                "className": "text-center",
              },
              { "orderable": false, "targets": 2 },
          ],
                
         });
        });

    $('#create').click(function () {
      document.getElementById('modal-title').innerHTML = 'หน่วยนับ';
      $('#_method').val("");
        $('#modalCreateFrm').trigger("reset");
        $('#UnitModal').modal('show');
        document.getElementById("modalCreateFrm").action = "{{url('unit')}}";

    });

     $('#dataTable tbody').on( 'click', '.btnedit', function () {
      event.preventDefault();
      var _id = $(this).data('id');
      $.get('unit/' + _id +'/edit', function (data) {
        console.log(data)
        document.getElementById('modal-title').innerHTML = 'แก้ไขหน่วยนับ';
        $('#UnitModal').modal('show');
          $('#name_th').val(data.name_th);
          $('#name_en').val(data.name_en);
          document.getElementById("modalCreateFrm").action = "{{url('unit')}}" + '/' + _id
          $('#_method').val("PATCH");
      })
  });

$('#dataTable tbody').on( 'click', '.btndelete', function () {
        event.preventDefault();
        var _id = $(this).data('id');
        $('#deleteModal').modal('show');
        document.getElementById("daleteFrm").action = "{{url('unit')}}" + '/' + _id
});
</script>
@endsection

@section('modal')
@include('modals.unit.unitmodals')
@include('modals.component.delete')
@endsection