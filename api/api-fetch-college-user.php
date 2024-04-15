
<?php
    //to fetch college teachers for displaying on screen ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $flag = false;
    $page = $data['page'];
    $limit = $data['limit'];
    $role = $data['userRole'];
    // $page = 1;
    // $limit = 2;
    $start = ($page - 1) * $limit;
    
    if($role == "teacher"){
        $sql = "SELECT *,(SELECT COUNT(*) FROM users JOIN college ON users.college_id = college.collegeId WHERE role='teacher') AS len FROM users JOIN college ON users.college_id = college.collegeId JOIN collegeteachers ON users.userId=collegeteachers.user_id WHERE role='$role' ORDER BY userId DESC LIMIT $start,$limit";

    } else{
        $sql = "SELECT *,(SELECT COUNT(*) FROM users JOIN college ON users.college_id = college.collegeId WHERE role='student') AS len FROM users JOIN college ON users.college_id = college.collegeId JOIN collegestudents ON users.userId=collegestudents.user_id WHERE role='$role' ORDER BY userId DESC LIMIT $start,$limit";
    }
    // $sql = "SELECT * FROM users JOIN college ON users.college_id = college.collegeId WHERE role='$role' ORDER BY collegeName LIMIT $start,$limit";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No data found" , 'status'=> false));

    }

?>