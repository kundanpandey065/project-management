<?php
include 'header.php';

if (empty($_GET['userid'])) {
   die();
}



$userid = $_GET['userid'];

$query = $conn->prepare("SELECT * FROM project_members where user_id = :userid limit 1");
$query->bindParam(':userid',$userid);
$query->execute();
$projectMemberResult = $query->fetchAll();
$projectMemberRow = count($projectMemberResult);

$query = $conn->prepare("SELECT * FROM users where id = :userid limit 1");
$query->bindParam(':userid',$userid);
$query->execute();
$userResult = $query->fetchAll();
$userRow = count($userResult);
if ($userRow>0) {
    $username = $userResult[0]['name'];
}



?> 


<script src="https://echarts.apache.org/en/js/vendors/echarts/dist/echarts.min.js"></script>

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
                        <h4 class="mb-sm-0 font-size-18">Task Detail</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Task Detail</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">                

                <?php
                if (isset($projectMemberRow)) {
                    foreach ($projectMemberResult as $value) {

                        $project_id = $value['project_id'];

                        $query = $conn->prepare("SELECT title FROM project where id = :project_id");
                        $query->bindParam(':project_id',$project_id);
                        $query->execute();
                        $projectResult = $query->fetchAll();
                        $projectRow = count($projectResult);
                        if ($projectRow >0) {
                            $projectTitle = $projectResult[0]['title'];
                        }

                        $task_status_id = 1; // TO DO
                        $query = $conn->prepare("SELECT SUM(weightage) as total_tasks FROM tasks WHERE project_id = :project_id and task_status_id = :task_status_id GROUP BY task_status_id");
                        $query->bindParam(':project_id',$project_id);
                        $query->bindParam(':task_status_id',$task_status_id);
                        $query->execute();
                        $tasksResult = $query->fetchAll();
                        $tasksRow = count($tasksResult);
                        $TODOWeightage= 0;
                        if (isset($tasksRow)) {
                            foreach ($tasksResult as $value) {
                                $TODOWeightage += $value['total_tasks'];
                            }
                        }



                        $task_status_id = 2; // In Progress
                        $query = $conn->prepare("SELECT SUM(weightage) as total_tasks FROM tasks WHERE project_id = :project_id and task_status_id = :task_status_id GROUP BY task_status_id");
                        $query->bindParam(':project_id',$project_id);
                        $query->bindParam(':task_status_id',$task_status_id);
                        $query->execute();
                        $tasksResult = $query->fetchAll();
                        $tasksRow = count($tasksResult);
                        $INProgressWeightage= 0;
                        if (isset($tasksRow)) {
                            foreach ($tasksResult as $value) {
                                $INProgressWeightage += $value['total_tasks'];
                            }
                        }

                        $task_status_id = 3; // Done
                        $query = $conn->prepare("SELECT SUM(weightage) as total_tasks FROM tasks WHERE project_id = :project_id and task_status_id = :task_status_id GROUP BY task_status_id");
                        $query->bindParam(':project_id',$project_id);
                        $query->bindParam(':task_status_id',$task_status_id);
                        $query->execute();
                        $tasksResult = $query->fetchAll();
                        $tasksRow = count($tasksResult);
                        $DONEWeightage= 0;
                        if (isset($tasksRow)) {
                            foreach ($tasksResult as $value) {
                                $DONEWeightage += $value['total_tasks'];
                            }
                        }

                        $task_status_id = 4; // Blocked
                        $query = $conn->prepare("SELECT SUM(weightage) as total_tasks FROM tasks WHERE project_id = :project_id and task_status_id = :task_status_id GROUP BY task_status_id");
                        $query->bindParam(':project_id',$project_id);
                        $query->bindParam(':task_status_id',$task_status_id);
                        $query->execute();
                        $tasksResult = $query->fetchAll();
                        $tasksRow = count($tasksResult);
                        $BLOCKEDWeightage= 0;
                        if (isset($tasksRow)) {
                            foreach ($tasksResult as $value) {
                                $BLOCKEDWeightage += $value['total_tasks'];
                            }
                        }

                        ?>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">
                                        <!-- Pie Chart -->
                                        <?php if(!empty($username)){ echo $username; }  ?>
                                    </h4>
                                    <div class="myaChart">
                                        <div id="chart-container"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php

                    }
                }
                ?>

            </div>






            
        </div> <!-- container-fluid -->
    </div>
</div>


<?php
include 'footer.php';
?> 






 

<!-- https://echarts.apache.org/examples/en/editor.html?c=pie-simple -->


 <script>
let dom = document.getElementById('chart-container');


let myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
let app = {};


let option;

option = {
  title: {
    text: `<?php echo $projectTitle;  ?>`,
    // subtext: 'Fake Data',
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
        { value: `<?php echo $TODOWeightage ?>`, name: 'To DO' },
        { value: `<?php echo $INProgressWeightage ?>`, name: 'In Progress' },
        { value: `<?php echo $DONEWeightage ?>`, name: 'Done' },
        { value: `<?php echo $BLOCKEDWeightage ?>`, name: 'Blocked' }     
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