<div class="row m-2 nameview">
  <script>
    $.post('back_db_search.php', {
      type: 'name',
      field: $("button.active").val(),
    }, function(data){
      var splitsel = data.split(",");
      for (var i = 0; i < (splitsel.length - 1)/12; i++) {
        $("div.nameview").append('<ul class="list-group col-3 m-0 p-0 nameline"></ul>');
        for (var j = i*12; j <splitsel.length-1; j++) {
          if (j<(i+1)*12) {
            $("ul.nameline").append('<li class="list-group-item toview">' + splitsel[j] + '</li>');
          }
        }
        $("ul.nameline").removeClass('nameline');
      }
    });
  </script>
</div>
