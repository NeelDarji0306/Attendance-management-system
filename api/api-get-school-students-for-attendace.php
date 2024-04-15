
<?php
    // to get subject taught by the teacher ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $std = $data['std'];
    $sub = $data['sub'];
    $tid = $data['tid'];
    $schlid = $data['schlid'];
    
    // $sql = "SELECT * FROM collegestudents JOIN users ON users.userId=collegestudents.user_id JOIN college ON users.college_id=college.collegeId WHERE branch='$dep' AND sem=$sem AND college_id=$clgid";
    $sql = "SELECT * FROM schoolstudents JOIN users ON users.userId=schoolstudents.user_id WHERE standard='$std' AND schoolname_id=$schlid ORDER BY schoolstudents.rollNumber ASC";
    
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No student data found" , 'status'=> false));

    }

?>