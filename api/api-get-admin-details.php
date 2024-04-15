
<?php
    //to fetch college teachers for displaying on screen ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $userId = $data['userId'];
    $role = $data['userRole'];
    
    if($role == "admin"){
      
      $sql = "SELECT * FROM users JOIN city ON users.city_id = city.cityId WHERE userId=$userId";
      $result = mysqli_query($conn,$sql) or die("SQL Query Failed");
  
      if(mysqli_num_rows($result)>0){
          $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
          echo json_encode($output);
        
      
      } else{
        echo json_encode(array('message'=>"You are not admin" , 'status'=> false));
      }
    } else{
      echo json_encode(array('message'=>"No university/college data found" , 'status'=> false));

    }

?>