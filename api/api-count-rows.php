
<?php
    //to fetch college teachers for displaying on screen ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $sql = $data['query'];
    
    
    // $sql = "SELECT COUNT(*) FROM users JOIN college ON users.college_id = college.collegeId WHERE role='teacher' ORDER BY userId DESC";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No teacher data found" , 'status'=> false));

    }

?>