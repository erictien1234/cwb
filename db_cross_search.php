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
  switch ($_POST["sel1"]) {
    case "water1":
    case "weather1":
      $sql = "SELECT `CountyName` FROM `cwbservice`.`county` where `CountyID` = 1";
      break;
    case 'water2':
    case 'weather2':
      $sql = "SELECT `CountyName` FROM `cwbservice`.`county` where `CountyID` != 1";
      break;
  }
  $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo $row["CountyName"]. ",";
    }
  } else {
      echo "0 results";
  }
?>
