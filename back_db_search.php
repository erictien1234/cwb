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
  // $_POST['type'] = 'view';
  // $_POST['servicetype'] = 'OUTPUT';
  // $_POST['field'] = 'WR';
  // $_POST['name'] = '各週之水庫蓄水量預報(Q90)';


  switch ($_POST['type']) {
    case 'dikw':
      $dikwtype = $_POST['dikw_type'];
      $field = $_POST['field'];
      $sql = "SELECT OUTPUT_NAME FROM `OUTPUT` WHERE `FIELD_ID` = '$field' AND `DIKW_ID` = '$dikwtype'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo $row['OUTPUT_NAME'] . ',';
        }
      }
      break;

    case 'view':
      $servicetype = $_POST['servicetype'];
      $field = $_POST['field'];
      $name = $_POST['name'];
      // $sql = "SELECT * FROM `$servicetype` WHERE `FIELD_ID` = '$field' AND `$servicetype" . "_NAME` = '$name'";
      // $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      usleep(200000);
      $sql0 = "SELECT OUTPUT_NAME, DIKW_ID, SCALE_SPATIAL_NAME, SCALE_TIME_NAME, TIME_LENGTH_NAME, UNIT, PUBLIC from OUTPUT o inner JOIN SCALE_SPATIAL s on o.SCALE_SPATIAL_ID=s.SCALE_SPATIAL_ID and o.OUTPUT_NAME= '$name' inner JOIN SCALE_TIME t on o.SCALE_TIME_ID=t.SCALE_TIME_ID inner join TIME_LENGTH l on o.TIME_LENGTH_ID=l.TIME_LENGTH_ID";
      $result0 = mysqli_query($_SESSION['link'] , $sql0) or die("MySQL query error");
      if(mysqli_num_rows($result0) > 0) {
        $row0 = mysqli_fetch_assoc($result0);
        echo $row0['OUTPUT_NAME'] . ',' . $row0['DIKW_ID'] . ',' . $row0['SCALE_SPATIAL_NAME'] . ',' . $row0['SCALE_TIME_NAME'] . ',' . $row0['TIME_LENGTH_NAME'] . ',' . $row0['UNIT'] . ',' . $row0['PUBLIC'];
      }
      // if (mysqli_num_rows($result) > 0) {
      //   $row = mysqli_fetch_assoc($result);
      //   $spatial = $row['SCALE_SPATIAL_ID'];
      //   $timescale = $row['SCALE_TIME_ID'];
      //   $length = $row['TIME_LENGTH_ID'];
      //   $sql1 = "SELECT * FROM `SCALE_SPATIAL` WHERE `SCALE_SPATIAL_ID` = '$spatial'";
      //   $result1 = mysqli_query($_SESSION['link'] , $sql1) or die("MySQL query error");
      //   usleep(200000);
      //   $sql2 = "SELECT * FROM `SCALE_TIME` WHERE `SCALE_TIME_ID` = '$timescale'";
      //   $result2 = mysqli_query($_SESSION['link'] , $sql2) or die("MySQL query error");
      //   usleep(200000);
      //   $sql3 = "SELECT * FROM `TIME_LENGTH` WHERE `TIME_LENGTH_ID` = '$length'";
      //   $result3 = mysqli_query($_SESSION['link'] , $sql3) or die("MySQL query error");
      //   $row1 = mysqli_fetch_assoc($result1);
      //   $row2 = mysqli_fetch_assoc($result2);
      //   $row3 = mysqli_fetch_assoc($result3);
      //   echo $row['OUTPUT_NAME'] . ',' . $row['DIKW_ID'] . ',' . $row1['SCALE_SPATIAL_NAME'] . ',' . $row2['SCALE_TIME_NAME'] . ',' . $row3['TIME_LENGTH_NAME'] . ',' . $row['UNIT'] . ',' . $row['PUBLIC'];
      // }
      break;

    case 'name':
      $field = $_POST['field'];
      $sql = "SELECT OUTPUT_NAME FROM `OUTPUT` WHERE `FIELD_ID` = '$field'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo $row['OUTPUT_NAME'] . ',';
        }
      }
  }

 ?>
