<?php
  require './checkValidity.php';
// session_start();
// if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true){
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
    <link rel="stylesheet" href="../css/student-nav.css">
    <!-- <link rel="stylesheet" href="../css/teacher-home.css"> -->
    <link rel="stylesheet" href="../css/teacher-attendance.css">     <!-- error/success mate include kri che -->
    <link rel="stylesheet" href="../css/datepicker.css">
    <!-- <link rel="stylesheet" href="../css/teacher-home.css"> --><style>
        .datepicker
        {
          z-index: 1600 !important; /* has to be larger than 1050 */
        }
    </style>
    <title>attendance</title>
  </head>
  <body>
    <?php include 'nav.html'; ?>
    
  <main>
    <div class="container border-bottom my-4 ps-5">
      <h2 class="tc">Check your attendance</h2>
  
    </div>

    <div class="container main-container">
      <!-- for college teacher  -->
      <div class="d-flex flex-column bd-highlight mb-3 flex-wrap flex-container gap-4 align-items-start" id="flex-container">
        
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


<!-- 
  <div class="show-pp">
    
    <div class="pic-and-btn">
      <img src="" alt="profile-pic" id="show-profile-pic">
      <button id="back-pp-btn" type="button">Back</button>
      -- <div class="close-btn" id="close-btn-remove-pp-schl">X</div> --
    </div>
  </div> -->
  <div class="d-flex flex-row">
    <div id="pieChartContainer" class="me-auto ms-auto"></div>

  </div>

  <div class="error-message">error</div>
  <div class="success-message">success</div>






    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      let g_sub = [];
      let g_obj;
      // sessionStorage.setItem("userId", uId);

      
      console.log(uId,role,soc);

      onLoad();

      function onLoad(){
        let obj = {
          userId: uId,
          userRole: role,
          schoolOrCollege: soc
        } // no use of userRoleObj
        g_obj=obj;
        let jsonString = JSON.stringify(obj);

        $.ajax({
          url: "http://localhost/Attendance-system/api/api-get-user-by-userId-and-schoolOrCollege.php",
          type: "POST",
          data: jsonString,
          async:false,
          success: function(data) {
            console.log(data);  
            $.each(data,function(key,value){
              g_obj[key]=value;
            });
            console.log(g_obj);
            if(soc=="college"){
              loadClgAttendance(g_obj[0].branch,g_obj[0].sem,g_obj[0].college_id);

            } else{
              loadSchlAttendance(g_obj[0].standard,g_obj[0].schoolname_id);
            }
          }
        });
      }

      function loadClgAttendance(dep,sem,clgid){
        console.log(dep);
        console.log(sem);
        console.log(clgid);
        let obj = {
          dep: dep,
          sem: sem,
          clgid: clgid
        } // no use of userRoleObj
        let jsonString = JSON.stringify(obj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-show-clg-attendance.php",
          type: "POST",
          data: jsonString,
          async:false,
          success: function(data) {
            // loadClgSub(".no-where",g_obj[0].sem,g_obj[0].university_id,g_obj[0].branch);
            // console.log(g_sub);

            // console.log(data);
            // console.log(g_sub.length);
            // for(i = 0; i < g_sub.length ; i++){
            //   console.log("h");
            // }
            // var parentDiv = document.getElementById("flex-container");
            // var childDivs = parentDiv.children;
            // console.log(childDivs.length);
            // for (var i = 0; i < childDivs.length; i++) {
            //     // Do something with each child div
            //     console.log(childDivs[i]);
            // }// Assuming 'data' is the array you provided
            console.log(data);
            let subjects = [];

            data.forEach(function(item) {
                if (!subjects.includes(item.subject+`(${item.laborlec})`)) {
                    subjects.push(item.subject+`(${item.laborlec})`);
                }
            });

            console.log(subjects);
            // let totalClassesAttended = 0;
            // let totalClassesHeld = 0;

            // data.forEach(function(item) {
            //     var presentNumbers = item.presentNumbers.split(", ");
            //     if (presentNumbers.includes(rollNumber)) {
            //         totalClassesAttended++;
            //     }
            //     totalClassesHeld++;
            // });

            // let attendancePercentage = (totalClassesAttended / totalClassesHeld) * 100;
            var attendanceData = {}; // Object to store attendance data for each subject
            var totalClassesHeld = {}; // Object to store total classes held for each subject
            var rollNumber = g_obj[0].rollNumber;

            data.forEach(function(item) {
                var presentNumbers = item.presentNumbers.split(", ");
                if (presentNumbers.includes(rollNumber)) {
                    // Increment totalClassesAttended for the subject
                    if (!attendanceData.hasOwnProperty(item.subject+`(${item.laborlec})`)) {
                        attendanceData[item.subject+`(${item.laborlec})`] = 1;
                    } else {
                        attendanceData[item.subject+`(${item.laborlec})`]++;
                    }
                }

                // Increment totalClassesHeld for the subject
                if (!totalClassesHeld.hasOwnProperty(item.subject+`(${item.laborlec})`)) {
                    totalClassesHeld[item.subject+`(${item.laborlec})`] = 1;
                } else {
                    totalClassesHeld[item.subject+`(${item.laborlec})`]++;
                }
            });

            var attendancePercentages = {}; // Object to store attendance percentages for each subject
            for (var subject in attendanceData) {
                if (attendanceData.hasOwnProperty(subject)) {
                    var attendancePercentage = (attendanceData[subject] / totalClassesHeld[subject]) * 100;
                    attendancePercentages[subject] = attendancePercentage.toFixed(2); // Rounds to 2 decimal places
                }
            }
            console.log(attendancePercentages);


            // drawing pie chart
            // var attendanceData = {
            //   "Subject 1": 80,
            //   "Subject 2": 75,
            //   "Subject 3": 90,
            // // Add more subjects and their percentages as needed
            // };
            let attendanceDataForPieChart = attendancePercentages;

            // Container element for pie charts
            var container = document.getElementById('pieChartContainer');

            // Create pie chart for each subject
            for (var subject in attendanceDataForPieChart) {
                if (attendanceDataForPieChart.hasOwnProperty(subject)) {
                    // Create canvas element for the chart
                    var canvas = document.createElement('canvas');
                    canvas.width = 250;
                    canvas.height = 250;
                    container.appendChild(canvas);

                    // Get context of the canvas
                    var ctx = canvas.getContext('2d');

                    // Create pie chart
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Present', 'Absent'],
                            datasets: [{
                                label: subject,
                                data: [attendanceDataForPieChart[subject], 100 - attendanceDataForPieChart[subject]],
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 99, 132, 0.5)',
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: false,
                            maintainAspectRatio: false,
                            title: {
                                display: true,
                                text: 'Attendance Percentage Pie Chart for ' + subject
                            }
                        }
                    });
                }
            }

          }
        });
      }

      function loadSchlAttendance(std,schlid){
        console.log(std);
        console.log(schlid);
        let obj = {
          std: std,
          schlid: schlid
        } // no use of userRoleObj
        let jsonString = JSON.stringify(obj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-show-schl-attendance.php",
          type: "POST",
          data: jsonString,
          async:false,
          success: function(data) {
            // loadClgSub(".no-where",g_obj[0].sem,g_obj[0].university_id,g_obj[0].branch);
            // console.log(g_sub);

            // console.log(data);
            // console.log(g_sub.length);
            // for(i = 0; i < g_sub.length ; i++){
            //   console.log("h");
            // }
            // var parentDiv = document.getElementById("flex-container");
            // var childDivs = parentDiv.children;
            // console.log(childDivs.length);
            // for (var i = 0; i < childDivs.length; i++) {
            //     // Do something with each child div
            //     console.log(childDivs[i]);
            // }// Assuming 'data' is the array you provided
            console.log(data);
            let subjects = [];

            data.forEach(function(item) {
                if (!subjects.includes(item.subject)) {
                    subjects.push(item.subject);
                }
            });

            console.log(subjects);
            // let totalClassesAttended = 0;
            // let totalClassesHeld = 0;

            // data.forEach(function(item) {
            //     var presentNumbers = item.presentNumbers.split(", ");
            //     if (presentNumbers.includes(rollNumber)) {
            //         totalClassesAttended++;
            //     }
            //     totalClassesHeld++;
            // });

            // let attendancePercentage = (totalClassesAttended / totalClassesHeld) * 100;
            var attendanceData = {}; // Object to store attendance data for each subject
            var totalClassesHeld = {}; // Object to store total classes held for each subject
            var rollNumber = g_obj[0].rollNumber;

            data.forEach(function(item) {
                var presentNumbers = item.presentNumbers.split(", ");
                if (presentNumbers.includes(rollNumber)) {
                    // Increment totalClassesAttended for the subject
                    if (!attendanceData.hasOwnProperty(item.subject)) {
                        attendanceData[item.subject] = 1;
                    } else {
                        attendanceData[item.subject]++;
                    }
                }

                // Increment totalClassesHeld for the subject
                if (!totalClassesHeld.hasOwnProperty(item.subject)) {
                    totalClassesHeld[item.subject] = 1;
                } else {
                    totalClassesHeld[item.subject]++;
                }
            });

            var attendancePercentages = {}; // Object to store attendance percentages for each subject
            for (var subject in attendanceData) {
                if (attendanceData.hasOwnProperty(subject)) {
                    var attendancePercentage = (attendanceData[subject] / totalClassesHeld[subject]) * 100;
                    attendancePercentages[subject] = attendancePercentage.toFixed(2); // Rounds to 2 decimal places
                }
            }
            console.log(attendancePercentages);


            // drawing pie chart
            // var attendanceData = {
            //   "Subject 1": 80,
            //   "Subject 2": 75,
            //   "Subject 3": 90,
            // // Add more subjects and their percentages as needed
            // };
            let attendanceDataForPieChart = attendancePercentages;

            // Container element for pie charts
            var container = document.getElementById('pieChartContainer');

            // Create pie chart for each subject
            for (var subject in attendanceDataForPieChart) {
                if (attendanceDataForPieChart.hasOwnProperty(subject)) {
                    // Create canvas element for the chart
                    var canvas = document.createElement('canvas');
                    canvas.width = 250;
                    canvas.height = 250;
                    container.appendChild(canvas);

                    // Get context of the canvas
                    var ctx = canvas.getContext('2d');

                    // Create pie chart
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Present', 'Absent'],
                            datasets: [{
                                label: subject,
                                data: [attendanceDataForPieChart[subject], 100 - attendanceDataForPieChart[subject]],
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 99, 132, 0.5)',
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: false,
                            maintainAspectRatio: false,
                            title: {
                                display: true,
                                text: 'Attendance Percentage Pie Chart for ' + subject
                            }
                        }
                    });
                }
            }

          }
        });
      }


      
      // // function to load subject corresponds to department
      // function loadClgSub(id, sem, uni, department) {
      //   let loadSubObj = {
      //     dep: department,
      //     sem: sem,
      //     uni: uni
      //   };
      //   let loadSubStr = JSON.stringify(loadSubObj);
      //   $.ajax({
      //     url: "http://localhost/Attendance-system/api/api-load-college-subject.php",
      //     type: "POST",
      //     data: loadSubStr,
      //     success: function(data) {
      //       // console.log(data);
      //       if (data.status == false) {
      //         $(id).append(`<div id="${data.message}" data-value="${data.message}">${data.message}</div>`);
      //       } else {
      //         // splitting data into array of subjucts
      //         data = data[0].sub.split(",");
      //         // console.log(data)

      //       }
            
      //       $.each(data, function(key, value) {
      //         g_sub.push(value.toLowerCase());
      //         $(id).append(`<div id="${value.toLowerCase()}" data-value="${value.toLowerCase()}" >${value}</div>`);



      //       })
      //     }
      //   });
      // }

      // // default load subject
      // function defaultClgSub() {
      //   $("#sub_c").html(
      //     '<option value="select-school" disabled selected>Select Subject</option>'
      //   );
      // }


      // // on change of sem and dep we will load correspondding subjects
      // $(document).on("change", "#uni", function() {
      //   defaultClgSub();
      //   // if($("#sem").val()!=null && $("#dep").val()!=null){
      //   loadClgSub("#sub_c", $("#sem").val(), $("#uni").val(), $("#dep").val());
      //   // console.log(uni)
      //   // console.log($("#sem").val())
      //   // console.log($("#dep").val())

      //   // }
      // });
      // $(document).on("change", "#sem", function() {
      //   defaultClgSub();
      //   // if($("#sem").val()!=null && $("#dep").val()!=null){
      //   loadClgSub("#sub_c", $("#sem").val(), $("#uni").val(), $("#dep").val());
      //   // console.log(uni)
      //   // console.log($("#sem").val())
      //   // console.log($("#dep").val())

      //   // }
      // });
      // $(document).on("change", "#dep", function() {
      //   defaultClgSub();
      //   // if($("#sem").val()!=null && $("#dep").val()!=null){
      //   loadClgSub("#sub_c", $("#sem").val(), $("#uni").val(), $("#dep").val());
      //   // console.log(uni)
      //   // console.log($("#sem").val())
      //   // console.log($("#dep").val())

      //   // }
      // });




      // // loading school subject regardless whaterver school it is just because we have enterd only 5 schools subjects and all of them are exactly sem if i will give it to any school then i might do it properly
      // function loadSchlSub(id, std, schlname) {
      //   let loadSubObj = {
      //     std: std,
      //     schlname_id: schlname
      //   };
      //   let loadSubStr = JSON.stringify(loadSubObj);
      //   $.ajax({
      //     url: "http://localhost/Attendance-system/api/api-load-school-subject.php",
      //     type: "POST",
      //     data: loadSubStr,
      //     success: function(data) {
      //       console.log(data);
      //       if (data.status == false) {
      //         $(id).append(`<option value="${data.message}">${data.message}</option>`);
      //       } else {
      //         // splitting data into array of subjucts
      //         data = data[0].sub.split(",");
      //         // console.log(data)

      //       }
      //       $.each(data, function(key, value) {

      //         $(id).append(`<option value="${value}" >${value}</option>`);



      //       });
      //     }
      //   });

      // }

      // // default load subject for school
      // function defaultSchlSub() {
      //   $("#sub_s").html(
      //     '<option value="select-school" disabled selected>Select Subject</option>'
      //   );
      // }


      // // on change of sem and dep we will load correspondding subjects
      // $(document).on("change", "#schl", function() {
      //   defaultSchlSub();
      //   loadSchlSub("#sub_s", $("#grade").val(), $("#schl").val());

      //   // }
      // });
      // $(document).on("change", "#grade", function() {
      //   defaultSchlSub();
      //   // if($("#sem").val()!=null && $("#dep").val()!=null){
      //   loadSchlSub("#sub_s", $("#grade").val(), $("#schl").val());
      //   // console.log(schlname)grade
      //   // console.log($("#sem").val())
      //   // console.log($("#dep").val())

      //   // }
      // });








    });
    </script>
  </body>


</html> 