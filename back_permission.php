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
  require_once 'db.php';
  $user = $_COOKIE["login_user"];
  $sql = "SELECT * FROM `cwbservice`.`user` WHERE `email` = '{$user}'";
  $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $usertype = $row['user_type'];
  }
  if ($_SESSION[$user] == true) {
    if ($usertype == $_POST['field'] || $usertype == 'admin') {
      echo '<label class="col-4 text-right p-0 my-auto mr-2">進階功能</label>' . ',';
      echo '<button type="button" class="btn btn-success mx-3" value="">修改屬性</button>' . ',';
      echo '<button type="button" class="btn btn-info mx-3" value="">更新數據</button>';
    }
  }
?>
