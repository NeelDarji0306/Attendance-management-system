
<?php
    //to load all the departments from database
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $tid = $data['tid'];
    $jsonString = $data['jstring'];       // UNCOMMENT THISSSSSSSSSSSSSSS
    // echo $jsonString;
    // echo $jsonString;
    
    // $tid = 5;
    // $jsonString = '{"sem":"1","dep":"Computer Engineering","laborlec":"lec","sub":"basic electrical engineering","tid":"5"}';
    // $jsonString = '';
    
    
    
    $sql = "SELECT subjectTaught FROM collegeteachers WHERE teacherId=$tid ";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    




    if(mysqli_num_rows($result)>0 && strlen($jsonString)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // var_dump($output[0]['subjectTaught']);
        

        $test = strtolower($output[0]['subjectTaught']);

        // var_dump(($test));
        $substringToRemove = strtolower($jsonString);
        // echo $substringToRemove;
        // echo $test;

        $newString = str_replace($substringToRemove, "", $test);
        // echo $newString;
        $newString = str_replace(",,", ",", $newString);
        $lastSecondCharacter = substr($newString, -2, 1);
        $secondCharacter = substr($newString, 1, 1);
        if($secondCharacter == ","){
          
          $position = 1;

          // Remove the last third character
          $newString = substr_replace($newString, "", $position, 1);
        }

        if($lastSecondCharacter == ","){
          
          $position = strlen($newString) - 2;

          // Remove the last third character
          $newString = substr_replace($newString, "", $position, 1);
        }

        // echo $newString;
        $sql2 = "UPDATE collegeteachers SET subjectTaught = '$newString' WHERE teacherId=$tid ";
        $result2 = mysqli_query($conn,$sql2) or die("SQL Query Failed");
        
        if($result2){
          echo json_encode(array('message'=>"Data Removed Successfully" , 'status'=> true));
        } else{
          echo json_encode(array('message'=>"Could not remove data" , 'status'=> false));
        }

    
    } else{
      if(strlen($jsonString)==0){
        echo json_encode(array('message'=>"json string error" , 'status'=> false));

      }else{
        echo json_encode(array('message'=>"No subject found" , 'status'=> false));

      }

    }
?>