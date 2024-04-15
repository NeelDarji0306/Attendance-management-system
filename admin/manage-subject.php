
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
  <link rel="stylesheet" href="../css/teacher-manage-subject.css">
  <link rel="stylesheet" href="../profile-pic/pp.css">
  <!-- <link rel="stylesheet" href="../css/admin-teachers.css"> -->
  <title>manage subject</title>
</head>

<body>
  <?php //include 'nav.html'; 
  ?>

  <main>
    <!-- template to add subject taught for college teacher  -->
    <!-- <div class="add-college-subject container mb-5" id="add-college-subject">

    </div> -->

    <!-- template to add subject taught for school teacher  -->
    <!-- <div class="add-school-subject container mb-5" id="add-school-subject">
      
    </div> -->

    <!-- <div class="border border-top-0 border-start-0 border-end-0 mb-3"></div> -->

    <!-- template to see/remove subject taught for college teacher  -->
    <!-- <div class="container mt-5" id="view-college-subject">
      
    </div> -->
    <!-- template to see/remove subject taught for school teacher  -->
    <!-- <div class="container mt-5" id="view-school-subject">
      
    </div> -->


  </main>
  <div class="back-btn"><span id="back-pp-btn" class="material-symbols-outlined">arrow_back</span></div>


  <?php // include '../profile-pic/pp.html'; ?>
  <!-- it contains this html  -->
  <!-- Popup Modal Box for Remove Clg teacher pp  -->
  <div class="delete-modal modal-class" id="delete-modal-clg">
    <div class="delete-modal-div">
      <div class="message">
        <p>
        <h2>Are you sure you want to delete this?</h2>
        </p>
      </div>
      <div class="btn-container">
        <div class="ok-btn"><input type="button" id="ok-clg-btn" value="Yes"></div>
        <div class="cancel-btn"><input type="button" id="cancel-clg-btn" value="No"></div>

      </div>

      <div class="close-btn" id="close-btn-remove-pp-clg">X</div>
    </div>
  </div>
  <!-- Popup Modal Box for Remove Schl teacher pp -->
  <div class="delete-modal modal-class" id="delete-modal-schl">
    <div class="delete-modal-div">
      <div class="message">
        <p>
        <h2>Are you sure you want to delete this?</h2>
        </p>
      </div>
      <div class="btn-container">
        <div class="ok-btn"><input type="button" id="ok-schl-btn" value="Yes"></div>
        <div class="cancel-btn"><input type="button" id="cancel-schl-btn" value="No"></div>

      </div>

      <div class="close-btn" id="close-btn-remove-pp-schl">X</div>
    </div>
  </div>
  <div class="error-message">error</div>
  <div class="success-message">success</div>








  <script src="../js/jquery.js"></script>
  <script src="../js/nav.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- <script src="../profile-pic/pp.js"></script> -->
  <script>
    $(document).ready(function() {





      
      // on click of back button it will go to wherever it was previously
      $("#back-pp-btn").on("click", function(e) {
        e.preventDefault();
        // window.location="http://localhost/Attendance-system/teacher/profile.php";
        window.history.back();
      });













      // to add a pop up msg when teacher wants to remove something
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



























      const uId = "<?php echo $_GET['uid'] ?>";
      const role = "<?php echo $_GET['role'] ?>";
      const soc = "<?php echo $_GET['soc'] ?>";
      let uni;
      let schlname;
      if(soc=="college"){
        uni = "<?php echo $_GET['uni'] ?>" || "";
      }
      if(soc=="school"){
        schlname = "<?php echo $_GET['schlname'] ?>" || "";
      }
      // if (sessionStorage.getItem("uniId")) {
      //   uni = sessionStorage.getItem("uniId");
      // } else {
      //   uni = "<?php //echo $_SESSION['userInfo']['university_id'] ?>";
      // }
      // if (sessionStorage.getItem("schlName")) {
      //    = sessionStorage.getItem("schlName");
      // } else {
      //   schlname = "<?php //echo $_SESSION['userInfo']['schoolname_id'] ?>";
      // }


      if (soc == "college") {
        $("main").html(

          `
          <div class="add-college-subject container mb-5" id="add-college-subject">
            <form>
              <div class="mb-3 mt-5">
                <label for="sem" class="form-label fw-lighter">Select Semester</label>
                <select class="form-select form-select-sm" id="sem" aria-label="Small select example">
                  <option selected disabled>--select sem--</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="dep" class="form-label fw-lighter">Select Department</label>
                <select class="form-select form-select-sm" id="dep" aria-label="Small select example">
                  <option selected disabled>--select department--</option>
                  ` + loadDep("#dep") + `
                </select>
              </div>

              <div class="mb-3">
                <label for="lab-or-lec" class="form-label fw-lighter">Are you allocated to take Lab or Lecture?</label>
                <select class="form-select form-select-sm" id="lab-or-lec" aria-label="Small select example">
                  <option selected disabled>--lab or lec--</option>
                  <option value="lab">Lab</option>
                  <option value="lec">Lecture</option>
                </select>
              </div>
              <div class="mb-3 ">
                <label for="subject" class="form-label fw-lighter">Select Subject</label>
                <select class="form-select form-select-sm" id="subject" aria-label="Small select example">
                  <option selected disabled>--select subject--</option>
                  ` + loadClgSub("#subject", $("#sem").val(), uni, $("#dep").val()) + ` 
                </select>
                <button type="submit" class="add-sub-btn btn btn-primary mt-3" id="add-clg-sub-btn">ADD</button>
              </div>
            </form>
          </div>


          <div class="border border-top-0 border-start-0 border-end-0 mb-3"></div>

          <div class="container mt-5 text-capitalize" id="view-college-subject">

          </div>
          `
        );
        
      } else {

        $("main").html(

          `
          <div class="add-school-subject container mb-5" id="add-school-subject">
            <form>
              <div class="mb-3 mt-5">
                <label for="std" class="form-label fw-lighter">Select Standard</label>
                <select class="form-select form-select-sm" id="std" aria-label="Small select example">
                  <option selected disabled>--select standard--</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11th-arts">11th-arts</option>
                  <option value="12th-arts">12th-arts</option>
                  <option value="11th-com">11th-com</option>
                  <option value="12th-com">12th-com</option>
                  <option value="11th-sci-a">11th-sci-a</option>
                  <option value="12th-sci-a">12th-sci-a</option>
                  <option value="11th-sci-b">11th-sci-b</option>
                  <option value="12th-sci-b">12th-sci-b</option>
                </select>
              </div>
              <div class="mb-3 ">
                <label for="subject" class="form-label fw-lighter">Select Subject</label>
                <select class="form-select form-select-sm" id="subject" aria-label="Small select example">
                  <option selected disabled>--select subject--</option>
                  ` + loadSchlSub("#subject", $("#std").val(), schlname) + `
                </select>
                <button type="submit" class="add-sub-btn btn btn-primary mt-3" id="add-schl-sub-btn">ADD</button>
              </div>

            </form>
          </div>


          <div class="border border-top-0 border-start-0 border-end-0 mb-3"></div>

          <div class="container mt-5 text-capitalize" id="view-school-subject">

          </div>
          `
        );


      }

      let obj = {
        userId: uId,
        role: role,
        soc: soc
      } // no use of userRoleObj

      let jsonString = JSON.stringify(obj);
      onLoad();

      function onLoad() {

        $.ajax({
          url: "http://localhost/Attendance-system/api/api-get-subjectTaught-by-userId.php",
          type: "POST",
          data: jsonString,
          success: function(data) {
            console.log(data);
            sessionStorage.setItem("teacherId", data[0].teacherId);
            if (data[0].subjectTaught == `<p style="color:red">Pending - Yet to be filled by teacher </p>`|| data[0].subjectTaught == '[]'|| data[0].subjectTaught == ``) {
              // alert("Please complete your profile first...")
              console.log("Need to addd");
              $("#view-college-subject").html("");
              $("#view-school-subject").html("");

            } else {
              
              let sub = JSON.parse(data[0].subjectTaught);
              console.log(sub);
              console.log("you can remove or add");
              if (soc == "college") {
                $("#view-college-subject").html(`<div class="msg fs-3 pb-3">Subjects taken by you in respective department</div>`);
                $.each(sub, function(key, value) {
                  $("#view-college-subject").append(
                    `
                    <div class="view-college-subject-container container border position-relative">
                      <div class="mb-3 mt-4 d-flex gap-4">
                        <label for="sem" class="form-label fw-bold" style="min-width: 121px;">Semester</label>
                        <div id="sem">` + value.sem + `</div>
                      </div>
                      <div class="mb-3 d-flex gap-4">
                        <label for="dep" class="form-label fw-bold" style="min-width: 121px;">Department</label>
                        <div id="dep">` + value.dep + `</div>
                      </div>
                      <div class="mb-3 d-flex gap-4">
                        <label for="lab-or-lec" class="form-label fw-bold" style="min-width: 121px;">Lab or Lecture?</label>
                        <div id="lab-or-lec">` + value.laborlec + `</div>
                      </div>
                      <div class="mb-3 d-flex gap-4">
                        <label for="subject" class="form-label fw-bold" style="min-width: 121px;">Subject</label>
                        <div id="subject">` + value.sub + `</div>
                        <button type="submit" id="remove-clg-sub-btn" data-tid="${data[0].teacherId}" 
                                                                      data-sem="${value.sem}"
                                                                      data-dep="${value.dep}"
                                                                      data-laborlec="${value.laborlec}"
                                                                      data-sub="${value.sub}"
                        class="remove-sub-btn btn btn-primary mt-3 me-3 position-absolute top-0 end-0">Remove</button>
                      </div>
                    </div>
                    `
                  );

                });

              } else {
                $("#view-school-subject").html(`<div class="msg fs-3 pb-3">Subjects taken by you in respective standard</div>`);
                $.each(sub, function(key, value) {
                  $("#view-school-subject").append(
                    `
                    <div class="view-school-subject-container container border position-relative">
                      <div class="mb-3 mt-4 d-flex gap-4">
                        <label for="std" class="form-label fw-bold" style="min-width: 121px;">Standard</label>
                        <div id="std">` + value.std + `</div>
                      </div>
                      <div class="mb-3 d-flex gap-4">
                        <label for="subject" class="form-label fw-bold" style="min-width: 121px;">Subject</label>
                        <div id="subject">` + value.sub + `</div>
                        <button type="submit" id="remove-schl-sub-btn" data-tid="${data[0].teacherId}" 
                                                                              data-std="${value.std}"
                                                                              data-sub="${value.sub}"
                                  class="remove-sub-btn btn btn-primary mt-3 me-3 position-absolute top-0 end-0">Remove</button>
                      </div>
                    </div>
                    `
                  );

                });



              }
            }
          }
        });
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

      // function to load subject corresponds to department
      function loadClgSub(id, sem, uni, department) {
        let loadSubObj = {
          dep: department,
          sem: sem,
          uni: uni
        };
        let loadSubStr = JSON.stringify(loadSubObj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-college-subject.php",
          type: "POST",
          data: loadSubStr,
          success: function(data) {
            // console.log(data);
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            } else {
              // splitting data into array of subjucts
              data = data[0].sub.split(",");
              // console.log(data)

            }
            $.each(data, function(key, value) {

              $(id).append(`<option value="${value}" >${value}</option>`);



            })
          }
        });
      }

      // default load subject
      function defaultClgSub() {
        $("#subject").html(
          '<option value="select-school" disabled selected>---select school---</option>'
        );
      }


      // on change of sem and dep we will load correspondding subjects
      $(document).on("change", "#sem", function() {
        defaultClgSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadClgSub("#subject", $("#sem").val(), uni, $("#dep").val());
        // console.log(uni)
        // console.log($("#sem").val())
        // console.log($("#dep").val())

        // }
      });
      $(document).on("change", "#dep", function() {
        defaultClgSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadClgSub("#subject", $("#sem").val(), uni, $("#dep").val());
        // console.log(uni)
        // console.log($("#sem").val())
        // console.log($("#dep").val())

        // }
      });




      // loading school subject regardless whaterver school it is just because we have enterd only 5 schools subjects and all of them are exactly sem if i will give it to any school then i might do it properly
      function loadSchlSub(id, std, schlname) {
        let loadSubObj = {
          std: std,
          schlname_id: schlname
        };
        let loadSubStr = JSON.stringify(loadSubObj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-load-school-subject.php",
          type: "POST",
          data: loadSubStr,
          success: function(data) {
            console.log(data);
            if (data.status == false) {
              $(id).append(`<option value="${data.message}">${data.message}</option>`);
            } else {
              // splitting data into array of subjucts
              data = data[0].sub.split(",");
              // console.log(data)

            }
            $.each(data, function(key, value) {

              $(id).append(`<option value="${value}" >${value}</option>`);



            });
          }
        });

      }

      // default load subject for school
      function defaultSchlSub() {
        $("#subject").html(
          '<option value="select-school" disabled selected>---select school---</option>'
        );
      }


      // on change of sem and dep we will load correspondding subjects
      $(document).on("change", "#std", function() {
        defaultSchlSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadSchlSub("#subject", $("#std").val(), schlname);
        console.log(schlname)
        // console.log($("#sem").val())
        // console.log($("#dep").val())

        // }
      });





      // to add the subject (clg teacher)
      $(document).on("click", "#add-clg-sub-btn", function(e) {
        e.preventDefault();
        if ($("#sem").val() == null || $("#dep").val() == null || $("#lab-or-lec").val() == null || $("#subject").val() == null) {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 1800);
        } else {

          let obj = {
            sem: `${$("#sem").val()}`, // aama by default j string che
            dep: $("#dep").val(),
            laborlec: $("#lab-or-lec").val(),
            sub: $("#subject").val(),
            tid: sessionStorage.getItem("teacherId"), // aama by default j string che
          } // no use of userRoleObj
          // console.log(obj);
          let jsonString = JSON.stringify(obj);
          let actualJson = {
            jstring: jsonString,
            tid: sessionStorage.getItem("teacherId")
          };
          let actualJsonStr = JSON.stringify(actualJson);
          $.ajax({
            url: "http://localhost/Attendance-system/api/api-add-clg-subject.php",
            type: "POST",
            data: actualJsonStr,
            success: function(data) {
              console.log(data);
              if (data.status == false) {
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 3000);
              } else {
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 3000);
                $("form").trigger("reset");
                onLoad();
              }
            }
          });

        }
      });




      // to add the subject (schl teacher)
      $(document).on("click", "#add-schl-sub-btn", function(e) {
        e.preventDefault();
        if ($("#std").val() == null || $("#subject").val() == null) {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 1800);
        } else {

          let obj = {
            // std: `${$("#std").val()}`, // aama by default j string che
            std: $("#std").val(), // aama by default j string che
            sub: $("#subject").val(),
            tid: sessionStorage.getItem("teacherId"), // aama by default j string che
          } // no use of userRoleObj
          console.log(obj);
          let jsonString = JSON.stringify(obj);
          let actualJson = {
            jstring: jsonString,
            tid: sessionStorage.getItem("teacherId")
          };
          let actualJsonStr = JSON.stringify(actualJson);
          $.ajax({
            url: "http://localhost/Attendance-system/api/api-add-schl-subject.php",
            type: "POST",
            data: actualJsonStr,
            success: function(data) {
              console.log(data);
              if (data.status == false) {
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 3000);
              } else {
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 3000);
                $("form").trigger("reset");
                onLoad();
              }
            }
          });

        }
      });



      
      // // It requires to set ```edit-college-teacher-user-id``` id when document is ready
      // $(document).on("click", "#remove-schl-sub-btn", function() {
  
      //   $("#delete-modal-schl").fadeIn(300);
      //   let uId = $("#edit-school-teacher-user-id").val();
      //   if($("#edit-school-teacher-user-id").val() == undefined){
      //     uId = sessionStorage.getItem("userId");
      //   }
      //   // let uIdObj = {userId : uId};
      //   // let uIdStr = JSON.stringify(uIdObj);
  
      //   $(("#ok-schl-btn")).data("id", uId);
      //   });
      //   $(document).on("click", "#ok-schl-btn", function() {
      //   // console.log($(this).data("id"));
      //   let uId = $(this).data("id");
      //   let uIdObj = {
      //     userId: uId
      //   };
      //   let uIdStr = JSON.stringify(uIdObj);
      //   // console.log("ok")
      //   $.ajax({
      //     url: "http://localhost/Attendance-system/api/api-default-picture.php",
      //     type: "POST",
      //     data: uIdStr,
      //     success: function(data) {
      //       if (data.status == true) {
  
      //         $("#edit-form .pic-container").html("<img name='profilePic' src = '../images/default.jpg' alt = 'profile_pic' height = '200px'> <input type='file' name='profile-picture' id='profile-picture'>");
      //       }
      //       // console.log(data.message);
      //     }
  
      //   });
      // });


      // to remove the subject if teacher may added it by mistake 
      // $(document).on("click", "#remove-clg-sub-btn", function() {

      //   let obj = {
      //     sem: `${$(this).data("sem")}`, // apde jate string krvu pde
      //     dep: $(this).data("dep"),
      //     laborlec: $(this).data("laborlec"),
      //     sub: $(this).data("sub"),
      //     tid: `${$(this).data("tid")}` // apde jate string krvu pde
      //   } // no use of userRoleObj

      //   let jsonString = JSON.stringify(obj);
      //   let actualJson = {
      //     jstring: jsonString,
      //     tid: $(this).data("tid")
      //   };
      //   let actualJsonStr = JSON.stringify(actualJson);
      //   console.log(obj);
      //   console.log(actualJson);
      //   $.ajax({
      //     url: "http://localhost/Attendance-system/api/api-remove-clg-subject.php",
      //     type: "POST",
      //     data: actualJsonStr,
      //     success: function(data) {
      //       console.log(data);
      //       if (data.status == false) {
      //         // console.log("in");
      //         $(".success-message").hide();
      //         $(".error-message").fadeIn();
      //         $(".error-message").text(data.message);
      //         setTimeout(() => {
      //           $(".error-message").fadeOut();
      //         }, 3000);
      //       } else {
      //         $(".error-message").hide();
      //         $(".success-message").fadeIn();
      //         $(".success-message").text(data.message);
      //         setTimeout(() => {
      //           $(".success-message").fadeOut();
      //         }, 3000);
      //         $("form").trigger("reset");
      //         onLoad();
      //       }
      //     }
      //   });
      // });



      
      
      // to remove the subject if teacher may added it by mistake 
      // // to remove profile pic and set it to the default one ----> fix delete modal
      $(document).on("click", "#remove-clg-sub-btn", function() {
        
        $("#delete-modal-clg").fadeIn(300);
        let obj = {
          sem: `${$(this).data("sem")}`,     // apde jate string krvu pde
          dep: $(this).data("dep"),
          laborlec: $(this).data("laborlec"),
          sub: $(this).data("sub"),
          tid:`${$(this).data("tid")}`           // apde jate string krvu pde
        } // no use of userRoleObj

        let jsonString = JSON.stringify(obj);
        let actualJson = {jstring: jsonString, tid:$(this).data("tid")};
        let actualJsonStr = JSON.stringify(actualJson);
        // console.log(obj);
        // console.log(actualJson);
        // let uIdObj = {userId : uId};
        // let uIdStr = JSON.stringify(uIdObj);

        $(("#ok-clg-btn")).data("jsnoStr", actualJsonStr);
      });
      $(document).on("click", "#ok-clg-btn", function() {
        console.log($(this).data("jsnoStr"));
        let actualJsonStr = $(this).data("jsnoStr");
        // let obj = JSON.parse(actualJsonStr);
        // console.log(obj);
        // let str = JSON.stringify(obj);
        // console.log(actualJsonStr);
        // console.log(str);
        $.ajax({
            url: "http://localhost/Attendance-system/api/api-remove-clg-subject.php",
            type: "POST",
            data: actualJsonStr,
            success: function(data) {
              console.log(data);
              if (data.status == false) {
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 3000);
              } else {
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 3000);
                $("form").trigger("reset");
                onLoad();
              }
            }
        });
      });


      // // to remove profile pic and set it to the default one ----> fix delete modal
      $(document).on("click", "#remove-schl-sub-btn", function() {
        
        $("#delete-modal-schl").fadeIn(300);
        let obj = {
          std: `${$(this).data("std")}`,     // apde jate string krvu pde
          sub: $(this).data("sub"),
          tid:`${$(this).data("tid")}`           // apde jate string krvu pde
        } // no use of userRoleObj

        let jsonString = JSON.stringify(obj);
        let actualJson = {jstring: jsonString, tid:$(this).data("tid")};
        let actualJsonStr = JSON.stringify(actualJson);
        // console.log(obj);
        // console.log(actualJson);
        // let uIdObj = {userId : uId};
        // let uIdStr = JSON.stringify(uIdObj);

        $(("#ok-schl-btn")).data("jsnoStr", actualJsonStr);
      });
      $(document).on("click", "#ok-schl-btn", function() {
        console.log($(this).data("jsnoStr"));
        let actualJsonStr = $(this).data("jsnoStr");
        // let obj = JSON.parse(actualJsonStr);
        // console.log(obj);
        // let str = JSON.stringify(obj);
        // console.log(actualJsonStr);
        // console.log(str);
        $.ajax({
            url: "http://localhost/Attendance-system/api/api-remove-schl-subject.php",
            type: "POST",
            data: actualJsonStr,
            success: function(data) {
              console.log(data);
              if (data.status == false) {
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 3000);
              } else {
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 3000);
                $("form").trigger("reset");
                onLoad();
              }
            }
        });
      });

      
      
      
    });
    </script>
</body>


</html>