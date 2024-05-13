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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> -->
  <link rel="stylesheet" href="../css/admin-nav.css">
  <link rel="stylesheet" href="../css/admin-teachers.css">
  <title>teachers</title>
</head>

<body>
  <?php
  include 'nav.html';
  ?>
  <main>
    <div class="college-teacher-container">
      <div id="table-header">
        <div>College Teacher List</div>
        <button type="button" name="add-college-teacher" id="add-college-teacher">Add<sup>+</sup></button>

      </div>
      <div id="content-container-college">
        <div id="search-container">
          <label for="search-college-teacher">Search: </label>
          <input type="text" name="search" id="search-college-teacher">
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="college-teacher">
          <tr>
            <th width="10%">Image</th>
            <th width="20%">Teacher Name</th>
            <th width="20%">Email address</th>
            <th width="20%">College</th>
            <th width="10%">View more</th>
            <th width="10%">Edit</th>
            <th width="10%">Delete</th>
          </tr>
          <tbody id="load-college-teacher"></tbody>
        </table>
        <div id="pagination-college" class="pagination"></div>
      </div>
    </div>


    <div class="school-teacher-container">
      <div id="table-header">
        <div>School Teacher List</div>
        <button type="button" name="add-school-teacher" id="add-school-teacher">Add<sup>+</sup></button>

      </div>

      <div id="content-container-school">
        <div id="search-container">
          <label for="search-school-teacher">Search: </label>
          <input type="text" name="search" id="search-school-teacher">
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="school-teacher">
          <tr>
            <th width="10%">Image</th>
            <th width="20%">Teacher Name</th>
            <th width="20%">Email address</th>
            <th width="20%">School</th>
            <th width="10%">View more</th>
            <th width="10%">Edit</th>
            <th width="10%">Delete</th>
          </tr>
          <tbody id="load-school-teacher"></tbody>
        </table>
        <div id="pagination-school" class="pagination"></div>
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
      <div class="message">
        <p>
        <h2>Are you sure you want to delete this record?</h2>
        </p>
      </div>
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
      <div class="message">
        <p>
        <h2>Do you want to remove this profile photo?</h2>
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
        <h2>Do you want to remove this profile photo?</h2>
        </p>
      </div>
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







      let count = 1;
      const userRoleObj = {
        userRole: "teacher"
      };
      // const userRoleObj = {userRole : "student"};
      const userRoleJsonStr = JSON.stringify(userRoleObj);
      let users = [];
      let collegePage = 1;
      let collegePage_search = 1;
      let schoolPage = 1;
      let schoolPage_search = 1;
      // let pendingCount = 0;


      // function removePendingCount(){
      //     $("#pending-count").hide();
      // }

      // if(pendingCount==0){
      //   removePendingCount();
      // }

      // to load the tables of teachers
      function onLoad() {
        // $.ajax({
        //   url:"http://localhost/Attendance-system/api/api-fetch-all-user.php",
        //   type:"POST",
        //   data: userRoleJsonStr,
        //   success : function(data){
        //     // console.log(data);
        //     $("#load-college-teacher").html("");
        //     $("#load-school-teacher").html("");
        //     if(data.status == false){
        //       $("#load-college-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>"+ data.message +"</h2></td></tr>");
        //       $("#load-school-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>"+ data.message +"</h2></td></tr>");
        //     }else{
        //       $.each(data, function(key, value){ 
        //         // // console.log(value.schoolOrCollege);
        //         if(value.schoolOrCollege == "college"){

        //           let collegeInfoObj = {
        //             userId : value.userId,
        //             schoolOrCollege : value.schoolOrCollege
        //           };
        //           let collegeInfoStr = JSON.stringify(collegeInfoObj);
        //           let thisTeachersCollege = "";
        //           $.ajax({
        //             url:"http://localhost/Attendance-system/api/api-get-college-school-teacher-by-userId-and-schoolOrCollege.php",
        //             type:"POST",
        //             data: collegeInfoStr,
        //             success : function(data){
        //               // // console.log(data);
        //               if(data.status == false){
        //                 thisTeachersCollege = "<p style='color:red'>Pending - yet to be filled<p>";
        //               } else{
        //                 thisTeachersCollege= data[0].collegeName;
        //                 // data[0].collegeName="";
        //                 if(data[0].collegeName == null || data[0].collegeName==""){
        //                   thisTeachersCollege = "<p style='color:red'>Pending - yet to be filled<p>";
        //                 }
        //                 // // console.log(thisTeachersCollege);

        //               }
        //               $("#load-college-teacher").append("<tr>" + 
        //                                       "<td>" + `<img id="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
        //                                       "<td>" + value.firstName + " " + value.lastName +"</td>" + 
        //                                       "<td>" + value.email +"</td>" + 
        //                                       "<td>" + thisTeachersCollege +"</td>" + 
        //                                       "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" + 
        //                                       "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
        //                                       "<td><button class='delete-btn' data-id='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" + 
        //                                       "</tr>");
        //             }
        //           });

        //         }
        //         if(value.schoolOrCollege == "school"){
        //           let collegeInfoObj = {
        //             userId : value.userId,
        //             schoolOrCollege : value.schoolOrCollege
        //           };
        //           let collegeInfoStr = JSON.stringify(collegeInfoObj);
        //           let thisTeachersSchool = "";
        //           $.ajax({
        //             url:"http://localhost/Attendance-system/api/api-get-college-school-teacher-by-userId-and-schoolOrCollege.php",
        //             type:"POST",
        //             data: collegeInfoStr,
        //             success : function(data){
        //               // // console.log(data);
        //               if(data.status == false){
        //                 thisTeachersSchool = "<p style='color:red'>Pending - yet to be filled<p>";
        //               } else{
        //                 thisTeachersSchool= data[0].schoolnameName;
        //                 if(data[0].schoolnameName == null || data[0].schoolnameName==""){
        //                   thisTeachersSchool = "<p style='color:red'>Pending - yet to be filled<p>";
        //                 }
        //                 // // console.log(thisTeachersSchool);

        //               }
        //               $("#load-school-teacher").append("<tr>" + 
        //                                       "<td>" + `<img id="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
        //                                       "<td>" + value.firstName + " " + value.lastName +"</td>" + 
        //                                       "<td>" + value.email +"</td>" + 
        //                                       "<td>" + thisTeachersSchool +"</td>" + 
        //                                       "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" + 
        //                                       "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
        //                                       "<td><button class='delete-btn' data-id='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" + 
        //                                       "</tr>");
        //             }
        //           });
        //         }
        //       });
        //     }
        //   }
        // });
        loadCollegeTeacher(1);
        loadSchoolTeacher(1);
      }
      onLoad();


      function loadCollegeTeacher(page = 1, limit = 4) {

        // $("#load-college-teacher").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {
          page: page,
          limit: limit,
          ...userRoleObj
        };
        // console.log(jsonObjForPagination);
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-fetch-college-user.php",
          type: "POST",
          data: jsonStrForPagination,
          async:false,
          success: function(data) {
            $("#load-college-teacher").html("");
            $("#pagination-college").html("");

            // // console.log(data);
            if (data.status == false) {
              $("#load-college-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>" + data.message + "</h2></td></tr>");
            } else {
              $.each(data, function(key, value) {

                let thisTeachersCollege = "";
                if (value.college_id == "" || value.college_id == undefined || value.college_id == null) {
                  thisTeachersCollege = "<p style='color:red'>Pending - yet to be filled<p>";
                } else {
                  thisTeachersCollege = value.collegeName;
                }
                users.push(value.userId);
                $("#load-college-teacher").append("<tr>" +
                  "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" +
                  "<td>" + value.firstName + " " + value.lastName + "</td>" +
                  "<td>" + value.email + "</td>" +
                  "<td>" + thisTeachersCollege + "</td>" +
                  "<td><button class='view-btn' data-vid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" +
                  "<td><button class='edit-btn' data-eid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
                  "<td><button class='delete-btn' data-id='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" +
                  "</tr>");



              });


              // public function pagination($table,$join = null,$where = null,$limit=null){
              //   // Ch``eck to see if table exists
              //   if($this->tableExists($table)){
              //     if($limit != null){
              //       // select count() query for pagination
              //       $sql = "SELECT COUNT(*) FROM $table";
              //       if($join != null){
              //         $sql .= " JOIN $join";  
              //       }
              //       if($where != null){
              //         $sql .= " WHERE $where"; 
              //       }

              //       $query = $this->mysqli->query($sql);

              //       $total_record = $query->fetch_array();
              //       $total_record = $total_record[0];

              //       $total_page = ceil($total_record / $limit);

              //       $url = basename($_SERVER['PHP_SELF']);
              //       // Get the Page Number which is set in URL
              //       if(isset($_GET['page'])){
              //         $page = $_GET['page'];
              //       }else{
              //         $page = 1;
              //       }
              //       // show pagination
              //       $output = "<ul class='pagination'>";

              //       if($page>1){
              //         $output .= "<li><a href='$url?page=".($page-1)."'>Prev</a></li>";
              //       }

              //       if($total_record > $limit){
              //         for($i = 1; $i <= $total_page; $i++){
              //           if($i == $page){
              //             $cls = "class='active'";
              //           }else{
              //             $cls = "";
              //           }
              //           $output .= "<li><a $cls href='$url?page=$i'>$i</a></li>";
              //         }
              //       }
              //       if($total_page>$page){
              //         $output .= "<li><a href='$url?page=".($page+1)."'>Next</a></li>";
              //       }
              //       $output .= "</ul>";

              //       echo $output;

              //     }else{
              //       return false; // If Limit is null
              //     }
              //   }else{
              //     return false; // Table does not exist
              //   }
              // }



              let len = data[0].len;
              // console.log(len);

              let total_record = len;
              let total_page = Math.ceil(total_record / limit) || 1;
              // let total_page = 4;
              let pageNo = 1;
              if (page == undefined) {
                pageNo = 1;
                collegePage = 1;
              } else {
                pageNo = page;
                collegePage = page;
              }
              // $output .='<div id="pagination">';
              let class_name = "";

              if (Math.ceil(len / limit) == collegePage) {
                if (((collegePage * limit) - (limit - 1)) == len) {
                  $("#content-container-college #pagination-college").append(`<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                } else {
                  $("#content-container-college #pagination-college").append(`<span>Showing ${collegePage * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                }
              } else {
                $("#content-container-college #pagination-college").append(`<span>Showing ${collegePage * limit - (limit-1)} to ${collegePage * limit} records out of ${len}</span>`);

              }


              if (pageNo > 1) {
                // $("#content-container-college #pagination-college").append( "<button type='button' onclick=loadCollegeTeacher(page-1)><Prev</button>");
                $("#content-container-college #pagination-college").append(`<button id="college-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
              } else {
                $("#content-container-college #pagination-college").append(`<button id="college-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
              }
              // for(let i=1; i <= len; i++){
              //   if(i == page){
              //     class_name = "active";
              //     $("#content-container-college #pagination-college").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }else{
              //     class_name = "";
              //     $("#content-container-college #pagination-college").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }
              // }
              // $output .='</div>';

              if (total_page > pageNo) {
                // $("#content-container-college #pagination-college").append( `<button type='button' id="college-page-next-btn" onclick=loadCollegeTeacher(${pageNo+1})>Next ${'>'}</button>`);
                $("#content-container-college #pagination-college").append(`<button type='button' id="college-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
              } else {
                $("#content-container-college #pagination-college").append(`<button type='button' id="college-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
              }

            }
          }
        });

      }

      $(document).on("click", "#college-page-prev-btn", function() {
        let page = $("#college-page-prev-btn").data("prevpage");
        // console.log(page);
        loadCollegeTeacher(page);
      });
      $(document).on("click", "#college-page-next-btn", function() {
        let page = $("#college-page-next-btn").data("nextpage");
        // console.log(page);
        loadCollegeTeacher(page);
      });

      function loadSchoolTeacher(page = 1, limit = 4) {

        // $("#load-school-teacher").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {
          page: page,
          limit: limit,
          ...userRoleObj
        };
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-fetch-school-user.php",
          type: "POST",
          data: jsonStrForPagination,
          async:false,
          success: function(data) {
            $("#load-school-teacher").html("");
            $("#pagination-school").html("");
            // // console.log(data);
            if (data.status == false) {
              $("#load-school-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>" + data.message + "</h2></td></tr>");
            } else {
              $.each(data, function(key, value) {
                let thisTeachersSchool = "";
                if (value.schoolname_id == "" || value.schoolname_id == undefined || value.schoolname_id == null) {
                  thisTeachersSchool = "<p style='color:red'>Pending - yet to be filled<p>";
                } else {
                  thisTeachersSchool = value.schoolnameName;
                }

                users.push(value.userId);
                $("#load-school-teacher").append("<tr>" +
                  "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" +
                  "<td>" + value.firstName + " " + value.lastName + "</td>" +
                  "<td>" + value.email + "</td>" +
                  "<td>" + thisTeachersSchool + "</td>" +
                  "<td><button class='view-btn' data-vid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" +
                  "<td><button class='edit-btn' data-eid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
                  "<td><button class='delete-btn' data-id='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" +
                  "</tr>");



              });

              let len = data[0].len;
              // console.log(len);

              let total_record = len;
              let total_page = Math.ceil(total_record / limit) || 1;
              // let total_page = 4;
              let pageNo = 1;
              if (page == undefined) {
                pageNo = 1;
                schoolPage = 1;
              } else {
                pageNo = page;
                schoolPage = page;
              }
              // $output .='<div id="pagination">';
              let class_name = "";

              if (Math.ceil(len / limit) == schoolPage) {
                if (((schoolPage * limit) - (limit - 1)) == len) {
                  $("#content-container-school #pagination-school").append(`<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                } else {
                  $("#content-container-school #pagination-school").append(`<span>Showing ${schoolPage * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                }
              } else {
                $("#content-container-school #pagination-school").append(`<span>Showing ${schoolPage * limit - (limit-1)} to ${schoolPage * limit} records out of ${len}</span>`);

              }


              if (pageNo > 1) {
                // $("#content-container-school #pagination-college").append( "<button type='button' onclick=loadSchoolTeacher(page-1)><Prev</button>");
                $("#content-container-school #pagination-school").append(`<button id="school-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
              } else {
                $("#content-container-school #pagination-school").append(`<button id="school-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
              }
              // for(let i=1; i <= len; i++){
              //   if(i == page){
              //     class_name = "active";
              //     $("#content-container-school #pagination-school").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }else{
              //     class_name = "";
              //     $("#content-container-school #pagination-school").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }
              // }
              // $output .='</div>';

              if (total_page > pageNo) {
                // $("#content-container-school #pagination-school").append( `<button type='button' id="school-page-next-btn" onclick=loadSchoolTeacher(${pageNo+1})>Next ${'>'}</button>`);
                $("#content-container-school #pagination-school").append(`<button type='button' id="school-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
              } else {
                $("#content-container-school #pagination-school").append(`<button type='button' id="school-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
              }
            }
          }
        });
      }

      $(document).on("click", "#school-page-prev-btn", function() {
        let page = $("#school-page-prev-btn").data("prevpage");
        // console.log(page);
        loadSchoolTeacher(page);
      });
      $(document).on("click", "#school-page-next-btn", function() {
        let page = $("#school-page-next-btn").data("nextpage");
        // console.log(page);
        loadSchoolTeacher(page);
      });
      // to initally load teachers
      // onLoad();



      // make onclick event listner and when user clicks on the view btn the make a ajax request on api-fetch-all-data-of single-user.php also in edit and (delete if needed)
      // to view the full details
      $(document).on("click", ".view-btn", function() {
        let that = this;
        $("#view-modal").fadeIn(500);
        let obj = {
          userId: $(this).data("vid"),
          schoolOrCollege: $(this).data("soc"),
          ...userRoleObj
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
                    "<td>" + value.subjectTaught + "</td>" +
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
                    "<td>" + value.subjectTaught + "</td>" +
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


      //Hide Modal Box
      // $(".close-btn").on("click",function(){
      // });
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




      // the functionality to edit the "subject taught" of teahcers is currently not added in this admin role, will add it later on... right  now it can only be done by teacher themselves.
      /* <tr>   
          <td> <strong>Subject Taught</strong> </td>  
          <td> 
            <select name="edit-college-teacher-subtt-select" id="edit-college-teacher-subtt-select">
              <option value="select-subtt" disabled selected>---select sub taught---</option>
            </select> 
          </td>  
        </tr>
        <tr>   
          <td> <strong>Subject Taught</strong> </td>  
          <td> 
            <select name="edit-school-teacher-subtt-select" id="edit-school-teacher-subtt-select">
              <option value="select-subtt" disabled selected>---select sub taught---</option>
            </select> 
          </td>  
        </tr> */
      // to edit the teachers data
      $(document).on("click", ".edit-btn", function() {
        $("#modal").fadeIn();
        let that = this;
        let obj = {
          userId: $(this).data("eid"),
          schoolOrCollege: $(this).data("soc"),
          ...userRoleObj
        } // no use of userRoleObj

        let jsonString = JSON.stringify(obj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-get-user-by-userId-and-schoolOrCollege.php",
          type: "POST",
          data: jsonString,
          success: function(data) {
            // console.log(data);
            // $("#load-view-table table").append('<tr><td>hii1</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii2</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii3</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii4</td></tr>');
            // $("#load-view-table table").append('<tr><td>hii5</td></tr>');
            $.each(data, function(key, value) {
              if (value.schoolOrCollege == "college") {
                if (data[0].profilePic != "images/default.jpg") {
                  $("#edit-form .pic-container").html(`<img class='modal-pp' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> <input type='file' name='profile-picture' id='profile-picture'>
                    <div class="remove-profile-pic">
                      <button class='remove-profile-pic-btn' id='remove-profile-pic-btn-clg' type='button' style='cursor:pointer'><span class="material-symbols-outlined">
                        delete
                      </span></button>
                    </div>`);
                } else {
                  $("#edit-form .pic-container").html("<img class='modal-pp' name='profilePic' src = '../" + data[0].profilePic + "' alt = 'profile_pic'> <input type='file' name='profile-picture' id='profile-picture'>");

                }
                $("#edit-form table").html(
                  `
                                <tr>  
                                  <td> <strong>First Name</strong> </td>  
                                  <td>  <input type="text" name="edit-college-teacher-fname" id="edit-college-teacher-fname" value="${value.firstName}">
                                      <input type="hidden" name="edit-college-teacher-user-id" id="edit-college-teacher-user-id" value="${value.userId}">
                                      <input type="hidden" name="edit-teacher-school-or-college" id="edit-teacher-school-or-college" value="${value.schoolOrCollege}">
                                      <input type="hidden" name="edit-college-teacher-id" id="edit-college-teacher-id" value="${value.teacherId}">
                                      <input type="hidden" name="edit-college-teacher-or-student" id="edit-college-teacher-or-student" value="${userRoleObj.userRole}"> </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong>Last Name</strong> </td>  
                                  <td>  <input type="text" name="edit-college-teacher-lname" id="edit-college-teacher-lname" value="${value.lastName}"> </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong>City</strong> </td>  
                                  <td> 
                                    <select name="edit-college-teacher-city-select" id="edit-college-teacher-city-select">
                                      <option value="select-city" disabled selected>---select city---</option>
                                      ` + loadCity("#edit-college-teacher-city-select", value.city_id) + `
                                    </select> 
                                  </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong>Email</strong> </td>  
                                  <td>  <input type="email" name="edit-college-teacher-email" id="edit-college-teacher-email" value="${value.email}"> </td>  
                                </tr> 
                                <tr>
                                  <td> <strong>University</strong> </td>  
                                  <td> 
                                    <select name="edit-college-teacher-universityName-select" id="edit-college-teacher-universityName-select">
                                      <option value="select-university" disabled selected>---select university---</option>
                                      
                                      ` + loadUni("#edit-college-teacher-universityName-select", value.city_id, value.university_id) + `
                                    </select>
                                  </td>  
                                </tr> 
                                <tr>   
                                  <td> <strong>College</strong> </td>  
                                  <td> 
                                    <select name="edit-college-teacher-collegeName-select" id="edit-college-teacher-collegeName-select">
                                      <option value="select-college" disabled selected>---select college---</option>
                                      
                                      ` + loadClg("#edit-college-teacher-collegeName-select", value.city_id, value.university_id, value.college_id) + `
                                    </select> 
                                  </td>  
                                </tr>  
                                <tr>   
                                  <td> <strong>Department</strong> </td>  
                                  <td> 
                                    <select name="edit-college-teacher-department-select" id="edit-college-teacher-department-select">
                                      <option value="select-department" disabled selected>---select department---</option>
                                      
                                      ` + loadDep("#edit-college-teacher-department-select", value.department) + `
                                    </select> 
                                  </td>  
                                </tr>  
                                  
                                <tr>   
                                  <td> <strong>Contact Number</strong> </td>  
                                  <td>  <input type="number" name="edit-college-teacher-phoneNumber" id="edit-college-teacher-phoneNumber" value="${value.phoneNumber}"> </td> 
                                </tr>  
                                <tr>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"><input type="submit" id="edit-college-teacher-submit" value="Update"></td>
                                </tr>`
                );

              } else {
                if (data[0].profilePic != "images/default.jpg") {
                  $("#edit-form .pic-container").html(`<img class='modal-pp' name='profilePic' src = '../${data[0].profilePic}' alt = 'profile_pic'> <input type='file' name='profile-picture' id='profile-picture'>
                    <div class="remove-profile-pic">
                      <button class='remove-profile-pic-btn' id='remove-profile-pic-btn-schl' type='button' style='cursor:pointer'><span class="material-symbols-outlined">
                        delete
                      </span></button>
                    </div>`);
                } else {
                  $("#edit-form .pic-container").html("<img class='modal-pp' name='profilePic' src = '../" + data[0].profilePic + "' alt = 'profile_pic'> <input type='file' name='profile-picture' id='profile-picture'>");

                }

                $("#edit-form table").html(
                  `<tr>  
                                  <td> <strong>First Name</strong> </td>  
                                  <td>  <input type="text" name="edit-school-teacher-fname" id="edit-school-teacher-fname" value="${value.firstName}">
                                        <input type="hidden" name="edit-school-teacher-user-id" id="edit-school-teacher-user-id" value="${value.userId}">
                                      <input type="hidden" name="edit-teacher-school-or-college" id="edit-teacher-school-or-college" value="${value.schoolOrCollege}">
                                      <input type="hidden" name="edit-school-teacher-id" id="edit-school-teacher-id" value="${value.teacherId}">
                                      <input type="hidden" name="edit-school-teacher-or-student" id="edit-school-teacher-or-student" value="${userRoleObj.userRole}"> </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong>Last Name</strong> </td>  
                                  <td>  <input type="text" name="edit-school-teacher-lname" id="edit-school-teacher-lname" value="${value.lastName}"> </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong>City</strong> </td>  
                                  <td> 
                                    <select name="edit-school-teacher-city-select" id="edit-school-teacher-city-select">
                                      <option value="select-city" disabled selected>---select city---</option>
                                      ` + loadCity("#edit-school-teacher-city-select", value.cityId) + `
                                    </select> 
                                  </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong>Email</strong> </td>  
                                  <td>  <input type="email" name="edit-school-teacher-email" id="edit-school-teacher-email" value="${value.email}"> </td>  
                                </tr> 
                                <tr>
                                  <td> <strong>Type</strong> </td>  
                                  <td> 
                                    <select name="edit-school-teacher-schoolType-select" id="edit-school-teacher-schoolType-select">
                                      <option value="select-type" disabled selected>---select type---</option>
                                      
                                      
                                      ` + loadSchlType("#edit-school-teacher-schoolType-select", value.schooltype_id) + `
                                    </select>
                                  </td>  
                                </tr> 
                                <tr>   
                                  <td> <strong>School</strong> </td>  
                                  <td> 
                                    <select name="edit-school-teacher-schoolName-select" id="edit-school-teacher-schoolName-select">
                                      <option value="select-school" disabled selected>---select school---</option>
                                      
                                      
                                      ` + loadSchlName("#edit-school-teacher-schoolName-select", value.schooltype_id, value.city_id, value.schoolname_id) + `
                                    </select> 
                                  </td>  
                                </tr>  <tr>   
                                  <td> <strong>Class</strong> </td>  
                                  <td> 
                                    <select name="edit-school-teacher-classAssigned-select" id="edit-school-teacher-classAssigned-select">
                                      <option value="select-classAssigned" disabled selected>---select class---</option>
                                      
                                      
                                      ` + loadClass("#edit-school-teacher-classAssigned-select", value.classAssigned) + `
                                    </select> 
                                  </td>  
                                </tr>    
                                <tr>   
                                  <td> <strong>Contact Number</strong> </td>  
                                  <td>  <input type="number" name="edit-school-teacher-phoneNumber" id="edit-school-teacher-phoneNumber" value="${value.phoneNumber}"> </td> 
                                </tr>  
                                <tr>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"><input type="submit" id="edit-school-teacher-submit" value="Update"></td>
                                </tr>`
                );

              }

            });
          }
        });
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
      $(document).on("change", "#edit-college-teacher-city-select", function() {
        defaultUni();
        loadUni("#edit-college-teacher-universityName-select", $("#edit-college-teacher-city-select").val());
      });
      //default university
      function defaultUni() {
        $("#edit-college-teacher-universityName-select").html(
          "<option value='select-university' disabled selected>---select university---</option>");
      }

      // function to load the university FORR ADD TEACHER
      $(document).on("change", "#city", function() {
        defaultUniForAdd();
        loadUni("#universityName", $("#city").val());
      });
      //default university FORR ADD TEACHER
      function defaultUniForAdd() {
        $("#universityName").html(
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
      $(document).on("change", "#edit-college-teacher-city-select", function() {
        defaultClg();

        if ($("#edit-college-teacher-universityName-select").val() == null) {
          defaultClg();
        } else {
          loadClg("#edit-college-teacher-collegeName-select", $("#edit-college-teacher-city-select").val(), $("#edit-college-teacher-universityName-select").val());

        }
      });
      $(document).on("change", "#edit-college-teacher-universityName-select", function() {
        defaultClg();
        loadClg("#edit-college-teacher-collegeName-select", $("#edit-college-teacher-city-select").val(), $("#edit-college-teacher-universityName-select").val());
      });
      //default college
      function defaultClg() {
        $("#edit-college-teacher-collegeName-select").html(
          "<option value='select-college' disabled selected>---select college---</option>");
      }


      // function to load the college FOR ADD TEACHER
      $(document).on("change", "#city", function() {
        defaultClgForAdd();

        if ($("#universityName").val() == null) {
          defaultClgForAdd();
        } else {
          loadClg("#collegeName", $("#city").val(), $("#universityName").val());

        }
      });
      $(document).on("change", "#universityName", function() {
        defaultClgForAdd();
        loadClg("#collegeName", $("#city").val(), $("#universityName").val());
      });
      //default college FOR ADD TEACHER
      function defaultClgForAdd() {
        $("#collegeName").html(
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
      //   $("#edit-college-teacher-department-select").html(
      //                                 '<option value="select-department" disabled selected>---select department---</option>'
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
        $("#edit-school-teacher-schoolName-select").html(
          '<option value="select-school" disabled selected>---select school---</option>'
        );
      }
      $(document).on("change", "#edit-school-teacher-schoolType-select", function() {
        defaultSchl();
        loadSchlName("#edit-school-teacher-schoolName-select", $("#edit-school-teacher-schoolType-select").val(), $("#edit-school-teacher-city-select").val());
      });
      $(document).on("change", "#edit-school-teacher-city-select", function() {
        defaultSchl();
        loadSchlName("#edit-school-teacher-schoolName-select", $("#edit-school-teacher-schoolType-select").val(), $("#edit-school-teacher-city-select").val());
      });


      //defalut school name FOR ADD TEACHER
      function defaultSchlForAdd() {
        $("#schoolName").html(
          '<option value="select-school" disabled selected>---select school---</option>'
        );
      }
      $(document).on("change", "#schoolType", function() {
        defaultSchlForAdd();
        loadSchlName("#schoolName", $("#schoolType").val(), $("#city").val());
      });
      $(document).on("change", "#city", function() {
        defaultSchlForAdd();
        if ($("#schoolType").val() == null || $("#schoolType").val() == undefined) {

        } else {
          loadSchlName("#schoolName", $("#schoolType").val(), $("#city").val());

        }
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
      // default class 
      // function defaultClass(){
      //   $("#edit-school-teacher-class-select").html(
      //                                 '<option value="select-class" disabled selected>---select class---</option>'
      //   );
      // }



      // EDITTT
      //  // to update profile pic we will do a different thing?? 
      // $(document).on("submit","#edit-college-teacher-form",function(e){
      $(document).on("submit", "#edit-form", function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        // if nothing is entered by the user and he clicks login 
        if (
          (($("#edit-college-teacher-fname").val() == '' || $("#edit-college-teacher-fname").val() == undefined) &&
            ($("#edit-school-teacher-fname").val() == '' || $("#edit-school-teacher-fname").val() == undefined)) ||
          (($("#edit-college-teacher-lname").val() == '' || $("#edit-college-teacher-lname").val() == undefined) &&
            ($("#edit-school-teacher-lname").val() == '' || $("#edit-school-teacher-lname").val() == undefined)) ||
          (($("#edit-college-teacher-city-select").val() == null || $("#edit-college-teacher-city-select").val() == undefined) && ($("#edit-school-teacher-city-select").val() == null || $("#edit-school-teacher-city-select").val() == undefined)) ||
          (($("#edit-college-teacher-email").val() == '' || $("#edit-college-teacher-email").val() == undefined) &&
            ($("#edit-school-teacher-email").val() == '' || $("#edit-school-teacher-email").val() == undefined)) ||
          (($("#edit-college-teacher-universityName-select").val() == null || $("#edit-college-teacher-universityName-select").val() == undefined) && ($("#edit-school-teacher-schoolType-select").val() == null || $("#edit-school-teacher-schoolType-select").val() == undefined)) ||
          (($("#edit-college-teacher-collegeName-select").val() == null || $("#edit-college-teacher-collegeName-select").val() == undefined) && ($("#edit-school-teacher-schoolName-select").val() == null || $("#edit-school-teacher-schoolName-select").val() == undefined)) ||
          (($("#edit-college-teacher-department-select").val() == null || $("#edit-college-teacher-department-select").val() == undefined) && ($("#edit-school-teacher-classAssigned-select").val() == null || $("#edit-school-teacher-classAssigned-select").val() == undefined)) ||
          (($("#edit-college-teacher-phoneNumber").val() == '' || $("#edit-college-teacher-phoneNumber").val() == undefined) && ($("#edit-school-teacher-phoneNumber").val() == '' || $("#edit-school-teacher-phoneNumber").val() == undefined))
        ) {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else {

          $.ajax({
            url: "http://localhost/Attendance-system/api/api-update-teachers-details.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            async: false,
            success: function(data) {
              // // console.log(data);
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
                // onLoad();
                if (data.soc == "college") {
                  // console.log("lctu");
                  loadCollegeTeacher(collegePage);
                  // to avoid the confusion we are clearing the search thing...
                  $("#search-college-teacher").val("");
                }
                if (data.soc == "school") {
                  // console.log("lstu");
                  loadSchoolTeacher(schoolPage);
                  // to avoid the confusion we are clearing the search thing...
                  $("#search-school-teacher").val("");
                }
                // // console.log("inin");
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 2500);
                closeTheModal();
              }
            }
          });
        }
      });

      // to remove profile pic and set it to the default one
      $(document).on("click", "#remove-profile-pic-btn-clg", function() {
        // // console.log(users.length);
        $("#delete-modal-clg").fadeIn(300);
        let uId = $("#edit-college-teacher-user-id").val();
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
              // // console.log(users);
              $.each(users, function(key, value) {
                // // console.log(value);
                if ($($("img.profile-pic")[key]).data("id") == $($("#remove-profile-pic-btn-clg").closest("#edit-form").children("table").children("tr").children("td").children("input")[1]).val()) {
                  $($("img.profile-pic")[key]).attr("src", "../images/default.jpg");

                }
              });
              // for(let i=0; i < users.length; i++){
              //   // console.log(users[i])
              // }
              $("#edit-form .pic-container").html("<img name='profilePic' src = '../images/default.jpg' alt = 'profile_pic' height = '200px'> <input type='file' name='profile-picture' id='profile-picture'>");
            }
            // // console.log(data.message);
          }

        });
      });

      $(document).on("click", "#remove-profile-pic-btn-schl", function() {

        $("#delete-modal-schl").fadeIn(300);
        let uId = $("#edit-school-teacher-user-id").val();
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

              $.each(users, function(key, value) {
                // // console.log(value);
                if ($($("img.profile-pic")[key]).data("id") == $($("#remove-profile-pic-btn-schl").closest("#edit-form").children("table").children("tr").children("td").children("input")[1]).val()) {
                  $($("img.profile-pic")[key]).attr("src", "../images/default.jpg");

                }
              });
              $("#edit-form .pic-container").html("<img name='profilePic' src = '../images/default.jpg' alt = 'profile_pic' height = '200px'> <input type='file' name='profile-picture' id='profile-picture'>");
            }
            // // console.log(data.message);
          }

        });
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








      // add teacher
      $("#add-college-teacher").on("click", function() {
        $("#add-modal").show();

        $("#add-form table").html(
          `
                                <tr>  
                                  <td> <strong><label for="fname">First Name *</label><strong> </td>  
                                  <td>  <input type="text" name="fname" id="fname"></td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="lname">Last Name *</label></strong> </td>  
                                  <td>  <input type="text" name="lname" id="lname"></td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="city">City *</label></strong> </td>  
                                  <td> 
                                    <select name="city" id="city">
                                      <option value="select-city" disabled selected>---select city---</option>
                                      ` + loadCity("#city") + `
                                    </select> 
                                  </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="email">Email *</label></strong> </td>  
                                  <td>  <input type="email" name="email" id="email"> </td>  
                                </tr> 
                                <tr>
                                  <td> <strong><label for="universityName">University *</label></strong> </td>  
                                  <td> 
                                    <select name="universityName" id="universityName">
                                      <option value="select-university" disabled selected>---select university---</option>
                                      
                                      ` + loadUni("#universityName") + `
                                    </select>
                                  </td>  
                                </tr> 
                                <tr>   
                                  <td> <strong><label for="collegeName">College *</label></strong> </td>  
                                  <td> 
                                    <select name="collegeName" id="collegeName">
                                      <option value="select-college" disabled selected>---select college---</option>
                                      
                                      ` + loadClg("#collegeName") + `
                                    </select> 
                                  </td>  
                                </tr>  
                                <tr>   
                                  <td> <strong><label for="department">Department *</label></strong> </td>  
                                  <td> 
                                    <select name="department" id="department">
                                      <option value="select-department" disabled selected>---select department---</option>
                                      
                                      ` + loadDep("#department") + `
                                    </select> 
                                  </td>  
                                </tr>  
                                  
                                <tr>   
                                  <td> <strong><label for="phoneNumber">Contact Number *</label></strong> </td>  
                                  <td>  <input type="number" name="phoneNumber" id="phoneNumber"> </td> 
                                </tr>  
                                <tr>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"><input type="submit" id="add-college-teacher-submit" value="Add"></td>
                                </tr>`
        );

      });
      $("#add-school-teacher").on("click", function() {
        $("#add-modal").show();

        $("#add-form table").html(
          `
                                <tr>  
                                  <td> <strong><label for="fname">First Name *</label><strong> </td>  
                                  <td>  <input type="text" name="fname" id="fname"></td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="lname">Last Name *</label></strong> </td>  
                                  <td>  <input type="text" name="lname" id="lname"></td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="city">City *</label></strong> </td>  
                                  <td> 
                                    <select name="city" id="city">
                                      <option value="select-city" disabled selected>---select city---</option>
                                      ` + loadCity("#city") + `
                                    </select> 
                                  </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="email">Email *</label></strong> </td>  
                                  <td>  <input type="email" name="email" id="email"> </td>  
                                </tr> 
                                <tr>
                                  <td> <strong><label for="schoolType">Type *</label></strong> </td>  
                                  <td> 
                                    <select name="schoolType" id="schoolType">
                                      <option value="select-type" disabled selected>---select type---</option>
                                      
                                      ` + loadSchlType("#schoolType") + `
                                    </select>
                                  </td>  
                                </tr> 
                                <tr>   
                                  <td> <strong><label for="schoolName">School *</label></strong> </td>  
                                  <td> 
                                    <select name="schoolName" id="schoolName">
                                      <option value="select-school" disabled selected>---select school---</option>
                                      
                                      ` + loadSchlName("#schoolName") + `
                                    </select> 
                                  </td>  
                                </tr>  
                                <tr>   
                                  <td> <strong><label for="classAssigned">Class *</label></strong> </td>  
                                  <td> 
                                    <select name="classAssigned" id="classAssigned">
                                      <option value="select-classAssigned" disabled selected>---select class---</option>
                                      
                                      ` + loadClass("#classAssigned") + `
                                    </select> 
                                  </td>  
                                </tr>  
                                  
                                <tr>   
                                  <td> <strong><label for="phoneNumber">Contact Number *</label></strong> </td>  
                                  <td>  <input type="number" name="phoneNumber" id="phoneNumber"> </td> 
                                </tr>  
                                <tr>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"><input type="submit" id="add-school-teacher-submit" value="Add"></td>
                                </tr>`
        );
      });

      // adding college teacher data
      $(document).on("click", "#add-college-teacher-submit", function(e) {
        e.preventDefault();
        // $("#add-form").trigger("reset");
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let city = $("#city").val();
        let email = $("#email").val();
        let universityName = $("#universityName").val();
        let collegeName = $("#collegeName").val();
        let department = $("#department").val();
        let phoneNumber = $("#phoneNumber").val();
        // if nothing is entered by the user and he clicks login 
        if (fname == "" || lname == "" || city == null || email == "" || universityName == null || collegeName == null || department == null || phoneNumber == "") {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else {
          let addClgTeacherObj = {
            fname: fname,
            lname: lname,
            city: city,
            email: email,
            uni: universityName,
            clg: collegeName,
            dep: department,
            phoneNo: phoneNumber,
            ...userRoleObj
          };
          let addClgTeacherJsonStr = JSON.stringify(addClgTeacherObj);

          $.ajax({
            url: "http://localhost/Attendance-system/api/api-insert-college-user.php",
            type: "POST",
            data: addClgTeacherJsonStr,
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
                // loadCollegeTeacher(collegePage);
                loadCollegeTeacher(1); //aa pn chale coz aapde obviously page no. 1, je by default load thse, ene j load krvanu che
                // // console.log("inin");
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 2500);
                $("#add-form").trigger("reset");
                closeTheModal();
              }
            }
          });
        }
      });

      // adding school teacher data
      $(document).on("click", "#add-school-teacher-submit", function(e) {

        e.preventDefault();
        // $("#add-form").trigger("reset");
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let city = $("#city").val();
        let email = $("#email").val();
        let schoolType = $("#schoolType").val();
        let schoolName = $("#schoolName").val();
        let classAssigned = $("#classAssigned").val();
        let phoneNumber = $("#phoneNumber").val();
        // if nothing is entered by the user and he clicks login 
        if (fname == "" || lname == "" || city == null || email == "" || schoolType == null || schoolName == null || classAssigned == null || phoneNumber == "") {
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else {
          let addSchlTeacherObj = {
            fname: fname,
            lname: lname,
            city: city,
            email: email,
            schoolType: schoolType,
            schoolName: schoolName,
            classAssigned: classAssigned,
            phoneNo: phoneNumber,
            ...userRoleObj
          };
          let addSchlTeacherJsonStr = JSON.stringify(addSchlTeacherObj);

          $.ajax({
            url: "http://localhost/Attendance-system/api/api-insert-school-user.php",
            type: "POST",
            data: addSchlTeacherJsonStr,
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

                // loadSchoolTeacher(schoolPage);
                loadSchoolTeacher(1); //aa pn chale coz aapde obviously page no. 1, je by default load thse, ene j load krvanu che
                // // console.log("inin");
                $(".error-message").hide();
                $(".success-message").fadeIn();
                $(".success-message").text(data.message);
                setTimeout(() => {
                  $(".success-message").fadeOut();
                }, 2500);
                $("#add-form").trigger("reset");
                closeTheModal();
              }
            }
          });
        }
      });
      // copy edit thing ditto......






      // to show delete modal
      $(document).on("click", ".delete-btn", function() {
        $("#delete-modal").fadeIn(300);
        let uId = $(this).data("id");
        let schlOrClg = $(this).data("soc");
        // let deleteUserObj = {uId : uId};
        // let deleteUserStr = JSON.stringify(deleteUserObj);
        $(("#ok-btn")).data("id", uId);
        $(("#ok-btn")).data("soc", schlOrClg);
        // alert(uId);
        // alert(schlOrClg);
      });
      $(document).on("click", "#ok-btn", function() {
        // // console.log($(this).data("id"));
        // // console.log($(this).data("soc"));
        let uId = $(this).data("id");
        let schlOrClg = $(this).data("soc");
        let deleteUserObj = {
          uId: uId
        };
        let deleteUserStr = JSON.stringify(deleteUserObj);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-delete-user.php",
          type: "POST",
          data: deleteUserStr,
          async: false,
          success: function(data) {
            if (data.status == false) {
              // // console.log("in");
              $(".success-message").hide();
              $(".error-message").fadeIn();
              $(".error-message").text(data.message);
              setTimeout(() => {
                $(".error-message").fadeOut();
              }, 4000);
            } else {
              // onLoad();
              // // console.log(users);
              users.pop();
              // // console.log(users);
              if (schlOrClg == "college") {
                // console.log("c");
                loadCollegeTeacher(collegePage);
                $("#search-college-teacher").val("");
              }
              if (schlOrClg == "school") {
                // console.log("s");
                loadSchoolTeacher(schoolPage);
                $("#search-school-teacher").val("");
              }
              // // console.log("inin");
              $(".error-message").hide();
              $(".success-message").fadeIn();
              $(".success-message").text(data.message);
              setTimeout(() => {
                $(".success-message").fadeOut();
              }, 2500);
              closeTheModal();
            }
          }
        });
        // if(schlOrClg == "college"){
        //   alert("okk");
        // }
      });

      //to cancel deleting any record
      $(document).on("click", "#cancel-btn", function() {
        $("#delete-modal").hide();

      });

      // add the functionality to delete the record from users if admin clicks "ok-btn (id)"      







      // search functionality in both    search-college-teacher,search-school-teacher
      $("#search-college-teacher").on("keyup", function() {
        let search_term = $(this).val();
        let searchTermObj = {
          search: search_term,
          ...userRoleObj
        };
        let searchTermStr = JSON.stringify(searchTermObj);
        if (search_term.trim() != '') {
          searchCollegeTeacher(search_term);
          // $.ajax({
          //   url:"http://localhost/Attendance-system/api/api-search-college-user.php",
          //   type:"POST",
          //   data: searchTermStr,
          //   success : function(data){

          //   $("#pagination-college").html("");
          //   $("#load-college-teacher").html("");
          //     // // console.log(data);
          //     if(data.status == false){
          //       $("#load-college-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>"+ data.message +"</h2></td></tr>");
          //     }else{
          //       $.each(data, function(key, value){ 

          //         $("#load-college-teacher").append("<tr>" + 
          //                                       "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
          //                                       "<td>" + value.firstName + " " + value.lastName +"</td>" + 
          //                                       "<td>" + value.email +"</td>" + 
          //                                       "<td>" + value.collegeName +"</td>" + 
          //                                       "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" + 
          //                                       "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
          //                                       "<td><button class='delete-btn' data-id='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" + 
          //                                       "</tr>");
          //     // let queryObj = {query: "SELECT COUNT(*) AS len FROM users JOIN college ON users.college_id = college.collegeId WHERE role='teacher' ORDER BY userId DESC"};



          //       });
          //     }
          //   }
          // });

        } else {
          loadCollegeTeacher();
        }

      });

      function searchCollegeTeacher(search, page = 1, limit = 4) {


        // $("#load-college-teacher").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {
          page: page,
          limit: limit,
          search: search,
          ...userRoleObj
        };
        // console.log(jsonObjForPagination);
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-search-college-user.php",
          type: "POST",
          data: jsonStrForPagination,
          success: function(data) {
            $("#load-college-teacher").html("");
            $("#pagination-college").html("");

            // console.log(data);
            if (data.status == false) {
              $("#load-college-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>" + data.message + "</h2></td></tr>");
            } else {
              $.each(data, function(key, value) {


                $("#load-college-teacher").append("<tr>" +
                  "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" +
                  "<td>" + value.firstName + " " + value.lastName + "</td>" +
                  "<td>" + value.email + "</td>" +
                  "<td>" + value.collegeName + "</td>" +
                  "<td><button class='view-btn' data-vid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" +
                  "<td><button class='edit-btn' data-eid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
                  "<td><button class='delete-btn' data-id='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" +
                  "</tr>");



              });




              let len = data[0].len;
              // console.log(len);

              let total_record = len;
              let total_page = Math.ceil(total_record / limit) || 1;
              // let total_page = 4;
              let pageNo = 1;
              if (page == undefined) {
                pageNo = 1;
                collegePage_search = 1;
              } else {
                pageNo = page;
                collegePage_search = page;
              }
              // $output .='<div id="pagination">';
              let class_name = "";

              if (Math.ceil(len / limit) == collegePage_search) {
                if (((collegePage_search * limit) - (limit - 1)) == len) {
                  $("#content-container-college #pagination-college").append(`<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                } else {
                  $("#content-container-college #pagination-college").append(`<span>Showing ${collegePage_search * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                }
              } else {
                $("#content-container-college #pagination-college").append(`<span>Showing ${collegePage_search * limit - (limit-1)} to ${collegePage_search * limit} records out of ${len}</span>`);

              }


              if (pageNo > 1) {
                // $("#content-container-college #pagination-college").append( "<button type='button' onclick=loadCollegeTeacher(page-1)><Prev</button>");
                $("#content-container-college #pagination-college").append(`<button id="college-search-page-prev-btn" type='button' data-prevpage= "${pageNo-1}" data-search="${search}">${'<<'} Prev</button>`);
              } else {
                $("#content-container-college #pagination-college").append(`<button id="college-search-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" data-search="${search}" disabled>${'<<'} Prev</button>`);
              }
              // for(let i=1; i <= len; i++){
              //   if(i == page){
              //     class_name = "active";
              //     $("#content-container-college #pagination-college").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }else{
              //     class_name = "";
              //     $("#content-container-college #pagination-college").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }
              // }
              // $output .='</div>';

              if (total_page > pageNo) {
                // $("#content-container-college #pagination-college").append( `<button type='button' id="college-page-next-btn" onclick=loadCollegeTeacher(${pageNo+1})>Next ${'>'}</button>`);
                $("#content-container-college #pagination-college").append(`<button type='button' id="college-search-page-next-btn" data-nextpage= "${pageNo+1}" data-search="${search}">Next ${'>>'}</button>`);
              } else {
                $("#content-container-college #pagination-college").append(`<button type='button' id="college-search-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" data-search="${search}" disabled>Next ${'>>'}</button>`);
              }

            }
          }
        });
      }

      $(document).on("click", "#college-search-page-prev-btn", function() {
        let page = $("#college-search-page-prev-btn").data("prevpage");
        let search = $("#college-search-page-prev-btn").data("search");
        // console.log(page);
        // console.log(search);
        searchCollegeTeacher(search, page);
      });
      $(document).on("click", "#college-search-page-next-btn", function() {
        let page = $("#college-search-page-next-btn").data("nextpage");
        let search = $("#college-search-page-next-btn").data("search");
        // console.log(page);
        // console.log(search);
        searchCollegeTeacher(search, page);
      });



      function searchSchoolTeacher(search, page = 1, limit = 4) {

        // $("#load-school-teacher").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {
          page: page,
          limit: limit,
          search: search,
          ...userRoleObj
        };
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url: "http://localhost/Attendance-system/api/api-search-school-user.php",
          type: "POST",
          data: jsonStrForPagination,
          success: function(data) {
            $("#load-school-teacher").html("");
            $("#pagination-school").html("");
            // console.log(data);
            if (data.status == false) {
              $("#load-school-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>" + data.message + "</h2></td></tr>");
            } else {
              $.each(data, function(key, value) {

                $("#load-school-teacher").append("<tr>" +
                  "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" +
                  "<td>" + value.firstName + " " + value.lastName + "</td>" +
                  "<td>" + value.email + "</td>" +
                  "<td>" + value.schoolnameName + "</td>" +
                  "<td><button class='view-btn' data-vid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" +
                  "<td><button class='edit-btn' data-eid='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
                  "<td><button class='delete-btn' data-id='" + value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" +
                  "</tr>");



              });

              let len = data[0].len;
              // console.log(len);

              let total_record = len;
              let total_page = Math.ceil(total_record / limit) || 1;
              // let total_page = 4;
              let pageNo = 1;
              if (page == undefined) {
                pageNo = 1;
                schoolPage_search = 1;
              } else {
                pageNo = page;
                schoolPage_search = page;
              }
              // $output .='<div id="pagination">';
              let class_name = "";

              if (Math.ceil(len / limit) == schoolPage_search) {
                if (((schoolPage_search * limit) - (limit - 1)) == len) {
                  $("#content-container-school #pagination-school").append(`<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                } else {
                  $("#content-container-school #pagination-school").append(`<span>Showing ${schoolPage_search * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                }
              } else {
                $("#content-container-school #pagination-school").append(`<span>Showing ${schoolPage_search * limit - (limit-1)} to ${schoolPage_search * limit} records out of ${len}</span>`);

              }


              if (pageNo > 1) {
                // $("#content-container-school #pagination-college").append( "<button type='button' onclick=loadSchoolTeacher(page-1)><Prev</button>");
                $("#content-container-school #pagination-school").append(`<button id="school-search-page-prev-btn" type='button' data-prevpage= "${pageNo-1}" data-search="${search}">${'<<'} Prev</button>`);
              } else {
                $("#content-container-school #pagination-school").append(`<button id="school-search-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" data-search="${search}" disabled>${'<<'} Prev</button>`);
              }
              // for(let i=1; i <= len; i++){
              //   if(i == page){
              //     class_name = "active";
              //     $("#content-container-school #pagination-school").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }else{
              //     class_name = "";
              //     $("#content-container-school #pagination-school").append(
              //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
              //     );
              //   }
              // }
              // $output .='</div>';

              if (total_page > pageNo) {
                // $("#content-container-school #pagination-school").append( `<button type='button' id="school-page-next-btn" onclick=loadSchoolTeacher(${pageNo+1})>Next ${'>'}</button>`);
                $("#content-container-school #pagination-school").append(`<button type='button' id="school-search-page-next-btn" data-nextpage= "${pageNo+1}" data-search="${search}">Next ${'>>'}</button>`);
              } else {
                $("#content-container-school #pagination-school").append(`<button type='button' id="school-search-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" data-search="${search}" disabled>Next ${'>>'}</button>`);
              }
            }
          }
        });
      }

      $(document).on("click", "#school-search-page-prev-btn", function() {
        let page = $("#school-search-page-prev-btn").data("prevpage");
        let search = $("#school-search-page-prev-btn").data("search");
        // console.log(page);
        // console.log(search);
        searchSchoolTeacher(search, page);
      });
      $(document).on("click", "#school-search-page-next-btn", function() {
        let page = $("#school-search-page-next-btn").data("nextpage");
        let search = $("#school-search-page-next-btn").data("search");
        // console.log(page);
        // console.log(search);
        searchSchoolTeacher(search, page);
      });
      //same thing USING GET REQUESTTTTTTTTTTTTTTTTTt
      // $("#search-college-teacher").on("keyup",function(){
      //   let search_term = $(this).val();

      //   if(search_term.trim()!=''){
      //     $.ajax({
      //       url:"http://localhost/Attendance-system/api/api-search-college-teacher.php?search="+search_term.trim(),
      //       type:"GET",
      //       success : function(data){

      //       $("#load-college-teacher").html("");
      //         // // console.log(data);
      //         if(data.status == false){
      //           $("#load-college-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>"+ data.message +"</h2></td></tr>");
      //         }else{
      //           $.each(data, function(key, value){ 

      //                   $("#load-college-teacher").append("<tr>" + 
      //                                           "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
      //                                           "<td>" + value.firstName + " " + value.lastName +"</td>" + 
      //                                           "<td>" + value.email +"</td>" + 
      //                                           "<td>" + value.collegeName +"</td>" + 
      //                                           "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" + 
      //                                           "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
      //                                           "<td><button class='delete-btn' data-id='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" + 
      //                                           "</tr>");



      //           });
      //         }
      //       }
      //     });

      //   } else{
      //     loadCollegeTeacher();
      //   }

      // });

      $("#search-school-teacher").on("keyup", function() {
        let search_term = $(this).val();
        let searchTermObj = {
          search: search_term,
          ...userRoleObj
        };
        let searchTermStr = JSON.stringify(searchTermObj);
        if (search_term.trim() != '') {
          searchSchoolTeacher(search_term);
          // $.ajax({
          //   url:"http://localhost/Attendance-system/api/api-search-school-user.php",
          //   type:"POST",
          //   data: searchTermStr,
          //   success : function(data){

          //     $("#pagination-school").html("");
          //     $("#load-school-teacher").html("");
          //     // // console.log(data);
          //     if(data.status == false){
          //       $("#load-school-teacher").html("<tr style='height: 4rem'><td colspan='7'><h2>"+ data.message +"</h2></td></tr>");
          //     }else{
          //       $.each(data, function(key, value){ 


          //         $("#load-school-teacher").append("<tr>" + 
          //                                       "<td>" + `<img id="${value.userId}" data-id="${value.userId}" class="profile-pic" src="../${value.profilePic}" alt="profile_pic">` + "</td>" + 
          //                                       "<td>" + value.firstName + " " + value.lastName +"</td>" + 
          //                                       "<td>" + value.email +"</td>" + 
          //                                       "<td>" + value.schoolnameName +"</td>" + 
          //                                       "<td><button class='view-btn' data-vid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>View</button></td>" + 
          //                                       "<td><button class='edit-btn' data-eid='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Edit</button></td>" +
          //                                       "<td><button class='delete-btn' data-id='"+ value.userId + "' data-soc='" + value.schoolOrCollege + "'>Delete</button></td>" + 
          //                                       "</tr>");




          //       });
          //     }
          //   }
          // });
        } else {
          loadSchoolTeacher();
        }
      });






      //REMAINING............
      // pagination while search ?? DONEEEEEEEEEEEE



      $(document).on("click", ".profile-pic", function() {
        // console.log($(this).attr("src"));
        // console.log("clicked");
        $(".show-pp").css("display", "flex");
        // $(".show-pp").show();
        $("#show-profile-pic").attr("src", $(this).attr("src"));

      });
      $(document).on("click", "#back-pp-btn", function() {

        $(".show-pp").hide();
      });



      // let imgWidth = $("div > #show-profile-pic").width();
      // $(".pic-and-btn").width(imgWidth);





    });
  </script>

