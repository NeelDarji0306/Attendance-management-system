
<?php
    //to fetch college teachers based on search ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $search = trim($data['search']);
    $role = $data['userRole'];
    $page = $data['page'];
    $limit = $data['limit'];
    $start = ($page - 1) * $limit;
    // $search = trim($_GET['search']);
    $sql = "";
    if($role=="teacher"){
        $sql .= "SELECT *,(SELECT COUNT(*) FROM users JOIN college ON users.college_id = college.collegeId JOIN collegeteachers ON users.userId=collegeteachers.user_id WHERE (collegeteachers.subjectTaught='' OR collegeteachers.subjectTaught='[]' OR collegeteachers.subjectTaught='<p style=\"color:red\">Pending - Yet to be filled by teacher </p>') AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR email LIKE '%{$search}%' OR collegeName LIKE '%{$search}%' OR sem LIKE '%{$search}%')) AS len FROM users JOIN college ON users.college_id = college.collegeId JOIN collegeteachers ON users.userId=collegeteachers.user_id WHERE (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR email LIKE '%{$search}%' OR collegeName LIKE '%{$search}%' OR sem LIKE '%{$search}%') AND (collegeteachers.subjectTaught='' OR collegeteachers.subjectTaught='[]' OR collegeteachers.subjectTaught='<p style=\"color:red\">Pending - Yet to be filled by teacher </p>') ORDER BY userId DESC LIMIT $start,$limit";

    } else{
      $clgId = $data['clgId'];
      $branch = $data['branch'];
      if($clgId){
        $sql .= "SELECT *,(SELECT COUNT(*) FROM users JOIN college ON users.college_id = college.collegeId JOIN collegestudents ON users.userId=collegestudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR collegeName LIKE '%{$search}%' OR sem LIKE '%{$search}%') AND users.college_id='$clgId' AND branch='$branch') AS len FROM users JOIN college ON users.college_id = college.collegeId JOIN collegestudents ON users.userId=collegestudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR collegeName LIKE '%{$search}%' OR sem LIKE '%{$search}%') AND users.college_id='$clgId' AND branch='$branch' ORDER BY userId DESC LIMIT $start,$limit";

      }
        // $sql = "SELECT *,(SELECT COUNT(*) FROM users JOIN college ON users.college_id = college.collegeId JOIN collegestudents ON users.userId=collegestudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR collegeName LIKE '%{$search}%' OR sem LIKE '%{$search}%')) AS len FROM users JOIN college ON users.college_id = college.collegeId JOIN collegestudents ON users.userId=collegestudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR collegeName LIKE '%{$search}%' OR sem LIKE '%{$search}%') ORDER BY userId DESC LIMIT $start,$limit";
    }
    // $sql = "SELECT * FROM users JOIN college ON users.college_id = college.collegeId WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR email LIKE '%{$search}%' OR collegeName LIKE '%{$search}%') ORDER BY userId DESC";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No data found" , 'status'=> false));

    }

?>