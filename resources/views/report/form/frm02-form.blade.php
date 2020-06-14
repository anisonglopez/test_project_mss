<style>
    @font-face{
     font-family:  'THSarabunNew';
     font-style: normal;
     font-weight: normal;
     src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
    }
    @font-face{
     font-family:  'THSarabunNew';
     font-style: normal;
     font-weight: bold;
     src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
    }
    @font-face{
     font-family:  'THSarabunNew';
     font-style: italic;
     font-weight: normal;
     src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
    }
    @font-face{
     font-family:  'THSarabunNew';
     font-style: italic;
     font-weight: bold;
     src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
    }
    body{
     font-family: "THSarabunNew";
     font-size: 18px;
    }
    @page {
          size: A4;
          padding: 12px;
          margin: 1.5cm 0.7cm 2cm 0.7cm;

        }
        p:last-child { page-break-after: never; }
        { margin: 100px 25px; }
        @media print {
          html, body {
            width: 210mm;
            height: 297mm;
            /*font-size : 16px;*/
          }
        }
        .table-border   td {
          border: 0.6px solid black ;
          border-color: #f1f1f1;
        }
        .table-border   th {
          border: 1px solid black;
        }
  .table-border { border-collapse: collapse; border: 1px solid black; }
  .page-break {
    page-break-after: always;
}
hr.new1 {
  border-top: 1px dashed red;
}
.pagenum:before {
        content: counter(page);
    }

    header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -50px; left: 0px; right: 0px;  height: 50px; }
    </style>
    <head>
    <title>ใบอนุมัติซ่อมบำรุง - {{$data->job_no}}</title>
    </head>
       <body>
       <header>
         <label for="">
        
        </label>
        </header>

        <footer style="">
          <div style="width:100%; text-align:right; font-size:10pt;">
            <label>ระเบียบฯ ได้รับอนุมัติตามบันทึกที่ สปธ. 53/323</label>
            <br>
            <label>ลงวันที่ 25 สิงหาคม พ.ศ. 2563</label>
          </div>
        </footer>

      <div>
        <table width="100%" style="width:100%; line-height: 16px;" border="0" class="table table-responsive">
            <tr>
              <td style="width:100%; text-align: center; font-size:18pt;">&nbsp;<label style=""><b>บริษัท กรุงเทพโทรทัศน์และวิทยุ จำกัด</b></label></td>
            </th>
            </tr>
            <tr>
                <td style="width:100%; text-align: center; font-size:18pt;">&nbsp;<label for=""><b>BANGKOK BROADCASTING & T.V. CO., LTD</b></label></td>
            </tr>
            <tr>
                <td style="width:100%; text-align: center; font-size:18pt;"><b>ใบอนุมัติซ่อมบำรุง</b></td>
            </tr>                
          </table>
          <br>
<div style=" outline-style: solid; outline-width: 0.1px;line-height: 19.4px; 
padding-top: 5px;
padding-right: 20px;
padding-bottom: 30px;
padding-left: 20px; ">
          <table width="100%" style="width:100%; " border="0" class="table table-responsive">
            <tr>
                <td style="text-align:right;">เลขที่ <span style="border-bottom: black 1px dotted">&nbsp;&nbsp;&nbsp;&nbsp;{{$data->job_no}}</span> </td>
            </tr>
            <tr>
                <td style="text-align:right;">วันที่ <span style="border-bottom: black 1px dotted">&nbsp;&nbsp;&nbsp;&nbsp;{{date("d/m/Y",strtotime("+543 year",strtotime($data->job_date)))}}</span>  </td>
            </tr>
          </table>
          <label style=" font-size:14pt;"><b>ฝ่ายงานผู้รับผิดชอบซ่อมบำรุง</b></label>
          <table width="100%" style="width:100%; " border="0" class="table table-responsive">
            <tr>
                <td width="2cm" style="text-align:left;">&nbsp;ข้าพเจ้า : (ชื่อ - สกุล)</td>
                <td width="3cm" style="border-bottom: black 1px dotted; text-align:center;">&nbsp; {{$data->approved_by}}</td>
                <td width="1cm" style="text-align:center;">&nbsp;ฝ่ายงาน </td>
                <td width="5cm" style="border-bottom: black 1px dotted;text-align:center;">&nbsp; {{$data->approved_dep}}</td>
            </tr>
          </table>

          <table  width="100%">
            <tr>
                <td width="2cm" style="text-align:left;">&nbsp;ผู้มีหน้าที่รับผิดชอบซ่อมบำรุงรักษาทรัพย์สิน</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_asset_send}}</td>
                <td width="1cm" style="text-align:center;">&nbsp;ยี่ห้อ</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_asset_brand}}</td>
            </tr>
          </table>
          
          <table width="100%">
            <tr>
                <td width="1cm" style="text-align:left;">&nbsp;รุ่น</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_asset_model}}</td>
                <td width="3cm" style="text-align:center;">&nbsp;S/N / เลขทะเบียน</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_asset_serial}}</td>
            </tr>
          </table>
          <table width="100%">
            <tr>
                <td width="1.5cm" style="text-align:left;">&nbsp;รหัสทรัพย์สิน</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_asset_no}}</td>
                <td width="3cm" style="text-align:left;">&nbsp;ของหน่วยงาน / แผนก</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_request_dep}}</td>
            </tr>
          </table>
          <table width="100%">
            <tr>
                <td width="2cm" style="text-align:left;">&nbsp;สำนัก / ฝ่าย</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->ap_request_sub_dep}}</td>
                <td width="3cm" style="text-align:center;">&nbsp;รหัส Cost Center</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{$data->cost_c_no}}</td>
                <td width="1cm" style="text-align:center;">&nbsp;จำนวน</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{number_format($data->cost_qty)}}</td>
            </tr>
          </table>
          <table width="100%" style=" line-height: 14px;" >
          <tr>
            <td style="text-align:left;">&nbsp;จากการตรวจเช็ค เห็นควรซ่อมบำรุงทรัพย์สินดังกล่าว 
                &nbsp;&nbsp;&nbsp;
                <input type="checkbox" style="position:absolute;  " name="ap_ma_type" id="ap_ma_type" value="ma_in" {{ $data->ap_ma_type == "ma_in" ? 'checked' : '' }}> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ซ่อมภายใน
                &nbsp;&nbsp;&nbsp;
                <input type="checkbox" style="position:absolute;  " name="ap_ma_type" id="ap_ma_type" value="ma_out" {{ $data->ap_ma_type == "ma_out" ? 'checked' : '' }}> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่งซ่อมภายนอก
                &nbsp;&nbsp;&nbsp;
            </td>
            </tr>
          </table>
          <table width="100%">
            <tr>
                <td width="2cm" style="text-align:left;">&nbsp;ให้กับบริษัท</td>
                <td style="border-bottom: black 1px dotted;">&nbsp;&nbsp;{{$data->vendor_name}}</td>
            </tr>
          </table>
          <div style="z-index:2; position:absolute;  line-height: 21px;  top:334px; height:160px; overflow: hidden;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data["ap_asset_desc"]}}
          </div>
        <table width="100%"  style="width:100%; line-height: 18px;" >
          <tr>
            <td width="15%" style="text-align:left;"><label>&nbsp;มีรายละเอียดดังนี้</label></td>
            <td width="85%" style="border-bottom: black 1px dotted">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
            <td style="border-bottom: black 1px dotted">&nbsp;</td>
          </tr>

        </table>
        <table width="100%">
            <tr>
                <td width="7cm" style="text-align:left;">&nbsp;ค่าใช้จ่ายในการซ่อมบำรุงทั้งสิ้น (ไม่รวมภาษีมูลค่าเพิ่ม)</td>
                <td width="1cm" style="text-align:left;">&nbsp;จำนวน</td>
                <td style="border-bottom: black 1px dotted; text-align:center;">{{number_format($data->cost_ma)}}</td>
                
                <td width="6cm" style="text-align:left;">บาท</td>
            </tr>
        </table>
