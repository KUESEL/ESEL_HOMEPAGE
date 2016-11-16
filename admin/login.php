<?php
  if ($_POST['password'] == 'esel10582'){
    session_start();
    $_SESSION['session'] = true;
    header("location:./home.php");
  }else{
    header("location:./");
  }
 ?>
