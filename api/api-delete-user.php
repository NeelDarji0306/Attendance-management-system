

<?php
    //to validate the user exists or not
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    
    $uId = $data['uId'];

    try{
      $sql = "DELETE FROM users WHERE userId=$uId";
      $result = mysqli_query($conn,$sql);
      if(!$result){
        throw new Exception("ERROR DELETING THE DATA !");
      }
      echo json_encode(array('message'=>"Deleted succesfully!!!" , 'status'=> true));
    } catch(Exception $e){
      echo json_encode(array('message'=>"Something went wrong: ".$e->getMessage() , 'status'=> false));
    }

    
?>