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
            <script>
              normalMap();
            </script>
          </div>
          <div class="card">
            <div class="btn-group m-3" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary fieldsel" value="LM">天氣</button>
              <button type="button" class="btn btn-secondary fieldsel" value="WR">水資源</button>
              <button type="button" class="btn btn-secondary fieldsel" value="AF">農糧</button>
              <button type="button" class="btn btn-secondary fieldsel" value="PH">公衛</button>
            </div>
            <h6 class="mx-2 my-0">請選取服務：</h3>
            <form class="form-inline">
              <label for="sel1" class="col-form-label col-5 col-md-3">產出選取</label>
              <select class="form-control-sm col-5 col-md-3 mr-auto sel1" id="sel1">
                <option style="display:none"></option>
              </select>
              <label for="sel2" class="col-form-label col-5 col-md-3">時間長度</label>
              <select class="form-control-sm col-5 col-md-3 mr-auto" id="sel2">
                <option style="display:none"></option>
              </select>
            </form>
            <form action="" class="form-inline">
              <label for="sel3" class="col-form-label col-5 col-md-3">地區</label>
              <select class="form-control-sm col-5 col-md-3 mr-auto" id="sel3">
                <option style="display:none"></option>
                <option>1</option>
                <option>2</option>
              </select>
              <label for="sel4" class="col-form-label col-5 col-md-3">起始時間</label>
              <input type="text" class="form-control-sm date col-5 col-md-3 mr-auto" id="sel4" placeholder="">
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
          <div class="container d-flex flex-fill align-self-start flex-wrap" id="present">
          </div>
          <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
          <script src="./js/chart_new.js"></script>
          <div class="mt-auto ml-auto pr-3 py-3">
            <button type="button" name="button" class="btn btn-warning clear2">清空</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "footer.php"?>
  <script>
    let mapstate = {"map":"normal","area":[],"point":[]};
    let counter = 0;
    $("button.clear1").on("click",function(){
      $("#sel1").empty();
      $("#sel2").empty();
      $("#sel3").empty();
      $("#sel4").val("");
    })
    $("button.clear2").click(function(){
      cleanCanvas();
      changemapcolor(mapstate,'none');
      mapstate = {"map":"normal","area":[],"point":[]};
      counter = 0;
    })
    $("button.fieldsel").on("click",function(){
      $("button.fieldsel").removeClass("active");
      $(this).addClass("active");
      $("select.sel1").empty();
      $("select.sel1").append("<option style='display:none'>請選擇</option>");
      $("#sel2").empty();
      $("#sel3").empty();
      $("#sel4").val("");
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
          $("div#present").append("<h6 class='card-title resulttitle'>" + $("#sel1 option:selected").text() + " : " + $("#sel3 option:selected").text() + "</h6>");
          // 呈現控制
          var dynamicColors = function() {
              var r = Math.floor(Math.random() * 255);
              var g = Math.floor(Math.random() * 255);
              var b = Math.floor(Math.random() * 255);
              return "rgba(" + r + "," + g + "," + b + ", 0.5)";
           };
          var splitdata = data.split(',');
          let StartDate = $("#sel4").val();
          let week_date = [];
          let week_date_short= [];
          let inputData = [];
          for (var i = 0; i < splitdata[0].split(';').length; i++) {
            counter++;
            switch (splitdata[0].split(';')[i]) {
              case 'A':  //pie
                //  F;A,月,縣市,1.安全2.警戒預備3.嚴重警戒4.高溫警戒,[嚴重警戒=37][安全=0.1][寒冷危險=59.6][警界預備=3.3]
                let pie_data = {
                  Type: "A",
                  Valve:{
                    datasets: [{
                      data: data.substring(data.indexOf("[")+1, data.length-1).split("][").map((item => parseFloat(item.substring(item.indexOf("=")+1, item.length)))),
                      backgroundColor: [
                        dynamicColors(),
                        dynamicColors(),
                        dynamicColors()
                      ]
                    }],
                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: data.substring(data.indexOf("[")+1, data.length-1).split("][").map((item => item.substring(0, item.indexOf("=")))),
                  },
                };
                pieChart(pie_data,counter)
                break;
              case 'B': //bar
                for(i=0;i<data.substring( data.indexOf("[[")+2, data.indexOf("]")-1 ).split(",").map((item) => parseFloat(item)).length;i++){
                  const firstday = new Date(StartDate.substring(0,4),StartDate.substring(5,7)-1,StartDate.substring(8,10));
                  if(splitdata[1] === "週") {
                    week_date.push(firstday.addDays(7*i).toString());
                  } else {
                    week_date.push(firstday.addDays(i).toString());
                  }
                }
                week_date_short = week_date.map((item) => item.substring(4,7).concat(item.substring(8,10)));
                barChart({
                  Type: "B",
                  WaterStorage: {
                    yAxisID: "萬噸",
                    labels: week_date_short,
                    datasets: [
                      {
                      label: $("#sel3 :selected").text(),
                      backgroundColor: 'green',
                      borderColor: 'white',
                      data: data.substring( data.indexOf("[[")+2, data.indexOf("]")-1 ).split(",").map((item) => parseFloat(item))
                      },
                    ]
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: splitdata[3],
                        }
                      }]
                    }
                  },
                  StartDate,
                  Location: $("#sel3 :selected").text(),
                  TimeScale: splitdata[1],
                },counter)
                break;
              case 'C':
                // bar by unit
                break;
              case 'D':  //line
                for(i=0;i<data.substring( data.indexOf("[[")+2, data.indexOf("]")-2 ).split(",").length;i++){
                  const firstday = new Date(StartDate.substring(0,4),StartDate.substring(5,7)-1,StartDate.substring(8,10));
                  if(splitdata[1] === "週") {
                    week_date.push(firstday.addDays(7*i).toString());
                  } else {
                    week_date.push(firstday.addDays(i).toString());
                  }
                }
                week_date_short = week_date.map((item) => item.substring(4,7).concat(item.substring(8,10)));
                let lineData_raw = data.substring( data.indexOf("[[")+2, data.length-3 ).split(",][");
                let line_datasets = [];
                let labels = [];
                lineData_raw.length === 5? labels = ["最小值", "Q25", "中位數", "Q75", "最大值"]: labels = [$("#sel3 :selected").text()];
                for(i=0; i<lineData_raw.length; i++){
                  let lineData_single = {
                    label: labels[i],
                    // fill: false,
                    borderColor: dynamicColors(),
                    data: lineData_raw[i].split(",").map((item) => parseFloat(item))
                  }
                  line_datasets[i] = lineData_single;
                }

                // console.log(line_datasets);
                lineChart({
                  Type: "D",
                  WaterStorage: {
                    labels: week_date_short,
                    datasets:line_datasets,
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: splitdata[3],
                        }
                      }]
                    }
                  },
                  StartDate,
                  Location: $("#sel3 :selected").text(),
                  TimeScale: splitdata[1],
                },counter)
                break;
              case 'E':
                // line by unit
                break;
              case 'F':  //normal map
                // cleanMaps();
                if (mapstate.map !== 'normal') {
                  cleanMaps();
                  normalMap();
                }
                let spatialType = splitdata[2];
                // if(spatialType === "縣市"){
                //   // normalMap();
                //   $("path#"+$("#sel3 :selected").text()).css("fill",'red');
                // } else {
                //   normalMap_point(spatialType);
                // }
                // changemapcolor(mapstate,'none');
                // mapstate = {"map":"normal","area":[],"point":[]};
                if(spatialType === "縣市"){
                  mapstate.area.push($("#sel3 :selected").text());
                } else {
                  mapstate.point.push($("#sel3 :selected").text());
                }
                changemapcolor(mapstate,'red');
                break;
              case 'G':  //raster map
                cleanMaps();
                let rasterData_raw = data.substring(data.indexOf("[")+1, data.length-1).split("][");
                let rasterData = [];
                let max = 0;
                let min = 0;
                for(let i = 0; i<rasterData_raw.length; i++){
                  let pointData = {
                    "x": parseFloat(rasterData_raw[i].split(",")[0]),
                    "y": parseFloat(rasterData_raw[i].split(",")[1]),
                    "value": parseFloat(rasterData_raw[i].split(",")[2])
                  }
                  max = Math.max(max,parseFloat(rasterData_raw[i].split(",")[2]));
                  min = Math.min(min,parseFloat(rasterData_raw[i].split(",")[2]));
                  rasterData[i] = pointData;
                }
                let unit = data.split(',')[3];
                rasterMap(rasterData, max, min, unit);
                break;
              case 'H':
                // table
                break;
              case 'I':  //light
                lightChart({
                  Type: "I",
                  Light: data.substring( data.indexOf("[")+1, data.indexOf("]") ).split(","),
                  Timescale: splitdata[2]
                },counter)
                break;
            }
          }
        })
      }
      else {
        $("label.falseresult").show();
      }
    })
  </script>
</body>
