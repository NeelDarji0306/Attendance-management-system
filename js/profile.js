$(document).ready(function () {
  // to hide and show the links when user clicks on menu button
  let clicked = 0;
  let clickCount = 0;
  $(".right").on("click", function (e) {
    e.preventDefault();
    // $(".pages-container").slideToggle().css('display','flex');

    if (clicked == 0) {
      $(".options").removeClass("d-none").addClass("d-flex");
      clicked = 1;
    } else {
      $(".options").addClass("d-none").removeClass("d-flex");
      clicked = 0;
    }
    // $(".options").slideToggle().css('display','flex');

    // window.location = "http://localhost/Attendance-system/teacher/profile.php";
  });
  $(document).on("click", function () {
    // // console.log("k")
    clickCount++;
    if (clickCount == 2 && clicked == 1) {
      // console.log("k")
      $(".options").addClass("d-none").removeClass("d-flex");
      clicked = 0;
      clickCount = 0;
    }
    if (clickCount == 2 && clicked == 0) {
      clickCount = 0;
    }
  });
});
