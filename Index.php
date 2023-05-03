<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="image/icone.svg" />
  <title>Connexion</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom 
  <!- CSS -->
  <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/7d87fa7c4e.js" crossorigin="anonymous"></script>
</head>

<body>
  <center><br>
    <header class="geapp-header-bar center-block">
        <img class="logo" src="image/tribunal.JPG"/>
    </header><br>
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <table class="table table-bordered">
              <thead>
                <tr class="table-warning">
                  <th scope="col"><center>تسجيل الدخول</center></th>
                  </tr>
              </thead>
<tbody>
  <tr>
    <th scope="row">
      <div class="container">
        <div class="panel-body">
          <form method="POST" action="verifierpass.php">
            <input lang="ar" dir="rtl" type="text" class="form-control" name="mat" placeholder="رقم التسجيل"> <br>
            <input lang="ar" dir="rtl" type="password" class="form-control" name="pass" placeholder="كلمة السر"><br>
              <?php
                session_start();
                if(isset($_GET['incorrect'])){
                  if ($_GET['incorrect']==1) { echo'<div class="alert alert-danger" role="alert">معلومات غير صحيحة</div>';
                }
                  }
              ?>
                <div class="checkbox" lang="ar" dir="rtl">
                  <label>
                    <input type="checkbox" name="remember" checked>دخول تلقائي
                  </label>
                </div>
                <button type="submit" class="btn btn-lg btn-warning btn-block">دخول</button>
          </form>
        </div>
      </div>
    </th>
   </tr>
  </tbody>
            </table>  
          </div>
        </div>
      </div>
  </center>
</body>
</html>
