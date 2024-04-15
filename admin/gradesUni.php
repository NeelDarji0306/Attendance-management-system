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
    <link rel="stylesheet" href="../css/admin-nav.css">
    <link rel="stylesheet" href="../css/admin-gradesUni.css">
    <title>grades and university</title>
  </head>
  <body>
  <?php 
    include 'nav.html';
  ?>
  <main>
    <div class="uni-container">
      <div id="table-header">
        <div>University & College List</div>
        <button type="button" name="add-uni" id="add-uni">Add<sup>+</sup></button>
  
      </div>
      <div id="content-container-uni">
        <div id="search-container">
          <label for="search-uni">Search: </label>
          <input type="text" name="search" id="search-uni">
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="uni">
          <tr>
            <th width="40%">University</th>
            <th width="40%">College</th>
            <th width="10%">City</th>
            <th width="10%">Delete</th>
          </tr>
          <tbody id="load-uni"></tbody>
        </table>
        <div id="pagination-uni" class="pagination"></div>
      </div>
    </div>

    
    <div class="grades-container">
      <div id="table-header">
        <div>Type & School List</div>
        <button type="button" name="add-grades" id="add-grades">Add<sup>+</sup></button>
  
      </div>
      
      <div id="content-container-grades">
        <div id="search-container">
          <label for="search-grades">Search: </label>
          <input type="text" name="search" id="search-grades">
        </div>
        <table width="97%" style="margin:auto;" cellpadding="10px" cellspacing="0" id="grades">
          <tr>
            <th width="40%">Type</th>
            <th width="40%">School</th>
            <th width="10%">City</th>
            <th width="10%">Delete</th>
          </tr>
          <tbody id="load-grades"></tbody>
        </table>
        <div id="pagination-grades" class="pagination"></div>
      </div>
    </div>

  </main>
  <!-- <br><br><br><br><br><br><hr><br><br><br><br>
  <br><br><br><br><br><br><hr><br><br><br><br>
  <br><br><br><br><br><br><hr><br><br><br><br> -->

  
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

  <div class="error-message">error</div>
  <div class="success-message">success</div>








    
    <script src="../js/jquery.js"></script>
    <script src="../js/profile.js"></script>
    <script src="../js/admin-nav.js"></script>
    <script>
    $(document).ready( function(){

      
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
      const userRoleObj = {userRole : "teacher"};
      const userRoleJsonStr = JSON.stringify(userRoleObj);
      let users = [];
      let uniPage=1;
      let gradesPage=1;
      let uniPage_search=1;
      let gradesPage_search=1;

      // to load the tables of teachers
      function onLoad(){
        
        loadUniClg(1); // loadUni()
        loadSchoolType(1); // loadGrades()
      } 
      onLoad();
      
      
      function loadUniClg(page=1,limit=4){
        
        // $("#load-uni").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit, ...userRoleObj};
        console.log(jsonObjForPagination);
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-fetch-uni-clg.php",
          type:"POST",
          data: jsonStrForPagination,
          success : function(data){
            $("#load-uni").html("");
            $("#pagination-uni").html("");
            
            // console.log(data);
            if(data.status == false){
              $("#load-uni").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
            }else{
              $.each(data, function(key, value){ 

                
                      users.push(value.userId);
                      $("#load-uni").append("<tr>" +  
                                              "<td>" + value.universityName +"</td>" + 
                                              "<td>" + value.collegeName +"</td>" + 
                                              "<td>" + value.cityName + "</td>" +
                                              "<td><button class='delete-btn' data-clgid='"+ value.collegeId + "' data-uniid='" + value.universityId + "'>Delete</button></td>" + 
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
                  console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    uniPage = 1;
                  }else{
                    pageNo = page;
                    uniPage = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == uniPage){
                    if(((uniPage * limit) - (limit-1)) == len){
                      $("#content-container-uni #pagination-uni").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-uni #pagination-uni").append( `<span>Showing ${uniPage * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                    }
                  }else{
                    $("#content-container-uni #pagination-uni").append( `<span>Showing ${uniPage * limit - (limit-1)} to ${uniPage * limit} records out of ${len}</span>`);

                  }

                  
                  if(pageNo>1){
                    // $("#content-container-uni #pagination-uni").append( "<button type='button' onclick=loadUniClg(page-1)><Prev</button>");
                    $("#content-container-uni #pagination-uni").append( `<button id="uni-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-uni #pagination-uni").append( `<button id="uni-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
                  }
                  // for(let i=1; i <= len; i++){
                  //   if(i == page){
                  //     class_name = "active";
                  //     $("#content-container-uni #pagination-uni").append(
                  //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                  //     );
                  //   }else{
                  //     class_name = "";
                  //     $("#content-container-uni #pagination-uni").append(
                  //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                  //     );
                  //   }
                  // }
                  // $output .='</div>';
                  
                  if(total_page>pageNo){
                    // $("#content-container-uni #pagination-uni").append( `<button type='button' id="uni-page-next-btn" onclick=loadUniClg(${pageNo+1})>Next ${'>'}</button>`);
                    $("#content-container-uni #pagination-uni").append( `<button type='button' id="uni-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
                  } else{
                    $("#content-container-uni #pagination-uni").append( `<button type='button' id="uni-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
                  }
                
              
              
            }
          }
        });
                
      }

      $(document).on("click","#uni-page-prev-btn",function(){
        let page = $("#uni-page-prev-btn").data("prevpage");
        console.log(page);
        loadUniClg(page);
      });
      $(document).on("click","#uni-page-next-btn",function(){
        let page = $("#uni-page-next-btn").data("nextpage");
        console.log(page);
        loadUniClg(page);
      });
      function loadSchoolType(page=1,limit=4){
        
        // $("#load-grades").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit, ...userRoleObj};
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-fetch-type-school.php",
          type:"POST",
          data:jsonStrForPagination,
          success : function(data){
            $("#load-grades").html("");
            $("#pagination-grades").html("");
            // console.log(data);
            if(data.status == false){
              $("#load-grades").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
            }else{
              $.each(data, function(key, value){ 
                
                
                $("#load-grades").append("<tr>" +  
                                              "<td>" + value.schooltypeType +"</td>" + 
                                              "<td>" + value.schoolnameName +"</td>" +
                                              "<td>" + value.cityName + "</td>" +
                                              "<td><button class='delete-btn' data-sid='"+ value.schoolnameId + "' data-tid='" + value.schooltypeId + "'>Delete</button></td>" + 
                                              "</tr>");
                                              
                                              
                                              
              });
              
                  let len = data[0].len;
                  console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    gradesPage = 1;
                  }else{
                    pageNo = page;
                    gradesPage = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == gradesPage){
                    if(((gradesPage * limit) - (limit-1)) == len){
                      $("#content-container-grades #pagination-grades").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-grades #pagination-grades").append( `<span>Showing ${gradesPage * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                    }
                  }else{
                    $("#content-container-grades #pagination-grades").append( `<span>Showing ${gradesPage * limit - (limit-1)} to ${gradesPage * limit} records out of ${len}</span>`);

                  }
                  
                  
                  if(pageNo>1){
                    // $("#content-container-grades #pagination-uni").append( "<button type='button' onclick=loadSchoolType(page-1)><Prev</button>");
                    $("#content-container-grades #pagination-grades").append( `<button id="grades-page-prev-btn" type='button' data-prevpage= "${pageNo-1}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-grades #pagination-grades").append( `<button id="grades-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" disabled>${'<<'} Prev</button>`);
                  }
                    // for(let i=1; i <= len; i++){
                    //   if(i == page){
                      //     class_name = "active";
                      //     $("#content-container-grades #pagination-grades").append(
                        //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                        //     );
                    //   }else{
                      //     class_name = "";
                      //     $("#content-container-grades #pagination-grades").append(
                        //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                        //     );
                    //   }
                    // }
                    // $output .='</div>';
                            
                    if(total_page>pageNo){
                              // $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" onclick=loadSchoolType(${pageNo+1})>Next ${'>'}</button>`);
                      $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" data-nextpage= "${pageNo+1}">Next ${'>>'}</button>`);
                    } else{
                      $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" disabled>Next ${'>>'}</button>`);
                    }
                
            }
          }
        });
      }
                
      $(document).on("click","#grades-page-prev-btn",function(){
        let page = $("#grades-page-prev-btn").data("prevpage");
        console.log(page);
        loadSchoolType(page);
      });
      $(document).on("click","#grades-page-next-btn",function(){
        let page = $("#grades-page-next-btn").data("nextpage");
        console.log(page);
        loadSchoolType(page);
      });



      $("#close-btn-view").on("click",function(){
        $("#view-modal").hide();
      });
      $("#close-btn-edit").on("click",function(){
        $("#modal").hide();
      });
      $("#close-btn-add").on("click",function(){
        $("#add-modal").hide();
      });
      $("#close-btn-delete").on("click",function(){
        $("#delete-modal").hide();
      });
      $("#close-btn-remove-pp-clg").on("click",function(){
        $(".delete-modal").hide();
      });
      $("#close-btn-remove-pp-schl").on("click",function(){
        $(".delete-modal").hide();
      });
      function closeTheModal(){
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
                                    <select name="edit-uni-subtt-select" id="edit-uni-subtt-select">
                                      <option value="select-subtt" disabled selected>---select sub taught---</option>
                                    </select> 
                                  </td>  
                                </tr>
                                <tr>   
                                  <td> <strong>Subject Taught</strong> </td>  
                                  <td> 
                                    <select name="edit-grades-subtt-select" id="edit-grades-subtt-select">
                                      <option value="select-subtt" disabled selected>---select sub taught---</option>
                                    </select> 
                                  </td>  
                                </tr> */
      // to edit the teachers data
      // $(document).on("click",".edit-btn",function(){
      //   $("#modal").fadeIn();
      //   let that = this;
      //   let obj={};
      //   if($(this).data("clgid") != undefined){
      //     obj = {
      //       clgId : $(this).data("clgid"), 
      //       uniId : $(this).data("uniid"),
      //       ...userRoleObj
      //     }// no use of userRoleObj

      //   } else{
      //     obj = {
      //       sid : $(this).data("sid"), 
      //       tid : $(this).data("tid"),
      //       ...userRoleObj
      //     }// no use of userRoleObj

      //   }
        
      //   let jsonString = JSON.stringify(obj);
      //   $.ajax({
      //     url:"http://localhost/Attendance-system/api/api-get-uni-or-schl.php",
      //     type:"POST",
      //     data: jsonString,
      //     success : function(data){
      //       console.log(data);
      //       // $("#load-view-table table").append('<tr><td>hii1</td></tr>');
      //       // $("#load-view-table table").append('<tr><td>hii2</td></tr>');
      //       // $("#load-view-table table").append('<tr><td>hii3</td></tr>');
      //       // $("#load-view-table table").append('<tr><td>hii4</td></tr>');
      //       // $("#load-view-table table").append('<tr><td>hii5</td></tr>');
      //       $.each(data,function(key,value){
      //         if(value.collegeId!=null){
      //             $("#edit-form table").html(
      //                           `
      //                           <tr>
      //                             <td> <strong>University</strong> </td>  
      //                             <td> 
      //                               <select name="edit-uni-universityName-select" id="edit-uni-universityName-select">
      //                                 <option value="select-university" disabled selected>---select university---</option>
                                      
      //                                 `+ loadUni("#edit-uni-universityName-select",value.cityId,value.universityId) +`
      //                               </select>
      //                             </td>  
      //                           </tr> 
      //                           <tr>   
      //                             <td> <strong>College</strong> </td>  
      //                             <td> 
      //                               <select name="edit-uni-collegeName-select" id="edit-uni-collegeName-select">
      //                                 <option value="select-college" disabled selected>---select college---</option>
                                      
      //                                 `+ loadClg("#edit-uni-collegeName-select",value.cityId,value.universityId,value.collegeId) +`
      //                               </select> 
      //                             </td>  
      //                           </tr>  
      //                           <tr>  
      //                             <td> <strong>City</strong> </td>  
      //                             <td> 
      //                               <select name="edit-uni-city-select" id="edit-uni-city-select">
      //                                 <option value="select-city" disabled selected>---select city---</option>
      //                                 `+ loadCity("#edit-uni-city-select",value.cityId) +`
      //                               </select> 
      //                             </td>  
      //                           </tr>
      //                           <tr> 
      //                           <tr>
      //                               <td style="border: none;"></td>
      //                               <td style="border: none;"><input type="submit" id="edit-uni-submit" value="Update"></td>
      //                           </tr>`
      //                     );
                
      //         } else {
                
                
      //             $("#edit-form table").html(
      //               `
                                 
      //                           <tr>
      //                             <td> <strong>Type</strong> </td>  
      //                             <td> 
      //                               <select name="edit-grades-schoolType-select" id="edit-grades-schoolType-select">
      //                                 <option value="select-type" disabled selected>---select type---</option>
                                      
                                      
      //                                 `+ loadSchlType("#edit-grades-schoolType-select",value.schooltypeId) +`
      //                               </select>
      //                             </td>  
      //                           </tr> 
      //                           <tr>   
      //                             <td> <strong>School</strong> </td>  
      //                             <td> 
      //                               <select name="edit-grades-schoolName-select" id="edit-grades-schoolName-select">
      //                                 <option value="select-school" disabled selected>---select school---</option>
                                      
                                      
      //                                 `+ loadSchlName("#edit-grades-schoolName-select",value.schooltypeId,value.cityId,value.schoolnameId)+`
      //                               </select> 
      //                             </td>  
      //                           </tr>
      //                           <tr> 
      //                             <td> <strong>City</strong> </td>  
      //                             <td> 
      //                               <select name="edit-grades-city-select" id="edit-grades-city-select">
      //                                 <option value="select-city" disabled selected>---select city---</option>
      //                                 `+ loadCity("#edit-grades-city-select",value.cityId) +`
      //                               </select> 
      //                             </td>  
      //                           </tr>
      //                           <tr>
      //                               <td style="border: none;"></td>
      //                               <td style="border: none;"><input type="submit" id="edit-grades-submit" value="Update"></td>
      //                           </tr>`
      //                    );
                
      //         }
      //         // if(value.collegeId==null){
      //         //   console.log("clg");
      //         // }
      //       });
      //     }
      //   });
      // });


      // // EDITTT
      // //  // to update profile pic we will do a different thing?? 
      //  $(document).on("submit","#edit-form",function(e){
      //   e.preventDefault();
        
      //   let formData = new FormData(this);
      //   // if nothing is entered by the user and he clicks login 
      //   if(
      //    (($("#edit-uni-city-select").val()==null || $("#edit-uni-city-select").val()==undefined) && ($("#edit-grades-city-select").val()==null || $("#edit-grades-city-select").val()==undefined)) 
      //    ||
      //    (($("#edit-uni-universityName-select").val()==null || $("#edit-uni-universityName-select").val()==undefined) && ($("#edit-grades-schoolType-select").val()==null || $("#edit-grades-schoolType-select").val()==undefined))
      //    ||
      //    (($("#edit-uni-collegeName-select").val()==null || $("#edit-uni-collegeName-select").val()==undefined) && ($("#edit-grades-schoolName-select").val() == null || $("#edit-grades-schoolName-select").val() == undefined)) 
      //    ){
      //     $(".success-message").hide();
      //     $(".error-message").fadeIn();
      //     $(".error-message").text("all fields are mendatory");
      //     setTimeout(() => {
      //       $(".error-message").fadeOut();
      //     }, 4000);
      //   } else{

      //     $.ajax({
      //       url:"http://localhost/Attendance-system/api/api-update-uni-or-schl.php",
      //       type:"POST",
      //       data: formData,
      //       contentType: false,
      //       processData: false,
      //       async:false,
      //       success : function(data){
      //         // console.log(data);
      //         // console.log(data[0].role);
      //         if(data.status == false){
      //           // console.log("in");
      //           $(".success-message").hide();
      //           $(".error-message").fadeIn();
      //           $(".error-message").text(data.message);
      //           setTimeout(() => {
      //             $(".error-message").fadeOut();
      //           }, 4000);
      //         } else{
      //           // onLoad();
      //           if(data.soc == "college"){
      //             console.log("lctu");
      //             loadUniClg(uniPage);
      //             // to avoid the confusion we are clearing the search thing...
      //             $("#search-uni").val("");
      //           } 
      //           if(data.soc == "school"){
      //             console.log("lstu");
      //             loadSchoolType(gradesPage);
      //             // to avoid the confusion we are clearing the search thing...
      //             $("#search-grades").val("");
      //           }
      //           // console.log("inin");
      //           $(".error-message").hide();
      //           $(".success-message").fadeIn();
      //           $(".success-message").text(data.message);
      //           setTimeout(() => {
      //             $(".success-message").fadeOut();
      //           }, 2500);
      //           closeTheModal();
      //         }
      //       }
      //     });
      //   }
      // });




      
      // add uni/clg
      $("#add-uni").on("click",function(){
        $("#add-modal").show();
        
        $("#add-form table").html(
                                `
                                <tr>  
                                  <td> <strong><label for="city">City</label></strong> </td>  
                                  <td> 
                                    <select name="city" id="city">
                                      <option value="select-city" disabled selected>---select city---</option>
                                      `+ loadCity("#city") +`
                                    </select> 
                                  </td>  
                                </tr> 
                                <tr>
                                  <td colspan='2' class="hrr1"><div class="hr-style"><hr class="hrr" />or<hr class="hrr" /></div></td>
                                </tr>
                                <tr>  
                                  <td> <strong><label for="city1">City </label><strong> </td>  
                                  <td>  <input type="text" name="city1" id="city1"></td>
                                </tr>
                                <tr>
                                  <td> <strong><label for="universityName">University</label></strong></td>  
                                  <td> 
                                    <select name="universityName" id="universityName">
                                      <option value="select-university" disabled selected>---select university---</option>
                                      
                                      `+ loadUni("#universityName") +`
                                    </select>
                                  </td>  
                                </tr>
                                <tr>
                                  <td colspan='2' class="hrr1"><div class="hr-style"><hr class="hrr" />or<hr class="hrr" /></div></td>
                                </tr>
                                <tr>  
                                  <td> <strong><label for="universityName1">University</label><strong> </td>  
                                  <td>  <input type="text" name="universityName1" id="universityName1"></td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="collegeName">College name *</label></strong> </td>  
                                  <td>  <input type="text" name="collegeName" id="collegeName"></td>  
                                </tr> 
                                
                                <tr>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"><input type="submit" id="add-uni-submit" value="Add"></td>
                                </tr>`
        );
                
      });
      $("#add-grades").on("click",function(){
        $("#add-modal").show();

        $("#add-form table").html(
                                `
                                <tr>  
                                  <td> <strong><label for="city">City</label></strong> </td>  
                                  <td> 
                                    <select name="city" id="city">
                                      <option value="select-city" disabled selected>---select city---</option>
                                      `+ loadCity("#city") +`
                                    </select> 
                                  </td>  
                                </tr>
                                <tr>
                                  <td colspan='2' class="hrr1"><div class="hr-style"><hr class="hrr" />or<hr class="hrr" /></div></td>
                                </tr>
                                <tr>  
                                  <td> <strong><label for="city1">City </label><strong> </td>  
                                  <td>  <input type="text" name="city1" id="city1"></td>
                                </tr>
                                <tr>
                                <tr>
                                  <td> <strong><label for="schoolType">Type *</label></strong> </td>  
                                  <td> 
                                    <select name="schoolType" id="schoolType">
                                      <option value="select-type" disabled selected>---select type---</option>
                                      
                                      `+ loadSchlType("#schoolType") +`
                                    </select>
                                  </td>  
                                </tr> 
                                <tr>  
                                  <td> <strong><label for="schoolName">School name *</label><strong> </td>  
                                  <td>  <input type="text" name="schoolName" id="schoolName"></td>  
                                </tr>
                                <tr>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"><input type="submit" id="add-grades-submit" value="Add"></td>
                                </tr>`
        );
        // afterUni("#universityName");
      });

      // adding college teacher data
      $(document).on("click","#add-uni-submit",function(e){
        e.preventDefault();
        // $("#add-form").trigger("reset");
        // let city = $("#city").val();
        let city = "";
        if($("#city").val()==null || $("#city").val()==undefined){
          city = $("city1").val();
        } else{
          city = $("#city").val();
        }
        let universityName = "";
        if($("#universityName").val()==null || $("#universityName").val()==undefined){
          universityName = $("universityName1").val();
        } else{
          universityName = $("#universityName").val();
        }
        let collegeName = $("#collegeName").val();
        // if nothing is entered by the user and he clicks login 
        if((city==null || city==undefined || city.trim()=="") || (universityName==null || universityName==undefined || universityName.trim()=="") || collegeName==null){
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else{
          let addObj = {
            city : city,
            uni : universityName,
            clg : collegeName,
            ...userRoleObj
          };
          let addJsonStr = JSON.stringify(addObj);

          $.ajax({
            url:"http://localhost/Attendance-system/api/api-insert-uni-clg.php",
            type:"POST",
            data: addJsonStr,
            success : function(data){
              console.log(data);
              // console.log(data[0].role);
              if(data.status == false){
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 4000);
              } else{
                // loadUniClg(uniPage);
                loadUniClg(1); //aa pn chale coz aapde obviously page no. 1, je by default load thse, ene j load krvanu che
                // console.log("inin");
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

      //edit-school-submit
      $(document).on("click","#add-grades-submit",function(e){
        
        e.preventDefault();
        // $("#add-form").trigger("reset");
        let city = "";
        let flag="";
        if($("#city").val()==null || $("#city").val()==undefined){
          city = $("#city1").val();
          flag = "new";
        } else{
          city = $("#city").val();
          flag = "exists";
        }
        let schoolType = $("#schoolType").val();
        let schoolName = $("#schoolName").val();
        // if nothing is entered by the user and he clicks login 
        console.log(city + " " + schoolType + " " + schoolName)
        if((city==null || city==undefined || city.trim()=="") || schoolType==null || schoolName.trim()==""){
          $(".success-message").hide();
          $(".error-message").fadeIn();
          $(".error-message").text("all fields are mendatory");
          setTimeout(() => {
            $(".error-message").fadeOut();
          }, 4000);
        } else{
          let addObj = {
            city : city,
            schoolType : schoolType,
            schoolName : schoolName,
            flag : flag,
            ...userRoleObj
          };
          let addJsonStr = JSON.stringify(addObj);

          $.ajax({
            url:"http://localhost/Attendance-system/api/api-insert-school.php",
            type:"POST",
            data: addJsonStr,
            success : function(data){
              console.log(data);
              // console.log(data[0].role);
              if(data.status == false){
                // console.log("in");
                $(".success-message").hide();
                $(".error-message").fadeIn();
                $(".error-message").text(data.message);
                setTimeout(() => {
                  $(".error-message").fadeOut();
                }, 4000);
              } else{
                
                // loadSchoolType(gradesPage);
                loadSchoolType(1); //aa pn chale coz aapde obviously page no. 1, je by default load thse, ene j load krvanu che
                // console.log("inin");
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



      
      
      // to show delete modal
      $(document).on("click",".delete-btn",function(){
        $("#delete-modal").fadeIn(300);
        if($(this).data("clgid")!=undefined){
          let clgId = $(this).data("clgid");
          $(("#ok-btn")).data("cos","c");
          $(("#ok-btn")).data("clgid",clgId);

        } else{
          sId = $(this).data("sid");
          $(("#ok-btn")).data("cos","s");
          $(("#ok-btn")).data("sid",sId);

        }
        // let deleteUserObj = {uId : uId};
        // let deleteUserStr = JSON.stringify(deleteUserObj);
        // alert(uId);
        // alert(schlOrClg);
      });
      $(document).on("click","#ok-btn",function(){
        // console.log($(this).data("id"));
        // console.log($(this).data("soc"));
        let cos = $(this).data("cos");
        let deleteObj = {};
        if($(this).data("cos")=="c"){
          // console.log("clg " + $(this).data("clgid"));
          deleteObj = {id : $(this).data("clgid"), cos : "c"};
        } else{
          // console.log("school " + $(this).data("sid"));
          deleteObj = {id : $(this).data("sid"), cos : "s"};
        }
        let deleteStr = JSON.stringify(deleteObj);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-delete-college-school.php",
          type:"POST",
          data: deleteStr,
          async:false,
          success : function(data){
            if(data.status == false){
              // console.log("in");
              $(".success-message").hide();
              $(".error-message").fadeIn();
              $(".error-message").text(data.message);
              setTimeout(() => {
                $(".error-message").fadeOut();
              }, 4000);
            } else{
              // onLoad();
              // console.log(users);
              users.pop();
              // console.log(users);
              if(cos == "c"){
                console.log("c");
                loadUniClg(uniPage);
              } 
              if(cos == "s"){
                console.log("s");
                loadSchoolType(gradesPage);
              }
              // console.log("inin");
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
      $(document).on("click","#cancel-btn",function(){
        $("#delete-modal").hide();

      });



       // search functionality in both    search-uni,search-grades
       $("#search-uni").on("keyup",function(){
        let search_term = $(this).val();
        let searchTermObj = {search: search_term, ...userRoleObj};
        let searchTermStr = JSON.stringify(searchTermObj);
        if(search_term.trim()!=''){
          searchUniClg(search_term);
          // $.ajax({
          //   url:"http://localhost/Attendance-system/api/api-search-uni-college.php",
          //   type:"POST",
          //   data: searchTermStr,
          //   success : function(data){
              
          //   $("#pagination-uni").html("");
          //   $("#load-uni").html("");
          //     // console.log(data);
          //     if(data.status == false){
          //       $("#load-uni").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
          //     }else{
          //       $.each(data, function(key, value){ 
  
          //               $("#load-uni").append("<tr>" +  
          //                                     "<td>" + value.universityName +"</td>" + 
          //                                     "<td>" + value.collegeName +"</td>" + 
          //                                     "<td>" + value.cityName + "</td>" +
          //                                     "<td><button class='delete-btn' data-clgid='"+ value.collegeId + "' data-uniid='" + value.universityId + "'>Delete</button></td>" + 
          //                                     "</tr>");
          //     // let queryObj = {query: "SELECT COUNT(*) AS len FROM users JOIN college ON users.college_id = college.collegeId WHERE role='teacher' ORDER BY userId DESC"};
              
                    
                  
          //       });
          //     }
          //   }
          // });

        } else{
          loadUniClg();
        }

      });
      
      function searchUniClg(search,page=1,limit=4){
        
        // $("#load-uni").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit,search:search, ...userRoleObj};
        console.log(jsonObjForPagination);
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-search-uni-college.php",
          type:"POST",
          data: jsonStrForPagination,
          success : function(data){
            $("#load-uni").html("");
            $("#pagination-uni").html("");
            
            // console.log(data);
            if(data.status == false){
              $("#load-uni").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
            }else{
              $.each(data, function(key, value){ 

                
                      users.push(value.userId);
                      $("#load-uni").append("<tr>" +  
                                              "<td>" + value.universityName +"</td>" + 
                                              "<td>" + value.collegeName +"</td>" + 
                                              "<td>" + value.cityName + "</td>" +
                                              "<td><button class='delete-btn' data-clgid='"+ value.collegeId + "' data-uniid='" + value.universityId + "'>Delete</button></td>" + 
                                              "</tr>");
                    
                  
                
              });


              
                  let len = data[0].len;
                  console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    uniPage_search = 1;
                  }else{
                    pageNo = page;
                    uniPage_search = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == uniPage_search){
                    if(((uniPage_search * limit) - (limit-1)) == len){
                      $("#content-container-uni #pagination-uni").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-uni #pagination-uni").append( `<span>Showing ${uniPage_search * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                    }
                  }else{
                    $("#content-container-uni #pagination-uni").append( `<span>Showing ${uniPage_search * limit - (limit-1)} to ${uniPage_search * limit} records out of ${len}</span>`);

                  }

                  
                  if(pageNo>1){
                    // $("#content-container-uni #pagination-uni").append( "<button type='button' onclick=loadUniClg(page-1)><Prev</button>");
                    $("#content-container-uni #pagination-uni").append( `<button id="uni-search-page-prev-btn" type='button' data-prevpage= "${pageNo-1}" data-search="${search}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-uni #pagination-uni").append( `<button id="uni-search-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" data-search="${search}" disabled>${'<<'} Prev</button>`);
                  }
                  // for(let i=1; i <= len; i++){
                  //   if(i == page){
                  //     class_name = "active";
                  //     $("#content-container-uni #pagination-uni").append(
                  //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                  //     );
                  //   }else{
                  //     class_name = "";
                  //     $("#content-container-uni #pagination-uni").append(
                  //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                  //     );
                  //   }
                  // }
                  // $output .='</div>';
                  
                  if(total_page>pageNo){
                    // $("#content-container-uni #pagination-uni").append( `<button type='button' id="uni-search-page-next-btn" onclick=loadUniClg(${pageNo+1})>Next ${'>'}</button>`);
                    $("#content-container-uni #pagination-uni").append( `<button type='button' id="uni-search-page-next-btn" data-nextpage= "${pageNo+1}" data-search="${search}">Next ${'>>'}</button>`);
                  } else{
                    $("#content-container-uni #pagination-uni").append( `<button type='button' id="uni-search-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" data-search="${search}" disabled>Next ${'>>'}</button>`);
                  }
                
              
              
            }
          }
        });
      }
      
      $(document).on("click","#uni-search-page-prev-btn",function(){
        let page = $("#uni-search-page-prev-btn").data("prevpage");
        let search = $("#uni-search-page-prev-btn").data("search");
        console.log(page);
        console.log(search);
        searchUniClg(search,page);
      });
      $(document).on("click","#uni-search-page-next-btn",function(){
        let page = $("#uni-search-page-next-btn").data("nextpage");
        let search = $("#uni-search-page-next-btn").data("search");
        console.log(page);
        console.log(search);
        searchUniClg(search,page);
      });
      //same thing USING GET REQUESTTTTTTTTTTTTTTTTTt
      // $("#search-uni").on("keyup",function(){
      //   let search_term = $(this).val();
        
      //   if(search_term.trim()!=''){
      //     $.ajax({
      //       url:"http://localhost/Attendance-system/api/api-search-uni.php?search="+search_term.trim(),
      //       type:"GET",
      //       success : function(data){
              
      //       $("#load-uni").html("");
      //         // console.log(data);
      //         if(data.status == false){
      //           $("#load-uni").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
      //         }else{
      //           $.each(data, function(key, value){ 
  
      //                   $("#load-uni").append("<tr>" + 
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
      //     loadUniClg();
      //   }

      // });
      
      $("#search-grades").on("keyup",function(){
        let search_term = $(this).val();
        let searchTermObj = {search: search_term, ...userRoleObj};
        let searchTermStr = JSON.stringify(searchTermObj);
        if(search_term.trim()!=''){
          searchSchoolType(search_term);
          // $.ajax({
          //   url:"http://localhost/Attendance-system/api/api-search-school.php",
          //   type:"POST",
          //   data: searchTermStr,
          //   success : function(data){

          //     $("#pagination-grades").html("");
          //     $("#load-grades").html("");
          //     console.log(data);
          //     if(data.status == false){
          //       $("#load-grades").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
          //     }else{
          //       $.each(data, function(key, value){ 
                  
                        
          //         $("#load-grades").append("<tr>" +  
          //                                     "<td>" + value.schooltypeType +"</td>" + 
          //                                     "<td>" + value.schoolnameName +"</td>" +
          //                                     "<td>" + value.cityName + "</td>" +
          //                                     "<td><button class='delete-btn' data-sid='"+ value.schoolnameId + "' data-tid='" + value.schooltypeId + "'>Delete</button></td>" + 
          //                                     "</tr>");
                      
                      
                    
                  
          //       });
          //         let len_st = data[0].len;
          //         console.log(len_st);
          //         let limit_st = 4;
          //         let total_record_st = len_st;
          //         let total_page_st = Math.ceil(total_record_st / limit_st) || 1;
          //         // let total_page_st = 4;
          //         let pageNo_st=1;
          //         if(page_st == undefined){
          //           pageNo_st = 1;
          //           gradesPage_search = 1;
          //         }else{
          //           pageNo_st = page_st;
          //           gradesPage_search = page_st;
          //         }
          //         // $output .='<div id="pagination">';
          //         let class_name="";
                  
          //         if(Math.ceil(len_st/limit_st) == gradesPage_search){
          //           if(((gradesPage_search * limit_st) - (limit_st-1)) == len_st){
          //             $("#content-container-grades #pagination-grades").append( `<span>Showing ${len_st}<sup>th</sup> record out of ${len_st}</span>`);
          //           } else{
          //             $("#content-container-grades #pagination-grades").append( `<span>Showing ${gradesPage_search * limit_st - (limit_st-1)} to ${len_st} records out of ${len_st}</span>`);

          //           }
          //         }else{
          //           $("#content-container-grades #pagination-grades").append( `<span>Showing ${gradesPage_search * limit_st - (limit_st-1)} to ${gradesPage_search * limit_st} records out of ${len_st}</span>`);

          //         }
                  
                  
          //         if(pageNo_st>1){
          //           // $("#content-container-grades #pagination-uni").append( "<button type='button' onclick=loadSchoolType(page-1)><Prev</button>");
          //           $("#content-container-grades #pagination-grades").append( `<button id="grades-page-prev-btn" type='button' data-prevpage= "${pageNo_st-1}">${'<<'} Prev</button>`);
          //         } else{
          //           $("#content-container-grades #pagination-grades").append( `<button id="grades-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo_st-1}" disabled>${'<<'} Prev</button>`);
          //         }
          //           // for(let i=1; i <= len; i++){
          //           //   if(i == page){
          //             //     class_name = "active";
          //             //     $("#content-container-grades #pagination-grades").append(
          //               //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
          //               //     );
          //           //   }else{
          //             //     class_name = "";
          //             //     $("#content-container-grades #pagination-grades").append(
          //               //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
          //               //     );
          //           //   }
          //           // }
          //           // $output .='</div>';
                            
          //           if(total_page_st>pageNo_st){
          //                     // $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" onclick=loadSchoolType(${pageNo+1})>Next ${'>'}</button>`);
          //             $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" data-nextpage= "${pageNo_st+1}">Next ${'>>'}</button>`);
          //           } else{
          //             $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" class="disabled" data-nextpage= "${pageNo_st+1}" disabled>Next ${'>>'}</button>`);
          //           }
          //     }
          //   }
          // });
        }else{
          loadSchoolType();
        }
      });

     
      function searchSchoolType(search,page=1,limit=4){
        
        // $("#load-grades").html("");
        // data: jsonStr, AAMA PAGE ID APISU LATER ON....
        let jsonObjForPagination = {page: page, limit: limit,search:search, ...userRoleObj};
        let jsonStrForPagination = JSON.stringify(jsonObjForPagination);
        $.ajax({
          url:"http://localhost/Attendance-system/api/api-search-school.php",
          type:"POST",
          data:jsonStrForPagination,
          success : function(data){
            $("#load-grades").html("");
            $("#pagination-grades").html("");
            // console.log(data);
            if(data.status == false){
              $("#load-grades").html("<tr style='height: 4rem'><td colspan='4'><h2>"+ data.message +"</h2></td></tr>");
            }else{
              $.each(data, function(key, value){ 
                
                
                $("#load-grades").append("<tr>" +  
                                              "<td>" + value.schooltypeType +"</td>" + 
                                              "<td>" + value.schoolnameName +"</td>" +
                                              "<td>" + value.cityName + "</td>" +
                                              "<td><button class='delete-btn' data-sid='"+ value.schoolnameId + "' data-tid='" + value.schooltypeId + "'>Delete</button></td>" + 
                                              "</tr>");
                                              
                                              
                                              
              });

                  let len = data[0].len;
                  console.log(len);
                  
                  let total_record = len;
                  let total_page = Math.ceil(total_record / limit) || 1;
                  // let total_page = 4;
                  let pageNo=1;
                  if(page == undefined){
                    pageNo = 1;
                    gradesPage_search = 1;
                  }else{
                    pageNo = page;
                    gradesPage_search = page;
                  }
                  // $output .='<div id="pagination">';
                  let class_name="";
                  
                  if(Math.ceil(len/limit) == gradesPage_search){
                    if(((gradesPage_search * limit) - (limit-1)) == len){
                      $("#content-container-grades #pagination-grades").append( `<span>Showing ${len}<sup>th</sup> record out of ${len}</span>`);
                    } else{
                      $("#content-container-grades #pagination-grades").append( `<span>Showing ${gradesPage_search * limit - (limit-1)} to ${len} records out of ${len}</span>`);

                    }
                  }else{
                    $("#content-container-grades #pagination-grades").append( `<span>Showing ${gradesPage_search * limit - (limit-1)} to ${gradesPage_search * limit} records out of ${len}</span>`);

                  }
                  
                  
                  if(pageNo>1){
                    // $("#content-container-grades #pagination-uni").append( "<button type='button' onclick=loadSchoolType(page-1)><Prev</button>");
                    $("#content-container-grades #pagination-grades").append( `<button id="grades-search-page-prev-btn" type='button' data-prevpage= "${pageNo-1}" data-search="${search}">${'<<'} Prev</button>`);
                  } else{
                    $("#content-container-grades #pagination-grades").append( `<button id="grades-search-page-prev-btn" class="disabled" type='button' data-prevpage= "${pageNo-1}" data-search="${search}" disabled>${'<<'} Prev</button>`);
                  }
                    // for(let i=1; i <= len; i++){
                    //   if(i == page){
                      //     class_name = "active";
                      //     $("#content-container-grades #pagination-grades").append(
                        //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                        //     );
                    //   }else{
                      //     class_name = "";
                      //     $("#content-container-grades #pagination-grades").append(
                        //               `<a class="${class_name}" id="${i}" href="">${i}</a>`
                        //     );
                    //   }
                    // }
                    // $output .='</div>';
                            
                    if(total_page>pageNo){
                              // $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-page-next-btn" onclick=loadSchoolType(${pageNo+1})>Next ${'>'}</button>`);
                      $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-search-page-next-btn" data-nextpage= "${pageNo+1}" data-search="${search}">Next ${'>>'}</button>`);
                    } else{
                      $("#content-container-grades #pagination-grades").append( `<button type='button' id="grades-search-page-next-btn" class="disabled" data-nextpage= "${pageNo+1}" data-search="${search}" disabled>Next ${'>>'}</button>`);
                    }
                
            }
          }
        });
      }
      $(document).on("click","#grades-search-page-prev-btn",function(){
        let page = $("#grades-search-page-prev-btn").data("prevpage");
        let search = $("#grades-search-page-prev-btn").data("search");
        console.log(page);
        console.log(search);
        searchSchoolType(search,page);
      });
      $(document).on("click","#grades-search-page-next-btn",function(){
        let page = $("#grades-search-page-next-btn").data("nextpage");
        let search = $("#grades-search-page-next-btn").data("search");
        console.log(page);
        console.log(search);
        searchSchoolType(search,page);
      });


      //function for loading city
      function loadCity(id,city_id){
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
      $(document).on("change","#edit-uni-city-select",function(){
        defaultUni();
        loadUni("#edit-uni-universityName-select",$("#edit-uni-city-select").val());
      });
      //default university
      function defaultUni(){
        $("#edit-uni-universityName-select").html(
        "<option value='select-university' disabled selected>---select university---</option>");
      }

      // function to load the university FORR ADD TEACHER
      $(document).on("change","#city",function(){
        defaultUniForAdd();
        loadUni("#universityName",$("#city").val());
      });
      //default university FORR ADD TEACHER
      function defaultUniForAdd(){
        $("#universityName").html(
        "<option value='select-university' disabled selected>---select university---</option>");
      }





      // function to load the schooltype
      function loadSchlType(id,schlType_id){
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





      


    });
    </script>
  </body>


</html>