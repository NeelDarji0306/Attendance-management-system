
$(document).ready(function() {
  // to hide and show the links when user clicks on menu button
  let clicked = 0;
  $(".right").on("click", function(e) {
    e.preventDefault();
    // $(".pages-container").slideToggle().css('display','flex');

    if(clicked==0){
      $(".options").removeClass("d-none").addClass("d-flex");
      clicked=1;
      
    } else{
      $(".options").addClass("d-none").removeClass("d-flex");
      clicked=0;

    }
    // $(".options").slideToggle().css('display','flex');
    
    // window.location = "http://localhost/Attendance-system/teacher/profile.php";
  });
});