</body>




</html>
<!-- // edit-college-submit teachers

      // $(document).on("click","#edit-college-teacher-submit",function(e){
      //   e.preventDefault();
      //   let edit_college_teacher_fname = $("#edit-college-teacher-fname").val();
      //   let edit_college_teacher_user_id = $("#edit-college-teacher-user-id").val();
      //   let edit_college_teacher_lname = $("#edit-college-teacher-lname").val();
      //   let edit_college_teacher_city_select = $("#edit-college-teacher-city-select").val();
      //   let edit_college_teacher_email = $("#edit-college-teacher-email").val();
      //   let edit_college_teacher_universityName_select = $("#edit-college-teacher-universityName-select").val();
      //   let edit_college_teacher_collegeName_select = $("#edit-college-teacher-collegeName-select").val();
      //   let edit_college_teacher_department_select = $("#edit-college-teacher-department-select").val();
      //   let edit_college_teacher_phoneNumber = $("#edit-college-teacher-phoneNumber").val();
      //   let editClgTeacherObj = {
      //     fname : edit_college_teacher_fname,
      //     userId : edit_college_teacher_user_id,
      //     lname : edit_college_teacher_lname,
      //     city : edit_college_teacher_city_select,
      //     email : edit_college_teacher_email,
      //     uni : edit_college_teacher_universityName_select,
      //     clg : edit_college_teacher_collegeName_select,
      //     dep : edit_college_teacher_department_select,
      //     phoneNo : edit_college_teacher_phoneNumber
      //   };
      //   let editClgTeacherJsonStr = JSON.stringify(editClgTeacherObj);
      //   // if nothing is entered by the user and he clicks login 
      //   if(edit_college_teacher_fname=="" || edit_college_teacher_user_id=="" || edit_college_teacher_lname=="" || edit_college_teacher_city_select==null || edit_college_teacher_email=="" || edit_college_teacher_universityName_select==null || edit_college_teacher_collegeName_select==null || edit_college_teacher_department_select==null || edit_college_teacher_phoneNumber==""){
      //     $(".success-message").hide();
      //     $(".error-message").fadeIn();
      //     $(".error-message").text("all fields are mendatory");
      //     setTimeout(() => {
      //       $(".error-message").fadeOut();
      //     }, 4000);
      //   } else{

      //     $.ajax({
      //       url:"http://localhost/Attendance-system/api/api-update-teachers-details.php",
      //       type:"POST",
      //       data: editClgTeacherJsonStr,
      //       success : function(data){
      //         // console.log(data);
      //         // // console.log(data[0].role);
      //         if(data.status == false){
      //           // // console.log("in");
      //           $(".success-message").hide();
      //           $(".error-message").fadeIn();
      //           $(".error-message").text(data.message);
      //           setTimeout(() => {
      //             $(".error-message").fadeOut();
      //           }, 4000);
      //         } else{
                
      //           // // console.log("inin");
      //           $(".error-message").hide();
      //           $(".success-message").fadeIn();
      //           $(".success-message").text(data.message);
      //           setTimeout(() => {
      //             $(".success-message").fadeOut();
      //           }, 4000);
      //         }
      //       }
      //     });
      //   }
      // });

      // //edit-school-submit
      // $(document).on("click","#edit-school-teacher-submit",function(){
        
      // }); -->