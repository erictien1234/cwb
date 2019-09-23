<div id="single">
  <div class="container my-4">
    <div class="row">
      <div class="col-6 col-md-4 d-flex">
        <div style="height:auto ; width:100% " id="map">
          <!-- <img src="./img/taiwan_H.png" alt="" class="img-fluid"> -->
          <script src="/js/map.js"></script>
        </div>
      </div>
      <div class="col-6 col-md-8 d-flex flex-column">
        <div class="card pt-3">
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
                format: "yyyy,mm,dd",
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
          </div>
        </div>
        <div class="card mt-3 flex-fill">
          <h6 class="card-title result" style="display:none">後三個月各週燈號推估：新竹</h6>
          <!-- <img src="/img/light.png" alt="" class="card-image img-fluid p-4 my-auto result" style="display:none"> -->
          <div class="container">
            <div id="lightChart">
              <div>
                <span>
                  <img id="light_1" class="waterLight_img">
                </span>
                <span>
                  <img id="light_2" class="waterLight_img">
                </span>
                <span>
                  <img id="light_3" class="waterLight_img">
                </span>
                <span>
                  <img id="light_4" class="waterLight_img">
                </span>
                <span>
                  <img id="light_5" class="waterLight_img">
                </span>
                <span>
                  <img id="light_6" class="waterLight_img">
                </span>
                <span>
                  <img id="light_7" class="waterLight_img">
                </span>
                <span>
                  <img id="light_8" class="waterLight_img">
                </span>
                <span>
                  <img id="light_9" class="waterLight_img">
                </span>
                <span>
                  <img id="light_10" class="waterLight_img">
                </span>
                <span>
                  <img id="light_11" class="waterLight_img">
                </span>
                <span>
                  <img id="light_12" class="waterLight_img">
                </span>
              </div>
              <div>
                <span>
                  <hr class="waterLight_hr">
                </span>
              </div>
              <div style="justify-content: space-between">
                <span>
                  <p id="week1_date" class="waterLight_date"></p>
                </span>
                <span>
                  <p id="week2_date" class="waterLight_date"></p>
                </span>
                <span>
                  <p id="week3_date" class="waterLight_date"></p>
                </span>
                <span>
                  <p id="week4_date" class="waterLight_date"></p>
                </span>
                <span>
                  <p id="week5_date" class="waterLight_date"></p>
                </span>
                <span>
                  <p id="week6_date" class="waterLight_date"></p>
                </span>
                <span>
                  <p id="week7_date" class="waterLight_date"></p>
                </span>
              </div>
            </div>
            <script src="./js/lightChart.js"></script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $("#sel1").on("change",function(){
    $("#sel2").empty();
    // $("#sel3").empty();
    $("#sel4").val("");
    $("#sel2").append("<option style='display:none'>請選擇</option>");
    $.post("db_search.php", {
      type: 'output',
      field:'<?php echo $page ?>',
      output: $("#sel1").val()
    },
    function(data){
      var splitsel = data.split(",");
      for (var i = 0; i < splitsel.length - 1; i++) {
        $("#sel2").append("<option value='" + splitsel[i] + "'>" + splitsel[i] + "</option>")
      }
    })
  })
  $("button.search").on("click",function(){
    if ($("#sel1").find('option:selected').val() && $("#sel2").find('option:selected').val() && $("#sel3").find('option:selected').val() && $("#sel4").val()) {
      // $("img.result").show();
      $("h6.result").show();
      $("label.falseresult").hide();
    }
    else {
      $("label.falseresult").show();
    }
  })
  $(document).ready(function(){
    $.post('db_search.php',{
      type: 'field',
      field:'<?php echo $page ?>'
    }, function(data){
      var splitsel = data.split(",");
      for (var i = 0; i < splitsel.length - 1; i++) {
        $("#sel1").append("<option value='" + splitsel[i] + "'>" + splitsel[i] + "</option>")
      }
    });
  });
</script>
