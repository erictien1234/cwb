<?php
  if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /*
       Up to you which header to send, some prefer 404 even if
       the files does exist for security
    */
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    /* choose the appropriate page to redirect users */
    die( header( 'location: /error.php' ) );
  }
  require_once "db.php";
  $user = $_POST["user"];
  $pw = $_POST["pw"];
  // $rm = $_POST["rm"];
  $result = null;

  $sql = "SELECT * FROM `cwbservice`.`user` WHERE `email` = '{$user}' AND `pw` = '{$pw}'";
  $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
  if (mysqli_num_rows($result) >= 1) {
    echo 'yes';
    $_SESSION[$user] = true;
    setcookie("login_user",$user,time()+3600);
  } else {
    echo 'no';
  }
?>
