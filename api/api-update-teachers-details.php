
<?php
    //to update users collegeteachers and schoolteachers............  
    require '_config.php';

    header('Content-Type: application/json'); // extra space ....................
    header('Access-Control-Allow-Origin: *');

    $schoolOrCollege = $_POST['edit-teacher-school-or-college'];
    
    function milliseconds(){
        $mt = explode(" ", microtime());
        return intval( $mt[1] * 1E3) + intval(round( $mt[0] * 1E3));
    }
    // $time = milliseconds();

    if($schoolOrCollege == "college"){
        $userIdClg = $_POST['edit-college-teacher-user-id'];
        $emailClg = $_POST['edit-college-teacher-email'];
        $fnameClg = $_POST['edit-college-teacher-fname'];
        $lnameClg = $_POST['edit-college-teacher-lname'];
        $cityClg = $_POST['edit-college-teacher-city-select'];
        $universityNameClg = $_POST['edit-college-teacher-universityName-select'];
        $collegeNameClg = $_POST['edit-college-teacher-collegeName-select'];
        $teacherIdClg = $_POST['edit-college-teacher-id'];
        $departmentClg = $_POST['edit-college-teacher-department-select'];
        $phoneNumberClg = $_POST['edit-college-teacher-phoneNumber'];

        $conn->begin_transaction();
        try{
            $flag = false;
            $path = "";
            if($_FILES['profile-picture']['name'] != ''){


                $filename = $_FILES['profile-picture']['name']; // Get the Uploaded file Name.
                
                $extension = pathinfo($filename,PATHINFO_EXTENSION); //Get the Extension of uploded file.
                
                $valid_extensions = array("jpg","jpeg","png","gif");
                
                if(in_array($extension, $valid_extensions)){ // check if upload file is a valid image file.
                    
                    $new_name = milliseconds() . "." . $extension;
                    $path .= "images/" . $new_name;
                    if(move_uploaded_file($_FILES['profile-picture']['tmp_name'], "../".$path)){ // Upload the Image File on server path
                        $flag = true;
                        
                    }
                
                }else{
                    echo '<script>alert("Invalid File Format.")</script>';
                }
            }
            $sqlForCollege1="";
            if($flag){
                $sql = "SELECT profilePic FROM users WHERE userId=$userIdClg";
                $result = $conn->query($sql) ;
                $row=mysqli_fetch_assoc($result);
                    if($result){
                        if($row['profilePic'] != "images/default.jpg"){
                            if(unlink("../".$row['profilePic'])){ // Delete the image from server path
                                // echo 'Image Deleted';
                                // echo json_encode(array('message'=>"andrandr!!!" , 'status'=> true));
                                
                                
                            }
                            // echo json_encode(array('message'=>"andr!!!" , 'status'=> true));
                        }

                    }
            }

            if($flag){
                $sqlForCollege1 = "UPDATE users SET email='$emailClg', firstName='$fnameClg', lastName='$lnameClg', profilePic= '$path', city_id ='$cityClg', university_id='$universityNameClg', college_id='$collegeNameClg' WHERE userId=$userIdClg";
            } else{
                $sqlForCollege1 = "UPDATE users SET email='$emailClg', firstName='$fnameClg', lastName='$lnameClg', city_id ='$cityClg', university_id='$universityNameClg', college_id='$collegeNameClg' WHERE userId=$userIdClg";

            }
            $resultSqlForCollege1 = $conn->query($sqlForCollege1) ;
            if(!$resultSqlForCollege1){
                throw new Exception("ERROR UPDATING TABLE1!");
            }

            
            $sqlForCollege2 ="UPDATE collegeteachers SET department='$departmentClg', phoneNumber='$phoneNumberClg' WHERE teacherId=$teacherIdClg" ;
            $resultSqlForCollege2 = $conn->query($sqlForCollege2) ;
            if(!$resultSqlForCollege2){
                throw new Exception("ERROR UPDATING TABLE2!");
            }

            $conn->commit();
            echo json_encode(array('message'=>"Updated succesfully!!!" , 'status'=> true, "soc"=>$schoolOrCollege));
        } catch(Exception $e){
            $conn->rollback();
            echo json_encode(array('message'=>"Something went wrong between 2 queries: ".$e->getMessage() , 'status'=> false));
        }
        
    }
    if($schoolOrCollege == "school"){
        $userIdSchl = $_POST['edit-school-teacher-user-id'];
        $emailSchl = $_POST['edit-school-teacher-email'];
        $fnameSchl = $_POST['edit-school-teacher-fname'];
        $lnameSchl = $_POST['edit-school-teacher-lname'];
        $citySchl = $_POST['edit-school-teacher-city-select'];
        $typeSchl = $_POST['edit-school-teacher-schoolType-select'];
        $schoolNameSchl = $_POST['edit-school-teacher-schoolName-select'];
        $teacherIdSchl = $_POST['edit-school-teacher-id'];
        $classSchl = $_POST['edit-school-teacher-classAssigned-select'];
        $phoneNumberSchl = $_POST['edit-school-teacher-phoneNumber'];

        $conn->begin_transaction();
        try{
            $flag2 = false;
            $path2 = "";
            if($_FILES['profile-picture']['name'] != ''){

                $filename2 = $_FILES['profile-picture']['name']; // Get the Uploaded file Name.
                
                $extension2 = pathinfo($filename2,PATHINFO_EXTENSION); //Get the Extension of uploded file.
                
                $valid_extensions2 = array("jpg","jpeg","png","gif");
                
                if(in_array($extension2, $valid_extensions2)){ // check if upload file is a valid image file.
                    $new_name2 = milliseconds() . "." . $extension2;
                    $path2 .= "images/" . $new_name2;
                    if(move_uploaded_file($_FILES['profile-picture']['tmp_name'], "../".$path2)){ // Upload the Image File on server path
                        $flag2 = true;
                        
                    }
                
                }else{
                    echo '<script>alert("Invalid File Format.")</script>';
                }
            }
            $sqlForSchool1="";
            if($flag2){
                $sql2 = "SELECT profilePic FROM users WHERE userId=$userIdSchl";
                $result2 = $conn->query($sql2) ;
                $row2=mysqli_fetch_assoc($result2);
                    if($result2){
                        if($row2['profilePic'] != "images/default.jpg"){
                            if(unlink("../".$row2['profilePic'])){ // Delete the image from server path
                                // echo 'Image Deleted';
                                // echo json_encode(array('message'=>"andrandr!!!" , 'status'=> true));
                            }
                            // echo json_encode(array('message'=>"andr!!!" , 'status'=> true));
                        }

                    }
            }
            if($flag2){
                $sqlForSchool1 = "UPDATE users SET email='$emailSchl', firstName='$fnameSchl', lastName='$lnameSchl',profilePic='$path2', city_id ='$citySchl', schooltype_id='$typeSchl', schoolname_id='$schoolNameSchl' WHERE userId=$userIdSchl";
            } else{
                $sqlForSchool1 = "UPDATE users SET email='$emailSchl', firstName='$fnameSchl', lastName='$lnameSchl', city_id ='$citySchl', schooltype_id='$typeSchl', schoolname_id='$schoolNameSchl' WHERE userId=$userIdSchl";

            }
            $resultSqlForSchool1  = $conn->query($sqlForSchool1) ;
            if(!$resultSqlForSchool1){
                throw new Exception("ERROR UPDATING TABLE1!");
            } 
            
            $sqlForSchool2 ="UPDATE schoolteachers SET classAssigned='$classSchl', phoneNumber='$phoneNumberSchl' WHERE teacherId=$teacherIdSchl" ;
            $resultSqlForSchool2 = $conn->query($sqlForSchool2) ;
            if(!$resultSqlForSchool2){
                throw new Exception("ERROR UPDATING TABLE2!");
            }

            $conn->commit();
            echo json_encode(array('message'=>"Updated succesfully!!!" , 'status'=> true, "soc"=>$schoolOrCollege));
        } catch(Exception $e){
            $conn->rollback();
            echo json_encode(array('message'=>"Something went wrong between 2 queries: ".$e->getMessage() , 'status'=> false));
        }
    } 
    
    
    
?>