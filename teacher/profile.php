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
  <link rel="stylesheet" href="../css/teacher-profile.css">
  <link rel="stylesheet" href="../profile-pic/pp.css">
  <!-- <link rel="stylesheet" href="../css/admin-teachers.css"> -->
  <title>Profile</title>
</head>

<body>
  <?php //include 'nav.html'; 
  ?>

  <!-- Popup Modal Box for View the full details -->
  <!-- <div id="view-modal" class="modal-class container">
    <div id="view-modal-div " class="container">
      <h2>Welcome <?php //echo $_SESSION['username'] 
                  ?></h2>
      <div id="load-view-table" class="container">
        <div class="pic-container"></div>
        <table cellpadding="10px" class="container" cellspacing="0" width="100%">
        </table>
      </div>
    </div>
  </div> -->
  <div class="container">
    <div id="load-view-table" class="mt-5 mb-0 ">
      <div class="pic-container pe-3">

      </div>
      <div class="container info ps-3">
        <!-- <div class="mx-auto mb-3">First Name</div>
        <div class="mx-auto mb-3">----</div> -->
      </div>
    </div>

    <div class="back-btn"><span id="back-pp-btn" class="material-symbols-outlined">arrow_back</span></div>
    <div class="edit-btn"><button type="button" name="edit-btn" id="edit-btn">Edit Profile</button></div>
  </div>
  <div class="error-message">error</div>
  <div class="success-message">success</div>
  <?php include '../profile-pic/pp.html'; ?>




  <script src="../js/jquery.js"></script>
  <script src="../js/nav.js"></script>
  <script src="../profile-pic/pp.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <?php
    if(isset($_GET['msg']) && trim($_GET['msg'])!=''){
      $msg = trim($_GET['msg']);
      
      unset($_GET['msg']);
      ?>
   <script>
     $(document).ready(function(){
       $(".error-message").hide();
       $(".success-message").fadeIn();
       $(".success-message").text("<?php echo $msg ?>");
       console.log("<?php echo $msg ?>");
       setTimeout(() => {
         $(".success-message").fadeOut();
         window.location = "http://localhost/Attendance-system/teacher/profile.php";
         
        }, 4000);
        
        
      });
      </script>
<?php
    unset($_GET['msg']);
  }
