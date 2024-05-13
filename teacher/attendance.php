<?php
require './checkValidity.php';
// require '../api/_config.php';
// session_start();
// if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true){
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="../css/teacher-nav.css">
  <link rel="stylesheet" href="../css/teacher-home.css">
  <link rel="stylesheet" href="../css/teacher-attendance.css">
  <link rel="stylesheet" href="../css/datepicker.css">
    <style>
        .datepicker
        {
          z-index: 1600 !important; /* has to be larger than 1050 */
        }
    </style>
  <!-- <link rel="stylesheet" href="../css/admin-teachers.css"> -->
  <title>attendance</title>
</head>

<body>
  <div class="alert-container position-fixed d-none">
    <div class="alert-c2 position-absolute top-0 start-50 translate-middle"></div>
  </div>
  <?php include 'nav.html'; ?>
  <main>
    <div class="container border-bottom my-4 ps-5">
      <h2 class="tc">Take/check Attendance</h2>
  
    </div>

    <div class="container main-container">
      <!-- for college teacher  -->
      <div class="d-flex flex-row bd-highlight mb-3 flex-wrap flex-container gap-4">
        <!-- <div class="p-2 bd-highlight item d-flex flex-column justify-content-around border">
          <div class="department">Branch : Computer Engineering</div>
          <div class="sem">Sem : 1</div>
          <div class="subject">Subject : basic electrical engineering</div>
          <div class="d-grid gap-2 take-attendance">
            <button class="btn btn-primary" type="button">Go</button>
          </div>
        </div>
        <div class="p-2 bd-highlight item d-flex flex-column justify-content-around border">
          <div class="department">Branch : Computer Engineering</div>
          <div class="sem">Sem : 1</div>
          <div class="subject">Subject : basic electrical engineering</div>
          <div class="d-grid gap-2 take-attendance">
            <button class="btn btn-primary" type="button">Go</button>
          </div>
        </div>
        <div class="p-2 bd-highlight item d-flex flex-column justify-content-around border">
          <div class="department">Branch : Computer Engineering</div>
          <div class="sem">Sem : 1</div>
          <div class="subject">Subject : basic electrical engineering</div>
          <div class="d-grid gap-2 take-attendance">
            <button class="btn btn-primary" type="button">Go</button>
          </div>
        </div> -->
      </div>
    </div>
  </main>
  

  
  <!-- date  -->
  <div class="modal" id="reportModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Make Report</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <div class="input-daterange">
              <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
              <span id="error_from_date" class="text-danger"></span>
              <br />
              <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
              <span id="error_to_date" class="text-danger"></span>
            </div>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" name="create_report" id="create_report" class="btn btn-success btn-sm">Create Report</button>
          <button type="button" class="btn btn-danger btn-sm close-date-btn" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>



  <div class="show-pp">
    
    <div class="pic-and-btn">
      <img src="" alt="profile-pic" id="show-profile-pic">
      <button id="back-pp-btn" type="button">Back</button>
      <!-- <div class="close-btn" id="close-btn-remove-pp-schl">X</div> -->
    </div>
  </div>


  <div class="error-message">error</div>
  <div class="success-message">success</div>






  <script src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
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
      let g_clgName;
      let g_dep ;
      let g_schlName;
      let g_class;
      let g_obj;
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
          // console.log(data);
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
            $(".flex-container").html("");
            
            if(soc=="college"){
              g_clgName=data[0].collegeName;
              let subjectTaughtObj = JSON.parse(data[0].subjectTaught);
              $.each(subjectTaughtObj, function(key,value){
                $(".flex-container").append(
                  `
                  <div class="p-2 bd-highlight item d-flex flex-column justify-content-around border">
                    <div class="department"><span class="font-monospace">Branch</span> : ${value.dep}</div>
                    <div class="sem"><span class="font-monospace">Sem</span> : ${value.sem}</div>
                    <div class="subject"><span class="font-monospace">Subject</span> : ${value.sub}</div>
                    <div class="laborlec"><span class="font-monospace">Lab/Lec</span> : ${value.laborlec}</div>
                    <div class="d-grid gap-2 take-attendance">
                      <button class="btn btn-primary go-btn" type="button" data-dep='${value.dep}' data-sem='${value.sem}' data-sub='${value.sub}' data-laborlec='${value.laborlec}' data-tid=${value.tid} data-clgid=${data[0].college_id} >Go</button>
                    </div>
                  </div>
                  `
                );
                
              });
              
            } else{
              g_schlName=data[0].schoolnameName;
              let subjectTaughtObj = JSON.parse(data[0].subjectTaught);
              $.each(subjectTaughtObj, function(key,value){
                $(".flex-container").append(
                  `
                  <div class="p-2 bd-highlight item d-flex flex-column justify-content-around border">
                    <div class="std"><span class="font-monospace">Class</span> : ${value.std}</div>
                    <div class="subject"><span class="font-monospace">Subject</span> : ${value.sub}</div>
                    <div class="d-grid gap-2 take-attendance">
                      <button class="btn btn-primary go-btn" type="button" data-std='${value.std}' data-sub='${value.sub}' data-tid=${value.tid} data-schlid=${data[0].schoolname_id}>Go</button>
                    </div>
                  </div>
                  `
                );
                
              });

            }
          }
        }
      });


      $(document).on("click",".go-btn",function(){
        if(soc=="college"){
          let dep = $(this).data("dep");
          let sem = $(this).data("sem");
          let sub = $(this).data("sub");
          let tid = $(this).data("tid");
          let laborlec = $(this).data("laborlec");
          let clgid = $(this).data("clgid");
          // console.log(dep);
          // console.log(sem);
          // console.log(sub);
          // console.log(tid);
          // console.log(laborlec);
          // console.log(clgid);
          g_dep = dep;
          $(".main-container").html("");
          $(".main-container").html(
            `
              <div class="back-btn"><span id="back-pp-btn" class="material-symbols-outlined">arrow_back</span></div>
              Select Date For Attendance: <input type="date" name="date" id="date-for-attendance">
              <div class="college-student-container">
                <div id="table-header">
                  <div class="table-title">College Student List</div>
                  <button type="button" name="report-college-student" id="report-college-student">Report</button>
            
                </div>
                <div id="content-container-college">
                  <div id="search-container">
                    <label for="search-college-student">Search: </label>
                    <input type="text" name="search" id="search-college-student">
                  </div>
                  <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="college-student">
                    <tr>
                      <th width="10%">Image</th>
                      <th width="30%">Student Name</th>
                      <th width="30%">Roll Number</th>
                      <th width="30%" colspan='2' class='text-center'>Status</th>
                    </tr>
                    <tbody id="load-college-student"></tbody>
                  </table>
                  <div id="pagination-college" class="pagination"></div>
                </div>
              </div>
            `
          );
          // Get today's date
var today = new Date();

// Format today's date as YYYY-MM-DD (required format for HTML date input)
var formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');

// Set the value of the date input field to today's date
document.getElementById('date-for-attendance').value = formattedDate;

          let obj = {
            dep: dep,
            sem: sem,
            sub: sub,
            tid: tid,
            laborlec: laborlec,
            clgid: clgid
          }
          g_obj = obj;
          let jsonString = JSON.stringify(obj);
          $.ajax({
            url: "http://localhost/Attendance-system/api/api-get-college-students-for-attendace.php",
            type: "POST",
            data: jsonString,
            success: function(data) {
              // // console.log(data);
              
            $("#load-college-student").html("");
            $("#pagination-college").html("");
            
            if(soc=="college"){
              $(".table-title").html(`${g_clgName}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;${g_dep} (Students List)`);
              
              
            } else{
              $(".table-title").html(`${g_schlName}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;${g_class} (Students List)`);
  
            }
            // console.log(data);
              if(data.status == false){
                $("#load-college-student").html("<tr style='height: 4rem'><td colspan='5'><h2>"+ data.message +"</h2></td></tr>");
              }else{
                $.each(data, function(key, value){ 

                        $("#load-college-student").append("<tr>" + 
                                                "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
                                                "<td>" + value.firstName + " " + value.lastName +"</td>" + 
                                                "<td>" + value.rollNumber +"</td>" + 
                                                `<td><div><input type='radio' id='${value.rollNumber}p' name='${value.rollNumber}' value='${value.rollNumber}'><label for='${value.rollNumber}p' >Present</label></div></td>` + 
                                                `<td><div><input type='radio' id='${value.rollNumber}a' name='${value.rollNumber}' value='absent'><label for='${value.rollNumber}a'>Absent</label></div></td>` + 
                                                "</tr>");
                      
                    
                  
                });
                $("#content-container-college").append('<div class="text-end"><button type="button" id="submit-college-attendance" class="btn btn-primary mb-2 me-4">Done</button></div>');
                
                
              }
            }
          });
        }else{
          let std = $(this).data("std");
          let sub = $(this).data("sub");
          let tid = $(this).data("tid");
          let schlid = $(this).data("schlid");
          // console.log(std);
          // console.log(sub);
          // console.log(tid);
          // console.log(schlid);
          g_class = std;

          $(".main-container").html("");
          $(".main-container").html(
            `
              <div class="back-btn"><span id="back-pp-btn" class="material-symbols-outlined">arrow_back</span></div>
              Select Date For Attendance: <input type="date" name="date" id="date-for-attendance">
              <div class="school-student-container">
                <div id="table-header">
                  <div class="table-title">School Student List</div>
                  <button type="button" name="report-college-student" id="report-college-student">Report</button>
            
                </div>
                <div id="content-container-school">
                  <div id="search-container">
                    <label for="search-school-student">Search: </label>
                    <input type="text" name="search" id="search-school-student">
                  </div>
                  <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="school-student">
                    <tr>
                      <th width="10%">Image</th>
                      <th width="30%">Student Name</th>
                      <th width="30%">Roll Number</th>
                      <th width="30%" colspan='2' class='text-center'>Status</th>
                    </tr>
                    <tbody id="load-school-student"></tbody>
                  </table>
                  <div id="pagination-school" class="pagination"></div>
                </div>
              </div>
            `
          );
          // Get today's date
var today = new Date();

// Format today's date as YYYY-MM-DD (required format for HTML date input)
var formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');

// Set the value of the date input field to today's date
document.getElementById('date-for-attendance').value = formattedDate;
          
          let obj = {
            std: std,
            sub: sub,
            tid: tid,
            schlid: schlid
          }
          g_obj = obj;
          let jsonString = JSON.stringify(obj);
          $.ajax({
            url: "http://localhost/Attendance-system/api/api-get-school-students-for-attendace.php",
            type: "POST",
            data: jsonString,
            success: function(data) {
              // // console.log(data);
              
            $("#load-school-student").html("");
            $("#pagination-school").html("");
            
            if(soc=="college"){
              $(".table-title").html(`${g_clgName}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;${g_dep} (Students List)`);
              
              
            } else{
              $(".table-title").html(`${g_schlName}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;${g_class} (Students List)`);
  
            }
            // console.log(data);
              if(data.status == false){
                $("#load-school-student").html("<tr style='height: 4rem'><td colspan='5'><h2>"+ data.message +"</h2></td></tr>");
              }else{
                $.each(data, function(key, value){ 

                        $("#load-school-student").append("<tr>" + 
                                                "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
                                                "<td>" + value.firstName + " " + value.lastName +"</td>" + 
                                                "<td>" + value.rollNumber +"</td>" + 
                                                `<td><div><input type='radio' id='${value.rollNumber}p' name='${value.rollNumber}' value='${value.rollNumber}'><label for='${value.rollNumber}p' >Present</label></div></td>` + 
                                                `<td><div><input type='radio' id='${value.rollNumber}a' name='${value.rollNumber}' value='absent'><label for='${value.rollNumber}a'>Absent</label></div></td>` + 
                                                "</tr>");
                      
                    
                  
                });
                $("#content-container-school").append('<div class="text-end"><button type="button" id="submit-school-attendance" class="btn btn-primary mb-2 me-4">Done</button></div>');
                
                
              }
            }
          });
          
        }
      });

      
      $(document).on("click","#back-pp-btn", function(e) {
        e.preventDefault();
        window.location="http://localhost/Attendance-system/teacher/attendance.php";
      });








      
      $(document).on("click",".profile-pic",function(){
        // console.log($(this).attr("src"));
        // console.log("clicked");
        $(".show-pp").css("display","flex");
        // $(".show-pp").show();
        $("#show-profile-pic").attr("src",$(this).attr("src"));

      });
      $(document).on("click","#back-pp-btn",function(){
        
        $(".show-pp").hide();
      });



      // submitting college attendance
      $(document).on("click","#submit-college-attendance",function(){
        // // console.log("c");
        // // console.log(g_obj);
        var radios = document.querySelectorAll('input[type="radio"]');
        let presentNumbers = [];
        // // console.log(radios);
        radios.forEach(function(radio) {
            // Add event listener for change event
            
            // // console.log(radio);
                if (radio.checked) {
                    if(radio.value != "absent"){
                      // // console.log('Selected value:', radio.value); 
                      presentNumbers.push(radio.value);
                    }

                }
        });
        // console.log(presentNumbers);
        g_obj['present']=presentNumbers;
        g_obj['date']=$("#date-for-attendance").val();
        // console.log(g_obj);
        let jsonString = JSON.stringify(g_obj);
        $.ajax({
            url: "http://localhost/Attendance-system/api/api-submit-college-attendance.php",
            type: "POST",
            data: jsonString,
            success: function(data) {
              // console.log(data);
              if(data.status == false){
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 3000);
              } else{
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 2500);
                uncheckRadios();
              }
            }

        });

      });
      
      // submitting school attendance
      $(document).on("click","#submit-school-attendance",function(){
        // // console.log("c");
        // // console.log(g_obj);
        var radios = document.querySelectorAll('input[type="radio"]');
        let presentNumbers = [];
        // // console.log(radios);
        radios.forEach(function(radio) {
            // Add event listener for change event
            
            // // console.log(radio);
                if (radio.checked) {
                    if(radio.value != "absent"){
                      // // console.log('Selected value:', radio.value); 
                      presentNumbers.push(radio.value);
                    }

                }
        });
        // console.log(presentNumbers);
        g_obj['present']=presentNumbers;
        g_obj['date']=$("#date-for-attendance").val();
        // console.log(g_obj);
        let jsonString = JSON.stringify(g_obj);
        $.ajax({
            url: "http://localhost/Attendance-system/api/api-submit-school-attendance.php",
            type: "POST",
            data: jsonString,
            success: function(data) {
              // console.log(data);
              if(data.status == false){
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 3000);
              } else{
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 2500);
                uncheckRadios();
              }
            }

        });

      });
      function uncheckRadios() {
          // Select all radio buttons within the form
          var radios = document.querySelectorAll('input[type="radio"]');

          // Loop through each radio button
          radios.forEach(function(radio) {
              // Set the checked property to false
              radio.checked = false;
          });
      }

      // Select all radio buttons with class "dynamic-radio"
      // var radios = document.querySelectorAll('input[type="radio"]');
      // // // console.log(radios);

      // // Loop through each radio button
      // radios.forEach(function(radio) {
      //     // Add event listener for change event
      //     radio.addEventListener('change', function() {
      //         // Check if radio button is checked
      //         if (this.checked) {
      //             // console.log('Selected value:', this.value);
      //         }
      //     });
      // });











      $('.input-daterange').datepicker({
        todayBtn:"linked",
        format:"yyyy-mm-dd",
        autoclose:true,
        container: 'body'
      });
      $(document).on('click', '#report-college-student', function(){
        $('#reportModal').modal('show');
      });
      
      $('#create_report').click(function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var error = 0;
        if(from_date == '')
        {
          $('#error_from_date').text('From Date is Required');
          error++;
        }
        else
        {
          $('#error_from_date').text('');
        }

        if(to_date == '')
        {
          $('#error_to_date').text("To Date is Required");
          error++;
        }
        else
        {
          $('#error_to_date').text('');
        }

        if(error == 0)
        {
          // console.log($('#from_date').val())
          // console.log($('#to_date').val())
          $('#from_date').val('');
          $('#to_date').val('');
          $('#reportModal').modal('hide');
          // console.log(g_obj);
          if(soc=="college"){
            window.open("report.php?action=clg_attendance_report&from_date="+from_date+"&to_date="+to_date+`&dep=${g_obj.dep}&laborlec=${g_obj.laborlec}&sem=${g_obj.sem}&sub=${g_obj.sub}&tid=${g_obj.tid}&clgid=${g_obj.clgid}`);

          } else{
            // // console.log("it'll go to school report");
            window.open("report.php?action=schl_attendance_report&from_date="+from_date+"&to_date="+to_date+`&std=${g_obj.std}&sub=${g_obj.sub}&tid=${g_obj.tid}&schlid=${g_obj.schlid}`);

          }
        }

      });
      $(document).on("click",".close-date-btn",function(){
        $('#reportModal').modal('hide');
      });
    });
  </script>
</body>


</html>