<br>
          <table width="100%" style="width:100%; " border="0" class="table table-responsive">
            <tr>
                <td width="10%" style="text-align:left;">&nbsp;<b>(ลงชื่อ)</b> ผู้ตรวจเช็ค</td>
                <td width="10%" style="border-bottom: black 1px dotted;">&nbsp;</td>
                <td width="2%" style="text-align:right;">&nbsp;วันที่</td>
                <td width="7%" style="border-bottom: black 1px dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width="12%" style="text-align:right;">&nbsp;<b>(ลงชื่อ)</b> ผู้จัดการฝ่าย</td>
                <td width="10%" style="border-bottom: black 1px dotted;">&nbsp;</td>
                <td width="2%" style="text-align:left;">&nbsp;วันที่</td>
                <td width="8%" style="border-bottom: black 1px dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        
          </table>
          <br>
     
        <table width="100%" style=" line-height: 14px;" >
          <tr>
            <td> 
                <input style="position:absolute;  "  type="checkbox" name="ma_type" id="ma_type" value="ma_in"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อนุมัติให้ซ่อมบำรุง
                &nbsp;&nbsp;&nbsp;
                <input style="position:absolute;  " type="checkbox" name="ma_type" id="ma_type" value="ma_out"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อื่น ๆ
                <td width="70%" style="border-bottom: black 1px dotted;">&nbsp;</td>
                &nbsp;&nbsp;&nbsp;
                
            </td>
        </tr>
      </table>
        <div style="z-index:2; position:absolute;  line-height: 16px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
      <table width="100%" style=" line-height: 14px;">
        <tr>
          <td  style="border-bottom: black 1px dotted; ">&nbsp;</td>
          <td style="border-bottom: black 1px dotted; ">&nbsp;</td>
        </tr>
            </table>
            
            <br>
            
            <table width="100%" style="width:100%; " border="0" class="table table-responsive">
              <tr>
                <td width="4%" style="text-align:left;">&nbsp;<b>(ลงชื่อ)</b> ผู้จัดการฝ่ายธุรการ</td>
                <td width="8%" style="border-bottom: black 1px dotted">&nbsp;</td>
                <td width="2%" style="text-align:right;">&nbsp;วันที่</td>
                <td width="5%" style="border-bottom: black 1px dotted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;</td>              
              </tr>
              <tr>
                <td width="4%" style="text-align:left;">&nbsp; <b>ผู้อนุมัติ</b> </td>
                <td width="8%" style="border-bottom: black 1px dotted"></td>
                <td width="2%" style="text-align:right;">&nbsp;วันที่</td>
                <td width="5%" style="border-bottom: black 1px dotted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
              </table>
</div>    
<label style="font-size:10pt;"><b>** ต้นฉบับ</b> <i>ส่งฝ่ายงานผู้มีหน้าที่รับผิดชอบงานซ่อมบำรุง</i> <b>สำเนา</b> <i>ฝ่ายงานผู้รับผิดชอบทรัพย์สิน</i>
</label><br>
<label style="font-size:12pt;"><b>สร้างโดย</b> <i>{{$data->f_name}} {{$data->l_name}}</i>
</label>

</body>
     