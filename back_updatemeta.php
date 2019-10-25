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

  // $_POST['user'] = 'erictien';
  // $_POST['FIELD_ID'] = 'WR';
  // $_POST['NAME'] = '1';
  // $_POST['DIKW_ID'] = '2';
  // $_POST['SCALE_SPATIAL'] = '3';
  // $_POST['SCALE_TIME'] = '4';
  // $_POST['TIME_LENGTH'] = '5';
  // $_POST['UNIT'] = '6';
  // $_POST['PUBLIC'] = '7';

  $user= $_POST['user'];
  $field= $_POST['FIELD_ID'];
  $name= $_POST['NAME'];
  $dikw= $_POST['DIKW_ID'];
  $spatial= $_POST['SCALE_SPATIAL'];
  $stime= $_POST['SCALE_TIME'];
  $timel= $_POST['TIME_LENGTH'];
  $unit= $_POST['UNIT'];
  $public= $_POST['PUBLIC'];

  $conn = new mysqli('localhost','sdlaber','abcABC123!@#','cwbservice');
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "INSERT INTO metaupdate (username,FIELD_ID,NAME,DIKW_ID,SCALE_SPATIAL_NAME,SCALE_TIME_NAME,TIME_LENGTH_NAME,UNIT,PUBLIC) VALUES ('$user','$field','$name','$dikw','$spatial','$stime','$timel','$unit','$public')";
  if (mysqli_query($conn, $sql)) {
    echo "success";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>
