
<?php
    //to add collegeteachers............  
    require '_config.php';
    
    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');
    
    $data = json_decode(file_get_contents("php://input"),true);
    
    
    $city = ((int) $data['city']) || $data['city'];
    $university = ((int) $data['uni']) || $data['uni'];
    $college = $data['clg'];
    // try{
    //   $toInt = (int) $university;
    // }catch(Exception $e){

    // }
    $conn->begin_transaction();
    try{
      if(is_int($city)){
        if(is_int($university)){
          $sql1 = "INSERT INTO college VALUES (NULL,'$college',$university,$city)";
          $result1 = mysqli_query($conn,$sql1);
          if(!$result1){
            throw new Exception("ERROR INSERTING IN COLLEGE TABLE!");
          }
    
        } else{
          $sql2 = "INSERT INTO university VALUES (NULL,'$university',$city)";
          $result2 = mysqli_query($conn,$sql2);
          if(!$result2){
            throw new Exception("ERROR INSERTING IN UNIVERSITY TABLE!");
          }
          
          $lastUniId = $conn->insert_id;
          
          $sql3 = "INSERT INTO college VALUES (NULL,'$college',$lastUniId,$city)";
          $result3 = mysqli_query($conn,$sql3);
          if(!$result3){
            throw new Exception("ERROR INSERTING IN COLLEGE TABLE!");
          }
        }

      } else{
        $sql4 = "INSERT INTO city VALUES (NULL,'$city')";
        $result4 = mysqli_query($conn,$sql4);
        if(!$result4){
          throw new Exception("ERROR INSERTING IN CITY TABLE!");
        }
        
        $lastCityId = $conn->insert_id;

        if(is_int($university)){
          $sql5 = "INSERT INTO college VALUES (NULL,'$college',$university,$lastCityId)";
          $result5 = mysqli_query($conn,$sql5);
          if(!$result5){
            throw new Exception("ERROR INSERTING IN COLLEGE TABLE!");
          }
    
        } else{
          $sql6 = "INSERT INTO university VALUES (NULL,'$university',$lastCityId)";
          $result6 = mysqli_query($conn,$sql6);
          if(!$result6){
            throw new Exception("ERROR INSERTING IN UNIVERSITY TABLE!");
          }
          
          $lastUniId = $conn->insert_id;
          
          $sql7 = "INSERT INTO college VALUES (NULL,'$college',$lastUniId,$lastCityId)";
          $result7 = mysqli_query($conn,$sql7);
          if(!$result7){
            throw new Exception("ERROR INSERTING IN COLLEGE TABLE!");
          }
        }


      }
    
      
      
      $conn->commit();
      echo json_encode(array('message'=>"Inserted succesfully!!!" , 'status'=> true));
    } catch(Exception $e){
      $conn->rollback();
      echo json_encode(array('message'=>"Something went wrong between 2 queries: ".$e->getMessage() , 'status'=> false));
    }
    
    
    
    ?>