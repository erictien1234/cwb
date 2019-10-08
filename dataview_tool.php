<div class="row d-flex justify-content-center">
  <div class="col-3 tool">
    <div class="mx-auto tooltype my-4">
      <h5 class="m-auto p-2">工具名稱</h5>
    </div>
  </div>
  <div class="col-3 toolin">
    <div class="mx-auto tooltype my-4">
      <h5 class="m-auto p-2">輸入數據</h5>
    </div>
  </div>
  <div class="col-3 toolout">
    <div class="mx-auto tooltype my-4">
      <h5 class="m-auto p-2">輸出數據</h5>
    </div>
  </div>
  <div class="col-3 toolpara">
    <div class="mx-auto tooltype my-4">
      <h5 class="m-auto p-2">參數設定</h5>
    </div>
  </div>
</div>
<script>
  $.post("back_db_search.php", {
    type: 'tool',
    field: $("button.active").val()
  }, function(data){
    let splitsel = data.split(';');
    for (var i = 0; i < splitsel.length-1; i++) {
      $("div.tool").append("<div class='card p-2 tooln" + i + " tool" + i + "'></div>");
      $("div.toolin").append("<div class='card p-2 inputn" + i + " tool" + i + "'></div>");
      $("div.toolout").append("<div class='card p-2 outputn" + i + " tool" + i + "'></div>");
      $("div.toolpara").append("<div class='card p-2 paran" + i + " tool" + i + "'></div>");
      $("div.tooln"+i).append("<p>" + splitsel[i].split(',')[0] + "</p>");
      for (var j = 0; j < splitsel[i].split(',')[1].split('.').length-1; j++) {
        $("div.inputn"+i).append("<a class='toview' href='#'>" + splitsel[i].split(',')[1].split('.')[j] + "</a>");
      }
      for (var j = 0; j < splitsel[i].split(',')[2].split('.').length-1; j++) {
        $("div.outputn"+i).append("<a class='toview' href='#'>" + splitsel[i].split(',')[2].split('.')[j] + "</a>");
      }
      $("div.paran"+i).append("<p>" + splitsel[i].split(',')[3] + "</p>");
      $(".tool"+i).height(Math.max($(".tooln"+i).height(), $(".inputn"+i).height(), $(".outputn"+i).height(), $(".paran"+i).height()));
    }
  })
</script>
