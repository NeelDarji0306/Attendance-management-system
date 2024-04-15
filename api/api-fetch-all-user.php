
<?php
    //to fetch all the users as needed , ex all students, or all teachers, or all admins etc...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    
    $userRoleAsked = $data['userRole'];
    $sql = "SELECT * FROM users WHERE role='{$userRoleAsked}' ORDER BY userId";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No user found with {$data['userRole']} role" , 'status'=> false));

    }
?>