<!DOCTYPE html>
<html lang="zh-TW" dir="ltr">
<?php
  $page = "cross";
?>
<?php require_once "head.php"?>
<body>
  <?php require_once "header.php"?>

  <div id="cross">
    <div class="container my-4 d-flex justify-content-center">
      <div class="col-6 col-md-4 d-flex flex-column">
        <div class="card map">
          <img src="/img/taiwan_H.png" alt="" class="card-img  my-auto">
        </div>
        <div class="card">
          <!-- <div class="row">
            <label for="fieldsel" class="my-auto btn">選取領域</label>
            <div class="btn-group list list-group-horizontal pl-2" role="group" data-toggle="buttons" id="fieldsel">
              <label class="btn btn-light">
                <input type="checkbox" class="form-check list-group-item">天氣
              </label>
              <label class="btn btn-light">
                <input type="checkbox" class="form-check list-group-item">水資源
              </label>
              <label class="btn btn-light">
                <input type="checkbox" class="form-check list-group-item">農糧
              </label>
              <label class="btn btn-light">
                <input type="checkbox" class="form-check list-group-item">公衛
              </label>
            </div>
          </div>
          <div class="row mb-2">
            <label for="figsel" class="my-auto btn">呈現圖表</label>
            <div class="btn-group list list-group-horizontal pl-2" role="group" data-toggle="buttons" id="figsel">
              <label class="btn btn-light btn-sm m-auto fig1" style="display:none">
                <input type="checkbox" class="form-check list-group-item"><p>目前水情</p>
              </label>
              <label class="btn btn-light btn-sm m-auto fig2" style="display:none">
                <input type="checkbox" class="form-check list-group-item"><p>水情走勢</p>
              </label>
              <label class="btn btn-light btn-sm m-auto fig3" style="display:none">
                <input type="checkbox" class="form-check list-group-item"><p>灌溉推估</p>
              </label>
              <label class="btn btn-light btn-sm m-auto fig4" style="display:none">
                <input type="checkbox" class="form-check list-group-item"><p>產量推估</p>
              </label>
            </div>
          </div>
          <button type="button" name="button" class="btn btn-primary col-4">下一步</button> -->
          <div class="btn-group m-3" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary fieldsel" value="weather">天氣</button>
            <button type="button" class="btn btn-secondary fieldsel" value="water">水資源</button>
            <button type="button" class="btn btn-secondary fieldsel" value="crop">農糧</button>
            <button type="button" class="btn btn-secondary fieldsel" value="health">公衛</button>
          </div>
          <form class="form-inline">
            <label for="sel1" class="col-form-label col-5 col-md-3">產出選取</label>
            <select class="form-control-sm col-5 col-md-2 mr-auto sel1" id="sel1">
              <option style="display:none"></option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
            <label for="sel2" class="col-form-label col-5 col-md-3">地區</label>
            <select class="form-control-sm col-5 col-md-2 mr-auto sel2" id="sel2">
              <option style="display:none"></option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </form>
          <form action="" class="form-inline">
            <label for="sel3" class="col-form-label col-5 col-md-3">起始日期</label>
            <input type="text" class="form-control-sm date col-5 col-md-2 mr-auto" id="sel3" placeholder="">
            <script>
              $('*.date').datepicker({
                maxViewMode: 3,
                todayBtn: "linked",
                language: "zh-TW",
                orientation: "bottom auto",
                autoclose: true,
                todayHighlight: true
              });
            </script>
            <label for="sel4" class="col-form-label col-5 col-md-3">推估方式</label>
            <select class="form-control-sm col-5 col-md-2 mr-auto" id="sel4">
              <option style="display:none"></option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </form>
          <form action="" class="form-inline">
            <label for="sel5" class="col-form-label col-5 col-md-3">推估長度</label>
            <select class="form-control-sm col-5 col-md-2 mr-auto" id="sel5">
              <option style="display:none"></option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </form>
          <div class="ml-auto pr-3 py-3">
            <label class="falseresult pr-2" style="display:none;color:rgb(255, 0, 0)">請選取完整項目</label>
            <button type="button" name="button" class="btn btn-primary search">查詢</button>
            <button type="button" name="button" class="btn btn-warning clear1">清空</button>
          </div>
        </div>
      </div>
      <div class="card col-6 col-md-8">
        <div class="mt-auto ml-auto pr-3 py-3">
          <button type="button" name="button" class="btn btn-warning clear2">清空</button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "footer.php"?>
  <script>
    $("#sel1").change(function(){
      $("#sel2").prop('selectedIndex',0);
      $("#sel3").val("");
      $("#sel4").prop('selectedIndex',0);
      $("#sel5").prop('selectedIndex',0);
    })
    $("button.search").on("click",function(){
      if ($("#sel1").find('option:selected').val() && $("#sel2").find('option:selected').val() && $("#sel3").val() && $("#sel4").find('option:selected').val() && $("#sel5").find('option:selected').val()) {
        $("img.result").show();
        $("h6.result").show();
        $("label.falseresult").hide();
      }
      else {
        $("label.falseresult").show();
      }
    })
    $("button.clear1").on("click",function(){
      $("#sel1").empty();
      $("#sel2").empty();
      $("#sel3").empty();
      $("#sel4").empty();
      $("#sel5").empty();
    })
    $("button.fieldsel").on("click",function(){
      $("button.fieldsel").removeClass("active");
      $(this).addClass("active");
      $("select.sel1").empty();
      $("select.sel1").append("<option style='display:none'>請選擇</option>");
      $.post("crosssel1.php", {
        value: $(this).val(),
      },
      function(data){
        var splitsel = data.split(",");
        for (var i = 0; i < splitsel.length; i++) {
          $("select.sel1").append("<option value='" + splitsel[i] + "'>" + splitsel[i] + "</option>")
        }
      });
    })
    $("select.sel1").on("change",function(){
      $("select.sel2").empty();
      $("select.sel2").append("<option style='display:none'>請選擇</option>");
      $.post("db_connect.php", {
        sel1: $(this).val(),
      },
      function(data){
        var splitsel = data.split(",");
        for (var i = 0; i < splitsel.length - 1; i++) {
          $("select.sel2").append("<option value='" + splitsel[i] + "'>" + splitsel[i] + "</option>")
        }
      })
    })
  </script>
</body>
