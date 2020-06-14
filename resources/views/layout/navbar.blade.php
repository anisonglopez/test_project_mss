
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column ">

      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar nav-bar-custom navbar-expand navbar-light skin-custom topbar mb-4 static-top shadow-sm">

          <!-- Sidebar Toggle (Topbar) -->
          {{-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 text-white">
            <i class="fa fa-bars"></i>
          </button> --}}
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  {{-- <button class="btn border-0 text-white" id="sidebarToggle">
  <i class="fa fa-bars"></i>
  </button> --}}
  <span class="mr-2 d-none d-lg-inline text-white text-uppercase"> 
    <img src="{{asset('build/img/logoch7hd.png')}}" class="img-profile" style="max-width: 50px;" />
  </span>
  {{-- <button class="btn border-0 text-white" id="viewless" >
  <i class="fa fa-bars"></i>
      </button> --}}
</div>
<!-- Topbar Search -->
<!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"> -->
 <b>MSS</b>
  <div class="d-none d-sm-inline-block form-inline   navbar-width-custom small">
    <nav class="navbar navbar-expand-lg ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      {{-- Service Desk System --}}
      @if (in_array( 'dashboard.view', $Permissions))
      <li class="nav-item {{ request()->routeIs('dashboard*') ? 'nav-active shadow-sm' : '' }}">
        <a class="nav-link zoom" href="{{url('/dashboard')}}">Dashboard</a>
      </li>
      @endif
      @if (in_array( 'joborder.view', $Permissions))
      <li class="nav-item {{ request()->routeIs('joborder*') ? 'nav-active shadow-sm' : '' }} {{ request()->is('jobordercreate') ? 'nav-active' : '' }}">
        <a class="nav-link zoom" href="{{url('/joborder')}}">งานซ่อมบำรุง</a>
      </li>
      @endif
      @if (in_array( 'ma_approved.view', $Permissions))
      <li class="nav-item {{ request()->routeIs('ma_approved*') ? 'nav-active shadow-sm' : '' }} {{ request()->is('ma_approvedcreate') ? 'nav-active' : '' }}">
        <a class="nav-link zoom" href="{{url('/ma_approved')}}">อนุมัติซ่อมบำรุง</a>
      </li>
      @endif
      @if (in_array( 'receive.view', $Permissions))
      <li class="nav-item  {{ request()->routeIs('receive*') ? 'nav-active shadow-sm' : '' }} {{ request()->is('receivecreate') ? 'nav-active' : '' }}">
        <a class="nav-link zoom" href="{{url('/receive')}}">รับของเข้าระบบ</a>
      </li>
      @endif
      @if (in_array( 'retirement.view', $Permissions))
      <li class="nav-item {{ request()->routeIs('retire*') ? 'nav-active shadow-sm' : '' }} {{ request()->is('retirecreate') ? 'nav-active' : '' }}">
        <a class="nav-link zoom" href="{{url('/retire')}}">จำหน่ายออก</a>
      </li>
      @endif
      @if (in_array( 'stock-management.view', $Permissions))
      <li class="nav-item {{ request()->routeIs('m_stock*') ? 'nav-active shadow-sm' : '' }}">
        <a class="nav-link zoom" href="{{url('/m_stock')}}">Stock</a>
      </li>
      @endif
      @if (in_array( 'report.view', $Permissions))
      <li class="nav-item {{ request()->routeIs('report*') ? 'nav-active shadow-sm' : '' }}  {{ request()->is('reportSearch') ? 'nav-active' : '' }}">
        <a class="nav-link zoom" href="{{url('/report')}}">รายงาน</a>
      </li>
      @endif
      @if (in_array( 'materialgroup.view', $Permissions) 
      || in_array( 'materialtype.view', $Permissions) 
      || in_array( 'material.view', $Permissions)
      || in_array( 'unit.view', $Permissions)
      || in_array( 'employee.view', $Permissions)
      || in_array( 'module.view', $Permissions)
      || in_array( 'jobtype.view', $Permissions)
      || in_array( 'jobstatus.view', $Permissions)
      || in_array( 'priority.view', $Permissions)
      )
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle zoom" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ข้อมูลตั้งต้นระบบ
        </a>
      <div class="dropdown-menu small shadow-lg" aria-labelledby="navbarDropdown">
        <h1 class="dropdown-header">ข้อมูลตั้งต้นระบบ</h1>
          @if (in_array( 'materialgroup.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/materialgroup')}}">ประเภทวัสดุ/อุปกรณ์</a>
          @endif
          @if (in_array( 'materialtype.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/materialtype')}}">ชนิดวัสดุ/อุปกรณ์</a>
          @endif
          @if (in_array( 'material.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/material')}}">ข้อมูลวัสดุอุปกรณ์</a>
          @endif
          @if (in_array( 'unit.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/unit')}}">หน่วยนับ</a>
          @endif
          {{-- @if (in_array( 'location.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/location')}}">สถานที่</a>
          @endif --}}
          @if (in_array( 'employee.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/employee')}}">พนักงาน</a>
          @endif
          {{-- @if (in_array( 'requester.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/requester')}}">ผู้แจ้ง</a>
          @endif --}}
          @if (in_array( 'jobtype.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/jobtype')}}">ประเภทงาน</a>
          @endif
          @if (in_array( 'jobstatus.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/jobstatus')}}">ประเภทสถานะงาน</a>
          @endif
          @if (in_array( 'priority.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/priority')}}">ลำดับความสำคัญ</a>
          @endif
          {{-- @if (in_array( 'report.view', $Permissions))
            <a class="dropdown-item " href="{{url('/assetgroup')}}">ประเภททรัพย์สิน</a>
          @endif
          @if (in_array( 'report.view', $Permissions))
            <a class="dropdown-item " href="{{url('/assetmodel')}}">รุ่นทรัพย์สิน</a>
          @endif
          @if (in_array( 'report.view', $Permissions))
            <a class="dropdown-item " href="{{url('/asset')}}">ทรัพย์สิน</a>
          @endif --}}
          
      </div>
      </li>
     @endif
  @if (in_array( 'company.view', $Permissions) 
      || in_array( 'branch.view', $Permissions) 
      || in_array( 'log.view', $Permissions)
      || in_array( 'businessunit.view', $Permissions)
      || in_array( 'department.view', $Permissions)
      || in_array( 'module.view', $Permissions)
      || in_array( 'menupermission.view', $Permissions)
      || in_array( 'intype.view', $Permissions)
      || in_array( 'outtype.view', $Permissions)
      )  {{-- end if --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ตั้งค่าระบบ
        </a>
        <div class="dropdown-menu small shadow-lg" aria-labelledby="navbarDropdown">
        <h6 class="dropdown-header">ตั้งค่าระบบ</h6>
          @if (in_array( 'company.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/company')}}">บริษัท</a>
          @endif
          @if (in_array( 'branch.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/branch')}}">หน่วยงาน</a>
          @endif
          @if (in_array( 'businessunit.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/businessunit')}}">ประเภทธุรกิจ</a>
          @endif
          @if (in_array( 'department.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/department')}}">ฝ่ายงาน</a>
          @endif
          @if (in_array( 'module.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/module')}}">โมดูล</a>
          @endif
          @if (in_array( 'menupermission.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/menu')}}">เมนู/สิทธิ์การใช้งาน</a>
          @endif
          @if (in_array( 'intype.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/intype')}}">ประเภทการรับเข้า</a>
          @endif
          @if (in_array( 'outtype.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/outtype')}}">ประเภทการจำหน่ายออก</a>
          @endif
          
          {{-- @if (in_array( 'checkinstatus.view', $Permissions))
            <a class="dropdown-item zoom" href="{{url('/checkinstatus')}}">สถานะรับเข้าอุปกรณ์</a>
          @endif --}}
          
          {{-- @if (in_array( 'docnumber.view', $Permissions))
            <a class="dropdown-item " href="{{url('/docnumber')}}">เลขเอกสาร</a>
          @endif --}}
      </div>
      </li>
 @endif
      @if (in_array( 'user.view', $Permissions) 
      || in_array( 'role.view', $Permissions) 
      || in_array( 'log.view', $Permissions)
      || in_array( 'recovery.view', $Permissions)
      )  {{-- end if --}}
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle zoom" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Authorization
        </a>
        <div class="dropdown-menu small shadow-lg" aria-labelledby="navbarDropdown">
          <h6 class="dropdown-header">Authorization</h6>
        @if (in_array( 'user.view', $Permissions))
          <a class="dropdown-item zoom" href="{{url('/user')}}"><span>ข้อมูลผู้ใช้งาน </span></a>
        @endif
        @if (in_array( 'role.view', $Permissions))
          <a class="dropdown-item zoom" href="{{url('/role')}}"><span>กลุ่มผู้ใช้งานระบบ </span></a>
        @endif
        @if (in_array( 'log.view', $Permissions))
          <a class="dropdown-item zoom" href="{{url('/log')}}"><span>ประวัติการใช้งานระบบ </span></a>
        @endif
        @if (in_array( 'recovery.view', $Permissions))
          <a class="dropdown-item zoom" href="{{url('/recovery')}}"><span>กู้คืนข้อมูล</span></a>
        @endif
        </div>
      </li>
       @endif
    </ul>
  </div>
  </nav>
  </div>
