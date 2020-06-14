  <div class="modal fade" id="materialModal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title">เพิ่มข้อมูลประเภทวัสดุอุปกรณ์</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
<form method="POST" id="modalCreateFrm">
<input type="hidden" name="_method" id="_method">
    <input type="hidden" name="id" id="id">
        <div class="modal-body">
            <div class="col-md-12">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('หน่วยงาน') }}</label><label class="text-danger">*</label>
                            <div class="col-md-7">
                            <select name="branch_id" id="branch_id" required class="form-control">
                                <option value="">Select</option>
                                    @foreach($data4 as $row)
                                        <option value="{{$row->id}}"> {{$row->short_name}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                    
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('ประเภทวัสดุอุปกรณ์') }}</label><label class="text-danger">*</label>
                            <div class="col-md-7">
                            <select name="m_g_id" id="m_g_id" required class="form-control">
                                <option value="">Select</option>
                                    @foreach($data2 as $row)
                                        <option value="{{$row['id']}}" data-code="{{$row['material_code']}}">{{$row['material_code']}} - {{$row['name']}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('ชนิดวัสดุอุปกรณ์') }}</label><label class="text-danger">*</label>
                                <div class="col-md-7">
                                    <select name="m_t_id" id="m_t_id" required class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('เลขที่วัสดุอุปกรณ์') }}</label>
                                <div class="col-md-7">
                                    <input id="m_no" type="text" class="form-control" name="m_no" required pattern="[A-Za-z0-9]{1,20}"  minlength="6" maxlength="6" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('ชื่อวัสดุอุปกรณ์') }}</label><label class="text-danger">*</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" pattern="[ก-๛A-Za-z0-9\s/,.]+{1,99}" title="กรุณากรอกชื่อภาษาไทย ภาษาอังกฤษ หรือตัวเลขเท่านั้น" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('คำอธิบาย') }}</label>
                            <div class="col-md-9">
                                <input id="desc" type="text" class="form-control" name="desc">
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('หน่วยนับ') }}</label><label class="text-danger">*</label>
                                <div class="col-md-6">
                                <select name="unit_id" id="unit_id" required class="form-control">
                                    <option value="">Select</option>
                                        @foreach($data3 as $row)
                                            <option value="{{$row['id']}}"> {{$row['name_th']}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Min') }}</label><label class="text-danger">*</label>
                            <div class="col-md-6">
                                <input id="min" type="number" class="form-control" name="min" min="1" step="1" required>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('สถานะ') }}</label>
                                <div class="col-md-6">
                                    <div class="material-switch mt-2 ml-1">
                                        <input id="status" name="status" type="checkbox" value="1" checked/>
                                        <label for="status" class="label-success"></label>
                                    </div>
                                </div>
                            </div>
                            </div>

                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Max') }}</label><label class="text-danger">*</label>
                            <div class="col-md-6">
                                <input id="max" type="number" class="form-control" name="max" min="1" step="1" required>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>  
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success" id="btnsave">
                                    {{ __('บันทึก') }}
          </button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <script>
        // var m_no = document.getElementById('m_no');
        // var material_mask =  IMask(
        //     m_no, {
        //     mask:   'a-aa-000'});
          $('#m_g_id').change(function () {
                 m_no.value = "";
                $("#m_t_id").empty();
                $("#m_t_id").append('<option value="" data-code="00">Select</option>');
                var _id = $(this).val();
                var m_g_code =$(this).find(':selected').data('code')
                var m_t_code =$('#m_t_id').find(':selected').data('code')
                // material_mask.destroy();
                // imask(m_g_code,m_t_code);
                if(_id){
                    $.ajax({
                                type:"get",
                                url:"{{url('/get_material_type')}}/"+_id,
                                success:function(res)
                                {       
                                    console.log(res)
                                        if(res)
                                        {
                                            $("#m_t_id").empty();
                                            $("#m_t_id").append('<option value="" data-code="00">Select</option>');
                                            $.each(res,function(key,value){
                                                $("#m_t_id").append('<option value="'+value["id"]+'" data-code="'+value["code"]+'">'+ value["code"]  + ' - '+value["name"]+'</option>');
                                            });
                                        }
                                }
                    });
                }
         });

         $('#m_t_id').change(function () {
            // material_mask.destroy();
            var m_g_code =$('#m_g_id').find(':selected').data('code')
            var m_t_code =$(this).find(':selected').data('code')
            // imask(m_g_code , m_t_code);
        });

function imask(m_g_code,m_t_code){
      material_mask =  IMask(
        m_no, {
            mask: m_g_code +'-' + m_t_code +  '-000',
     });
}

function m_gSelected(_id){
            if(_id){
                            $.ajax({
                                type:"get",
                                url:"{{url('/get_mg_from_material')}}/"+_id,
                                success:function(res)
                                {       
                                    console.log(res)
                                        if(res)
                                        {
                                            // material_mask.destroy();
                                            var m_g_code = ""
                                            var m_t_code = ""
                                            $("#m_t_id").empty();
                                            $("#m_t_id").append('<option value="" data-code="00">Select</option>');
                                            $.each(res,function(key,value){
                                                $("#m_t_id").append('<option value="'+value["id"]+'" data-code="'+value["code"]+'">'+ value["code"]  + ' - '+value["name"]+'</option>');
                                                $('#m_g_id').val(value["m_g_id"]);
                                                m_g_code = value["material_code"];
                                                m_t_code = value["code"];
                                            });
                                            $('#m_t_id').val(_id);
                                           
                                            // imask(m_g_code,m_t_code);
                                            console.log(_id)
                                        }
                                }
                            });
                    }
        };

  </script>