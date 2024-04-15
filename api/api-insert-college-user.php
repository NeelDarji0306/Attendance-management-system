
<?php
    //to add collegeteachers............  
    require '_config.php';
    
    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');
    
    $data = json_decode(file_get_contents("php://input"),true);
    
    
    $email = $data['email'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $city = $data['city'];
    $university = $data['uni'];
    $college = $data['clg'];
    $department = $data['dep'];
    $phoneNumber = $data['phoneNo'];
    $role = $data['userRole'];
    $sem=null;
    $rollNo=null;
    if($role=="student"){
      $sem=$data['sem'];
      $rollNo=$data['rollNo'];
    }
    
    $conn->begin_transaction();
    try{
      
    
      $sqlForUsers = "INSERT INTO users VALUES (NULL,'$email','$role@123','$fname','$lname','$role','images/default.jpg','college',$city,$university,$college,NULL,NULL)";
      $resultForUsers = mysqli_query($conn,$sqlForUsers) ;
      if(!$resultForUsers){
        throw new Exception("ERROR INSERTING IN TABLE1!");
      }

      $lastUserId = $conn->insert_id;
    
      if($role == 'teacher'){
        $sqlForCTeachers = "INSERT INTO collegeteachers VALUES (NULL,'$department','<p style=\"color:red\">Pending - Yet to be filled by teacher </p>',$phoneNumber,$lastUserId)";
        $resultForCTeachers = mysqli_query($conn,$sqlForCTeachers) ;
        if(!$resultForCTeachers){
          throw new Exception("ERROR INSERTING IN TABLE2!");
        }

      } else{
        // code to add student
        $sqlForCStudents = "INSERT INTO collegestudents VALUES (NULL,'$department',$sem,$rollNo,$phoneNumber,$lastUserId)";
        $resultForCStudents = mysqli_query($conn,$sqlForCStudents) ;
        if(!$resultForCStudents){
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