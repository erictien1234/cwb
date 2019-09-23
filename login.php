<!DOCTYPE html>
<html lang="zh-TW" dir="ltr">
  <?php
    $page = "login";
  ?>
  <?php require_once "head.php"?>
  <body>
    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card my-5">
          <div class="card-body">
            <h5 class="card-title text-center">會員登入</h5>
            <form class="form">
              <div class="form-label-group">
                <label for="inputEmail">電子信箱Email address</label>
                <input id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
              </div>
              <div class="form-label-group mt-4">
                <label for="inputPassword">密碼Password</label>
                <input id="inputPassword" class="form-control" placeholder="Password" type="password" required>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="rmuser">
                <label class="custom-control-label" for="rmuser">Remember Email</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block login">登入</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("button.login").on("click",function(e){
      e.preventDefault();
      $.post("login_user.php", {
        'user': $("#inputEmail").val(),
        'pw': $("#inputPassword").val(),
      },
      function(data){
        if (data == 'yes') {
          window.location.href = '../back.php';
        } else {
          alert("登入失敗");
        }
      },'html')
    });

  </script>
  </body>
</html>
