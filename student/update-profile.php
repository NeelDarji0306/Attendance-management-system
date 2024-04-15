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
  <link rel="stylesheet" href="../css/student-update-profile.css">
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
      const soc = "<?php echo $_SESSION['userInfo']['schoolOrCollege'] ?>";
      const uRole = "<?php echo $_SESSION['userInfo']['role'] ?>";

      let obj = {
        userId: uId,
        schoolOrCollege: soc,
        userRole: uRole
      } // no use of userRoleObj
      // console.log(soc); 
      let jsonString = JSON.stringify(obj);
      $.ajax({
        url: "http://localhost/Attendance-system/api/api-get-user-by-userId-and-schoolOrCollege.php",
        type: "POST",
        data: jsonString,
        success: function(data) {
          console.log(data);
          // $.session.set("pp", data[0].profilePic);
          // console.log($.session.get("pp"))
          // sessionStorage.pp = data[0].profilePic
          // $("#load-view-table table").append('<tr><td>hii1</td></tr>');
          $.each(data, function(key, value) {
            if (soc == "college") {
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
                    <input type="text" class="form-control fs-5" id="fname" placeholder="firstname" value="${value.firstName}" name="edit-college-student-fname">
                    <input type="hidden" name="edit-college-student-user-id" id="edit-college-student-user-id" value="${value.userId}">
                    <input type="hidden" name="edit-student-school-or-college" id="edit-student-school-or-college" value="${value.schoolOrCollege}">
                    <input type="hidden" name="edit-college-student-id" id="edit-college-student-id" value="${value.studentId}">
                    <input type="hidden" name="edit-college-teacher-or-student" id="edit-college-teacher-or-student" value="${'<?php echo $_SESSION['userRole'] ?>'}">
                  </div>
                  <div class="mb-3">
                    <label for="lname" class="form-label fs-6">Last Name</label>
                    <input type="text" class="form-control fs-5" name="edit-college-student-lname" id="lname" placeholder="lastname" value="${value.lastName}">
                  </div>
                  <div class="mb-3">
                    <label for="rollNo" class="form-label fs-6">Roll Number</label>
                    <input type="text" class="form-control fs-5" name="edit-college-student-rollNo" id="rollNo" placeholder="Roll number" value="${value.rollNumber}">
                  </div>
                  <select class="form-select mb-3 fs-5" name="edit-college-student-sem" id="sem" aria-label="Default select example">
                    <option selected disabled>---select city---</option>
                    ` + loadSem("#sem", value.sem) + `
                  </select>
                  <div class="mb-3">
                    <label for="email" class="form-label fs-6">Email address</label>
                    <input type="email" class="form-control fs-5" name="edit-college-student-email" id="email" placeholder="name@example.com" value="${value.email}">
                  </div>
                  <div class="mb-3">
                    <label for="cnumber" class="form-label fs-6">Contact Number</label>
                    <input type="number" class="form-control fs-5" name="edit-college-student-phoneNumber" id="cnumber" placeholder="Contact Number" value="${value.phoneNumber}">
                  </div>
                  <select class="form-select mb-3 fs-5" name="edit-college-student-city-select" id="city" aria-label="Default select example">
                    <option selected disabled>---select city---</option>
                    ` + loadCity("#city", value.cityId) + `
                  </select>
                  <select class="form-select mb-3 fs-5" name="edit-college-student-universityName-select" id="uni" aria-label="Default select example">
                    <option selected disabled>---select university---</option>
                    ` + loadUni("#uni", value.city_id, value.university_id) + `
                  </select>
                  <select class="form-select mb-3 fs-5" name="edit-college-student-collegeName-select" id="clg" aria-label="Default select example">
                    <option selected disabled>---select college---</option>
                    ` + loadClg("#clg", value.city_id, value.university_id, value.college_id) + `
                  </select>
                  <select class="form-select mb-3 fs-5" name="edit-college-student-department-select" id="dep" aria-label="Default select example">
                    <option selected disabled>---select branch---</option>
                    ` + loadDep("#dep", value.branch) + `
                  </select>
                  <button type="submit" class="btn btn-primary px-5 fs-5">Update</button>

                `
              );
            } else {
              if (data[0].profilePic != "images/default.jpg") {
                $(".container .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> <input class="d-block mx-auto mb-3 " type='file' name='profile-picture' id='profile-picture'>
                    <div class="remove-profile-pic d-block mx-auto mb-3">
                      <button class='remove-profile-pic-btn d-block mx-auto mb-3' id='remove-profile-pic-btn-schl' type='button' style='cursor:pointer'><span class="material-symbols-outlined d-block mx-auto mb-3">
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
                <input type="text" class="form-control fs-5" name="edit-school-student-fname" id="fname" placeholder="firstname" value="${value.firstName}">
                <input type="hidden" name="edit-school-student-user-id" id="edit-school-student-user-id" value="${value.userId}">
                <input type="hidden" name="edit-student-school-or-college" id="edit-student-school-or-college" value="${value.schoolOrCollege}">
                <input type="hidden" name="edit-school-student-id" id="edit-school-student-id" value="${value.studentId}">
                <input type="hidden" name="edit-school-teacher-or-student" id="edit-school-teacher-or-student" value="${'<?php echo $_SESSION['userRole'] ?>'}">
              </div>
              <div class="mb-3">
                <label for="lname" class="form-label fs-6">Last Name</label>
                <input type="text" name="edit-school-student-lname" class="form-control fs-5" id="lname" placeholder="lastname" value="${value.lastName}">
              </div>
                  <div class="mb-3">
                    <label for="rollNo" class="form-label fs-6">Roll Number</label>
                    <input type="text" class="form-control fs-5" name="edit-school-student-rollNo" id="rollNo" placeholder="Roll number" value="${value.rollNumber}">
                  </div>
              <div class="mb-3">
                <label for="email" class="form-label fs-6">Email address</label>
                <input type="email" class="form-control fs-5" name="edit-school-student-email" id="email" placeholder="name@example.com" value="${value.email}">
              </div>
              <div class="mb-3">
                <label for="cnumber" class="form-label fs-6">Contact Number</label>
                <input type="number" class="form-control fs-5" name="edit-school-student-phoneNumber" id="cnumber" placeholder="Contact Number" value="${value.phoneNumber}">
              </div>
              <select class="form-select mb-3 fs-5" name="edit-school-student-city-select" id="city" aria-label="Default select example">
                <option selected disabled>---select city---</option>
                ` + loadCity("#city", value.cityId) + `
              </select>
              <select class="form-select mb-3 fs-5" name="edit-school-student-schoolType-select" id="type" aria-label="Default select example">
                <option selected disabled>---select type---</option>
                ` + loadSchlType("#type", value.schooltype_id) + `
              </select>
              <select class="form-select mb-3 fs-5" name="edit-school-student-schoolName-select" id="school" aria-label="Default select example">
                <option selected disabled>---select school---</option>
                ` + loadSchlName("#school", value.schooltype_id, value.city_id, value.schoolname_id) + `
              </select>
              <select class="form-select mb-3 fs-5" name="edit-school-student-classAssigned-select" id="classAssigned" aria-label="Default select example">
                <option selected disabled>---select classAssigned---</option>
                ` + loadClass("#classAssigned", value.standard) + `
              </select>
              <button type="submit" class="btn btn-primary px-5 fs-5">Update</button>
          `
              );
            }
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
            ($("#email").val() == '' || $("#email").val() == undefined)) ||
          (($("#uni").val() == null || $("#uni").val() == undefined) && ($("#type").val() == null || $("#type").val() == undefined)) ||
          (($("#clg").val() == null || $("#clg").val() == undefined) && ($("#school").val() == null || $("#school").val() == undefined)) ||
          (($("#dep").val() == null || $("#dep").val() == undefined) && ($("#classAssigned").val() == null || $("#classAssigned").val() == undefined)) ||
          (($("#cnumber").val() == '' || $("#cnumber").val() == undefined) && ($("#cnumber").val() == '' || $("#cnumber").val() == undefined))
        ) {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else {

          $.ajax({
            url: "http://localhost/Attendance-system/api/api-update-students-details.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            async: false,
            success: function(data) {
              console.log(data);
              // console.log(data[0].role);
              if (data.status == false) {
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 4000);
              } else {
                
                // onLoad();

                // if(($("#fname").val() != '') || ($("#lname").val() == '' )){
                //   sessionStorage.setItem('uname', $("#fname").val() + " " + $("#lname").val());
                //   // console.log(sessionStorage.getItem('uname'));
                // }




                if($("#uni").val()!=null){
                  sessionStorage.setItem("uniId",$("#uni").val());

                }
                if($("#school").val()!=null){
                  sessionStorage.setItem("schlName",$("#school").val());

                }

                window.location = "http://localhost/Attendance-system/student/profile.php?msg="+`${data.message}`;
              }
            }
          });
        }
      });












      // on click of back button it will go to wherever it was previously
      $("#back-pp-btn").on("click", function(e) {
        e.preventDefault();
        window.location="http://localhost/Attendance-system/student/profile.php";
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




      // function to load the university
      function loadUni(id, city_id, uni_id) {
        let loadUniObj = {
          city_id: city_id
        };
        let loadUniStr = JSON.stringify(loadUniObj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-university.php",
          type: "POST",
          data: loadUniStr,
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (uni_id == value.universityId) {
                $(id).append(`<option value="${value.universityId}" selected>${value.universityName}</option>`);
              } else {
                $(id).append(`<option value="${value.universityId}" >${value.universityName}</option>`);

              }

            })
          }
        });
      }
      $(document).on("change", "#city", function() {
        defaultUni();
        loadUni("#uni", $("#city").val());
      });
      //default university
      function defaultUni() {
        $("#uni").html(
          "<option value='select-university' disabled selected>---select university---</option>");
      }




      // function to load the college
      function loadClg(id, city_id, uni_id, clg_id) {
        let loadClgObj = {
          city_id: city_id,
          uni_id: uni_id
        };
        let loadClgStr = JSON.stringify(loadClgObj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-college.php",
          type: "POST",
          data: loadClgStr,
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (clg_id == value.collegeId) {
                $(id).append(`<option value="${value.collegeId}" selected>${value.collegeName}</option>`);
              } else {
                $(id).append(`<option value="${value.collegeId}" >${value.collegeName}</option>`);

              }

            })
          }
        });
      }
      $(document).on("change", "#city", function() {
        defaultClg();

        if ($("#uni").val() == null) {
          defaultClg();
        } else {
          loadClg("#clg", $("#city").val(), $("#uni").val());

        }
      });
      $(document).on("change", "#uni", function() {
        defaultClg();
        loadClg("#clg", $("#city").val(), $("#uni").val());
      });
      //default college
      function defaultClg() {
        $("#clg").html(
          "<option value='select-college' disabled selected>---select college---</option>");
      }








      // function to load department
      function loadDep(id, department) {
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-department.php",
          type: "POST",
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (department == value.dep) {
                $(id).append(`<option value="${value.dep}" selected>${value.dep}</option>`);
              } else {
                $(id).append(`<option value="${value.dep}" >${value.dep}</option>`);

              }

            })
          }
        });
      }
      // default dep 
      // function defaultDep(){
      //   $("#dep").html(
      //                                 '<option value="select-branch" disabled selected>---select department---</option>'
      //   );
      // }




      // function to load the schooltype
      function loadSchlType(id, schlType_id) {
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-schoolType.php",
          type: "POST",
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (schlType_id == value.schooltypeId) {
                $(id).append(`<option value="${value.schooltypeId}" selected>${value.schooltypeType}</option>`);
              } else {
                $(id).append(`<option value="${value.schooltypeId}" >${value.schooltypeType}</option>`);

              }

            })
          }
        });
      }

      // function defaultSchlForAdd(){
      //   $("#schoolName").html(
      //     '<option value="select-school" disabled selected>---select school---</option>'
      //       );
      // }



      // function to load the schoolname
      function loadSchlName(id, schlType_id, city_id, schlName_id) {
        let loadSchlNameObj = {
          schlType_id: schlType_id,
          city_id: city_id
        };
        let loadSchlNameStr = JSON.stringify(loadSchlNameObj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-schoolName.php",
          type: "POST",
          data: loadSchlNameStr,
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (schlName_id == value.schoolnameId) {
                $(id).append(`<option value="${value.schoolnameId}" selected>${value.schoolnameName}</option>`);
              } else {
                $(id).append(`<option value="${value.schoolnameId}" >${value.schoolnameName}</option>`);

              }

            })
          }
        });
      }
      //defalut school name
      function defaultSchl() {
        $("#school").html(
          '<option value="select-school" disabled selected>---select school---</option>'
        );
      }
      $(document).on("change", "#type", function() {
        defaultSchl();
        loadSchlName("#school", $("#type").val(), $("#city").val());
      });
      $(document).on("change", "#city", function() {
        defaultSchl();
        loadSchlName("#school", $("#type").val(), $("#city").val());
      });





      // function to load class
      function loadClass(id, classAssigned) {
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-class.php",
          type: "POST",
          success: function(data) {
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            }
            $.each(data, function(key, value) {
              if (classAssigned == value.std) {
                $(id).append(`<option value="${value.std}" selected>${value.std}</option>`);
              } else {
                $(id).append(`<option value="${value.std}" >${value.std}</option>`);

              }

            })
          }
        });
      }
      
      function loadSem(id,sem){
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-sem.php",
          type:"POST",
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(sem == value.sem){
                $(id).append(`<option value="${value.sem}" selected>${value.sem}</option>`); 
              } else{
                $(id).append(`<option value="${value.sem}" >${value.sem}</option>`);

              }

            })
          }
        });
      }
      // default class 
      // function defaultClass(){
      //   $("#edit-school-teacher-class-select").html(
      //                                 '<option value="select-class" disabled selected>---select class---</option>'
      //   );
      // }







      // ADDED THIS IN SCRIPT TAG UPSIDE


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





      
      // It requires to set ```edit-college-student-user-id``` id when document is ready

      // to remove profile pic and set it to the default one ----> fix delete modal
      $(document).on("click", "#remove-profile-pic-btn-clg", function() {
        // console.log(users.length);
        // it requires to set ```edit-college-student-user-id``` id when document is ready
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
              $("#edit-form .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'> <input type='file' class='d-block mx-auto mb-3' name='profile-picture' id='profile-picture'>`);
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
              $("#edit-form .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'> <input type='file' class='d-block mx-auto mb-3' name='profile-picture' id='profile-picture'>`);
            }
            // console.log(data.message);
          }

        });
      });


    });
  </script>
</body>


</html>