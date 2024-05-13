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











  // table jevu j pan ek button hovu joye jeni pr click krta j ee alg j page pr jaine update-profile kri skse ee teacher ni
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../css/admin-nav.css">
    <link rel="stylesheet" href="../css/admin-teachers.css">
    <link rel="stylesheet" href="../css/admin-students.css">
    <title>pending</title>
  </head>
  <body>
    <?php include 'nav.html'; ?>
    <main>
    <div class="college-teacher-container">
      <div id="table-header">
        <div>College Teacher List</div>
  
      </div>
      <div id="content-container-college">
        <div id="search-container">
          <!-- <label for="search-college-teacher">Search: </label> -->
          <!-- <input type="text" name="search" id="search-college-teacher"> -->
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="college-teacher">
          <tr>
            <th width="10%">Image</th>
            <th width="20%">Teacher Name</th>
            <th width="25%">Email address</th>
            <th width="25%">College</th>
            <th width="10%">View more</th>
            <th width="10%">Complete Profile</th>
          </tr>
          <tbody id="load-college-teacher"></tbody>
        </table>
        <div id="pagination-college-t" class="pagination"></div>
      </div>
    </div>

    
    <div class="school-teacher-container">
      <div id="table-header">
        <div>School Teacher List</div>
  
      </div>
      
      <div id="content-container-school">
        <div id="search-container">
          <!-- <label for="search-school-teacher">Search: </label>
          <input type="text" name="search" id="search-school-teacher"> -->
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="school-teacher">
          <tr>
            <th width="10%">Image</th>
            <th width="20%">Teacher Name</th>
            <th width="25%">Email address</th>
            <th width="25%">School</th>
            <th width="10%">View more</th>
            <th width="10%">Complete Profile</th>
          </tr>
          <tbody id="load-school-teacher"></tbody>
        </table>
        <div id="pagination-school-t" class="pagination"></div>
      </div>
    </div>

    <div class="college-student-container">
      <div id="table-header">
        <div>College Student List</div>
  
      </div>
      <div id="content-container-college">
        <div id="search-container">
          <!-- <label for="search-college-student">Search: </label>
          <input type="text" name="search" id="search-college-student"> -->
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="college-student">
          <tr>
            <th width="10%">Image</th>
            <th width="20%">Student Name</th>
            <th width="25%">Roll Number</th>
            <th width="25%">College</th>
            <th width="10%">View more</th>
            <th width="10%">Complete Profile</th>
          </tr>
          <tbody id="load-college-student"></tbody>
        </table>
        <div id="pagination-college-s" class="pagination"></div>
      </div>
    </div>

    
    <div class="school-student-container">
      <div id="table-header">
        <div>School Student List</div>
  
      </div>
      
      <div id="content-container-school">
        <div id="search-container">
          <!-- <label for="search-school-student">Search: </label>
          <input type="text" name="search" id="search-school-student"> -->
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="school-student">
          <tr>
            <th width="10%">Image</th>
            <th width="20%">Student Name</th>
            <th width="25%">Roll Number</th>
            <th width="25%">School</th>
            <th width="10%">View more</th>
            <th width="10%">Complete Profile</th>
          </tr>
          <tbody id="load-school-student"></tbody>
        </table>
        <div id="pagination-school-s" class="pagination"></div>
      </div>
    </div>

  </main>
  <!-- <br><br><br><br><br><br><hr><br><br><br><br>
  <br><br><br><br><br><br><hr><br><br><br><br>
  <br><br><br><br><br><br><hr><br><br><br><br> -->

  
  <!-- Popup Modal Box for View the full details -->
  <div id="view-modal" class="modal-class">
    <div id="view-modal-div">
      <h2>View Full Details</h2>
      <div id="load-view-table">
      <!-- <form action="" id="view-form"> -->
        <div class="pic-container"></div>
       <table cellpadding="10px" cellspacing="0" width="100%">
      <!--  <tr>
          <td width="90px">Name</td>
          <td>
          </td>
        </tr>
        <tr>
          <td>Age</td>
          <td></td>
        </tr>
        <tr>
          <td>City</td>
          <td></td>
        </tr>
        <tr>
          <td>dd</td>
          <td></td>
        </tr>  -->
        </table> 
      </div>
      <!-- </form> -->
      <div class="close-btn" id="close-btn-view">X</div>
    </div>
  </div>

  <!-- Popup Modal Box for Update the Records -->
  <div id="modal" class="modal-class">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <form action="" id="edit-form">
      <div class="pic-container"></div>
      <table cellpadding="10px" cellspacing="0" width="100%">

      
      </table>
      </form>
      <div class="close-btn" id="close-btn-edit">X</div>
    </div>
  </div>



  <!-- Popup Modal Box for Adding the Records -->
  <div id="add-modal" class="modal-class">
    <div id="add-modal-form">
      <h2>Add Form</h2>
      <form action="" id="add-form">
      <!-- <div class="pic-container"></div> -->
      <table cellpadding="10px" cellspacing="0" width="100%">

      
      </table>
      </form>
      <div class="close-btn" id="close-btn-add">X</div>
    </div>
  </div>

  <!-- Popup Modal Box for Delete the Records -->
  <div id="delete-modal" class="modal-class">
    <div id="delete-modal-div">
      <div class="message"><p><h2>Are you sure you want to delete this record?</h2></p></div>
      <div class="btn-container">
        <div class="ok-btn"><input type="button" id="ok-btn" value="Ok"></div>
        <div class="cancel-btn"><input type="button" id="cancel-btn" value="Cancel"></div>

      </div>

      <div class="close-btn" id="close-btn-delete">X</div>
    </div>
  </div>
  <!-- Popup Modal Box for Remove Clg teacher pp  -->
  <div class="delete-modal modal-class" id="delete-modal-clg">
    <div class="delete-modal-div">
      <div class="message"><p><h2>Do you want to remove this profile photo?</h2></p></div>
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
      <div class="message"><p><h2>Do you want to remove this profile photo?</h2></p></div>
      <div class="btn-container">
        <div class="ok-btn"><input type="button" id="ok-schl-btn" value="Yes"></div>
        <div class="cancel-btn"><input type="button" id="cancel-schl-btn" value="No"></div>

      </div>

      <div class="close-btn" id="close-btn-remove-pp-schl">X</div>
    </div>
  </div>


  

  <div class="show-pp">

    <div class="pic-and-btn">
      <img src="" alt="profile-pic" id="show-profile-pic">
      <span id="back-pp-btn" class="material-symbols-outlined">
        arrow_back
      </span>
      <!-- <div class="close-btn" id="close-btn-remove-pp-schl">X</div> -->
    </div>
  </div>

  <div class="error-message">error</div>
  <div class="success-message">success</div>















    
    <script src="../js/jquery.js"></script>
    <script src="../js/profile.js"></script>
    <script src="../js/admin-nav.js"></script>
    <script>
      
    </script>
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
      // let count = 1;
      let usersT = [];
      let usersS = [];
      let collegePageT=1;
      let schoolPageT=1;
      let collegePageS=1;
      let schoolPageS=1;
      function onLoad(){
        loadCollegeTeacher(1);
        loadSchoolTeacher(1);
        loadCollegeStudent(1);
        loadSchoolStudent(1);
      }
      onLoad();
      
      function loadCollegeTeacher(page=1,limit=4){
        const userRoleObj = {userRole : "teacher"};
        // const userRoleObj = {userRole : "student"};
        const userRoleJsonStr = JSON.stringify(userRoleObj);
          
        // $("#load-college-teacher").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit, ...userRoleObj};
        // console.log(jsonObjForPagination);
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-fetch-pending-college-user.php",
          type:"POST",
          data: jsonStrForPagination,
          async:false,
          success : function(data){
            $("#load-college-teacher").html("");
            $("#pagination-college-t").html("");
            
            // // console.log(data);
            if(data.status == false){
              $("#load-college-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>No Pending Teachers</h2></td></tr>");
            }else{
              $.each(data, function(key, value){ 
                      let thisTeachersCollege = "";
                      if(value.college_id=="" || value.college_id==undefined || value.college_id==null){
                        thisTeachersCollege = "<p style='color:red'>Pending - yet to be filled<p>";
                      } else{
                        thisTeachersCollege = value.collegeName;
                      }
                      usersT.push(value.userId);
                      $("#load-college-teacher").append("<tr>" + 
                                              "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
                                              "<td>" + value.firstName + " " + value.lastName +"</td>" + 
                                              "<td>" + value.email +"</td>" + 
                                              "<td>" + thisTeachersCollege +"</td>" + 
                                              "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-uni='"+ value.university_id +"'>View</button></td>" + 
                                              "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-uni='"+ value.university_id +"'>Edit</button></td>" +
                                              "</tr>");
                    
                    
                
              });
              

              
                let len = data[0].len;
                  // console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    collegePageT = 1;
                  }else{
                    pageNo = page;
                    collegePageT = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == collegePageT){
                    if(((collegePageT * limit) - (limit-1)) == len){
                      $("#content-container-college #pagination-college-t").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-college #pagination-college-t").append( `<span>Showing ${collegePageT * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                    }
                  }else{
                    $("#content-container-college #pagination-college-t").append( `<span>Showing ${collegePageT * limit - (limit-1)} to ${collegePageT * limit} records out of ${len}</span>`);

                  }

                  
                  if(pageNo>1){
                    // $("#content-container-college #pagination-college-t").append( "<button type='button' onclick=loadCollegeTeacher(page-1)><Prev</button>");
                    $("#content-container-college #pagination-college-t").append( `<button id="college-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-college #pagination-college-t").append( `<button id="college-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
                  }
                  // for(let i=1; i <= len; i++){
                  //   if(i == page){
                  //     class_name = "active";
                  //     $("#content-container-college #pagination-college-t").append(
                  //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                  //     );
                  //   }else{
                  //     class_name = "";
                  //     $("#content-container-college #pagination-college-t").append(
                  //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                  //     );
                  //   }
                  // }
                  // $output .='</div>';
                  
                  if(total_page>pageNo){
                    // $("#content-container-college #pagination-college-t").append( `<button type='button' id="college-page-next-btn" onclick=loadCollegeTeacher(${pageNo+1})>Next ${'>'}</button>`);
                    $("#content-container-college #pagination-college-t").append( `<button type='button' id="college-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
                  } else{
                    $("#content-container-college #pagination-college-t").append( `<button type='button' id="college-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
                  }
              


              
              
            }
          }
        });
                
      }

      $(document).on("click","#college-page-prev-btn",function(){
        let page = $("#college-page-prev-btn").data("prevpage");
        // console.log(page);
        loadCollegeTeacher(page);
      });
      $(document).on("click","#college-page-next-btn",function(){
        let page = $("#college-page-next-btn").data("nextpage");
        // console.log(page);
        loadCollegeTeacher(page);
      });
      function loadSchoolTeacher(page=1,limit=4){
        
        const userRoleObj = {userRole : "teacher"};
        // const userRoleObj = {userRole : "student"};
        const userRoleJsonStr = JSON.stringify(userRoleObj);
        
        // $("#load-school-teacher").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit, ...userRoleObj};
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-fetch-pending-school-user.php",
          type:"POST",
          data:jsonStrForPagination,
          async:false,
          success : function(data){
            $("#load-school-teacher").html("");
            $("#pagination-school-t").html("");
            // // console.log(data);
            let flag=false;
            if(data.status == false){
              $("#load-school-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>No Pending Teachers</h2></td></tr>");
            }else{
              $.each(data, function(key, value){
                
                  flag=true;
                  let thisTeachersSchool = "";
                  if(value.schoolname_id=="" || value.schoolname_id==undefined || value.schoolname_id==null){
                    thisTeachersSchool = "<p style='color:red'>Pending - yet to be filled<p>";
                  } else{
                    thisTeachersSchool = value.schoolnameName;
                  }
                        
                  usersT.push(value.userId);
                  $("#load-school-teacher").append("<tr>" + 
                                              "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
                                              "<td>" + value.firstName + " " + value.lastName +"</td>" + 
                                              "<td>" + value.email +"</td>" + 
                                              "<td>" + thisTeachersSchool +"</td>" + 
                                              "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-schlname='"+ value.schoolname_id +"'>View</button></td>" + 
                                              "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-schlname='"+ value.schoolname_id +"'>Edit</button></td>" +
                                              "</tr>");
                                 
                                              
                                              
              });
              // if(!flag){
              //   $("#load-school-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>No Pending Teachers</h2></td></tr>");

              // } else{
                let len = data[0].len;
                // console.log(len);
                
                let total_record = len;
                let total_page = Math.ceil(total_record / limit) || 1;
                // let total_page = 4;
                let pageNo=1;
                if(page == undefined){
                  pageNo = 1;
                  schoolPageT = 1;
                }else{
                  pageNo = page;
                  schoolPageT = page;
                }
                // $output .='<div id="pagination">';
                let class_name="";
                
                if(Math.ceil(len/limit) == schoolPageT){
                  if(((schoolPageT * limit) - (limit-1)) == len){
                    $("#content-container-school #pagination-school-t").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                  } else{
                    $("#content-container-school #pagination-school-t").append( `<span>Showing ${schoolPageT * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                  }
                }else{
                  $("#content-container-school #pagination-school-t").append( `<span>Showing ${schoolPageT * limit - (limit-1)} to ${schoolPageT * limit} records out of ${len}</span>`);

                }
                
                
                if(pageNo>1){
                  // $("#content-container-school #pagination-college-t").append( "<button type='button' onclick=loadSchoolTeacher(page-1)><Prev</button>");
                  $("#content-container-school #pagination-school-t").append( `<button id="school-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
                } else{
                  $("#content-container-school #pagination-school-t").append( `<button id="school-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
                }
                  // for(let i=1; i <= len; i++){
                  //   if(i == page){
                    //     class_name = "active";
                    //     $("#content-container-school #pagination-school-t").append(
                      //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                      //     );
                  //   }else{
                    //     class_name = "";
                    //     $("#content-container-school #pagination-school-t").append(
                      //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                      //     );
                  //   }
                  // }
                  // $output .='</div>';
                          
                  if(total_page>pageNo){
                            // $("#content-container-school #pagination-school-t").append( `<button type='button' id="school-page-next-btn" onclick=loadSchoolTeacher(${pageNo+1})>Next ${'>'}</button>`);
                    $("#content-container-school #pagination-school-t").append( `<button type='button' id="school-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
                  } else{
                    $("#content-container-school #pagination-school-t").append( `<button type='button' id="school-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
                  }

              // }
            }
          }
        });
      }
                
      $(document).on("click","#school-page-prev-btn",function(){
        let page = $("#school-page-prev-btn").data("prevpage");
        // console.log(page);
        loadSchoolTeacher(page);
      });
      $(document).on("click","#school-page-next-btn",function(){
        let page = $("#school-page-next-btn").data("nextpage");
        // console.log(page);
        loadSchoolTeacher(page);
      });
    // to initally load teachers
    // onLoad();

    
      function loadCollegeStudent(page=1,limit=4){
        
        const userRoleObj = {userRole : "student"};
        // const userRoleObj = {userRole : "student"};
        const userRoleJsonStr = JSON.stringify(userRoleObj);
        // $("#load-college-student").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit, ...userRoleObj};
        // console.log(jsonObjForPagination);
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-fetch-pending-college-user.php",
          type:"POST",
          data: jsonStrForPagination,
          success : function(data){
            $("#load-college-student").html("");
            $("#pagination-college-s").html("");
            
            // console.log(data);
            if(data.status == false){
              $("#load-college-student").html("<tr style='height: 4rem'><td colspan='7'><h2>No Pending Students</h2></td></tr>");
              
            } else{
              
              $.each(data, function(key, value){ 
                  
                        let thisStudentsCollege = "";
                        if(value.college_id=="" || value.college_id==undefined || value.college_id==null){
                          thisStudentsCollege = "<p style='color:red'>Pending - yet to be filled<p>";
                        } else{
                          thisStudentsCollege = value.collegeName;
                        }
                        usersS.push(value.userId);
                        $("#load-college-student").append("<tr>" + 
                                                "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
                                                "<td>" + value.firstName + " " + value.lastName +"</td>" + 
                                                "<td>" + value.rollNumber +"</td>" + 
                                                "<td>" + thisStudentsCollege +"</td>" + 
                                                "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-uni='"+ value.university_id +"'>View</button></td>" + 
                                                "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-uni='"+ value.university_id +"'>Edit</button></td>" +
                                                "</tr>");
                                                
                                                
                                              
                });
                  let len = data[0].len;
                  // console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    collegePageS = 1;
                  }else{
                    pageNo = page;
                    collegePageS = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == collegePageS){
                    if(((collegePageS * limit) - (limit-1)) == len){
                      $("#content-container-college #pagination-college-s").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-college #pagination-college-s").append( `<span>Showing ${collegePageS * limit - (limit-1)} to ${len} records out of ${len}</span>`);
                      
                    }
                  }else{
                    $("#content-container-college #pagination-college-s").append( `<span>Showing ${collegePageS * limit - (limit-1)} to ${collegePageS * limit} records out of ${len}</span>`);
                    
                  }
                  
                  
                  if(pageNo>1){
                    // $("#content-container-college #pagination-college-s").append( "<button type='button' onclick=loadCollegeStudent(page-1)><Prev</button>");
                    $("#content-container-college #pagination-college-s").append( `<button id="college-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-college #pagination-college-s").append( `<button id="college-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
                  }
                  
                  if(total_page>pageNo){
                    // $("#content-container-college #pagination-college-s").append( `<button type='button' id="college-page-next-btn" onclick=loadCollegeStudent(${pageNo+1})>Next ${'>'}</button>`);
                    $("#content-container-college #pagination-college-s").append( `<button type='button' id="college-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
                  } else{
                    $("#content-container-college #pagination-college-s").append( `<button type='button' id="college-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
                  }
              
                  
                  
                  

              
              
              
            }
          }
        });
                
      }

      $(document).on("click","#college-page-prev-btn",function(){
        let page = $("#college-page-prev-btn").data("prevpage");
        // console.log(page);
        loadCollegeStudent(page);
      });
      $(document).on("click","#college-page-next-btn",function(){
        let page = $("#college-page-next-btn").data("nextpage");
        // console.log(page);
        loadCollegeStudent(page);
      });
      function loadSchoolStudent(page=1,limit=4){
        
        const userRoleObj = {userRole : "student"};
        // const userRoleObj = {userRole : "student"};
        const userRoleJsonStr = JSON.stringify(userRoleObj);
        // $("#load-school-student").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit, ...userRoleObj};
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-fetch-pending-school-user.php",
          type:"POST",
          data:jsonStrForPagination,
          success : function(data){
            $("#load-school-student").html("");
            $("#pagination-school-s").html("");
            // // console.log(data);
            if(data.status == false){
              $("#load-school-student").html("<tr style='height: 4rem'><td colspan='7'><h2>No Pending Students</h2></td></tr>");
            }else{
              $.each(data, function(key, value){
                      let thisStudentsSchool = "";
                      if(value.schoolname_id=="" || value.schoolname_id==undefined || value.schoolname_id==null){
                        thisStudentsSchool = "<p style='color:red'>Pending - yet to be filled<p>";
                      } else{
                        thisStudentsSchool = value.schoolnameName;
                      }
                            
                      usersS.push(value.userId);
                      $("#load-school-student").append("<tr>" + 
                                              "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
                                              "<td>" + value.firstName + " " + value.lastName +"</td>" + 
                                              "<td>" + value.rollNumber +"</td>" + 
                                              "<td>" + thisStudentsSchool +"</td>" + 
                                              "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-schlname='"+ value.schoolname_id +"'>View</button></td>" + 
                                              "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "' data-role='"+ value.role +"' data-schlname='"+ value.schoolname_id +"'>Edit</button></td>" +
                                              "</tr>");
                                              
                                    
                        
                    
                });
                  let len = data[0].len;
                  // console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    schoolPageS = 1;
                  }else{
                    pageNo = page;
                    schoolPageS = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == schoolPageS){
                    if(((schoolPageS * limit) - (limit-1)) == len){
                      $("#content-container-school #pagination-school-s").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-school #pagination-school-s").append( `<span>Showing ${schoolPageS * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                    }
                  }else{
                    $("#content-container-school #pagination-school-s").append( `<span>Showing ${schoolPageS * limit - (limit-1)} to ${schoolPageS * limit} records out of ${len}</span>`);

                  }
                  
                  
                  if(pageNo>1){
                    // $("#content-container-school #pagination-college-s").append( "<button type='button' onclick=loadSchoolStudent(page-1)><Prev</button>");
                    $("#content-container-school #pagination-school-s").append( `<button id="school-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-school #pagination-school-s").append( `<button id="school-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
                  }
                    
                            
                  if(total_page>pageNo){
                            // $("#content-container-school #pagination-school-s").append( `<button type='button' id="school-page-next-btn" onclick=loadSchoolStudent(${pageNo+1})>Next ${'>'}</button>`);
                    $("#content-container-school #pagination-school-s").append( `<button type='button' id="school-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
                  } else{
                    $("#content-container-school #pagination-school").append( `<button type='button' id="school-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
                  }

                
            }
          }
        });
      }
                
      $(document).on("click","#school-page-prev-btn",function(){
        let page = $("#school-page-prev-btn").data("prevpage");
        // console.log(page);
        loadSchoolStudent(page);
      });
      $(document).on("click","#school-page-next-btn",function(){
        let page = $("#school-page-next-btn").data("nextpage");
        // console.log(page);
        loadSchoolStudent(page);
      });
      


      
      $(document).on("click", ".view-btn", function() {
        let that = this;
        $("#view-modal").fadeIn(500);
        let obj = {
          userId: $(this).data("vid"),
          schoolOrCollege: $(this).data("soc"),
          userRole: $(this).data("role")
        } // no use of userRoleObj

        let jsonString = JSON.stringify(obj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-get-user-by-userId-and-schoolOrCollege.php",
          type: "POST",
          data: jsonString,
          success: function(data) {
            // // console.log(data);
            // $("#load-view-table table").append('<tr><td>hii1</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii2</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii3</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii4</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii5</td></tr>');
            $("#load-view-table .pic-container").html("<img class='modal-pp' src = '../" + data[0].profilePic + "' alt = 'profile_pic'> ");
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
                    "<td> <strong>Department</strong> </td>" +
                    "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Subject Taught</strong> </td>" +
                    "<td> <p style='color:red'>Pending - yet to be filled<p> </td>" +
                    "</tr>"
                  );
                } else {
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
                    "<td> <strong>Department</strong> </td>" +
                    "<td>" + value.department + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Subject Taught</strong> </td>" +
                    "<td>" + uniqueSubTt + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Email</strong> </td>" +
                    "<td>" + value.email + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Contact Number</strong> </td>" +
                    "<td>" + value.phoneNumber + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<tr>" +
                    "<td> <strong>College</strong> </td>" +
                    "<td>" + value.collegeName + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>University</strong> </td>" +
                    "<td>" + value.universityName + "</td>" +
                    "</tr>" +
                    "<td> <strong>City</strong> </td>" +
                    "<td>" + value.cityName + "</td>" +
                    "</tr>"
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
                    "<td> <strong>Class</strong> </td>" +
                    "<td>" + value.classAssigned + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Subject Taught</strong> </td>" +
                    "<td>" + uniqueSubTt + "</td>" +
                    "</tr>" +
                    "<td> <strong>Email</strong> </td>" +
                    "<td>" + value.email + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Contact Number</strong> </td>" +
                    "<td>" + value.phoneNumber + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>School</strong> </td>" +
                    "<td>" + value.schoolnameName + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td> <strong>Type</strong> </td>" +
                    "<td>" + value.schooltypeType + "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<tr>" +
                    "<td> <strong>City</strong> </td>" +
                    "<td>" + value.cityName + "</td>" +
                    "</tr>"
                  );

                }
              }

            });
          }
        });
      });
      
      $("#close-btn-view").on("click", function() {
        $("#view-modal").hide();
      });
      $("#close-btn-edit").on("click", function() {
        $("#modal").hide();
      });
      $("#close-btn-add").on("click", function() {
        $("#add-modal").hide();
      });
      $("#close-btn-delete").on("click", function() {
        $("#delete-modal").hide();
      });
      $("#close-btn-remove-pp-clg").on("click", function() {
        $(".delete-modal").hide();
      });
      $("#close-btn-remove-pp-schl").on("click", function() {
        $(".delete-modal").hide();
      });

      function closeTheModal() {
        $("#view-modal").hide();
        $("#modal").hide();
        $("#delete-modal").hide();
        $("#add-modal").hide();
        $(".delete-modal").hide();
      }

      
          $(".edit-btn").on("click",function(){
            // e.preventDefault();
            // // console.log($(this).data('uni'));
            if($(this).data('soc')=="college"){
              window.location = `http://localhost/Attendance-system/admin/manage-subject.php?uid=${$(this).data('eid')}&role=${$(this).data('role')}&soc=${$(this).data('soc')}&uni=${$(this).data('uni')}&schlname=${""}`;
              
            }else{
              window.location = `http://localhost/Attendance-system/admin/manage-subject.php?uid=${$(this).data('eid')}&role=${$(this).data('role')}&soc=${$(this).data('soc')}&schlname=${$(this).data('schlname')}&uni=${""}`;

            }
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


    });
    // to initally load students
    // onLoad();

    </script>
  </body>


</html>  