
<?php
    //to fetch all the users as needed , ex all students, or all teachers, or all admins etc...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $userId = $data['userId'];
    $schoolOrCollege = $data['schoolOrCollege'];
    $role = $data['userRole'];
    $flag = false;

    if($schoolOrCollege == "college"){
      if($role == "teacher"){
        $sqlForCollege = "SELECT * FROM users JOIN college ON users.college_id = college.collegeId JOIN university ON users.university_id = university.universityId JOIN city ON users.city_id = city.cityId JOIN collegeteachers ON users.userId = collegeteachers.user_id WHERE userId= $userId";

      } else{
        $sqlForCollege = "SELECT * FROM users JOIN college ON users.college_id = college.collegeId JOIN university ON users.university_id = university.universityId JOIN city ON users.city_id = city.cityId JOIN collegestudents ON users.userId = collegestudents.user_id WHERE userId= $userId";
        
      }
      $result1 = mysqli_query($conn,$sqlForCollege) or die("SQL Query Failed");
      if(mysqli_num_rows($result1)>0){
        $flag = true;
        $output1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
        echo json_encode($output1);
      }
    }
    if($schoolOrCollege == "school"){
      if($role == "teacher"){
        $sqlForSchool = "SELECT * FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId JOIN schooltype ON users.schooltype_id = schooltype.schooltypeId JOIN city ON users.city_id = city.cityId JOIN schoolteachers ON users.userId = schoolteachers.user_id WHERE userId= $userId";

      } else{
        $sqlForSchool = "SELECT * FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId JOIN schooltype ON users.schooltype_id = schooltype.schooltypeId JOIN city ON users.city_id = city.cityId JOIN schoolstudents ON users.userId = schoolstudents.user_id WHERE userId= $userId";
      }
      
      $result2 = mysqli_query($conn,$sqlForSchool) or die("SQL Query Failed");
      if(mysqli_num_rows($result2)>0){
        $flag = true;
        $output2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
        echo json_encode($output2);
      }
    } 
    
    
    if($flag == false){
      // echo json_encode(array('message'=>"No data found in neither school nor college" , 'status'=> false));
      echo json_encode(array('message'=>"Pending - yet to be filled" , 'status'=> false));

    }
?>