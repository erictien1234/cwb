<div class="container">
  <div class="col-8">
    <div>
      <h5 class="inout m-2 py-2 text-center"></h3>
    </div>
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
      <!-- Modal -->
      <div class="modal fade" id="changemeta" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">修改屬性</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row m-4">
                <div class="col-4 metaname text-right">
                  <label class="col-form-label my-1" style="display:block" for="NAME">數據名稱：</label>
                  <label class="col-form-label my-1" style="display:block" for="DIKW">知識階級：</label>
                  <label class="col-form-label my-1" style="display:block" for="SCALE_SPATIAL">資料空間尺度：</label>
                  <label class="col-form-label my-1" style="display:block" for="SCALE_TIME">時間尺度：</label>
                  <label class="col-form-label my-1" style="display:block" for="TIME_LENGTH">輸出時間長度：</label>
                  <label class="col-form-label my-1" style="display:block" for="UNIT">單位：</label>
                  <label class="col-form-label my-1" style="display:block" for="PUBLIC">可否公開：</label>
                </div>
                <div class="col-8 metadatarevise">
                  <input type="text" class="form-control my-1" id="NAME">
                  <input type="text" class="form-control my-1" id="DIKW">
                  <input type="text" class="form-control my-1" id="SCALE_SPATIAL">
                  <input type="text" class="form-control my-1" id="SCALE_TIME">
                  <input type="text" class="form-control my-1" id="TIME_LENGTH">
                  <input type="text" class="form-control my-1" id="UNIT">
                  <input type="text" class="form-control my-1" id="PUBLIC">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
              <button type="button" class="btn btn-primary" id="savechange">上傳修改項目</button>
            </div>
          </div>
        </div>
      </div>
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
        $("button#savechange").click(function(){
          $.post('back_updatemeta.php',{
            user: $("span.username").text(),
            FIELD_ID: $("button.active").val(),
            NAME: $("input#NAME").val(),
            DIKW_ID: $("input#DIKW").val(),
            SCALE_SPATIAL: $("input#SCALE_SPATIAL").val(),
            SCALE_TIME: $("input#SCALE_TIME").val(),
            TIME_LENGTH: $("input#TIME_LENGTH").val(),
            UNIT: $("input#UNIT").val(),
            PUBLIC: $("input#PUBLIC").val()
          }, function(data){
            if (data == 'success') {
              alert('修改屬性資料已傳至平台管理員')
            }
          })
        })
      </script>
    </div>
  </div>
</div>
