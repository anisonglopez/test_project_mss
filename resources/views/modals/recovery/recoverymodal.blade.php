  <!-- Logout Modal-->
  <div class="modal fade" id="RecoveryModal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title"></h5>
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
                        <div class="col-md-12 text-center">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success" id="btnsave">
                                        {{ __('กู้คืนข้อมูล') }}
                                  </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                                </div>
                              
              
                            </div>
                        </div> 
                </div>
        </div>
        <div class="modal-footer">
       
        </div>
      </div>
      </form>
    </div>
  </div>
</div>