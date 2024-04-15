
<?php
    //to add collegeteachers............  
    require '_config.php';
    
    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');
    
    $data = json_decode(file_get_contents("php://input"),true);
    
    
    $city = $data['city'];
    $type = $data['schoolType'];
    $school = $data['schoolName'];
    $flag = $data['flag'];
    $conn->begin_transaction();
    try{
      
      
      if($flag=="exists"){
        $city = (int)$city;
        $sql = "INSERT INTO schoolname VALUES (NULL,'$school',$type,$city)";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          throw new Exception("ERROR INSERTING IN SCHOONAME TABLE!");
        }
  
      } else{
        $sql1 = "INSERT INTO city VALUES (NULL,'$city')";
        $result1 = mysqli_query($conn,$sql1); 
        if(!$result1){
          throw new Exception("ERROR INSERTING IN CITY TABLE!");
        }
        
        $lastCityId = $conn->insert_id;

        $sql3 = "INSERT INTO schoolname VALUES (NULL,'$school',$type,$lastCityId)";
        $result3 = mysqli_query($conn,$sql3);
        if(!$result3){
          throw new Exception("ERROR INSERTING IN SCHOONAME TABLE!");
        }
      }
      
      
      
      $conn->commit();
      echo json_encode(array('message'=>"Inserted succesfully!!!" , 'status'=> true));
    } catch(Exception $e){
      $conn->rollback();
      echo json_encode(array('message'=>"Something went wrong: ".$e->getMessage() , 'status'=> false));
    }
    
    
    
    ?>