<?php session_start(); 
$serveur="localhost";
          $login="root";
          $pass="";
          try{
            $connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      if (isset($_SESSION['mat'])) {
          $mat=$_SESSION['mat'];
         
            $r0=$connexion->prepare("
                  SELECT NOM,PRENOM,IMAGE FROM USER WHERE MATRICULE='$mat'");
            $r0->execute();
            $r0=$r0->fetchall();
     }else{
          exit("Echec") ;
      }
      if (isset($_SESSION['id'])) {
        unset($_SESSION['id']);
      }
    }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
?>
<!DOCTYPE html>
<html>
<head>
  <style>
 #border{
  border: 5px solid GREY;
  height: 400px ;
  text-align: right;
  }
  label{
    margin-right: 10px;
  }
</style>

  <link rel="icon" type="image/png" href="image/icone.svg" />
  <title>ProfilUser</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom 
  <!- CSS -->

  <link rel="stylesheet" type="text/css" href="css/stylenav.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <!-- jQuery, #Popper.js -->
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/jquery-3.3.1.slim.min.js"></script>
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/popper.min.js"></script>
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
  <script src="https://kit.fontawesome.com/7d87fa7c4e.js" crossorigin="anonymous"></script>
</head>

<body>
  <!--navbar-->
<nav class="navbar navbar-expand-xl navbar-dark">
  <a class="navbar-brand" >
      <div class="form-row">
      <img src="image/icone.svg" width="30" height="30" class="d-inline-block align-top">&nbsp; &nbsp;
        <div style="text-align: center; font-size: 13px; line-height: 1%; margin-top: 7px; color: white;">
          <p>المملكة المغربية </p>
          <p>وزارة العدل</p>
          <p>المحكمة الابتدائية بآسفي</p>
        </div>
      </div>
    </a>   
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Collection of nav links, forms, and other content for toggling -->
  <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">    
    
    <div class="navbar-nav ml-auto">
      <a href="profiluser.php" class="nav-item nav-link"><i class="fa fa-home"></i><span>الرئيسية</span></a>
      <a href="AjouteDos.php" class="nav-item nav-link  active"><i class="fa fa-folder"></i><span>إضافة ملف</span></a>
      <a href="AjouteTransfert.php" class="nav-item nav-link"><i class="fas fa-map-marker-alt"></i><span>إضافة التنقلات</span></a>
      <a href="Progtransfert.php" class="nav-item nav-link"><i class="fas fa-car-side"></i><span>برنامج التنقلات</span></a>
      <a href="Demandeinfo.php" class="nav-item nav-link"><i class="fa fa-info"></i><span>طلب المعلومات</span></a>
      <a href="graphe.php" class="nav-item nav-link"><i class="fa fa-line-chart"></i><span>رسم بياني</span></a>
         
      <div class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action"><img src="<?php echo $r0[0][2]; ?>" class="avatar" alt="Avatar"></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item"><i class="fa fa-user-o"></i><?php echo $r0[0][0].' '.$r0[0][1]; ?></a>
          <div class="divider dropdown-divider"></div>
          <a href="Deconnexion.php" class="dropdown-item"><i class="fa fa-sign-out">&#xE8AC;</i>خروج</a>
        </div>
      </div>
    </div>
  </div>
