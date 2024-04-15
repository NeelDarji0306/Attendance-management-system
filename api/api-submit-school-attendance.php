
<?php
    // to submit college attendance ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $date = $data['date'];
    $std = $data['std'];
    $sub = strtolower($data['sub']);
    $tid = $data['tid'];
    $schlid = $data['schlid'];
    $present = $data['present'];
    $present =  implode(", ", $present);
    // echo json_encode(array('message'=>$present , 'status'=> false));
    
    $checkSql = "SELECT * FROM schoolattendance WHERE date='$date' AND standard='$std' AND subject='$sub' AND teacher_id='$tid' AND schoolname_id='$schlid'";
    
    $checkResult = mysqli_query($conn,$checkSql) or die("SQL Query Failed");

    if(mysqli_num_rows($checkResult)>0){
        echo json_encode(array('message'=>"Attendance of this subject is already been taken" , 'status'=> false));

    } else{
        $sql = "INSERT INTO schoolattendance (date,standard,subject,presentNumbers,teacher_id,schoolname_id) VALUES('$date','$std','$sub','$present','$tid','$schlid')";
        
        $result = mysqli_query($conn,$sql) or die("SQL Query Failed");
    
        if($result){
            echo json_encode(array('message'=>"Attendace has been Taken !!!" , 'status'=> true));
        } else{
            echo json_encode(array('message'=>"Something went wrong!" , 'status'=> false));
        }

    }


?>