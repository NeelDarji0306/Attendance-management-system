<?php
require './checkValidity.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- <link rel="stylesheet" href="../css/teacher-nav.css"> -->
  <!-- <link rel="stylesheet" href="../css/teacher-profile.css"> -->
  <link rel="stylesheet" href="../css/admin-update-profile.css">
  <link rel="stylesheet" href="../profile-pic/pp.css">
  <!-- <link rel="stylesheet" href="../css/admin-teachers.css"> -->
  <title>update profile</title>
</head>

<body>
  <?php //include 'nav.html'; 
  ?>

  <main>
    <div class="container ">
      <form action="" id="edit-form" class="update-from d-flex gap-5 mt-5">
        <div class="pic-container">
          <!-- <img src=".." class="d-block mx-auto mb-3 " alt="profile photo"> -->
        </div>
        <div class="input-container flex-grow-1">

      </form>

    </div>


  </main>
  <div class="back-btn"><span id="back-pp-btn" class="material-symbols-outlined">arrow_back</span></div>


  <div class="error-message">error</div>
  <div class="success-message">success</div>

  <?php
  // INCLUDING DELETE MODAL
  include '../profile-pic/pp.html'
  ?>







  <script src="../js/jquery.js"></script>
  <script src="../js/nav.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../profile-pic/pp.js"></script>
  <script>
    $(document).ready(function() {
      const uId = "<?php echo $_SESSION['userInfo']['userId'] ?>";
      const uRole = "<?php echo $_SESSION['userInfo']['role'] ?>";

      let obj = {
        userId: uId,
        userRole: uRole
      } // no use of userRoleObj

      let jsonString = JSON.stringify(obj);
      $.ajax({
        url: "http://localhost/Attendance-system/api/api-get-admin-details.php",
        type: "POST",
        data: jsonString,
        success: function(data) {
          // console.log(data);
          // $.session.set("pp", data[0].profilePic);
          // // console.log($.session.get("pp"))
          // sessionStorage.pp = data[0].profilePic
          // $("#load-view-table table").append('<tr><td>hii1</td></tr>');
          $.each(data, function(key, value) {
              if (data[0].profilePic != "images/default.jpg") {
                $(".container .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> <input class="d-block mx-auto mb-3 " type='file' name='profile-picture' id='profile-picture'>
                    <div class="remove-profile-pic d-block mx-auto mb-3">
                      <button class='remove-profile-pic-btn d-block mx-auto mb-3' id='remove-profile-pic-btn-clg' type='button' style='cursor:pointer'><span class="material-symbols-outlined d-block mx-auto mb-3">
                        delete
                      </span></button>
                    </div>`);
              } else {
                $(".container .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> <input type='file' class='d-block mx-auto mb-3' name='profile-picture' id='profile-picture'>`);
              }
              $(".container .input-container").html(
                `
                  <div class="mb-3">
                    <label for="fname" class="form-label fs-6">First Name</label>
                    <input type="text" class="form-control fs-5" id="fname" placeholder="firstname" value="${value.firstName}" name="fname">
                    <input type="hidden" name="edit-admin-id" id="edit-admin-id" value="${value.userId}">
                    <input type="hidden" name="edit-admin-role" id="edit-admin-role" value="${'<?php echo $_SESSION['userRole'] ?>'}">
                  </div>
                  <div class="mb-3">
                    <label for="lname" class="form-label fs-6">Last Name</label>
                    <input type="text" class="form-control fs-5" name="lname" id="lname" placeholder="lastname" value="${value.lastName}">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label fs-6">Email address</label>
                    <input type="email" class="form-control fs-5" name="email" id="email" placeholder="name@example.com" value="${value.email}">
                  </div>
                  <select class="form-select mb-3 fs-5" name="city" id="city" aria-label="Default select example">
                    <option selected disabled>---select city---</option>
                    ` + loadCity("#city", value.cityId) + `
                  </select>
                  
                  <button type="submit" class="btn btn-primary px-5 fs-5">Update</button>

                `
              );
            
          });
        }
      });


      //  // to update profile pic we will do a different thing?? 
      $(document).on("submit", "#edit-form", function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        // if nothing is entered by the user and he clicks login 
        if (
          (($("#fname").val() == '' || $("#fname").val() == undefined) &&
            ($("#fname").val() == '' || $("#fname").val() == undefined)) ||
          (($("#lname").val() == '' || $("#lname").val() == undefined) &&
            ($("#lname").val() == '' || $("#lname").val() == undefined)) ||
          (($("#city").val() == null || $("#city").val() == undefined) && ($("#city").val() == null || $("#city").val() == undefined)) ||
          (($("#email").val() == '' || $("#email").val() == undefined) &&
            ($("#email").val() == '' || $("#email").val() == undefined)) 
        ) {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else {
          $.ajax({
            url: "http://localhost/Attendance-system/api/api-update-admin-details.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            
            // async:false,
            success: function(data) {
              // console.log(data);
              // // console.log(data[0].role);
              if (data.status == false) {
                // // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 4000);
              } else {

                window.location = "http://localhost/Attendance-system/admin/profile.php?msg="+`${data.message}`;
              }
            }
          });
        }
      });












      // on click of back button it will go to wherever it was previously
      $("#back-pp-btn").on("click", function(e) {
        e.preventDefault();
        window.location="http://localhost/Attendance-system/admin/profile.php";
      });


      











      //function for loading city
      function loadCity(id, city_id) {
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-city.php",
          type: "POST",
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (city_id == value.cityId) {
                $(id).append(`<option value="${value.cityId}" selected>${value.cityName}</option>`);
              } else {
                $(id).append(`<option value="${value.cityId}" >${value.cityName}</option>`);

              }

            })
          }
        });
      }










      

      //Hide Modal Box
      $("#close-btn-remove-pp-clg").on("click", function() {
        $(".delete-modal").hide();
      });
      $("#close-btn-remove-pp-schl").on("click", function() {
        $(".delete-modal").hide();
      });

      // for remove pp
      $(document).on("click", "#cancel-clg-btn", function() {
        $("#delete-modal-clg").hide();

      });
      $(document).on("click", "#cancel-schl-btn", function() {
        $("#delete-modal-schl").hide();

      });

      // for remove pp
      $(document).on("click", "#ok-clg-btn", function() {
        $("#delete-modal-clg").hide();

      });
      $(document).on("click", "#ok-schl-btn", function() {
        $("#delete-modal-schl").hide();

      });





      
      // It requires to set ```edit-college-teacher-user-id``` id when document is ready

      // to remove profile pic and set it to the default one ----> fix delete modal
      $(document).on("click", "#remove-profile-pic-btn-clg", function() {
        // // console.log(users.length);
        // it requires to set ```edit-college-teacher-user-id``` id when document is ready
        $("#delete-modal-clg").fadeIn(300);
        let uId = sessionStorage.getItem("userId");
        // let uIdObj = {userId : uId};
        // let uIdStr = JSON.stringify(uIdObj);

        $(("#ok-clg-btn")).data("id", uId);
      });
      $(document).on("click", "#ok-clg-btn", function() {
        // // console.log($(this).data("id"));
        let uId = $(this).data("id");
        let uIdObj = {
          userId: uId
        };
        let uIdStr = JSON.stringify(uIdObj);
        // // console.log("ok")
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-default-picture.php",
          type: "POST",
          data: uIdStr,
          success: function(data) {
            if (data.status == true) {
              sessionStorage.setItem('pp', 'images/default.jpg');
              // // console.log(users);
              $("#edit-form .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'> <input type='file' class='d-block mx-auto mb-3' name='profile-picture' id='profile-picture'>`);
            }
            // // console.log(data.message);
          }

        });
      });

      $(document).on("click", "#remove-profile-pic-btn-schl", function() {

        $("#delete-modal-schl").fadeIn(300);
        
        let uId = sessionStorage.getItem("userId");
        // let uIdObj = {userId : uId};
        // let uIdStr = JSON.stringify(uIdObj);

        $(("#ok-schl-btn")).data("id", uId);
      });
      $(document).on("click", "#ok-schl-btn", function() {
        // // console.log($(this).data("id"));
        let uId = $(this).data("id");
        let uIdObj = {
          userId: uId
        };
        let uIdStr = JSON.stringify(uIdObj);
        // // console.log("ok")
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-default-picture.php",
          type: "POST",
          data: uIdStr,
          success: function(data) {
            if (data.status == true) {

              sessionStorage.setItem('pp', 'images/default.jpg');
              $("#edit-form .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'> <input type='file' class='d-block mx-auto mb-3' name='profile-picture' id='profile-picture'>`);
            }
            // // console.log(data.message);
          }

        });
      });




    });
  </script>
</body>


</html>