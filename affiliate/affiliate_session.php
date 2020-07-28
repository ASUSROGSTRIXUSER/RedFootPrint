<?php
  session_start();
  include_once '../conn.php';

  if(!isset($_SESSION['user']))
  {
      header("Location: affiliate_login.php");
  }
      $res = mysqli_query($conn,"SELECT * FROM wp_member WHERE user_id=".$_SESSION['user']);
      $row = mysqli_fetch_array($res);
?>