<div class="row d-flex justify-content-center">
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: brown">
      <h5 class="m-auto p-2">Data</h5>
    </div>
    <div class="card p-2 da dikwcard">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'd',
        }, function(data){
          let splitsel = data.split(";");
          $("div.da").append("<div class='dain dikwin d-flex flex-column'></div>");
          $("div.da").append("<div class='daout dikwout d-flex flex-column'></div>")
          for (var i = 0; i < splitsel[0].split(",").length - 1; i++) {
            $("div.dain").append("<a class='toview' href='#'>" + splitsel[0].split(",")[i] + "</a>");
          }
          for (var i = 0; i < splitsel[1].split(",").length - 1; i++) {
            $("div.daout").append("<a class='toview' href='#'>" + splitsel[1].split(",")[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
  <div class="col-1 arrow mx-0 px-0">
    <img src="/img/arrow.png" class="img-fluid mt-5 pt-5">
  </div>
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: green">
      <h5 class="m-auto p-2">Information</h5>
    </div>
    <div class="card p-2 in dikwcard">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'i',
        }, function(data){
          let splitsel = data.split(";");
          $("div.in").append("<div class='inin dikwin d-flex flex-column'></div>");
          $("div.in").append("<div class='inout dikwout d-flex flex-column'></div>")
          for (var i = 0; i < splitsel[0].split(",").length - 1; i++) {
            $("div.inin").append("<a class='toview' href='#'>" + splitsel[0].split(",")[i] + "</a>");
          }
          for (var i = 0; i < splitsel[1].split(",").length - 1; i++) {
            $("div.inout").append("<a class='toview' href='#'>" + splitsel[1].split(",")[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
  <div class="col-1 arrow mx-0 px-0">
    <img src="/img/arrow.png" class="img-fluid mt-5 pt-5">
  </div>
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: purple">
      <h5 class="m-auto p-2">Knowledge</h5>
    </div>
    <div class="card p-2 kn dikwcard">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'k',
        }, function(data){
          let splitsel = data.split(";");
          $("div.kn").append("<div class='knin dikwin d-flex flex-column'></div>");
          $("div.kn").append("<div class='knout dikwout d-flex flex-column'></div>")
          for (var i = 0; i < splitsel[0].split(",").length - 1; i++) {
            $("div.knin").append("<a class='toview' href='#'>" + splitsel[0].split(",")[i] + "</a>");
          }
          for (var i = 0; i < splitsel[1].split(",").length - 1; i++) {
            $("div.knout").append("<a class='toview' href='#'>" + splitsel[1].split(",")[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
  <div class="col-1 arrow mx-0 px-0">
    <img src="/img/arrow.png" class="img-fluid mt-5 pt-5">
  </div>
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: red">
      <h5 class="m-auto p-2">Wisdom</h5>
    </div>
    <div class="card p-2 wi dikwcard">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'w',
        }, function(data){
          let splitsel = data.split(";");
          $("div.wi").append("<div class='wiin dikwin d-flex flex-column'></div>");
          $("div.wi").append("<div class='wiout dikwout d-flex flex-column'></div>")
          for (var i = 0; i < splitsel[0].split(",").length - 1; i++) {
            $("div.wiin").append("<a class='toview' href='#'>" + splitsel[0].split(",")[i] + "</a>");
          }
          for (var i = 0; i < splitsel[1].split(",").length - 1; i++) {
            $("div.wiout").append("<a class='toview' href='#'>" + splitsel[1].split(",")[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
</div>
