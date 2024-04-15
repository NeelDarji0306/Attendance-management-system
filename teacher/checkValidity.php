<?php
require '../api/_config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true || $_SESSION['userRole']!='teacher'){
  header("Location:login.html");
} else {
  $currentTime = time();
  if($currentTime > $_SESSION['expire']){
        session_unset();
        session_destroy();
        header("Location:login.html");
    }else{
        $_SESSION['start']=time();
        $_SESSION['expire'] = $_SESSION['start'] + (60*60*24*4); //4days
    }
}
?>