    $(document).ready(function(){

      // //Hide Modal Box
      // $("#close-btn-remove-pp-clg").on("click", function() {
      //   $(".delete-modal").hide();
      // });
      // $("#close-btn-remove-pp-schl").on("click", function() {
      //   $(".delete-modal").hide();
      // });

      // // for remove pp
      // $(document).on("click", "#cancel-clg-btn", function() {
      //   $("#delete-modal-clg").hide();

      // });
      // $(document).on("click", "#cancel-schl-btn", function() {
      //   $("#delete-modal-schl").hide();

      // });

      // // for remove pp
      // $(document).on("click", "#ok-clg-btn", function() {
      //   $("#delete-modal-clg").hide();

      // });
      // $(document).on("click", "#ok-schl-btn", function() {
      //   $("#delete-modal-schl").hide();

      // });





      
      // // It requires to set ```edit-college-teacher-user-id``` id when document is ready

      // // to remove profile pic and set it to the default one ----> fix delete modal
      // $(document).on("click", "#remove-profile-pic-btn-clg", function() {
      //   // console.log(users.length);
      //   // it requires to set ```edit-college-teacher-user-id``` id when document is ready
      //   $("#delete-modal-clg").fadeIn(300);
      //   let uId = $("#edit-college-teacher-user-id").val();
      //   if($("#edit-college-teacher-user-id").val() == undefined){
      //     uId = sessionStorage.getItem("userId");
      //   }
      //   // let uIdObj = {userId : uId};
      //   // let uIdStr = JSON.stringify(uIdObj);

      //   $(("#ok-clg-btn")).data("id", uId);
      // });
      // $(document).on("click", "#ok-clg-btn", function() {
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
      //         sessionStorage.removeItem("pp");
      //         // console.log(users);
      //         $(".container .pic-container").html(`<img class='d-block mx-auto mb-3' name='profilePic' src = '../images/default.jpg' alt = 'profile_pic'> <input type='file' class='d-block mx-auto mb-3' name='profile-picture' id='profile-picture'>`);
      //       }
      //       // console.log(data.message);
      //     }

      //   });
      // });

      // $(document).on("click", "#remove-profile-pic-btn-schl", function() {

      //   $("#delete-modal-schl").fadeIn(300);
      //   let uId = $("#edit-school-teacher-user-id").val();
      //   if($("#edit-school-teacher-user-id").val() == undefined){
      //     uId = sessionStorage.getItem("userId");
      //   }
      //   // let uIdObj = {userId : uId};
      //   // let uIdStr = JSON.stringify(uIdObj);

      //   $(("#ok-schl-btn")).data("id", uId);
      // });
      // $(document).on("click", "#ok-schl-btn", function() {
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

      //         sessionStorage.removeItem("pp");
      //         $("#edit-form .pic-container").html("<img name='profilePic' src = '../images/default.jpg' alt = 'profile_pic' height = '200px'> <input type='file' name='profile-picture' id='profile-picture'>");
      //       }
      //       // console.log(data.message);
      //     }

      //   });
      // });
    });
