<?php
  require './checkValidity.php';
  // require '../api/_config.php';
  // session_start();
  // if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true){
  //     header("Location:login.html");
  // } else {
  //     $currentTime = time();
  //     if($currentTime > $_SESSION['expire']){
  //         session_unset();
  //         session_destroy();
  //         header("Location:login.html");
  //     }else{
  //       $_SESSION['start']=time();
  //       $_SESSION['expire'] = $_SESSION['start'] + (60*60*24*4); //4days
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
    <link rel="stylesheet" href="../css/admin-nav.css">
    <link rel="stylesheet" href="../css/admin-teachers.css">
    <link rel="stylesheet" href="../css/datepicker.css" />

    <style>
        .datepicker
        {
          z-index: 1600 !important; /* has to be larger than 1050 */
        }
    </style>
    <title>attendance</title>
  </head>
  <body>
    <?php include 'nav.html'; ?>

    <!-- for clg student  -->
    <div class="container" style="margin-top:30px">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-9">Attendance List - For College Students</div>
            <div class="col-md-3" align="right">
              <button type="button" id="clg_report_button" class="btn btn-danger btn-sm">Report</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          </div>
        </div>
      </div>
    </div>

    <!-- for schl student  -->
    <div class="container" style="margin-top:30px">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-9">Attendance List - For School Students</div>
            <div class="col-md-3" align="right">
              <button type="button" id="schl_report_button" class="btn btn-danger btn-sm">Report</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          </div>
        </div>
      </div>
    </div>





  <!-- date for clg student -->
    <div class="modal" id="reportModal_clg">
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
              <select name="city" id="city" class="form-control mb-2">
                <option value="" disabled selected>Select City</option>
              </select>
              <span id="error_city" class="text-danger"></span>
              <select name="uni" id="uni" class="form-control mb-2">
                <option value="" disabled selected>Select University</option>
              </select>
              <span id="error_uni" class="text-danger"></span>
              <select name="clg" id="clg" class="form-control mb-2">
                <option value="" disabled selected>Select College</option>
              </select>
              <span id="error_clg" class="text-danger"></span>
              <select name="dep" id="dep" class="form-control mb-2">
                <option value="" disabled selected>Select Department</option>
              </select>
              <span id="error_dep" class="text-danger"></span>
              <select name="sem" id="sem" class="form-control mb-2">
                <option value="" disabled selected>Select Sem</option>
              </select>
              <span id="error_sem" class="text-danger"></span>
              <select name="laborlec" id="laborlec" class="form-control mb-2">
                <option value="" disabled selected>Lab Or Lec?</option>
                <option value="lab">lab</option>
                <option value="lec">lecture</option>
              </select>
              <span id="error_laborlec" class="text-danger"></span>
              <select name="sub_c" id="sub_c" class="form-control mb-2">
                <option value="" disabled selected>Select Subject</option>
              </select>
              <span id="error_sub_c" class="text-danger"></span>
            </div>
            <div class="form-group">
              <div class="input-daterange">
                <input type="text" name="from_date_clg" id="from_date_clg" class="form-control" placeholder="From Date" readonly />
                <span id="error_from_date_clg" class="text-danger"></span>
                <br />
                <input type="text" name="to_date_clg" id="to_date_clg" class="form-control" placeholder="To Date" readonly />
                <span id="error_to_date_clg" class="text-danger"></span>
              </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" name="create_report_clg" id="create_report_clg" class="btn btn-success btn-sm">Create Report</button>
            <button type="button" class="btn btn-danger btn-sm close-date-btn" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
  <!-- date for schl student -->
    <div class="modal" id="reportModal_schl">
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
              <select name="city_s" id="city_s" class="form-control mb-2">
                <option value="" disabled selected>Select City</option>
              </select>
              <span id="error_city_s" class="text-danger"></span>
              <select name="type" id="type" class="form-control mb-2">
                <option value="" disabled selected>Select School Type</option>
              </select>
              <span id="error_type" class="text-danger"></span>
              <select name="schl" id="schl" class="form-control mb-2">
                <option value="" disabled selected>Select School</option>
              </select>
              <span id="error_schl" class="text-danger"></span>
              <select name="grade" id="grade" class="form-control mb-2">
                <option value="" disabled selected>Select Grade</option>
              </select>
              <span id="error_grade" class="text-danger"></span>
              <select name="sub_s" id="sub_s" class="form-control mb-2">
                <option value="" disabled selected>Select Subject</option>
              </select>
              <span id="error_sub_s" class="text-danger"></span>
            </div>
            <div class="form-group">
              <div class="input-daterange">
                <input type="text" name="from_date_schl" id="from_date_schl" class="form-control" placeholder="From Date" readonly />
                <span id="error_from_date_schl" class="text-danger"></span>
                <br />
                <input type="text" name="to_date_schl" id="to_date_schl" class="form-control" placeholder="To Date" readonly />
                <span id="error_to_date_schl" class="text-danger"></span>
              </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" name="create_report_schl" id="create_report_schl" class="btn btn-success btn-sm">Create Report</button>
            <button type="button" class="btn btn-danger btn-sm close-date-btn" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>








    
    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/profile.js"></script>
    <script src="../js/admin-nav.js"></script>
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

      function loadSem(id,sem){
        $(id).html(`<option value="" disabled selected>Select Sem</option>`); 
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
      //function for loading city
      function loadCity(id,city_id){
        $(id).html(`<option value="" disabled selected>Select City</option>`);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-city.php",
          type:"POST",
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(city_id == value.cityId){
                $(id).append(`<option value="${value.cityId}" selected>${value.cityName}</option>`); 
              } else{
                $(id).append(`<option value="${value.cityId}" >${value.cityName}</option>`);

              }

            })
          }
        });
      }




      // function to load the university
      function loadUni(id,city_id,uni_id){
        let loadUniObj = {city_id : city_id};
        let loadUniStr = JSON.stringify(loadUniObj);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-university.php",
          type:"POST",
          data: loadUniStr,
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(uni_id == value.universityId){
                $(id).append(`<option value="${value.universityId}" selected>${value.universityName}</option>`); 
              } else{
                $(id).append(`<option value="${value.universityId}" >${value.universityName}</option>`);

              }

            })
          }
        });
      }
      $(document).on("change","#city",function(){
        defaultUni();
        loadUni("#uni",$("#city").val());
      });
      //default university
      function defaultUni(){
        $("#uni").html(
        "<option value='select-university' disabled selected>Select University</option>");
      }




      // function to load the college
      function loadClg(id,city_id,uni_id,clg_id){
        let loadClgObj = {
                            city_id : city_id,
                            uni_id : uni_id
                          };
        let loadClgStr = JSON.stringify(loadClgObj);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-college.php",
          type:"POST",
          data: loadClgStr,
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(clg_id == value.collegeId){
                $(id).append(`<option value="${value.collegeId}" selected>${value.collegeName}</option>`); 
              } else{
                $(id).append(`<option value="${value.collegeId}" >${value.collegeName}</option>`);

              }

            })
          }
        });
      }
      $(document).on("change","#city",function(){
        defaultClg();
        
        if($("#uni").val() == null){
          defaultClg();
        } else{
          loadClg("#clg",$("#city").val(),$("#uni").val()); 

        }
      });
      $(document).on("change","#uni",function(){
        defaultClg();
        loadClg("#clg",$("#city").val(),$("#uni").val());
      });
      //default college
      function defaultClg(){
        $("#clg").html(
        "<option value='select-college' disabled selected>Select College</option>");
      }






      // function to load department
      function loadDep(id,department){
        $(id).html(`<option value="" selected disabled>Select Department</option>`); 
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-department.php",
          type:"POST",
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(department == value.dep){
                $(id).append(`<option value="${value.dep}" selected>${value.dep}</option>`); 
              } else{
                $(id).append(`<option value="${value.dep}" >${value.dep}</option>`);

              }

            })
          }
        });
      }
      // default dep 
      // function defaultDep(){
      //   $("#edit-college-student-department-select").html(
      //                                 '<option value="select-department" disabled selected>-select department</option>'
      //   );
      // }


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
        $("#sub_c").html(
          '<option value="select-school" disabled selected>Select Subject</option>'
        );
      }


      // on change of sem and dep we will load correspondding subjects
      $(document).on("change", "#uni", function() {
        defaultClgSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadClgSub("#sub_c", $("#sem").val(), $("#uni").val(), $("#dep").val());
        // console.log(uni)
        // console.log($("#sem").val())
        // console.log($("#dep").val())

        // }
      });
      $(document).on("change", "#sem", function() {
        defaultClgSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadClgSub("#sub_c", $("#sem").val(), $("#uni").val(), $("#dep").val());
        // console.log(uni)
        // console.log($("#sem").val())
        // console.log($("#dep").val())

        // }
      });
      $(document).on("change", "#dep", function() {
        defaultClgSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadClgSub("#sub_c", $("#sem").val(), $("#uni").val(), $("#dep").val());
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
        $("#sub_s").html(
          '<option value="select-school" disabled selected>Select Subject</option>'
        );
      }


      // on change of sem and dep we will load correspondding subjects
      $(document).on("change", "#schl", function() {
        defaultSchlSub();
        loadSchlSub("#sub_s", $("#grade").val(), $("#schl").val());

        // }
      });
      $(document).on("change", "#grade", function() {
        defaultSchlSub();
        // if($("#sem").val()!=null && $("#dep").val()!=null){
        loadSchlSub("#sub_s", $("#grade").val(), $("#schl").val());
        // console.log(schlname)grade
        // console.log($("#sem").val())
        // console.log($("#dep").val())

        // }
      });




      // function to load the schooltype
      function loadSchlType(id,schlType_id){
        $(id).html(`<option value="" disabled selected>Select School Type</option>`); 
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-schoolType.php",
          type:"POST",
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(schlType_id == value.schooltypeId){
                $(id).append(`<option value="${value.schooltypeId}" selected>${value.schooltypeType}</option>`); 
              } else{
                $(id).append(`<option value="${value.schooltypeId}" >${value.schooltypeType}</option>`);

              }

            })
          }
        });
      }




      // function to load the schoolname
      function loadSchlName(id,schlType_id,city_id,schlName_id){
        let loadSchlNameObj = {
                            schlType_id : schlType_id,
                            city_id : city_id
                          };
        let loadSchlNameStr = JSON.stringify(loadSchlNameObj);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-schoolName.php",
          type:"POST",
          data: loadSchlNameStr,
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(schlName_id == value.schoolnameId){
                $(id).append(`<option value="${value.schoolnameId}" selected>${value.schoolnameName}</option>`); 
              } else{
                $(id).append(`<option value="${value.schoolnameId}" >${value.schoolnameName}</option>`);

              }

            })
          }
        });
      }
      //defalut school name
      function defaultSchl(){
        $("#schl").html(
          '<option value="select-school" disabled selected>Select School</option>'
            );
      }
      $(document).on("change","#type",function(){
        defaultSchl();
        loadSchlName("#schl",$("#type").val(),$("#city_s").val());
      });
      $(document).on("change","#city_s",function(){
        defaultSchl();
        loadSchlName("#schl",$("#type").val(),$("#city_s").val());
      });

      



       // function to load class
      function loadClass(id,classAssigned){
        $(id).html(`<option value="" disabled selected>Select Grade</option>`); 
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-load-class.php",
          type:"POST",
          success : function(data){
            if(data.status == false){
              $(id).append(`<option value="${data.message}">${data.message}</option>`); 
            }
            $.each(data,function(key,value){
              if(classAssigned == value.std){
                $(id).append(`<option value="${value.std}" selected>${value.std}</option>`); 
              } else{
                $(id).append(`<option value="${value.std}" >${value.std}</option>`);

              }

            })
          }
        });
      }

      
      

















      
      $('.input-daterange').datepicker({
        todayBtn: "linked",
        format: "yyyy-mm-dd",
        autoclose: true,
        container: 'body'
      });

      $(document).on('click', '#clg_report_button', function(){
        $('#reportModal_clg').modal('show');
        loadCity("#city");
        loadDep("#dep");
        loadSem("#sem");

      });

      $('#create_report_clg').click(function(){
        var city = $('#city').val();
        var uni = $('#uni').val();
        var clg = $('#clg').val();
        var dep = $('#dep').val();
        var sem = $('#sem').val();
        var laborlec = $('#laborlec').val();
        var sub_c = $('#sub_c').val();
        var from_date = $('#from_date_clg').val();
        var to_date = $('#to_date_clg').val();
        var error = 0;

        if(city == null || city == '')
        {
          $('#error_city').text('City is Required');
          error++;
        }
        else
        {
          $('#error_city').text('');
        }
        if(uni == null || uni == '')
        {
          $('#error_uni').text('University is Required');
          error++;
        }
        else
        {
          $('#error_uni').text('');
        }
        if(clg == null || clg == '')
        {
          $('#error_clg').text('College is Required');
          error++;
        }
        else
        {
          $('#error_clg').text('');
        }
        if(dep == null || dep == '')
        {
          $('#error_dep').text('Department is Required');
          error++;
        }
        else
        {
          $('#error_dep').text('');
        }
        if(sem == null || sem == '')
        {
          $('#error_sem').text('Sem is Required');
          error++;
        }
        else
        {
          $('#error_sem').text('');
        }
        if(laborlec == null || laborlec == '')
        {
          $('#error_laborlec').text('This field is Required');
          error++;
        }
        else
        {
          $('#error_laborlec').text('');
        }
        if(sub_c == null || sub_c == '')
        {
          $('#error_sub_c').text('Subject is Required');
          error++;
        }
        else
        {
          $('#error_sub_c').text('');
        }

        if(from_date == '')
        {
          $('#error_from_date_clg').text('From Date is Required');
          error++;
        }
        else
        {
          $('#error_from_date_clg').text('');
        }

        if(to_date == '')
        {
          $('#error_to_date_clg').text("To Date is Required");
          error++;
        }
        else
        {
          $('#error_to_date_clg').text('');
        }

        if(error == 0)
        {
          // console.log($('#grade_id').val());
          console.log(from_date,to_date,city,uni,clg,dep,sem,laborlec,sub_c);
          $('#from_date_clg').val('');
          $('#to_date_clg').val('');
          // $('#city').val('');
          // $('#uni').val('');
          // $('#clg').val('');
          // $('#dep').val('');
          // $('#sem').val('');
          // $('#laborlec').val('');
          // $('#sub_c').val('');
          $('#reportModal_clg').modal('hide');
          window.open("report.php?action=clg_attendance_report&from_date="+from_date+"&to_date="+to_date+`&laborlec=${laborlec}&dep=${dep}&sem=${sem}&sub=${sub_c}&clgid=${clg}`);
        }

      });
      $(document).on("click",".close-date-btn",function(){
        $('#reportModal_clg').modal('hide');
        $('#reportModal_schl').modal('hide');
      });



      $(document).on('click', '#schl_report_button', function(){
        $('#reportModal_schl').modal('show');
        loadCity("#city_s");
        loadSchlType("#type");
        loadClass("#grade");
      });

      $('#create_report_schl').click(function(){
        var city = $('#city_s').val();
        var type = $('#type').val();
        var schl = $('#schl').val();
        var grade = $('#grade').val();
        var sub_s = $('#sub_s').val();
        var from_date = $('#from_date_schl').val();
        var to_date = $('#to_date_schl').val();
        var error = 0;

        if(city == null || city == '')
        {
          $('#error_city_s').text('City is Required');
          error++;
        }
        else
        {
          $('#error_city_s').text('');
        }
        if(type == null || type == '')
        {
          $('#error_type').text('School Type is Required');
          error++;
        }
        else
        {
          $('#error_type').text('');
        }
        if(schl == null || schl == '')
        {
          $('#error_schl').text('School is Required');
          error++;
        }
        else
        {
          $('#error_schl').text('');
        }
        if(grade == null || grade == '')
        {
          $('#error_grade').text('Grade is Required');
          error++;
        }
        else
        {
          $('#error_grade').text('');
        }
        if(sub_s == null || sub_s == '')
        {
          $('#error_sub_s').text('Subject is Required');
          error++;
        }
        else
        {
          $('#error_sub_s').text('');
        }

        if(from_date == '')
        {
          $('#error_from_date_schl').text('From Date is Required');
          error++;
        }
        else
        {
          $('#error_from_date_schl').text('');
        }

        if(to_date == '')
        {
          $('#error_to_date_schl').text("To Date is Required");
          error++;
        }
        else
        {
          $('#error_to_date_schl').text('');
        }

        if(error == 0)
        {
          // console.log($('#grade_id').val());
          console.log($('#from_date_schl').val());
          console.log($('#to_date_schl').val());
          $('#from_date_schl').val('');
          $('#to_date_schl').val('');
          // $('#city').val('');
          // $('#type').val('');
          // $('#schl').val('');
          // $('#grade').val('');
          // $('#sub_s').val('');
          $('#reportModal_schl').modal('hide');
          window.open("report.php?action=schl_attendance_report&from_date="+from_date+"&to_date="+to_date+`&std=${grade}&sub=${sub_s}&schlid=${schl}`);
        }

      });
    });
    </script>
  </body>


</html> 