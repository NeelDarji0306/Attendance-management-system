<?php
  require './checkValidity.php';
// session_start();
// if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true || $_SESSION['userRole']!='student'){
//   header("Location:login.html");
// } else {
//   $currentTime = time();
//   if($currentTime > $_SESSION['expire']){
//         require '../api/_config.php';
//         session_unset();
//         session_destroy();
//         header("Location:login.html");
//     }else{
//         $_SESSION['start']=time();
//         $_SESSION['expire'] = $_SESSION['start'] + (60*60*24*4); //4days
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!--<link rel="stylesheet" href="../css/teacher-nav.css"> it will same work for students -->
    <link rel="stylesheet" href="../css/student-nav.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            /* background-color: #335b8d;
            background: linear-gradient(to bottom, #335b8d, #6696d1);  */
            background: linear-gradient(to right, #213c5f, #6696d1); 
            color: #fff;
            text-align: center;
            padding: 40px 0;
        }

        .container {
            max-width: 800px;
            margin: 80px auto; /* Adjusted margin to create space from the top */
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
        }

        .description {
            font-size: 18px;
            margin-bottom: 40px;
        }

        .btn {
            display: inline-block;
            background-color: #335b8d;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .animated {
            animation-duration: 2s;
            animation-fill-mode: both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .fadeIn {
            animation-name: fadeIn;
        }
    </style>
    <!-- <link rel="stylesheet" href="../css/teacher-home.css"> -->
    <title>home - welcome to attendance system</title>
  </head>
  <body>
    <?php include 'nav.html'; ?>
    <?php
      // echo "these are the session variables<br />";
      // var_dump($_SESSION['userId']);
      // echo "<br />";
      // var_dump($_SESSION['userRole']);
      // echo "<br />";
      // var_dump($_SESSION['loggedin']);
      // echo "<br />";
      // var_dump($_SESSION['start']);
      // echo "<br />";
      // var_dump($_SESSION['expire']);
      // echo "<br />";
      // var_dump($_SESSION['username']);
      // echo "<br />";
      // var_dump($_SESSION['userId']===1);
      // echo "<br />";
      // echo microtime();
      // echo "<br />";
      // function milliseconds(){
      //   $mt = explode(" ", microtime());
      //   return intval( $mt[1] * 1E3) + intval(round( $mt[0] * 1E3));
      // }
      // $time = milliseconds();
      // echo $time;
      // echo "<br />";

      // echo "make logout page,nav,teacher,student,pending,contanct us,about us, insta, wp, fb, etc";
    ?>
    <div class="header">
        <h1>Welcome, Student!</h1>
    </div>

    <div class="container animated fadeIn">
        <p class="description">View your attendance records...</p>
        <a href="attendance.php" class="btn">View Attendance Records</a>
    </div>






    <script src="../js/jquery.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/profile.js"></script>
    <script>
      
    // For changing the navigation bar's profile in nav whenever user updates his/her account
    $(document).ready(function() {
      if (sessionStorage.getItem("pp")) {
        let src = sessionStorage.getItem("pp");
        $("#pp-c>img").attr("src", "../" + src);
      } else {
        $("#pp-c>img").attr("src", "../" + "<?php echo $_SESSION['pp'] ?>");
      }

      if (sessionStorage.getItem("uname")) {
        let uname = sessionStorage.getItem("uname");
        $("#name-c").html(uname);
      } else {
        $("#name-c").html("<?php echo $_SESSION['username'] ?>");
      }


      
      const uId = "<?php echo $_SESSION['userInfo']['userId'] ?>";
      const role = "<?php echo $_SESSION['userInfo']['role'] ?>";
      const soc = "<?php echo $_SESSION['userInfo']['schoolOrCollege'] ?>";
      sessionStorage.setItem("userId", uId);
    });
    </script>
  </body>


</html> 