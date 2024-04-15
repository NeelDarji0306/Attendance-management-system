

<?php
    //to validate the user exists or not
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    
    $cos = $data['cos'];
    $id = $data['id'];

    try{
      if($cos == "c"){
        $sql = "DELETE FROM college WHERE collegeId=$id";
        
      } else{
        $sql = "DELETE FROM schoolname WHERE schoolnameId=$id";
        
      }
      $result = mysqli_query($conn,$sql);
      if(!$result){
        throw new Exception("ERROR DELETING THE DATA !");
      }
      echo json_encode(array('message'=>"Deleted succesfully!!!" , 'status'=> true));
    } catch(Exception $e){
      echo json_encode(array('message'=>"Something went wrong: ".$e->getMessage() , 'status'=> false));
    }

    
?>