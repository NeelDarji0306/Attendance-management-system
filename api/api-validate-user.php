

<?php
    //to validate the user exists or not
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    
    $userEmail = $data['email'];
    $userPass = $data['pass'];
    $role = $data['role'];
    // $userEmail="neeldarji089@gmail.com";
    // $userPass = "admin";
    $sql = "SELECT * FROM users WHERE email='{$userEmail}' AND role='$role'";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        if($output[0]['password'] == $userPass){
            session_start();
            $_SESSION['userId'] = (int)$output[0]['userId']; // it is in the form of string so use bcz of assoc array
            $_SESSION['userRole'] = $output[0]['role'];
            $_SESSION['loggedin'] = true ;
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60*60*24*4); //4days
            $_SESSION['username'] = $output[0]['firstName']." ".$output[0]['lastName'];
            $_SESSION['schoolOrCollege'] = $output[0]['schoolOrCollege'];
            $_SESSION['pp'] = $output[0]['profilePic'];
            $_SESSION['userInfo'] = $output[0];
            // $_SESSION['schoolOrCollege'] = "1";  
            
            echo json_encode($output);

        } else{
            echo json_encode(array('message'=>'Incorrect Password' , 'status'=> false));

        }
    } else{
            echo json_encode(array('message'=>'No user found' , 'status'=> false));

    }
?>
















<?php
    //to validate the user exists or not
    // require '_config.php';

    // header('Content-Type: application/json'); // extra space ....................
    // header('Access-Control-Allow-Origin: *');

    // $data = json_decode(file_get_contents("php://input"),true);

    
    // $userEmail = $data['email'];
    // $userPass = $data['pass'];
    // // $userEmail="neeldarji089@gmail.com";
    // // $userPass = "admin";
    // $sql = "SELECT * FROM users WHERE email='{$userEmail}' AND password='{$userPass}' ";
    // $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    // if(mysqli_num_rows($result)>0){
    //     $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //     session_start();
    //     $_SESSION['userId'] = (int)$output[0]['userId']; // it is in the form of string so use bcz of assoc array
    //     $_SESSION['userRole'] = $output[0]['role'];
    //     $_SESSION['loggedin'] = true ;
    //     $_SESSION['start'] = time();
    //     $_SESSION['expire'] = $_SESSION['start'] + (60*60*24*4); //4days
    //     $_SESSION['username'] = $output[0]['firstName']." ".$output[0]['lastName'];
    //     echo json_encode($output);
    // } else{
    //     $sqlFetchEmail = "SELECT * FROM users WHERE email='{$userEmail}'";
    //     $resultOfSqlFetchEmail = mysqli_query($conn,$sqlFetchEmail) or die("SQL Query Failed");
    //     if(mysqli_num_rows($resultOfSqlFetchEmail)>0){
    //         echo json_encode(array('message'=>'Incorrect Password' , 'status'=> false));
    //     } else{
    //         echo json_encode(array('message'=>'No user found' , 'status'=> false));
    //     }

    // }
?> 
