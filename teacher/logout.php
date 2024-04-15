<script>
  $(document).ready(function(){
    sessionStorage.removeItem("pp");
    sessionStorage.clear();

  })
</script>
<?php
  
  session_unset();
  session_destroy();
  header("Location:login.html");

?>