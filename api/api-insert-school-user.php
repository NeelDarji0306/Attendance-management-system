
<?php
    //to add schoolteachers............  
    require '_config.php';
    
    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');
    
    $data = json_decode(file_get_contents("php://input"),true);
    
    
    $email = $data['email'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $city = $data['city'];
    $schoolType = $data['schoolType'];
    $schoolName = $data['schoolName'];
    $classAssigned = $data['classAssigned'];
    $phoneNumber = $data['phoneNo'];
    $role = $data['userRole'];
    $rollNo=null;
    if($role=="student"){
      $rollNo=$data['rollNo'];
    }
    
    $conn->begin_transaction();
    try{
      
    
      $sqlForUsers = "INSERT INTO users VALUES (NULL,'$email','$role@123','$fname','$lname','$role','images/default.jpg','school',$city,NULL,NULL,$schoolType,$schoolName)";
      $resultForUsers = mysqli_query($conn,$sqlForUsers) ;
      if(!$resultForUsers){
        throw new Exception("ERROR INSERTING IN TABLE1!");
      }

      $lastUserId = $conn->insert_id;
    
      if($role == 'teacher'){
        $sqlForSTeachers = "INSERT INTO schoolteachers VALUES (NULL,'$classAssigned','<p style=\"color:red\">Pending - Yet to be filled by teacher </p>',$phoneNumber,$lastUserId)";
        $resultForSTeachers = mysqli_query($conn,$sqlForSTeachers) ;
        if(!$resultForSTeachers){
          throw new Exception("ERROR INSERTING IN TABLE2!");
        }

      } else{
        // code to add student
        $sqlForSStudents = "INSERT INTO schoolstudents VALUES (NULL,'$classAssigned',$rollNo,$phoneNumber,$lastUserId)";
        $resultForSStudents = mysqli_query($conn,$sqlForSStudents) ;
        if(!$resultForSStudents){
          throw new Exception("ERROR INSERTING IN TABLE2!");
        }
      }
      
      
      $conn->commit();
      echo json_encode(array('message'=>"Inserted succesfully!!!" , 'status'=> true));
    } catch(Exception $e){
      $conn->rollback();
      echo json_encode(array('message'=>"Something went wrong between 2 queries: ".$e->getMessage() , 'status'=> false));
    }
    
    
    
    ?>