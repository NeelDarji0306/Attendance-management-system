
<?php
    //to load all the departments from database
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    // $sem = $data['sem'];
    // $dep = $data['dep'];
    // $laborlec = $data['laborlec'];
    // $sub = $data['sub'];
    $tid = $data['tid'];
    $jsonString = $data['jstring'];        // UNCOMMENT THISSSSSSSSSSSSSSS

    // echo $jsonString;
    // $sem = "1";
    // $dep = "Computer Engineering";
    // $laborlec = "lec";
    // $sub = "basic electrical engineering";
    // $tid = 5;
    // $jsonString = '{"sem":1,"dep":"Computer Engineering","sub":"basic electrical engineering", "laborlec":"lec"}';
    // $jsonString = '';
    // $sem = 2;
    // $uid = 2;
    // $dep = "Automobile Engineering";
    $duplicate = false;
    
    
    $sql = "SELECT subjectTaught FROM collegeteachers WHERE teacherId=$tid ";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    




    if(mysqli_num_rows($result)>0 && strlen($jsonString)>0){



      $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
      // var_dump($output[0]['subjectTaught']);
      
      if($output[0]['subjectTaught']!="" && $output[0]['subjectTaught']!='<p style="color:red">Pending - Yet to be filled by teacher </p>' && $output[0]['subjectTaught']!='[]'){
        // echo "true";
        $cameToAdd = json_decode($jsonString, true);
        $test = json_decode($output[0]['subjectTaught'], true);
        // var_dump($test);
        $len = count($test);
        for($i = 0 ; $i < $len ; $i = $i + 1){
          $semester = strtolower($cameToAdd['sem']);
          $department = strtolower($cameToAdd['dep']);
          $lol = strtolower($cameToAdd['laborlec']);
          $subject = strtolower($cameToAdd['sub']);
  
          $semesterTest = strtolower($test[$i]['sem']);
          $departmentTest = strtolower($test[$i]['dep']);
          $lolTest = strtolower($test[$i]['laborlec']);
          $subjectTest = strtolower($test[$i]['sub']);
  
  
          if($semester==$semesterTest && $department==$departmentTest && $lol==$lolTest && $subject==$subjectTest){
            $duplicate = true;
            break;
          }
          
        }
  
        if($duplicate==true){
          echo json_encode(array('message'=>"Duplicate Entry : This data already exist" , 'status'=> false));
        } else{
          $string1 = $output[0]['subjectTaught'];
          $length = strlen($string1);
          $string1 = substr($string1,0,$length-1);
          $string2 = $jsonString;
          $mergedString = implode(",", [$string1, $string2])."]";
          $mergedString = strtolower($mergedString);
          // echo $mergedString;
  
           
          
          $sql2 = "UPDATE collegeteachers SET subjectTaught = '$mergedString'  WHERE teacherId=$tid ";
          $result2 = mysqli_query($conn,$sql2) or die("SQL Query Failed");
          
          if($result2){
            echo json_encode(array('message'=>"Data Added Successfully" , 'status'=> true));
          } else{
            echo json_encode(array('message'=>"Could not add data" , 'status'=> false));
          }
          
        }

      } else{
        $jsonString = "[".$jsonString."]";
        $jsonString = strtolower($jsonString);
        $sql2 = "UPDATE collegeteachers SET subjectTaught = '$jsonString' WHERE teacherId=$tid ";
        $result2 = mysqli_query($conn,$sql2) or die("SQL Query Failed");
        
        if($result2){
          echo json_encode(array('message'=>"Data Added Successfully" , 'status'=> true));
        } else{
          echo json_encode(array('message'=>"Could not add data" , 'status'=> false));
        }
        
      
     }
     
    }else{
        if(strlen($jsonString)==0){
          echo json_encode(array('message'=>"json string error" , 'status'=> false));
  
        }else{
          echo json_encode(array('message'=>"No subject found" , 'status'=> false));
  
        }

      
    }
?>