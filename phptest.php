<?php
$servicetype = 'OUTPUT';
$field = 'WR';
$name = '後三個月各週燈號預測';
$sql = "SELECT * FROM `$servicetype` WHERE `FIELD_ID` = '$field' AND `$servicetype" . "_NAME` = '$name'";
echo $sql;
 ?>
