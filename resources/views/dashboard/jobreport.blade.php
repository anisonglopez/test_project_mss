<!-- Default Card Example -->
<div class="card mb-4 ">
        <div class="card-header ">
          <div class="row">
            <div class="col-md-6 font-weight-bold ">
                   แสดงสถานะใบงาน
            </div>
            <div class="col-md-6 text-right">
            </div>
          </div>        
        </div>
      <!-- end card header -->
        <div class="card-body">
          <div class="col-md-12">
              {{-- <canvas id="joborder_status_report" width="100" height="100" class="chartjs-render-monitor" style="display: block; height: 25px; width:182px;"></canvas> --}}
              <canvas id="joborder_status_report" width="100" height="50"></canvas>
            </div>
          </div>
    </div>

    <script>
      $.ajax({
        type: "POST",
        url: "{{url('dashboard2_getdata')}}",
        dataType:"json",
        data: { _token: "{{csrf_token()}}"}, // serializes the form's elements.
        success: function(data)
        {
          console.log(data)
          var jsonfile = {
            "jsonarray": JSON.parse(data.barchart)
          };

        var labels = jsonfile.jsonarray.map(function(e) {
          return e.js_name; 
        });
        
        var data_json = jsonfile.jsonarray.map(function(e) {
          return e.total;
        });

        var ctx = document.getElementById('joborder_status_report').getContext('2d');
var joborder_status_Chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'จำนวนแบ่งตามสถานะ ',
            data: data_json,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
      legend: {
        display: false
    },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


        }
      });

       </script>