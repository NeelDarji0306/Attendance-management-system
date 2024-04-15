<?php
  require './checkValidity.php';
// require '../api/_config.php';
// session_start();
// if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true || $_SESSION['userRole'] != "admin"){
//   header("Location:login.html");
// } else {
//   $currentTime = time();
//   if($currentTime > $_SESSION['expire']){
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
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../css/admin-nav.css">
    <link rel="stylesheet" href="../css/admin-teachers.css">
    <title>home - welcome to attendance system</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

header {
    text-align: center;
    margin-bottom: 30px;
}

header h1 {
    font-size: 36px;
    color: #333;
    margin-bottom: 10px;
}

header p {
    font-size: 18px;
    color: #666;
}

.features {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.feature {
  text-decoration: none;
    width: calc(50% - 20px);
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.feature:hover {
    transform: translateY(-5px);
}

.feature h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.feature p {
    font-size: 16px;
    color: #666;
}

footer {
    text-align: center;
    margin-top: 50px;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

footer p {
    font-size: 14px;
    color: #666;
}

    </style>
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
   <div class="container">
        <header>
            <h1>Welcome, Admin!</h1>
            <p>Manage users, schools, colleges, and attendance records with ease.</p>
        </header>
        <main>
            <section class="features">
                <a class="feature" href="teachers.php">
                    <h2>Teacher Management</h2>
                    <p>Easily add, edit, or remove teachers from the system.</p>
                </a>
                <a class="feature" href="students.php">
                    <h2>Student Management</h2>
                    <p>Easily add, edit, or remove students from the system.</p>
                </a>
                <a class="feature" href="gradesUni.php">
                    <h2>Grade Management</h2>
                    <p>Add or remove Grade/Clg and School/Clg as needed.</p>
                </a>
                <a class="feature" href="attendance.php">
                    <h2>Attendance Tracking</h2>
                    <p>Efficiently track attendance records for each class.</p>
                </a>
            </section>
        </main>
        <footer>
            <p>&copy; 2024 Attendance Management System</p>
        </footer>
    </div>






    <script src="../js/jquery.js"></script>
    <!-- <script src="../js/nav.js"></script> -->
    <script src="../js/profile.js"></script>
    <script src="../js/admin-nav.js"></script>
    <script>
      
    // For changing the navigation bar's profile in nav whenever user updates his/her account
    $(document).ready(function() {


      const uId = "<?php echo $_SESSION['userInfo']['userId'] ?>";
      sessionStorage.setItem("userId", uId);


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
    });
    </script>
  </body>


</html> 