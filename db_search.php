<?php
  // if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
  //   /*
  //      Up to you which header to send, some prefer 404 even if
  //      the files does exist for security
  //   */
  //   header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  //   /* choose the appropriate page to redirect users */
  //   die( header( 'location: /error.php' ) );
  // }
  require_once "db.php";
  // $_POST['type'] = 'data';
  // $_POST['field'] = 'WR';
  // $_POST['output'] = 'Q90水庫模擬入流量';
  // $_POST['length'] = '未來三個月';
  // $_POST['where'] = '上坪';
  // $_POST['date'] = '2019-01-09';

  switch ($_POST['type']) {
    case 'output':
      // $outputname= array();
      // $outputid= array();
      $field = $_POST['field'];
      $sql = "SELECT OUTPUT_NAME FROM `OUTPUT` WHERE `FIELD_ID` = '$field' AND `PUBLIC` = 'YES'";
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

    case 'length':
      $field = $_POST['field'];
      $output = $_POST['output'];
      $length = array();
      $sql = "SELECT TIME_LENGTH_ID FROM `OUTPUT` WHERE `FIELD_ID` = '$field' AND `OUTPUT_NAME` = '$output'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($length, $row['TIME_LENGTH_ID']);
        }
      }
      for ($i=0; $i < count($length); $i++) {
        $sql = "SELECT TIME_LENGTH_NAME FROM `TIME_LENGTH` where `TIME_LENGTH_ID` = '$length[$i]'";
        $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo $row['TIME_LENGTH_NAME'] . ',';
          }
        }
      }
      break;

    case 'spatial':
      $field = $_POST['field'];
      $output = $_POST['output'];
      $length = $_POST['length'];
      $spatial = [];
      $table = [];
      $cname = [];
      // $sql = "SELECT TIME_START FROM (SELECT TABLE_ID FROM OUTPUT where FIELD_ID = $field and OUTPUT_NAME = $output and TIME_LENGTH_ID = $length)";
      $sql = "SELECT SCALE_SPATIAL_NAME, o.TABLE_ID as ot, s.TABLE_ID as st FROM SCALE_SPATIAL s inner JOIN OUTPUT o on s.SCALE_SPATIAL_ID = o.SCALE_SPATIAL_ID where OUTPUT_NAME = '$output'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($spatial, $row['SCALE_SPATIAL_NAME']);
          array_push($table, $row['ot']);
          array_push($cname, $row['st']);
        }
      }
      // var_dump($spatial);
      for ($i=0; $i < count($spatial); $i++) {
        $sql1 = "SELECT DISTINCT $cname[$i]_NAME FROM $table[$i] t inner JOIN $cname[$i] c on t.$cname[$i]_ID = c.$cname[$i]_ID";
        $result1 = mysqli_query($_SESSION['link'] , $sql1) or die("MySQL query error");
        if (mysqli_num_rows($result1) > 0) {
          while($row1 = mysqli_fetch_assoc($result1)) {
            echo $row1[$cname[$i].'_NAME'] . ',';
          }
        }
        echo ';';
      }
      break;

    case 'date':
      $field = $_POST['field'];
      $output = $_POST['output'];
      $length = $_POST['length'];
      $where = $_POST['where'];
      $table;
      $cname;
      $date = [];
      $d;
      $dcount = 1;
      $sql = "SELECT o.TABLE_ID as ot, s.TABLE_ID as st FROM SCALE_SPATIAL s inner JOIN OUTPUT o on s.SCALE_SPATIAL_ID = o.SCALE_SPATIAL_ID where OUTPUT_NAME = '$output'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          $table = $row['ot'];
          $cname = $row['st'];
        }
      }
      if ($table == 'Q90' || $table == 'q90') {
        $sql1 = "SELECT TIME FROM $table t inner JOIN $cname c on c.{$cname}_ID = t.{$cname}_ID";
        $result1 = mysqli_query($_SESSION['link'] , $sql1) or die("MySQL query error");
        if (mysqli_num_rows($result1) > 0) {
          while($row1 = mysqli_fetch_assoc($result1)) {
            array_push($date, $row1['TIME']);
          }
        }
        echo date("Y") . '-' . $date[0] . ',' . date("Y") . '-' . end($date) . ';';
      } else {
        $sql1 = "SELECT TIME_START FROM $table t inner JOIN $cname c on c.{$cname}_ID = t.{$cname}_ID";
        $result1 = mysqli_query($_SESSION['link'] , $sql1) or die("MySQL query error");
        if (mysqli_num_rows($result1) > 0) {
          while($row1 = mysqli_fetch_assoc($result1)) {
            array_push($date, $row1['TIME_START']);
          }
        }
        echo $date[0] . ',' . end($date) . ';';
        $d = new DateTime($date[0]);
        while ($d != new DateTime(end($date))) {
          date_add($d, date_interval_create_from_date_string('1 day'));
          if ($d != new DateTime($date[$dcount])) {
            echo date_format($d,'Y-m-d') . ',';
          } else {
            $dcount++;
          }
        }
      }

      break;

    case 'data':
      $field = $_POST['field'];
      $output = $_POST['output'];
      $length = $_POST['length'];
      $where = $_POST['where'];
      $date = $_POST['date'];
      $table;
      $cname;
      $ptype;
      $stime;
      $sql = "SELECT o.TABLE_ID as ot, s.TABLE_ID as st, PRESENTING_TYPE_ID, SCALE_TIME_NAME FROM OUTPUT o inner JOIN SCALE_SPATIAL s on s.SCALE_SPATIAL_ID = o.SCALE_SPATIAL_ID inner JOIN TIME_LENGTH l on l.TIME_LENGTH_ID = o.TIME_LENGTH_ID inner JOIN SCALE_TIME stime on stime.SCALE_TIME_ID = o.SCALE_TIME_ID where OUTPUT_NAME = '{$output}' AND FIELD_ID = '{$field}' AND TIME_LENGTH_NAME = '{$length}'";
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          $table = $row['ot'];
          $cname = $row['st'];
          $ptype = $row['PRESENTING_TYPE_ID'];
          $stime = $row['SCALE_TIME_NAME'];
        }
      }
      echo $ptype . ',' . $stime . ',';
      if ($table == 'Q90' || $table == 'q90') {
        $sql1 = "SELECT DATA FROM {$table} t inner JOIN {$cname} c on c.{$cname}_ID = t.{$cname}_ID WHERE TIME = '" . str_replace(date("Y") . '-', '', $date) . "' AND {$cname}_NAME = '{$where}'";
      } else {
        $sql1 = "SELECT DATA FROM {$table} t inner JOIN {$cname} c on c.{$cname}_ID = t.{$cname}_ID WHERE TIME_START = '{$date}' AND {$cname}_NAME = '{$where}'";
      }
      $result1 = mysqli_query($_SESSION['link'] , $sql1) or die("MySQL query error");
      if (mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)) {
          echo $row1['DATA'];
        }
      }
  }
 ?>
