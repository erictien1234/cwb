<div id="single">
  <div class="container my-4">
    <div class="row">
      <div class="col-6 col-md-4 d-flex">
        <div class="card">
          <img src="/img/taiwan_H.png" alt="" class="card-img img-fluid my-auto">
        </div>
      </div>
      <div class="col-6 col-md-8 d-flex flex-column">
        <div class="card pt-3">
          <form class="form-inline">
            <label for="sel1" class="col-form-label col-5 col-md-3">產出選取</label>
            <select class="form-control-sm col-5 col-md-2 mr-auto sel1" id="sel1">
              <option style="display:none"></option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
            <label for="sel2" class="col-form-label col-5 col-md-3">地區</label>
            <select class="form-control-sm col-5 col-md-2 mr-auto" id="sel2">
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
          </div>
        </div>
        <div class="card mt-3 flex-fill">
          <h6 class="card-title result" style="display:none">後三個月各週燈號推估：新竹</h6>
          <img src="/img/light.png" alt="" class="card-image img-fluid p-4 my-auto result" style="display:none">
        </div>
      </div>
    </div>
  </div>
</div>
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
</script>
