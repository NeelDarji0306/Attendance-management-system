
<?php
    //to load all the schools from database
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    
    $schlTypeId = $data['schlType_id'];
    $cityId = $data['city_id'];
    
    
    $sql = "SELECT * FROM schoolname WHERE schooltype_id = '$schlTypeId' AND city_id = '$cityId'";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);  

    
    } else{
            echo json_encode(array('message'=>"No University found for this city" , 'status'=> false));

    }
?>