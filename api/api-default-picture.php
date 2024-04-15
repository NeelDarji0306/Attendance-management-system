<?php
    //to remove pp and make it defalut...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $userId = $data['userId'];
    $schoolOrCollege="";
    $sql2 = "SELECT profilePic,schoolOrCollege FROM users WHERE userId=$userId";
      $result2 = $conn->query($sql2) ;
      if($result2){
          $row2=mysqli_fetch_assoc($result2);
          $schoolOrCollege=$row2['schoolOrCollege'];
          if($row2['profilePic'] != "images/default.jpg"){
            if(unlink("../".$row2['profilePic'])){ // Delete the image from server path
              // echo 'Image Deleted';
              // echo json_encode(array('message'=>"andrandr!!!" , 'status'=> true));
            }
                            // echo json_encode(array('message'=>"andr!!!" , 'status'=> true));
          }

        }
    
    $sql = "UPDATE users SET profilePic='images/default.jpg' WHERE userId= '$userId'";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if($result){
      echo json_encode(array('message'=>"Successfully removed pp" , 'status'=> true, "soc"=>$schoolOrCollege,"uid"=>$userId)); 

    
    } else{
            echo json_encode(array('message'=>"Not removed pp" , 'status'=> false));

    }
?>