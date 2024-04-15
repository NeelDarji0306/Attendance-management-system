
<?php
    //to fetch college teachers based on search ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $search = trim($data['search']);
    $role = trim($data['userRole']);
    $page = $data['page'];
    $limit = $data['limit'];
    $start = ($page - 1) * $limit;

    if($role=="teacher"){
        $sql = "SELECT *,(SELECT COUNT(*) FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR email LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR standard LIKE '%{$search}%')) AS len FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR email LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR standard LIKE '%{$search}%') ORDER BY userId DESC LIMIT $start,$limit";

    } else{
      $schlId = $data['schlId'];
      $standard = $data['classAssigned'];
      if($schlId){
        $sql = "SELECT *,(SELECT COUNT(*) FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId JOIN schoolstudents ON users.userId=schoolstudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR standard LIKE '%{$search}%') AND schoolname_id='$schlId' AND standard='$standard') AS len FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId JOIN schoolstudents ON users.userId=schoolstudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR standard LIKE '%{$search}%') AND schoolname_id='$schlId' AND standard='$standard' ORDER BY userId DESC LIMIT $start,$limit";

      }
        // $sql = "SELECT *,(SELECT COUNT(*) FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId JOIN schoolstudents ON users.userId=schoolstudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR standard LIKE '%{$search}%')) AS len FROM users JOIN schoolname ON users.schoolname_id = schoolname.schoolnameId JOIN schoolstudents ON users.userId=schoolstudents.user_id WHERE role='$role' AND (CONCAT(firstName,' ',lastName) LIKE '%{$search}%' OR rollNumber LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR standard LIKE '%{$search}%') AND schoolname_id='$schlId' ORDER BY userId DESC LIMIT $start,$limit";
    }
    
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No data found" , 'status'=> false));

    }

?>