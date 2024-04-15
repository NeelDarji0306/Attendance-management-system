
<?php
    //to fetch college teachers for displaying on screen ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    // $data = json_decode(file_get_contents("php://input"),true);

    $userId = $_POST['edit-admin-id'];
    $role = $_POST['edit-admin-role'];
    
    function milliseconds(){
      $mt = explode(" ", microtime());
      return intval( $mt[1] * 1E3) + intval(round( $mt[0] * 1E3));
    }

    
    if($role == "admin"){
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $city = $_POST['city'];
      // $sql = "UPDATE users SET firstName='$fname',lastName='$lname',email='$email',city_id=$city WHERE userId=$userId";
      // $result = mysqli_query($conn,$sql) or die("SQL Query Failed");
      $conn->begin_transaction();
          try{
              $flag = false;
              $path = "";
              if($_FILES['profile-picture']['name'] != ''){
  
  
                  $filename = $_FILES['profile-picture']['name']; // Get the Uploaded file Name.
                  
                  $extension = pathinfo($filename,PATHINFO_EXTENSION); //Get the Extension of uploded file.
                  
                  $valid_extensions = array("jpg","jpeg","png","gif");
                  
                  if(in_array($extension, $valid_extensions)){ // check if upload file is a valid image file.
                      
                      $new_name = milliseconds() . "." . $extension;
                      $path .= "images/" . $new_name;
                      if(move_uploaded_file($_FILES['profile-picture']['tmp_name'], "../".$path)){ // Upload the Image File on server path
                          $flag = true;
                          
                      }
                  
                  }else{
                      echo '<script>alert("Invalid File Format.")</script>';
                  }
              }
              $sql1="";
              if($flag){
                  $sql = "SELECT profilePic FROM users WHERE userId=$userId";
                  $result = $conn->query($sql) ;
                  $row=mysqli_fetch_assoc($result);
                      if($result){
                          if($row['profilePic'] != "images/default.jpg"){
                              if(unlink("../".$row['profilePic'])){ // Delete the image from server path
                                  // echo 'Image Deleted';
                                  // echo json_encode(array('message'=>"andrandr!!!" , 'status'=> true));
                                  
                                  
                              }
                              // echo json_encode(array('message'=>"andr!!!" , 'status'=> true));
                          }
  
                      }
              }
  
              if($flag){
                $sql1 = "UPDATE users SET firstName='$fname',lastName='$lname',email='$email',city_id=$city, profilePic= '$path' WHERE userId=$userId";
              } else{
                $sql1 = "UPDATE users SET firstName='$fname',lastName='$lname',email='$email',city_id=$city WHERE userId=$userId";
  
              }
              $result1 = $conn->query($sql1) ;
              if(!$result1){
                  throw new Exception("ERROR UPDATING TABLE1!");
              }
  
              
              $conn->commit();
              echo json_encode(array('message'=>"Updated succesfully!!!" , 'status'=> true));
          } catch(Exception $e){
              $conn->rollback();
              echo json_encode(array('message'=>"Something went wrong between 2 queries: ".$e->getMessage() , 'status'=> false));
          }
  
    } else{
      echo json_encode(array('message'=>"You are not admin" , 'status'=> false));

    }
      // $fname = $_POST['fname'];
      // $lname = $_POST['lname'];
      // $email = $_POST['email'];
      // $city = $_POST['city'];
      // $sql = "UPDATE users SET firstName='$fname',lastName='$lname',email='$email',city_id=$city WHERE userId=$userId";
      // $result = mysqli_query($conn,$sql) or die("SQL Query Failed");
  
      // if($result){
      //   echo json_encode(array('message'=>"Updated Successfully!" , 'status'=> true));
      
      // } else{
      //   echo json_encode(array('message'=>"Error in updating..." , 'status'=> false));
      //   // echo json_encode(array('message'=>"You are not admin" , 'status'=> false));
      // }

?>