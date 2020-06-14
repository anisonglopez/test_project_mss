<!DOCTYPE html>
<html>
<head>
    <title>Unauthorized action - 403</title>
      <!-- Custom styles for this template-->
  <link href="{{asset('build/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<style>
    .center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}
body{
    background-color: #333637;
}

</style>
<body>
    <div class="center-screen animated--grow-in">
        <label for="" style="font-size:70pt;" class=" text-white">ERROR 403 Unauthorized</label>
  <h1>Unauthorized action. </h1>
<p>คุณไม่ได้รับสิทธิ์ในการเข้าถึงข้อมูล</p>
 <a href="{{url('/')}}" class="btn btn-outline-danger">กลับไปยังหน้าหลัก</a>
    </div>
</body>
</html>