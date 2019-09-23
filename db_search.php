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
  switch ($_POST['type']) {
    case 'field':
      // $outputname= array();
      // $outputid= array();
      $field = $_POST['field'];
      $sql = "SELECT * FROM `OUTPUT` WHERE `FIELD_ID` = '$field'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          // array_push($outputname, $row['OUTPUT_NAME']);
          // array_push($outputid, $row['OUTPUT_ID']);
          echo $row['OUTPUT_NAME'] . ",";
        }
      } else {
          echo "無結果" . ",";
      }
      break;

    case 'output':
      $field = $_POST['field'];
      $output = $_POST['output'];
      $length = array();
      $sql = "SELECT * FROM `OUTPUT` WHERE `FIELD_ID` = '$field' AND `OUTPUT_NAME` = '$output'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($length, $row['TIME_LENGTH_ID']);
        }
      }
      for ($i=0; $i < count($length); $i++) {
        $sql = "SELECT * FROM `TIME_LENGTH` where `TIME_LENGTH_ID` = '$length[$i]'";
        $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo $row['TIME_LENGTH_NAME'] . ',';
          }
        }
      }
      break;
  }
 ?>
