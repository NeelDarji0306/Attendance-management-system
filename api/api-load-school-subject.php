
<?php
    //to load all the departments from database
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $std = $data['std'];
    $schlname_id = $data['schlname_id'];
    // $std = 1;
    // $schlname_id = 7;

    // this is temp solution bcz we have not entered the data for uni greater than 5 uni id 
    // we can apply same logic for schools ...........
    if($schlname_id > 5){
        $schlname_id = 5;
    }
    // $sem = 2;
    // $uid = 2;
    // $dep = "Automobile Engineering";
    
    
    $sql = "SELECT sub FROM stdsubasperschlname WHERE std='$std' AND schoolname_id=$schlname_id";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);  

    
    } else{
            echo json_encode(array('message'=>"No subject found" , 'status'=> false));

    }
?>