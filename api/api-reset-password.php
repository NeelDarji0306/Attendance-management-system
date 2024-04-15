

<?php
    //to validate the user exists or not
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    
    $userId = $data['userId'];
    $prevPass = $data['prevPass'];
    $pass = $data['pass'];

    $sql = "SELECT (password) FROM users WHERE userId=$userId";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
            
        if($output[0]['password']==$prevPass){
          // echo json_encode(array('message'=>'prev pass matched' , 'status'=> true));
          $sql2 = "UPDATE users SET password='$pass' WHERE userId=$userId";
          $result2 = mysqli_query($conn,$sql2) or die("SQL Query Failed");
          if($result2){
            echo json_encode(array('message'=>'Passeword updated!' , 'status'=> true));

          }else{
            echo json_encode(array('message'=>'Passeword could not be updated...' , 'status'=> false));

          }


        }else{
          echo json_encode(array('message'=>'prev pass not matched' , 'prevPassStatus'=> false));

        }
        // echo json_encode($output);

    } else{
            echo json_encode(array('message'=>'Something went wrong!! Passeword could not be updated...' , 'status'=> false));

    }
?>