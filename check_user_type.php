<?php
  $sql = "SELECT `username`,`user_type` FROM `cwbservice`.`user` WHERE `email` = '{$us}'";
  $result = mysqli_query($_SESSION['link'] , $sql) or die("MySQL query error");

  if (mysqli_num_rows($result) >= 1) {
    $row = mysqli_fetch_array($result);
    $username = $row[0];
    // switch ($row[1]) {
    //   case 'admin':
    //     $usertype = '系統管理員';
    //     break;
    //   case 'WR':
    //     $usertype = '服務提供者(水)';
    //     break;
    // }
    $usertype = $row[1];
  }
?>
