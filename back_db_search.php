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
  require_once 'db.php';
  // $_POST['type'] = 'tool';
  // $_POST['field'] = 'WR';


  switch ($_POST['type']) {
    case 'dikw':
      $servicetype = 'INPUT';
      $dikwtype = $_POST['dikw_type'];
      $field = $_POST['field'];
      if ($dikwtype == 'd') {
        $sql = "SELECT {$servicetype}_NAME FROM $servicetype WHERE `FIELD_ID` = '$field' AND (`DIKW_ID` = 'D1' OR `DIKW_ID` = 'D2')";
      } else {
        $sql = "SELECT {$servicetype}_NAME FROM $servicetype WHERE `FIELD_ID` = '$field' AND `DIKW_ID` = '$dikwtype'";
      }
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          if ($servicetype == 'INPUT') {
            echo $row['INPUT_NAME'] . ',';
          } elseif ($servicetype == 'OUTPUT') {
            echo $row['OUTPUT_NAME'] . ',';
          }
        }
      }
      echo ';';
      $servicetype = 'OUTPUT';
      if ($dikwtype == 'd') {
        $sql = "SELECT {$servicetype}_NAME FROM $servicetype WHERE `FIELD_ID` = '$field' AND (`DIKW_ID` = 'D1' OR `DIKW_ID` = 'D2')";
      } else {
        $sql = "SELECT {$servicetype}_NAME FROM $servicetype WHERE `FIELD_ID` = '$field' AND `DIKW_ID` = '$dikwtype'";
      }
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          if ($servicetype == 'INPUT') {
            echo $row['INPUT_NAME'] . ',';
          } elseif ($servicetype == 'OUTPUT') {
            echo $row['OUTPUT_NAME'] . ',';
          }
        }
      }
      break;

    case 'view':
      $servicetype = $_POST['servicetype'];
      $field = $_POST['field'];
      $name = $_POST['name'];
      usleep(200000);
      if ($servicetype == 'OUTPUT') {
        $sql = "SELECT OUTPUT_NAME, DIKW_ID, SCALE_SPATIAL_NAME, SCALE_TIME_NAME, TIME_LENGTH_NAME, UNIT, PUBLIC from OUTPUT ser inner JOIN SCALE_SPATIAL s on ser.SCALE_SPATIAL_ID=s.SCALE_SPATIAL_ID inner JOIN SCALE_TIME t on ser.SCALE_TIME_ID=t.SCALE_TIME_ID inner join TIME_LENGTH l on ser.TIME_LENGTH_ID=l.TIME_LENGTH_ID WHERE OUTPUT_NAME= '$name'";
      } elseif ($servicetype == 'INPUT') {
        $sql = "SELECT INPUT_NAME, DIKW_ID, SCALE_SPATIAL_NAME, SCALE_TIME_NAME, TIME_LENGTH_NAME, UNIT, PUBLIC from INPUT ser inner JOIN SCALE_SPATIAL s on ser.SCALE_SPATIAL_ID=s.SCALE_SPATIAL_ID inner JOIN SCALE_TIME t on ser.SCALE_TIME_ID=t.SCALE_TIME_ID inner join TIME_LENGTH l on ser.TIME_LENGTH_ID=l.TIME_LENGTH_ID WHERE INPUT_NAME= '$name'";
      }
      $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");
      if(mysqli_num_rows($result) > 0) {
        $row0 = mysqli_fetch_assoc($result);
        if ($servicetype == 'OUTPUT') {
          echo 'OUTPUT,' . $row0['OUTPUT_NAME'] . ',' . $row0['DIKW_ID'] . ',' . $row0['SCALE_SPATIAL_NAME'] . ',' . $row0['SCALE_TIME_NAME'] . ',' . $row0['TIME_LENGTH_NAME'] . ',' . $row0['UNIT'] . ',' . $row0['PUBLIC'];
        } elseif ($servicetype == 'INPUT') {
          echo 'INPUT,' . $row0['INPUT_NAME'] . ',' . $row0['DIKW_ID'] . ',' . $row0['SCALE_SPATIAL_NAME'] . ',' . $row0['SCALE_TIME_NAME'] . ',' . $row0['TIME_LENGTH_NAME'] . ',' . $row0['UNIT'] . ',' . $row0['PUBLIC'];
        }
      }
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
      break;

    case 'tool':
      $field = $_POST['field'];
      $sql1 = "SELECT TOOL_NAME, PARAMETER, t.TOOL_ID FROM TOOL t where t.FIELD_ID = '$field'";
      $sql2 = "SELECT INPUT_NAME, t.TOOL_ID FROM TOOL t inner JOIN TOOLINPUT tin on t.TOOL_ID = tin.TOOL_ID inner JOIN INPUT i on tin.INPUT_ID = i.INPUT_ID WHERE t.FIELD_ID = '$field'";
      $sql3 = "SELECT OUTPUT_NAME, t.TOOL_ID FROM TOOL t inner JOIN TOOLOUTPUT tout on t.TOOL_ID = tout.TOOL_ID inner JOIN OUTPUT o on tout.OUTPUT_ID = o.OUTPUT_ID WHERE t.FIELD_ID = '$field'";
      $result1 = mysqli_query($_SESSION['link'] , $sql1) or die("MySQL query error");
      $tooln = [];
      $toolid = [];
      $toolp = [];
      $tooli = [];
      $toolo = [];
      if (mysqli_num_rows($result1) > 0) {
        // output data of each row
        while($row1 = mysqli_fetch_assoc($result1)) {
          array_push($tooln,($row1['TOOL_NAME']));
          array_push($toolp,($row1['PARAMETER']));
          array_push($toolid,($row1['TOOL_ID']));
        }
      }
      for ($i=0; $i < count($tooln); $i++) {
        $tooli[$i] = [];
        $toolo[$i] = [];
      }
      usleep(100000);
      $result2 = mysqli_query($_SESSION['link'] , $sql2) or die("MySQL query error");
      if (mysqli_num_rows($result2) > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
          for ($i=0; $i < count($tooln); $i++) {
            if ($row2['TOOL_ID'] == $toolid[$i]) {
              array_push($tooli[$i],($row2['INPUT_NAME']));
            }
          }
        }
      }
      usleep(100000);
      $result3 = mysqli_query($_SESSION['link'] , $sql3) or die("MySQL query error");
      if (mysqli_num_rows($result3) > 0) {
        while($row3 = mysqli_fetch_assoc($result3)) {
          for ($i=0; $i < count($tooln); $i++) {
            if ($row3['TOOL_ID'] == $toolid[$i]) {
              array_push($toolo[$i],($row3['OUTPUT_NAME']));
            }
          }
        }
      }
      for ($i=0; $i < count($tooln); $i++) {
        echo $tooln[$i] . ',';
        for ($j=0; $j < count($tooli[$i]); $j++) {
          echo $tooli[$i][$j] . '.';
        }
        echo ',';
        for ($j=0; $j < count($toolo[$i]); $j++) {
          echo $toolo[$i][$j] . '.';
        }
        echo ',' . $toolp[$i] . ';';
      }
      break;
  }

 ?>
