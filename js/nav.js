$(document).ready(function () {
  // to hide and show the links when user clicks on menu button
  $("#menu-btn").on("click", function (e) {
    e.preventDefault();
    // $(".pages-container").slideToggle().css('display','flex');
    $(".pages-container").fadeToggle().css("display", "flex");
  });
  $(".onhover").hover(
    function () {
      $(".options").removeClass("d-none").addClass("d-flex");
    },
    function () {
      $(".options").addClass("d-none").removeClass("d-flex");
    }
  );

  // for fixing the navigation bar bug
  $(window).resize(function () {
    if (
      $(document).width() > 858 &&
      $(".pages-container").css("display") == "none"
    ) {
      $(".pages-container").css("display", "flex");
      // console.log("hii");
    }
    if (
      $(document).width() <= 858 &&
      $(".pages-container").css("display") == "flex"
    ) {
      $(".pages-container").css("display", "none");
      // console.log("huu");
    }
  });
});