</nav>
<br>

	<center lang="ar" dir="rtl">
    <h3>إضافة ملف</h3><br>
    <?php
    if (isset($_GET['X'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>تمت الإضافة بنجاح</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
    }
    ?>
<form method="POST" action="ajouteDosDB.php">
        <div id="border">
          <center><h4>الملف</h4></center>
          <div class="form-row">
          <label for="NUM_DOS__TRIBUNAL">رقم الملف بالمحكمة</label><input type="text" class="form-control form-group col-md-1" name="NUM_DOS__TRIBUNAL" id="NUM_DOS__TRIBUNAL" placeholder="رقم ..." required>
          <label for="NOM_DOS">إسم الملف</label><input type="text" class="form-control form-group col-md-2" name="NOM_DOS" id="NOM_DOS" placeholder="إسم ..." required>
          <label for="NUM_DOS_NB">رقم الملف بالنيابة</label><input type="text" class="form-control form-group col-md-1" name="NUM_DOS_NB" id="NUM_DOS_NB" placeholder="رقم ..." required>
          <label for="NUM_DOS_SUJET">رقم ملف الموضوع</label><input type="text" class="form-control form-group col-md-1" name="NUM_DOS_SUJET" id="NUM_DOS_SUJET" placeholder="رقم ..." required><br>
        </div>
        <div class="form-row">
          <label for="NUM_JUGE">حكم رقم</label><input type="text" class="form-control form-group col-md-1" name="NUM_JUGE" id="NUM_JUGE" placeholder="رقم ..." required>
          <label for="DATE_JUGE">صادر في</label><input type="date" class="form-control col-md-2" name="DATE_JUGE" id="DATE_JUGE" required><br>
        </div>
        <div class="form-row">
          <label for="TYPE">نوعه</label><input type="text" class="form-control form-group col-md-2" name="TYPE" id="TYPE" placeholder="نوعه" required><br>
        </div>
        <div class="form-row">
          <label for="DATE_NOTIF">تاريخ التبليغ</label><input type="date" class="form-control col-md-2" name="DATE_NOTIF" id="DATE_NOTIF" required><br><br>
        </div>
        <div class="form-row">
          <label for="PERIODE_CONTRAINTE">مدة الإجبار</label><input type="text" class="form-control form-group col-md-2" name="PERIODE_CONTRAINTE" id="PERIODE_CONTRAINTE" placeholder="مدة الإجبار" required><br>
        </div>
        </div>
        
        <div id="border">
          <center><h4>صاحب الملف</h4></center>
          <div class="form-row">
          <label for="NOM">الاسم العائلي</label><input type="text" class="form-control form-group col-md-2" name="NOM" id="NOM" placeholder="الاسم العائلي" required><br>
        </div>
          <div class="form-row">
          <label for="PRENOM">الاسم الشخصي</label><input type="text" class="form-control form-group col-md-2" name="PRENOM" id="PRENOM" placeholder="الاسم الشخصي" required><br>
        </div>
        <div class="form-row">
          <label for="PERE">أبوه</label><input type="text" class="form-control form-group col-md-2" name="PERE" id="PERE" placeholder="أبوه" required>
          <label for="MERE">أمه</label><input type="text" class="form-control form-group col-md-2" name="MERE" id="MERE" placeholder="أمه" required><br>
        </div>
        <div class="form-row">
          <label for="DATE_NAISSANCE">تاريخ الإزدياد</label><input type="Date" class="form-control col-md-2" name="DATE_NAISSANCE" id="DATE_NAISSANCE" required>
          <label for="LIEU_NAISSANCE">مكانه</label><input type="text" class="form-control form-group col-md-2" name="LIEU_NAISSANCE" id="LIEU_NAISSANCE" placeholder="مكانه" required><br>
        </div>
        <div class="form-row">
          <label for="CIN">رقم بطاقة التعريف الوطنية</label><input type="text" class="form-control form-group col-md-2" name="CIN" id="CIN" placeholder="قم بطاقة ..." required><br>
          <label for="LIEU_RESIDENCE">الساكن</label><input type="text" class="form-control form-group col-md-2" name="LIEU_RESIDENCE" id="LIEU_RESIDENCE" placeholder="الساكن" required><br>
        </div>
        <div class="form-row">
          <label for="CHARGE">التهمة</label><input type="text" class="form-control form-group col-md-2" name="CHARGE" id="CHARGE" placeholder="التهمة" required><br>
        </div>
        </div>
        <div  id="border" >
          <center><h4>الغرامة<h4></center>
            <div class="form-row">
          <label for="SOMME_TOTAL">المبلغ الاجمالي</label><input type="number" class="form-control form-group col-md-2" name="SOMME_TOTAL" id="SOMME_TOTAL" placeholder="المبلغ..." required><br>
        </div>
        </div><br>
        <center><button class="btn btn-secondary btn-lg" type="submit">إضافة</button></center>
        <br>
</form>
  </center>
</body>
</html>