
<?php
    //to load all the departments from database
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $data = json_decode(file_get_contents("php://input"),true);
    $sem = $data['sem'];
    $uid = $data['uni'];
    $dep = $data['dep'];

    // this is temp solution bcz we have not entered the data for uni greater than 5 uni id 
    // we can apply same logic for schools ...........
    if($uid > 5){
        $uid = 5;
    }
    // $sem = 2;
    // $uid = 2;
    // $dep = "Automobile Engineering";
    
    
    $sql = "SELECT sub FROM depsemsubasperuni WHERE dep='$dep' AND sem=$sem AND university_id=$uid";
    $result = mysqli_query($conn,$sql) or die("SQL Query Failed");

    if(mysqli_num_rows($result)>0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);  

    
    } else{
            echo json_encode(array('message'=>"No subject found" , 'status'=> false));

    }
?>