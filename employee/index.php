<?php
include 'header.php';

$is_active = 'active';
$today_date = date('Y-m-d');




?>            



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Doughnut Chart</h4>
                            <div id="doughnut-chart" data-colors='["--bs-primary","--bs-warning", "--bs-danger","--bs-info", "--bs-success"]' class="e-charts"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Pie Chart</h4>
                            <!-- <div id="pie-chart" data-colors='["--bs-primary","--bs-warning", "--bs-danger","--bs-info", "--bs-success"]' class="e-charts"></div> -->
                            <div class="myaChart">
                                <div id="chart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- End Page-content -->


        









<?php
    include 'footer.php';
?>   


<script src="https://echarts.apache.org/en/js/vendors/echarts/dist/echarts.min.js"></script>
<script>
var dom = document.getElementById('chart-container');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};


var option;

option = {
  title: {
    text: 'Referer of a Website',
    subtext: 'Fake Data',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  // legend: {
  //   orient: 'vertical',
  //   left: 'left'
  // },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: '50%',
      data: [
        { value: 1048, name: 'Search Engine' },
        { value: 735, name: 'Direct' },
        { value: 580, name: 'Email' },
        { value: 484, name: 'Union Ads' },
        { value: 300, name: 'Video Ads' }
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};


if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
</script>


<!-- <script>
$(document).ready(function () {
    $(".contentHideShow").hide();
    $(".show_hide").on("click", function () {
        var txt = $(".contentHideShow").is(':visible') ? 'Show More...' : 'Show Less';
        $(".show_hide").text(txt);
        $(this).prev('.contentHideShow').slideToggle(200);
    });
});
</script>
 -->