?>
  <script>
    $(document).ready(function() {


      // For changing the navigation bar's profile in nav whenever user updates his/her account
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











      const soc = "<?php echo $_SESSION['userInfo']['schoolOrCollege'] ?>";

      let obj = {
        userId: <?php echo $_SESSION['userInfo']['userId'] ?>,
        schoolOrCollege: "<?php echo $_SESSION['userInfo']['schoolOrCollege'] ?>",
        userRole: "<?php echo $_SESSION['userInfo']['role'] ?>"
      } // no use of userRoleObj

      let jsonString = JSON.stringify(obj);
      $.ajax({
        url: "http://localhost/Attendance-system/api/api-get-user-by-userId-and-schoolOrCollege.php",
        type: "POST",
        data: jsonString,
        success: function(data) {
          console.log(data);
          sessionStorage.setItem('pp', data[0].profilePic);
          console.log(sessionStorage.getItem('pp'));
          sessionStorage.setItem('uname', data[0].firstName + " " + data[0].lastName);
          console.log(sessionStorage.getItem('uname'));
          // $("#load-view-table table").append('<tr><td>hii1</td></tr>');
          // $("#load-view-table table").append('<tr><td>hii2</td></tr>');
          // $("#load-view-table table").append('<tr><td>hii3</td></tr>');
          // $("#load-view-table table").append('<tr><td>hii4</td></tr>');
          // $("#load-view-table table").append('<tr><td>hii5</td></tr>');

          if(soc=="college"){
            if (data[0].profilePic != "images/default.jpg") {
              $("#load-view-table .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> 
                      <div class="remove-profile-pic d-block mx-auto mb-3">
                        <button class='remove-profile-pic-btn d-block mx-auto mb-3' id='remove-profile-pic-btn-clg' type='button' style='cursor:pointer'><span class="material-symbols-outlined d-block mx-auto mb-3">
                          delete
                        </span></button>
                      </div>`);
            } else {
              $("#load-view-table .pic-container").html("<img class='d-block mx-auto mb-3' name='profilePic' src = '../" + data[0].profilePic + "' alt = 'profile_pic'> ");

            }

          } else{
            if (data[0].profilePic != "images/default.jpg") {
              $("#load-view-table .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> 
                      <div class="remove-profile-pic d-block mx-auto mb-3">
                        <button class='remove-profile-pic-btn d-block mx-auto mb-3' id='remove-profile-pic-btn-schl' type='button' style='cursor:pointer'><span class="material-symbols-outlined d-block mx-auto mb-3">
                          delete
                        </span></button>
                      </div>`);
            } else {
              $("#load-view-table .pic-container").html("<img class='d-block mx-auto mb-3' name='profilePic' src = '../" + data[0].profilePic + "' alt = 'profile_pic'> ");

            }

          }
          // $("#load-view-table .pic-container>img").attr("src", `../${data[0].profilePic}`);
          $.each(data, function(key, value) {
            let subTt = [];
            let uniqueSubTt = [];
            if(value.subjectTaught!='[]' && value.subjectTaught.trim()!='' && value.subjectTaught!='<p style="color:red">Pending - Yet to be filled by teacher </p>'){
              let objSubTt = JSON.parse(value.subjectTaught);
              $.each(objSubTt, function(k,v){
                subTt.push(v['sub']);
                
              });
              uniqueSubTt = [...new Set(subTt)];

            } else{
              uniqueSubTt = [...new Set(['<p style="color:red">Pending - Yet to be filled by teacher </p>'])];
            }

            if (value.schoolOrCollege == "college") {
              if ((value.university_id == undefined || value.university_id == null || value.university_id == "") && (value.college_id == undefined || value.college_id == null || value.college_id == "") &&
                (value.schoolname_id == undefined || value.schoolname_id == null || value.schoolname_id == "") &&
                (value.schooltype_id == undefined || value.schooltype_id == null || value.schooltype_id == "")) {
                $(".info").html(
                  "<tr>" +
                  "<td> <strong>First Name</strong> </td>" +
                  "<td>" + value.firstName + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Last Name</strong> </td>" +
                  "<td>" + value.lastName + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>City</strong> </td>" +
                  "<td>" + value.cityName + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Email</strong> </td>" +
                  "<td>" + value.email + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>College</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>University</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Department</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Subject Taught</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>"
                );
              } else {
                $(".info").html(

                  ` 
                          <div class="mx-auto fw-lighter fs-6">First Name</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.firstName}</div>
                          <div class="mx-auto fw-lighter fs-6">Last Name</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.lastName}</div>
                          <div class="mx-auto fw-lighter fs-6">Department</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.department}</div>
                          <div class="mx-auto fw-lighter fs-6">Subject Taught</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${uniqueSubTt}</div>
                          <div class="mx-auto fw-lighter fs-6">Email</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.email}</div>
                          <div class="mx-auto fw-lighter fs-6">Contact Number</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.phoneNumber}</div>
                          <div class="mx-auto fw-lighter fs-6">College</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.collegeName}</div>
                          <div class="mx-auto fw-lighter fs-6">University</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.universityName}</div>
                          <div class="mx-auto fw-lighter fs-6">City</div>
                          <div class="mx-auto mb-3 fs-4 fw-normal">${value.cityName}</div>
                          
                          `

                );

              }
            } else {
              if ((value.university_id == undefined || value.university_id == null || value.university_id == "") && (value.college_id == undefined || value.college_id == null || value.college_id == "") &&
                (value.schoolname_id == undefined || value.schoolname_id == null || value.schoolname_id == "") &&
                (value.schooltype_id == undefined || value.schooltype_id == null || value.schooltype_id == "")) {
                $("#load-view-table table").html(
                  "<tr>" +
                  "<td> <strong>First Name</strong> </td>" +
                  "<td>" + value.firstName + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Last Name</strong> </td>" +
                  "<td>" + value.lastName + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>City</strong> </td>" +
                  "<td>" + value.cityName + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Email</strong> </td>" +
                  "<td>" + value.email + "</td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>College</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>University</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Class Assigned</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>" +
                  "<tr>" +
                  "<td> <strong>Subject Taught</strong> </td>" +
                  "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                  "</tr>"
                );
              } else {
                $(".info").html(

                  ` 
                            <div class="mx-auto fw-lighter fs-6">First Name</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.firstName}</div>
                            <div class="mx-auto fw-lighter fs-6">Last Name</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.lastName}</div>
                            <div class="mx-auto fw-lighter fs-6">Class</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.classAssigned}</div>
                            <div class="mx-auto fw-lighter fs-6">Subject Taught</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${uniqueSubTt}</div>
                            <div class="mx-auto fw-lighter fs-6">Email</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.email}</div>
                            <div class="mx-auto fw-lighter fs-6">Contact Number</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.phoneNumber}</div>
                            <div class="mx-auto fw-lighter fs-6">School</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.schoolnameName}</div>
                            <div class="mx-auto fw-lighter fs-6">Type</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.schooltypeType}</div>
                            <div class="mx-auto fw-lighter fs-6">City</div>
                            <div class="mx-auto mb-3 fs-4 fw-normal">${value.cityName}</div>
                            
                            `
                );

              }
            }

          });
        }
      });



      // on click of edit button the control will go onto the update-profile page
      $("#edit-btn").on("click", function(e) {
        e.preventDefault();
        window.location = "http://localhost/Attendance-system/teacher/update-profile.php";
      });



      // on click of back button it will go to wherever it was previously
      $("#back-pp-btn").on("click", function(e) {
        e.preventDefault();
        // window.history.back();
        window.location = "http://localhost/Attendance-system/teacher/home.php";
      });








      
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
        // console.log(users.length);
        // it requires to set ```edit-college-teacher-user-id``` id when document is ready
        $("#delete-modal-clg").fadeIn(300);
        let uId = sessionStorage.getItem("userId");
        // let uIdObj = {userId : uId};
        // let uIdStr = JSON.stringify(uIdObj);

        $(("#ok-clg-btn")).data("id", uId);
      });
      $(document).on("click", "#ok-clg-btn", function() {
        // console.log($(this).data("id"));
        let uId = $(this).data("id");
        let uIdObj = {
          userId: uId
        };
        let uIdStr = JSON.stringify(uIdObj);
        // console.log("ok")
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-default-picture.php",
          type: "POST",
          data: uIdStr,
          success: function(data) {
            if (data.status == true) {
              sessionStorage.setItem('pp', 'images/default.jpg');
              // console.log(users);
              $(".container .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'>`);
            }
            // console.log(data.message);
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
        // console.log($(this).data("id"));
        let uId = $(this).data("id");
        let uIdObj = {
          userId: uId
        };
        let uIdStr = JSON.stringify(uIdObj);
        // console.log("ok")
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-default-picture.php",
          type: "POST",
          data: uIdStr,
          success: function(data) {
            if (data.status == true) {

              sessionStorage.setItem('pp', 'images/default.jpg');
              $(".container .pic-container").html("<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'>");
            }
            // console.log(data.message);
          }

        });
      });


    });
  </script>
</body>


</html>