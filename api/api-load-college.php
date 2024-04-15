
<?php
    //to load all the colleges from database
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    
    $cityId = $data['city_id'];
    $uniId = $data['uni_id'];
    
    
    $sql = "SELECT * FROM college WHERE city_id = '$cityId' AND university_id = '$uniId' ";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);  

    
    } else{
            echo json_encode(array('message'=>"No College found for this city and Uni" , 'status'=> false));

    }
?>