<!DOCTYPE html>
<html lang="zh-TW" dir="ltr">
<?php
  require_once "db.php";
  // print_r($_SESSION);
  $us = $_COOKIE["login_user"];
  // echo $us;
  if ($_SESSION[$us] != true || !$_SESSION[$us]) {
    header("Location: index.php");
  }
?>
<?php
  $page = "back";
  if (!isset($field)) {
    $field = "WR";
  }
  if (!isset($class)) {
    $class = "dikw";
  }
?>
<?php require_once "head.php"?>
  <body>
    <?php require_once "headerb.php" ?>
    <div class="container">
      <div class="row">
        <div class="container col-2 shadow-sm" id="backleft">
          <div class="container row my-2">
            <img src="/img/user_logo.png">
            <?php  require_once 'check_user_type.php';?>
            <h6 class="my-auto"><span class="username"><?php echo $username ?></span><br><span class="usertype"><?php echo $usertype ?></span></h6>

          </div>
          <div class="container row my-3 mx-0">
            <button type="button" class="fd btn btn-outline-primary flex-fill text-left my-2 <?php if($field == "LM") echo "active" ?>" value="LM"><img src="/img/weather_icon.png" class="backicon">天氣氣候</button>
            <button type="button" class="fd btn btn-outline-primary flex-fill text-left my-2 <?php if($field == "WR") echo "active" ?>" value="WR"><img src="/img/water_icon.png" class="backicon">水資源領域</button>
            <button type="button" class="fd btn btn-outline-primary flex-fill text-left my-2 <?php if($field == "AF") echo "active" ?>" value="AF"><img src="/img/crop_icon.png" class="backicon">農糧領域</button>
            <button type="button" class="fd btn btn-outline-primary flex-fill text-left my-2 <?php if($field == "PH") echo "active" ?>" value="PH"><img src="/img/health_icon.png" class="backicon">公衛領域</button>
            <button type="button" class="disabled btn btn-outline-primary flex-fill text-left my-2 <?php if($field == "cross") echo "active" ?>"><img src="/img/cross_icon.png" class="backicon">跨領域</button>
            <script>
              $("button.fd").click(function(){
                $("button.fd.active").removeClass("active");
                $(this).addClass("active");
                $("a.active").removeClass("active");
                $("a#dikw").addClass("active");
                $("#dataview > div").remove();
                $("#dataview").load('dataview_dikw.php');
              })
            </script>
          </div>
        </div>
        <div class="container col-10 pb-3" id="backright">
          <div class="row backclasssel pt-2 px-2">
            <p class="my-auto mx-4">分類方式</p>
            <ul class="nav nav-tabs">
              <li class="nav-item my-auto">
                <a href="#" class="nav-link <?php if($class == "dikw") echo "active" ?> classlink" id="dikw">知識階級</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link <?php if($class == "tool") echo "active" ?> classlink" id="tool">工具列表</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link <?php if($class == "name") echo "active" ?> classlink" id="name">名稱</a>
              </li>
              <li class="nav-item px-3">
                <a class="nav-link <?php if($class == "view") echo "active" ?> view" id="view">數據瀏覽</a>
              </li>
            </ul>
            <script>
              $("a.classlink").click(function(){
                $("a.active").removeClass("active");
                $(this).addClass("active");
                $("#dataview > div").remove();
                var loadpage = "dataview_" + $(this).attr('id') + ".php";
                $("#dataview").load(loadpage);
              })
            </script>
          </div>
          <div id="dataview">
            <?php require_once "dataview_dikw.php" ?>
          </div>
        </div>
        <script>
          $(document).on("click","#dataview .dikwin .toview",function(){
            $("a.active").removeClass("active");
            $("a.view").addClass("active");
            $("#dataview > div").remove();
            $("#dataview").load('dataview_view.php');
            $.post('back_db_search.php',{
              type: 'view',
              servicetype: 'INPUT',
              field: $("button.active").val(),
              name: $(this).html()
            }, function(data){
              var splitsel = data.split(",");
              $("h5.inout").text(splitsel[0] + $("button.active").text());
              for (var i = 1; i < splitsel.length-1; i++) {
                $("div.metadata").append("<p>" + splitsel[i] + "</p>");
              }
              $("button.download").attr('value', splitsel.slice(-1).pop());
            })
          });
          $(document).on("click","#dataview .dikwout .toview",function(){
            $("a.active").removeClass("active");
            $("a.view").addClass("active");
            $("#dataview > div").remove();
            $("#dataview").load('dataview_view.php');
            $.post('back_db_search.php',{
              type: 'view',
              servicetype: 'OUTPUT',
              field: $("button.active").val(),
              name: $(this).html()
            }, function(data){
              var splitsel = data.split(",");
              $("h5.inout").text(splitsel[0] + $("button.active").text());
              for (var i = 1; i < splitsel.length-1; i++) {
                $("div.metadata").append("<p>" + splitsel[i] + "</p>");
              }
              $("button.download").attr('value', splitsel.slice(-1).pop());
            })
          });
          $(document).on("click","#dataview .nameview .toview",function(){
            $("a.active").removeClass("active");
            $("a.view").addClass("active");
            $("#dataview > div").remove();
            $("#dataview").load('dataview_view.php');
            $.post('back_db_search.php',{
              type: 'view',
              servicetype: 'OUTPUT',
              field: $("button.active").val(),
              name: $(this).html()
            }, function(data){
              var splitsel = data.split(",");
              $("h5.inout").text(splitsel[0] + $("button.active").text());
              for (var i = 1; i < splitsel.length-1; i++) {
                $("div.metadata").append("<p>" + splitsel[i] + "</p>");
              }
              $("button.download").attr('value', splitsel.slice(-1).pop());
            })
          });
          $(document).on("click","#dataview .toolin .toview",function(){
            $("a.active").removeClass("active");
            $("a.view").addClass("active");
            $("#dataview > div").remove();
            $("#dataview").load('dataview_view.php');
            $.post('back_db_search.php',{
              type: 'view',
              servicetype: 'INPUT',
              field: $("button.active").val(),
              name: $(this).html()
            }, function(data){
              var splitsel = data.split(",");
              $("h5.inout").text(splitsel[0] + $("button.active").text());
              for (var i = 1; i < splitsel.length-1; i++) {
                $("div.metadata").append("<p>" + splitsel[i] + "</p>");
              }
              $("button.download").attr('value', splitsel.slice(-1).pop());
            })
          });
          $(document).on("click","#dataview .toolout .toview",function(){
            $("a.active").removeClass("active");
            $("a.view").addClass("active");
            $("#dataview > div").remove();
            $("#dataview").load('dataview_view.php');
            $.post('back_db_search.php',{
              type: 'view',
              servicetype: 'OUTPUT',
              field: $("button.active").val(),
              name: $(this).html()
            }, function(data){
              var splitsel = data.split(",");
              $("h5.inout").text(splitsel[0] + $("button.active").text());
              for (var i = 1; i < splitsel.length-1; i++) {
                $("div.metadata").append("<p>" + splitsel[i] + "</p>");
              }
              $("button.download").attr('value', splitsel.slice(-1).pop());
            })
          })
        </script>
      </div>
    </div>
    <?php require_once "footer.php" ?>
  </body>
</html>