<!-- </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto ">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
          
              <label class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline" id="clock"></span>
              </label>
            </li>


            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle zoom" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><label id="min_material_count">0</label></span>
              </a>
              
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  แจ้งเตือน วัสดุอุปกรณ์มีจำนวนต่ำกว่าที่กำหนดไว้
                </h6>
                <div style="height:350px;width:100%; overflow:auto; mb-4">    
                <div id="materail_min_list"></div>
                <a class="dropdown-item text-center small text-gray-500" href="{{url('/dashboard2')}}">ดูรายการทั้งหมด</a>
                </div>
                {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">หลอดไฟ LED </span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    <span class="font-weight-bold">ประตู</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    <span class="font-weight-bold">กุญแจ</span>
                  </div>
                </a> --}}
              </div>
            </li>
     
            <!-- <div class="topbar-divider d-none d-sm-block"> </div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
           <!-- <p class="nav-link"><span class="mr-2 d-none d-lg-inline text-white text-uppercase"><?=date('d/m/Y')?></span></p>  -->
              <a class="nav-link dropdown-toggle zoom" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <!-- <span class="mr-2 d-none d-lg-inline text-white text-uppercase"><div id="clock" style="color: white;"></div></span> -->

                <span class="mr-2 d-none d-lg-inline text-white text-uppercase"></span>
                <img class="img-profile rounded-circle" src="{{asset('build/img/user-png.png')}}">
                 <span for=""> &nbsp;  {{ Auth::user()->email }} </span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item zoom" href="#" data-toggle="modal" data-target="#changepassModal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                   เปลี่ยนรหัสผ่าน
                  </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item zoom" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                 ออกจากระบบ
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        <script>
            $.ajax({
                       type:'GET',
                       url:'{{url('get_count_min_material') }}',
                       data:{ _token: "{{csrf_token()}}"},
                       success:function(data) {
                          $("#min_material_count").html(data);
                       }
                    });
                    $.ajax({
                       type:'POST',
                       url:'{{url('get_min_material_list') }}',
                       data:{ _token: "{{csrf_token()}}"},
                       success:function(data) {
                          $("#materail_min_list").html(data);
                       }
                    });
        </script>