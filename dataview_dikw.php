<div class="row d-flex justify-content-center">
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: brown">
      <h5 class="m-auto p-2">Data</h5>
    </div>
    <div class="card p-2 da">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'd'
        }, function(data){
          var splitsel = data.split(",");
          for (var i = 0; i < splitsel.length - 1; i++) {
            $("div.da").append("<a class='toview' href='#'>" + splitsel[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
  <div class="col-1 arrow mx-0 px-0">
    <img src="/img/arrow.png" class="img-fluid mt-5 pt-5">
    <p>tooltool</p>
    <p>tooltool</p>
  </div>
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: green">
      <h5 class="m-auto p-2">Information</h5>
    </div>
    <div class="card p-2 in">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'i'
        }, function(data){
          var splitsel = data.split(",");
          for (var i = 0; i < splitsel.length - 1; i++) {
            $("div.in").append("<a class='toview' href='#'>" + splitsel[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
  <div class="col-1 arrow mx-0 px-0">
    <img src="/img/arrow.png" class="img-fluid mt-5 pt-5">
    <p>tool12321</p>
  </div>
  <div class="col-2">
    <div class="d-flex mx-auto datatype my-4" style="background-color: purple">
      <h5 class="m-auto p-2">Knowledge</h5>
    </div>
    <div class="card p-2 kn">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'k'
        }, function(data){
          var splitsel = data.split(",");
          for (var i = 0; i < splitsel.length - 1; i++) {
            $("div.kn").append("<a class='toview' href='#'>" + splitsel[i] + "</a>");
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
    <div class="card p-2 wi">
      <script>
        $.post('back_db_search.php', {
          type: 'dikw',
          field: $("button.active").val(),
          dikw_type: 'w'
        }, function(data){
          var splitsel = data.split(",");
          for (var i = 0; i < splitsel.length - 1; i++) {
            $("div.wi").append("<a class='toview' href='#'>" + splitsel[i] + "</a>");
          }
        });
      </script>
    </div>
  </div>
</div>
