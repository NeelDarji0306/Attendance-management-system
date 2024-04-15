<?php
require './checkValidity.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="../css/teacher-nav.css">
  <link rel="stylesheet" href="../css/teacher-home.css">
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #335b8d;
            background: linear-gradient(to bottom, #335b8d, #6696d1); 
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
  <!-- <link rel="stylesheet" href="../css/admin-teachers.css"> -->
  <title>home - welcome to attendance system</title>
</head>

<body>
  <div class="alert-container position-fixed d-none">
    <div class="alert-c2 position-absolute top-0 start-50 translate-middle"></div>
  </div>
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
  // var_dump($_SESSION['userId'] === 1);
  // echo "<br />";
  // var_dump($_SESSION['schoolOrCollege']);
  // echo "<br />";
  // echo microtime();
  // echo "<br />";
  // function milliseconds()
  // {
  //   $mt = explode(" ", microtime());
  //   return intval($mt[1] * 1E3) + intval(round($mt[0] * 1E3));
  // }
  // $time = milliseconds();
  // echo $time;
  // echo "<br />";

  // echo "make logout page,nav,teacher,student,pending,contanct us,about us, insta, wp, fb, etc";
  ?>
  <div class="header">
        <h1>Welcome, Teacher!</h1>
    </div>

    <div class="container animated fadeIn">
        <p class="description">Manage students,attendance records, and more.</p>
        <a href="attendance.php" class="btn">View Attendance Records</a>
        <a href="students.php" class="btn">View Students Records</a>
    </div>






  <script src="../js/jquery.js"></script>
  <script src="../js/nav.js"></script>
  <script src="../js/profile.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

      let obj = {
        userId: uId,
        role: role,
        soc: soc
      } // no use of userRoleObj

      let jsonString = JSON.stringify(obj);
      $.ajax({
        url: "http://localhost/Attendance-system/api/api-get-subjectTaught-by-userId.php",
        type: "POST",
        data: jsonString,
        success: function(data) {
          console.log(data);
          if(data[0].subjectTaught==`<p style="color:red">Pending - Yet to be filled by teacher </p>` || data[0].subjectTaught == '[]'|| data[0].subjectTaught == `` ){
            // alert("Please complete your profile first...")
            $(".alert-container").removeClass("d-none");
            $(".alert-container").addClass("d-block");
            $(".alert-container > .alert-c2").html(
              `
              <div class="alert alert-primary" role="alert">
                Please complete your profile first by updating subject taught by you in respective class <a href="./manage-subject.php" class="alert-link">&nbsp;Go&nbsp;</a>.
              </div>
              `
            );
          } else{
          }
        }
      });
    });
  </script>
</body>


</html>