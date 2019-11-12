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
      <button type="button" class="btn btn-success mx-3 download" data-toggle="modal" data-target="#download">網頁下載</button>
      <button type="button" class="btn btn-info mx-3 api" data-toggle="modal" data-target="#apirequest">API下載</button>
      <!-- Modal -->
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
        });
        $("button.download").click(function(e){
          if ($("h5.inout").text()[0] == 'I') {
            e.stopPropagation();
            alert("目前INPUT不提供下載與API服務");
          } else {
            $("#sel3").empty();
            $("#sel3").append("<option style='display:none'>請選擇</option>")
            $.post('back_db_search.php',{
              type: 'downloadsearch',
              TABLE: $("button.download").val(),
              OUTPUT_NAME: $("div.metadata>p:first").text()
            },function(data){
              var splitsel = data.split(";");
              console.log(splitsel);
              for (var i = 0; i < splitsel.length-1; i++) {
                for (var j = 0; j < splitsel[i].split(',').length-1; j++) {
                  $("#sel3").append("<option value='" + splitsel[i].split(',')[j] + "'>" + splitsel[i].split(',')[j] + "</option>")
                }
              }
            })
          }
        });
        $("#sel3").on("change",function(){
          $.post('back_db_search.php',{
            type: 'downloaddate',
            TABLE: $("button.download").val(),
            OUTPUT_NAME: $("div.metadata>p:first").text(),
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
        $("button#geturl").click(function(){
          $.post('back_geturl.php',{
            type:'download',
            TABLE: $("button.download").val(),
            where: $("#sel3 option:selected").text(),
            date: $("#sel4").val()
          }, function(data){
            if (data == 'MySQL query error') {
              alert('發生錯誤，請聯繫系統管理員。');
            }
            else{
              alert('前往下載頁面。');
              window.open(data);
            }
          });
        });
        $("button.api").click(function(){
          $.post("back_geturl.php",{
            type:'api',
            TABLE: $("button.download").val()
          },function(data){
            $("p.apiurl").empty();
            $("div.apiurl").append("<p class='apiurl'>" + data + "</p>");
          })
        });
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
            } else {
              alert('錯誤，請連繫平台管理員。錯誤訊息：' + data)
            }
          })
        });
        $("button#upload").click(function(){
          var fd = new FormData();
          var files = $('#file')[0].files[0];
          fd.append('file',files);
          fd.append('name',$("div.metadata>p:first").text());
          fd.append('username',$("span.username").text());
          $.ajax({
            url: 'back_uploadfile.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response != 0){
                // Show image preview
                // $('#preview').append("<img src='"+response+"' width='100' height='100' style='display: inline-block;'>");
                console.log(response);
                alert('檔案上傳成功，平台管理員將會更新檔案。')
              } else {
                alert('上傳失敗，請確認檔名正確或聯絡平台管理員。');
              }
            }
          });
        })
      </script>
    </div>
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
    <div class="modal fade" id="updatedata" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">更新數據</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row m-4">
              <div class="col-4 text-right">
                <label class="col-form-label my-1" style="display:block" for="file">上傳CSV檔：</label>
              </div>
              <div class="col-8">
                <input type="file" class="form-control my-1" id="file">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="upload">確認上傳</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="download" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">網頁下載</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row m-4">
              <label for="sel3" class="col-form-label col-5 col-md-3">地區</label>
              <select class="form-control-sm col-5 col-md-2 mr-auto" id="sel3">
                <option style="display:none"></option>
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
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="geturl">取得下載連結</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="apirequest" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">API說明</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row m-4 apiurl">
              <p>API使用說明：</p>
              <p>請利用下列API網址取得數據，並將WWWW改為該資料之空間位置，YYYY-MM-DD為要查詢的時間，並依格式填入。</p>
              <p>(若查詢錯誤或無此資料，則會跳出空值或server error。)</p>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
