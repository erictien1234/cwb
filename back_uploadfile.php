<?php

  // file name
  $filename = $_FILES['file']['name'];
  $username = $_POST['username'];
  $servicename = $_POST['name'];
  $time = strftime("%Y. %B %d. %A. %X");
  // Location
  $location = 'upload/'.$filename;

  // file extension
  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
  $file_extension = strtolower($file_extension);

  // Valid image extensions
  $csv_ext = array("csv","txt");

  $response = 0;
  if(in_array($file_extension,$csv_ext)){
    // Upload file
    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      $response = $location;
    }
    require_once 'db.php';
    $sql = "INSERT INTO uploadlog (TIME, username, FILENAME, SERVICENAME) VALUES ('$time', '$username','$filename', '$servicename')";
    if (mysqli_query($_SESSION['link'], $sql)) {
      echo "success";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($_SESSION['link']);
    }
  }

  echo $response;
?>
