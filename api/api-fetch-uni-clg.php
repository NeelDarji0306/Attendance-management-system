
<?php
    //to fetch college teachers for displaying on screen ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $flag = false;
    $page = $data['page'];
    $limit = $data['limit'];
    // $role = $data['userRole'];
    // $page = 1;
    // $limit = 2;
    $start = ($page - 1) * $limit;
    
    $sql = "SELECT *,(SELECT COUNT(*) FROM university JOIN college ON university.universityId = college.university_id JOIN city ON university.city_id=city.cityId) AS len FROM university JOIN college ON university.universityId = college.university_id JOIN city ON university.city_id=city.cityId LIMIT $start,$limit";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No university/college data found" , 'status'=> false));

    }

?>