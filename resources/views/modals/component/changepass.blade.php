
    <!-- UserProfile Modal-->
    <div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="modal-title-changepass" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title-changepass">เปลี่ยนรหัสผ่าน</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="javascript:void(0)"  id="changepassword" class="changepassword" onsubmit="return validateChangePass()">
          @csrf
             <div class="modal-body">           
                  <div class="form-group row">
                      <label for="password" class="col-sm-4 col-form-label">รหัสผ่านเดิม : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" name="current-password" id="current-password" class="form-control"    required minlength="6" maxlength="10" placeholder="Current Password">
                    </div>
                    </div>

                <div class="form-group row">
                      <label for="password" class="col-sm-4 col-form-label">รหัสผ่านใหม่ : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" name="new-password" id="new-password" class="form-control"    required minlength="6" maxlength="10" placeholder="New Password">
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="password" class="col-sm-4 col-form-label">ยืนยันรหัสผ่านอีกครั้ง : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" name="renew-password" id="renew-password" class="form-control"    required  minlength="6" maxlength="10" placeholder="Confirm Password">
                        <label for="infomation_pass" id="infomation_pass" class="text-danger"></label>
                      </div>
                    </div>
                   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success" >ยืนยัน</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function validateChangePass(){
      var current_password = $('#current-password').val();
      var new_password = $('#new-password').val();
      var renew_password = $('#renew-password').val();
      if (new_password != renew_password){
        $('#infomation_pass').html("รหัสผ่านไม่ตรงกัน");
        return false;
      }
      console.log(current_password)
      event.preventDefault(); 
      $.ajax({
        type: "POST",
        url: "{{url('changepassword') }}",
        data: { _token: "{{csrf_token()}}",new_password:new_password,current_password:current_password,id:{{ Auth::user()->id}}}, // serializes the form's elements.
        success: function(data)
        {
          console.log(data)
            if (data == 'False_1'){
              $('#infomation_pass').html('รหัสผ่านเดิมไม่ถูกต้อง');
            }else if (data == 'False_2'){
              $('#infomation_pass').html('Error ! ระบบทำงานผิดพลาด');
            }else if (data == 'Ture'){
              $('#infomation_pass').html('เปลี่ยนรหัสผ่านสำเร็จ');
              $('#btn_logout').click()
            }
            
        }
      });  
    }

  </script>