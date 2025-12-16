<?php
include 'header.php';

if (empty($_GET['userid'])) {
   die();
}



$userid = $_GET['userid'];

$query = $conn->prepare("SELECT * FROM project_members where user_id = :userid");
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

                $chartDataArray = [];
                $chartCounter = 0;


                if (isset($projectMemberRow)) {
                    foreach ($projectMemberResult as $value) {
                        $chartCounter++;
                        $project_id = $value['project_id'];

                        // Fetch project title
                        $query = $conn->prepare("SELECT title FROM project WHERE id = :project_id");
                        $query->bindParam(':project_id', $project_id);
                        $query->execute();
                        $projectResult = $query->fetchAll();
                        $projectTitle = $projectResult[0]['title'] ?? 'Project';

                        // Function to fetch weightage based on task status
                        // function getWeightage($conn, $project_id, $task_status_id) {
                        //     $query = $conn->prepare("SELECT SUM(weightage) as total_tasks FROM tasks WHERE project_id = :project_id and task_status_id = :task_status_id GROUP BY task_status_id");
                        //     $query->bindParam(':project_id', $project_id);
                        //     $query->bindParam(':task_status_id', $task_status_id);
                        //     $query->execute();
                        //     $result = $query->fetch();
                        //     return $result['total_tasks'] ?? 0;
                        // }

                        if (!function_exists('getWeightage')) {
                            function getWeightage($conn, $project_id, $task_status_id) {
                                $query = $conn->prepare("SELECT SUM(weightage) as total_tasks FROM tasks WHERE project_id = :project_id and task_status_id = :task_status_id GROUP BY task_status_id");
                                $query->bindParam(':project_id', $project_id);
                                $query->bindParam(':task_status_id', $task_status_id);
                                $query->execute();
                                $result = $query->fetch();
                                return $result['total_tasks'] ?? 0;
                            }
                        }

                        $chartDataArray[] = [
                            'id' => 'chart-container-' . $chartCounter,
                            'title' => $projectTitle,
                            'todo' => getWeightage($conn, $project_id, 1),
                            'in_progress' => getWeightage($conn, $project_id, 2),
                            'done' => getWeightage($conn, $project_id, 3),
                            'blocked' => getWeightage($conn, $project_id, 4)
                        ];
                ?>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4"><?php echo $username; ?> - <?php echo $projectTitle; ?></h4>
                                    <div class="myaChart">
                                        <div id="chart-container-<?php echo $chartCounter; ?>" style="height: 400px;"></div>
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
const chartDataArray = <?php echo json_encode($chartDataArray); ?>;

chartDataArray.forEach((chartData) => {
    const chartDom = document.getElementById(chartData.id);
    const myChart = echarts.init(chartDom);
    const option = {
        title: {
            text: chartData.title,
            left: 'center'
        },
        tooltip: {
            trigger: 'item'
        },
        series: [
            {
                name: 'Task Status',
                type: 'pie',
                radius: '50%',
                data: [
                    { value: chartData.todo, name: 'To DO' },
                    { value: chartData.in_progress, name: 'In Progress' },
                    { value: chartData.done, name: 'Done' },
                    { value: chartData.blocked, name: 'Blocked' }
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
    myChart.setOption(option);
    window.addEventListener('resize', () => myChart.resize());
});
</script>