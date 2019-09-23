<!DOCTYPE html>
<html lang="zh-TW" dir="ltr">
<?php
  $page = "index";
?>
<?php require_once "head.php"?>
<body>
  <?php require_once "header.php"?>

  <div id="main">
    <div class="container">
      <div style="flex-direction: row ; flex: 1 ; display:flex">
        <div style="flex:3 ; display:flex">
          <div style="height:auto ; width:50% " id="map">
            <!-- <img src="./img/taiwan_H.png" alt="" class="img-fluid"> -->
            <script src="./js/map.js"></script>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="func_fig">
    <div class="container my-4">
      <div class="row p-2">
        <div class="col-md-4 col-sm-6 d-flex py-2">
          <div class="card" herf="#">
            <h6 class="card-title">天氣氣候資訊</h6>
            <img class="card-img my-auto" src="/img/climate_H.png" alt="" class="img-fluid">
            <a href="/weather.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 d-flex py-2">
          <div class="card" herf="#">
            <h6 class="card-title">水情燈號資訊</h6>
            <img class="card-img p-2 my-auto" src="/img/water_H.png" alt="" class="img-fluid">
            <a href="/water.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 d-flex py-2">
          <div class="card" herf="#">
            <h6 class="card-title">耕作建議分析</h6>
            <img class="card-img p-2 my-auto" src="/img/crop_H1.png" alt="" class="img-fluid">
            <a href="/crop.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 d-flex py-2">
          <div class="card flex-fill" herf="#">
            <h6 class="card-title">高低溫預警</h6>
            <img class="card-img p-2 my-auto" src="/img/health_H.png" alt="" class="img-fluid">
            <a href="/health.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 d-flex py-2">
          <div class="card flex-fill" herf="#">
            <h6 class="card-title">跨領域分析</h6>
            <img class="card-img p-2 my-auto" src="/img/cross_H1.png" alt="" class="img-fluid">
            <a href="/cross.php" class="stretched-link"></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "footer.php"?>
</body>

</html>
