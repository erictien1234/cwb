<div id="header">
  <div class="container p-0">
    <nav class="navbar navbar-expand-lg navbar-dark head">
      <img src="/img/logo.png" alt="">
      <h3 class="my-auto pl-3"><a class="navbar-brand" href="/index.php">天氣與氣候資訊數位化應用服務平台</a></h3>
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-lg-column" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link h6" href="/login.php">會員登入</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h6" href="#">關於我們</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h6" href="#">聯繫我們</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link h6 <?php if($page == "LM") echo "active" ?>" href="/weather.php">天氣氣候</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h6 <?php if($page == "WR") echo "active" ?>" href="/water.php">水資源領域</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h6 <?php if($page == "AF") echo "active" ?>" href="/crop.php">農糧領域</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h6 <?php if($page == "PH") echo "active" ?>" href="/health.php">公衛領域</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h6 <?php if($page == "cross") echo "active" ?>" href="/cross.php">跨領域分析</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
