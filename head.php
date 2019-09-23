<head>
  <meta charset="utf-8">
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <![endif]-->
  <title>天氣與氣候資訊數位化應用服務平台
  <?php
    if (isset($page));
    else {
      $page = "";
    }
    switch ($page) {
      case 'weather':
        echo "- 天氣氣候服務瀏覽";
        break;
      case 'water':
        echo "- 水資源領域服務瀏覽";
        break;
      case 'crop':
        echo "- 農糧領域服務瀏覽";
        break;
      case 'health':
        echo "- 公衛領域服務瀏覽";
        break;
      case 'cross':
        echo "- 跨領域服務瀏覽";
        break;
      case 'login':
        echo "- 會員登入";
        break;
    }
  ?>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Yu-Chuan Tien">
  <link rel="stylesheet" herf="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
  <script src="https://d3js.org/d3-array.v1.min.js"></script>
  <script src="https://d3js.org/d3-geo.v1.min.js"></script>
  <script src="https://d3js.org/d3.v5.js"></script>
  <?php
    if ($page == 'weather' || 'water' || 'crop' || 'health' ||  'cross') {
      // echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.zh-TW.min.js"></script>';
      echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" charset="UTF-8"></script>';
      echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css">';
    }
  ?>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/map.css">
</head>
