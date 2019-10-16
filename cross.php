<!DOCTYPE html>
<html lang="zh-TW" dir="ltr">
<?php
  $page = "cross";
?>
<?php require_once "head.php"?>
<body>
  <?php require_once "header.php"?>

  <div id="cross">
    <div class="container my-4">
      <div class="row">
        <div class="col-6 col-md-4 d-flex flex-column mx-0">
          <div style="height:auto ; width:100% " id="map">
            <!-- <img src="./img/taiwan_H.png" alt="" class="img-fluid"> -->
            <script src="/js/map.js"></script>
          </div>
          <div class="card">
            <div class="btn-group m-3" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary fieldsel" value="LM">天氣</button>
              <button type="button" class="btn btn-secondary fieldsel" value="WR">水資源</button>
              <button type="button" class="btn btn-secondary fieldsel" value="AF">農糧</button>
              <button type="button" class="btn btn-secondary fieldsel" value="PH">公衛</button>
            </div>
            <form class="form-inline">
              <label for="sel1" class="col-form-label col-5 col-md-3">產出選取</label>
              <select class="form-control-sm col-5 col-md-2 mr-auto sel1" id="sel1">
                <option style="display:none"></option>
              </select>
              <label for="sel2" class="col-form-label col-5 col-md-3">時間長度</label>
              <select class="form-control-sm col-5 col-md-2 mr-auto" id="sel2">
                <option style="display:none"></option>
              </select>
            </form>
            <form action="" class="form-inline">
              <label for="sel3" class="col-form-label col-5 col-md-3">地區</label>
              <select class="form-control-sm col-5 col-md-2 mr-auto" id="sel3">
                <option style="display:none"></option>
                <option>1</option>
                <option>2</option>
              </select>
              <label for="sel4" class="col-form-label col-5 col-md-3">起始時間</label>
              <input type="text" class="form-control-sm date col-5 col-md-2 mr-auto" id="sel4" placeholder="">
              <script>
                $('*.date').datepicker({
                  format: "yyyy-mm-dd",
                  maxViewMode: 3,
                  todayBtn: "linked",
                  language: "zh-TW",
                  orientation: "bottom auto",
                  autoclose: true,
                  todayHighlight: true
                });
              </script>
            </form>
            <div class="ml-auto pr-3 py-3">
              <label class="falseresult pr-2" style="display:none;color:rgb(255, 0, 0)">請選取完整項目</label>
              <button type="button" name="button" class="btn btn-primary search" id="singlesearch">查詢</button>
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
  </div>

  <?php require_once "footer.php"?>
  <script>
    $("button.clear1").on("click",function(){
      $("#sel1").empty();
      $("#sel2").empty();
      // $("#sel3").empty();
      $("#sel4").val("");
    })
    $("button.fieldsel").on("click",function(){
      $("button.fieldsel").removeClass("active");
      $(this).addClass("active");
      $("select.sel1").empty();
      $("select.sel1").append("<option style='display:none'>請選擇</option>");
      $.post("db_search.php", {
        type: 'output',
        field: $(this).val()
      },
      function(data){
        var splitsel = data.split(",");
        for (var i = 0; i < splitsel.length - 1; i++) {
          $("#sel1").append("<option value='" + splitsel[i] + "'>" + splitsel[i] + "</option>")
        }
      });
    })
    $("#sel1").on("change",function(){
      $("#sel2").empty();
      $("#sel3").empty();
      $("#sel4").val("");
      $("#sel2").append("<option style='display:none'>請選擇</option>");
      $.post("db_search.php", {
        type: 'length',
        field: $("button.fieldsel.active").val(),
        output: $("#sel1").val()
      },
      function(data){
        var splitsel = data.split(",");
        for (var i = 0; i < splitsel.length - 1; i++) {
          $("#sel2").append("<option value='" + splitsel[i] + "'>" + splitsel[i] + "</option>")
        }
      })
    })
    $("#sel2").on("change",function(){
      $("#sel3").append("<option style='display:none'>請選擇</option>");
      $.post('db_search.php',{
        type: 'spatial',
        field: $("button.fieldsel.active").val(),
        output: $("#sel1 option:selected").text(),
        length: $("#sel2 option:selected").text()
      }, function(data){
        var splitsel = data.split(";");
        console.log(splitsel);
        for (var i = 0; i < splitsel.length-1; i++) {
          for (var j = 0; j < splitsel[i].split(',').length-1; j++) {
            $("#sel3").append("<option value='" + splitsel[i].split(',')[j] + "'>" + splitsel[i].split(',')[j] + "</option>")
          }
        }
      })
    });
    $("#sel3").on("change",function(){
      $.post('db_search.php',{
        type: 'date',
        field: $("button.fieldsel.active").val(),
        output: $("#sel1 option:selected").text(),
        length: $("#sel2 option:selected").text(),
        where: $("#sel3 option:selected").text()
      }, function(data){
        var splitsel = data.split(";");
        $("#sel4").datepicker("setStartDate", splitsel[0].split(',')[0]);
        $("#sel4").datepicker("setEndDate", splitsel[0].split(',')[1]);
        console.log(splitsel[1].split(','));
        if (splitsel.length > 1) {
          let splitsel1 = splitsel[1].split(',');
          $("#sel4").datepicker("setDatesDisabled", splitsel1);
        }
        $("#sel4").datepicker("update", splitsel[0].split(',')[0]);
      })
    })
    $("button.search").on("click",function(){
      if ($("#sel1").find('option:selected').val() && $("#sel2").find('option:selected').val() && $("#sel3").find('option:selected').val() && $("#sel4").val()) {
        $("h6.result").show();
        $("label.falseresult").hide();
        $.post('db_search.php',{
          type: 'data',
          field: $("button.fieldsel.active").val(),
          output: $("#sel1 option:selected").text(),
          length: $("#sel2 option:selected").text(),
          where: $("#sel3 option:selected").text(),
          date: $("#sel4").val()
        }, function(data){
          console.log(data);
        })
      }
      else {
        $("label.falseresult").show();
      }
    })
  </script>
</body>
