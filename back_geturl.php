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
  switch ($_POST['type']) {
    case 'download':
      $table = $_POST['TABLE'];
      $where = $_POST['where'];
      $date = $_POST['date'];
      $cname;

      $sql = "SELECT s.TABLE_ID as st FROM SCALE_SPATIAL s inner JOIN OUTPUT o on s.SCALE_SPATIAL_ID = o.SCALE_SPATIAL_ID where o.TABLE_ID = '{$table}'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          $cname = $row['st'];
        }
      }
      $url = "http://cwbservice.zapto.org/download/?table={$table}&{$cname}={$where}&time={$date}";
      echo $url;

      break;

    case 'api':
      $table = $_POST['TABLE'];
      $name;
      $cname;

      $sql = "SELECT OUTPUT_NAME as ot, s.TABLE_ID as st FROM SCALE_SPATIAL s inner JOIN OUTPUT o on s.SCALE_SPATIAL_ID = o.SCALE_SPATIAL_ID where o.TABLE_ID = '{$table}'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          $cname = $row['st'];
          $name = $row['ot'];
        }
      }
      $url = "http://cwbservice.zapto.org/api/?OUTPUT={$name}&{$cname}=WWWW&TIME=YYYY-MM-DD";
      echo $url;

      break;

    default:
      // code...
      break;
  }
?>
