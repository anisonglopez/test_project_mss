  <!-- Logout Modal-->
  <div class="modal fade" id="joborder_sendtoapproved_Modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="joborder_sendtoapproved_Modal-title">[modal_title]</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
<form method="POST" id="modalCreateFrm" name=""  action="{{url('joborder')}}/{{$data->id}}/sendtoapproved">
<input type="hidden" name="_method" id="_method">
    <input type="hidden" name="id" id="id">
        <div class="modal-body">
            <div class="col-md-12 text-center">
                        @csrf                 
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success" id="joborder_modal_btnsave">
                                                  {{ __('ยืนยัน ส่งอนุมัติซ่อมบำรุง') }}
                        </button>
                        <div id="joborder_sendtoapproved_Modal-detail"></div>
                        <div id="sendtoapproved_response-detail"></div>
          </div>
          <br>
        <div class="modal-footer">
         <br>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>