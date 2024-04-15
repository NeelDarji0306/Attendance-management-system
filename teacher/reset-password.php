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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!--<link rel="stylesheet" href="../css/teacher-nav.css"> it will same work for students -->
    <!-- <link rel="stylesheet" href="../css/student-nav.css">  -->
    <link rel="stylesheet" href="../css/reset-password.css">
    <title>reset password</title>
  </head>
  <body>
    <?php //include 'nav.html'; ?>
    <main>
      <div class="container mt-5">
        <div class="reset-msg fs-5 mb-5 fw-bold">Reset Your Password</div>
        <form id="reset-pass-form">
          <div class="mb-3">
            <label for="prev-password" class="form-label">Please enter your current password</label>
            <input type="text" class="form-control" id="prev-password">
            <span id="p-pass-err" class="text-danger d-none">* wrong password</span>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Enter New Password</label>
            <input type="password" class="form-control" id="password" placeholder="">
            <span id="pass-err" class="text-danger d-none">* password shoul be at least 8 characters long</span>
          </div>
          <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" placeholder="">
            <span id="c-pass-err" class="text-danger d-none">* password shoul be at least 8 characters long</span>
          </div>
          <button type="submit" id="reset-pass" class="btn btn-primary">Submit</button>
        </form>
  
      </div>

    </main>
    <div class="back-btn"><span id="back-pp-btn" class="material-symbols-outlined">arrow_back</span></div>

    <div class="error-message">error</div>
    <div class="success-message">success</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <!-- <script src="../js/nav.js"></script> -->
    <!-- <script src="../js/profile.js"></script> -->
    <script>
      
    // For changing the navigation bar's profile in nav whenever user updates his/her account
    $(document).ready(function() {




      
      // on click of back button it will go to wherever it was previously
      $("#back-pp-btn").on("click", function(e) {
        e.preventDefault();
        window.history.back();
      });







      $("#reset-pass-form").on("submit",function(e){
        e.preventDefault();
        let prevPass = $("#prev-password").val().trim();
        let pass = $("#password").val().trim();
        let cPass = $("#confirm-password").val().trim();
  
        // console.log(prevPass, pass, cPass);


        if(prevPass==""){
          $("#p-pass-err").removeClass("d-none").html("* This field is mendatory");
          $("#prev-password").val("");
        }else{
          $("#p-pass-err").addClass("d-none");
        }
        if(pass==""){
          $("#pass-err").removeClass("d-none").html("* This field is mendatory");
          $("#password").val("");
        }else if(pass.length < 8){
          $("#pass-err").removeClass("d-none").html("* password must be at least 8 character long");

        }else{
          $("#pass-err").addClass("d-none");
        }
        if(cPass==""){
          $("#c-pass-err").removeClass("d-none").html("* This field is mendatory");
          $("#confirm-password").val("");
        }else if(cPass.length < 8){
          $("#c-pass-err").removeClass("d-none").html("* password must be at least 8 character long");

        }else{
          $("#c-pass-err").addClass("d-none");
        }

        
        if(pass!="" && cPass!=""){
          
          if(pass != cPass){
            $("#c-pass-err").removeClass("d-none").html("* password and confirm-password did not match");
            
          } else{
            $("#c-pass-err").addClass("d-none");
            
          }
          if(pass.length<8){
            $("#pass-err").removeClass("d-none").html("* password must be at least 8 character long");
          }
          if(cPass.length<8){
            $("#c-pass-err").removeClass("d-none").html("* password must be at least 8 character long");
          }

        }


        let obj = {
          userId: sessionStorage.getItem("userId"),
          prevPass: prevPass,
          pass: pass
        }
        let jsonString = JSON.stringify(obj);
        if(prevPass.length>0 && pass==cPass && pass.length>=8 && cPass.length>=8){
          // console.log(jsonString);
          $.ajax({
          url: "http://localhost/Attendance-system/api/api-reset-password.php",
          type: "POST",
          data: jsonString,
          success: function(data) {
            // console.log(data);
            if(data.prevPassStatus==false){
              $("#p-pass-err").removeClass("d-none").html("* Wrong Password");

            } else if(data.status == false){
              
              $(".success-message").hide();
              $(".error-message").fadeIn();
              $(".error-message").text(data.message);
              setTimeout(() => {
                $(".error-message").fadeOut();
              }, 2500);
            } else{
              
              $(".error-message").hide();
              $(".success-message").fadeIn();
              $(".success-message").text(data.message);
              setTimeout(() => {
                $(".success-message").fadeOut();
              }, 2500);
              $("form#reset-pass-form").trigger("reset");
            }
          }

          });
        }
        
      });

    });
    </script>
  </body>


</html> 