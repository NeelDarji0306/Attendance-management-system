
<?php
    //to fetch school/type based on search ...
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);

    $search = trim($data['search']);
    $page = $data['page'];
    $limit = $data['limit'];
    $start = ($page - 1) * $limit;
    // $search = trim($_GET['search']);
    $sql = "SELECT *,(SELECT COUNT(*) FROM schooltype JOIN schoolname ON schooltype.schooltypeId = schoolname.schooltype_id JOIN city ON schoolname.city_id=city.cityId WHERE cityName LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR schooltypeType LIKE '%{$search}%') AS len FROM schooltype JOIN schoolname ON schooltype.schooltypeId = schoolname.schooltype_id JOIN city ON schoolname.city_id=city.cityId WHERE cityName LIKE '%{$search}%' OR schoolnameName LIKE '%{$search}%' OR schooltypeType LIKE '%{$search}%' LIMIT $start,$limit";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

    
    } else{
            echo json_encode(array('message'=>"No uni/college/city Found" , 'status'=> false));

    }

?>