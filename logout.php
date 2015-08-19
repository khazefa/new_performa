<?php  
  session_start();
  session_destroy();
  include "lib/config.php";
  echo "<script>alert('Anda telah keluar..'); window.location = '$webhost'</script>";
?>
