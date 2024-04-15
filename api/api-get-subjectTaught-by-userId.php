
<?php
    // to get subject taught by the teacher ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $userId = $data['userId'];
    $role = $data['role'];
    $soc = $data['soc'];
    
    if($soc=='college'){
      $sql = "SELECT * FROM users JOIN collegeteachers ON users.userId=collegeteachers.user_id JOIN college ON users.college_id=college.collegeId WHERE user_id=$userId";
    } else{
      $sql = "SELECT * FROM users JOIN schoolteachers ON users.userId=schoolteachers.user_id JOIN schoolname ON users.schoolname_id=schoolname.schoolnameId WHERE user_id=$userId";
    }
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No teacher data found for this user" , 'status'=> false));

    }

?>