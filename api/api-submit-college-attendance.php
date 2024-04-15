
<?php
    // to submit college attendance ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $dep = strtolower($data['dep']);
    $date = $data['date'];
    $sem = $data['sem'];
    $sub = strtolower($data['sub']);
    $tid = $data['tid'];
    $clgid = $data['clgid'];
    $lol = strtolower($data['laborlec']);
    $clgid = $data['clgid'];
    $present = $data['present'];
    $present =  implode(", ", $present);
    // echo json_encode(array('message'=>$present , 'status'=> false));
    
    $checkSql = "SELECT * FROM collegeattendance WHERE date='$date' AND department='$dep' AND sem='$sem' AND subject='$sub' AND laborlec='$lol' AND teacher_id='$tid' AND college_id='$clgid'";
    
    $checkResult = mysqli_query($conn,$checkSql) or die("SQL Query Failed");

    if(mysqli_num_rows($checkResult)>0){
        echo json_encode(array('message'=>"Attendance of this subject is already been taken" , 'status'=> false));

    } else{
        $sql = "INSERT INTO collegeattendance (date,department,sem,subject,laborlec,presentNumbers,teacher_id,college_id) VALUES('$date','$dep','$sem','$sub','$lol','$present','$tid','$clgid')";
        
        $result = mysqli_query($conn,$sql) or die("SQL Query Failed");
    
        if($result){
            echo json_encode(array('message'=>"Attendace has been Taken !!!" , 'status'=> true));
        } else{
            echo json_encode(array('message'=>"Something went wrong!" , 'status'=> false));
        }

    }


?>