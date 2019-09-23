<?php
  require_once "db.php";
  $username = $_COOKIE["login_user"];
  unset($_SESSION[$username]);
  setcookie("login_user","",time()-3600);
  header("Location: /index.php");
?>
