<div class="container">
  <div class="col-8">
    <div class="row m-4">
      <div class="col-4 metaname text-right">
        <p>數據名稱：</p>
        <p>知識階級：</p>
        <p>資料空間尺度：</p>
        <p>時間尺度：</p>
        <p>輸出時間長度：</p>
        <p>單位：</p>
        <p>可否公開：</p>
      </div>
      <div class="col-8 metadata">
      </div>
    </div>
    <div class="row my-2">
      <label class="col-4 text-right p-0 my-auto mr-2">輸出數據</label>
      <button type="button" class="btn btn-success mx-3" value="">網頁下載</button>
      <button type="button" class="btn btn-info mx-3" value="">API下載</button>
    </div>
    <div class="row adv-btn my-2">
      <script>
        $.post('back_permission.php',{
          field: $("button.active").val()
        }, function(data){
          var splitsel = data.split(",");
          for (var i = 0; i < splitsel.length; i++) {
            $("div.adv-btn").append(splitsel[i]);
          }
        })
      </script>
    </div>
  </div>
</div>
