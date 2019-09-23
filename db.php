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
  @session_start();
  $host = 'localhost';
  $dbuser = 'sdlaber';
  $dbpw = 'abcABC123!@#';
  $dbname = 'cwbservice';

  $_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);

  if ($_SESSION['link']) {
    mysqli_set_charset($_SESSION['link'],"utf8");
  } else {
    echo "Error with MySQL connection : " . mysqli_connect_error();
  }
 ?>
