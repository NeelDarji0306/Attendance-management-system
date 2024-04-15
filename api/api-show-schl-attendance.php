
<?php
    //to fetch all the users as needed , ex all students, or all teachers, or all admins etc...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $std = $data['std'];
    $schlid = $data['schlid'];
    
    $sql = "SELECT * FROM schoolattendance WHERE standard='$std' AND schoolname_id='$schlid'";

    
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");
    if(mysqli_num_rows($result)>0){
      $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
      echo json_encode($output);
    }else{
      echo json_encode(array('message'=>"Attendance details not found" , 'status'=> false));
    }

?>