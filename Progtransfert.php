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
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="image/icone.svg" />
  <title>ProfilUser</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom 
  <!- CSS -->
  <link rel="stylesheet" type="text/css" href="css/stylenav.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">

  <script src="https://kit.fontawesome.com/7d87fa7c4e.js" crossorigin="anonymous"></script>
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/jquery-3.3.1.slim.min.js"></script>
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
  
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
      <a href="AjouteDos.php" class="nav-item nav-link"><i class="fa fa-folder"></i><span>إضافة ملف</span></a>
      <a href="AjouteTransfert.php" class="nav-item nav-link"><i class="fas fa-map-marker-alt"></i><span>إضافة التنقلات</span></a>
      <a href="Progtransfert.php" class="nav-item nav-link active"><i class="fas fa-car-side"></i><span>برنامج التنقلات</span></a>
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
    <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
      <div class="form-row align-items-center">
        <div class="col-sm-5 my-1">
          <h3>برنامج تنقل موظفي التبليغ و التحصيل أشهر</h3>
        </div>
        <div class="col-sm-1 my-1">
          <select class="custom-select mr-sm-2" name="moi1">
            <option value="00"selected>شهر...</option>
            <option value="01">يناير</option>
            <option value="02">فبراير</option>
            <option value="03">مارس</option>
            <option value="04">أبريل</option>
            <option value="05">ماي</option>
            <option value="06">يونيو</option>
            <option value="07">يوليوز</option>
            <option value="08">غشت</option>
            <option value="09">شتنبر</option>
            <option value="10">أكتوبر</option>
            <option value="11">نونبر</option>
            <option value="12">ديسمبر</option>
          </select>
        </div>
        <div class="col-sm-0 my-1">
          <strong>&nbsp; &nbsp; -</strong>
        </div>
        <div class="col-sm-1 my-1">
          <select class="custom-select mr-sm-2 " name="moi2">
            <option value="00" selected>شهر...</option>
            <option value="01">يناير</option>
            <option value="02">فبراير</option>
            <option value="03">مارس</option>
            <option value="04">أبريل</option>
            <option value="05">ماي</option>
            <option value="06">يونيو</option>
            <option value="07">يوليوز</option>
            <option value="08">غشت</option>
            <option value="09">شتنبر</option>
            <option value="10">أكتوبر</option>
            <option value="11">نونبر</option>
            <option value="12">ديسمبر</option>
          </select>
        </div>
        <div class="col-sm-0 my-1">
          <strong>&nbsp; &nbsp; -</strong>
        </div>
        <div class="col-sm-1 my-1">
          <select class="custom-select mr-sm-2 " name="moi3">
            <option value="00"selected>شهر...</option>
            <option value="01">يناير</option>
            <option value="02">فبراير</option>
            <option value="03">مارس</option>
            <option value="04">أبريل</option>
            <option value="05">ماي</option>
            <option value="06">يونيو</option>
            <option value="07">يوليوز</option>
            <option value="08">غشت</option>
            <option value="09">شتنبر</option>
            <option value="10">أكتوبر</option>
            <option value="11">نونبر</option>
            <option value="12">ديسمبر</option>
          </select>
        </div>
        <div class="col-sm-1 my-1">
          <h3>سنة</h3>
        </div>
        <div class="col-sm-1 my-1">
          <input type="number" size="4" class="form-control" name="annee" required>
        </div>
      </div>
      <!--button enter-->
      <p onKeyPress="if(event.keyCode == 13) validerForm();"></p>
    </form>
    <br>
  
      <?php


        //require_once ( 'username.php' );
        if (isset($_POST['annee'])) {
          //annee
          $annee = $_POST['annee'];
          if (isset($_POST['moi1'])) {
            //1eremoi
            $moi1=$_POST['moi1'];
            if ($moi1!=00) {
            //echo $moi1;
            //2eme moi
            if (isset($_POST['moi2'])) {
            //2eme moi
            $moi2=$_POST['moi2'];
            //echo $moi2;
            if (isset($_POST['moi3'])) {
              $moi3=$_POST['moi3'];
              //echo $moi3;
              $requete1=$connexion->prepare("
                      SELECT DAY_T, DATE_T, DESTINATION FROM prog_transfert_global WHERE YEAR(DATE_T) = $annee AND ( MONTH(DATE_T) = $moi1 OR MONTH(DATE_T) = $moi2 OR MONTH(DATE_T) = $moi3 ) ORDER BY DATE_P ASC");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            //print_r($requete1);
            }else{
              $requete1=$connexion->prepare("
                      SELECT DAY_T, DATE_T, DESTINATION FROM prog_transfert_global WHERE YEAR(DATE_T) = $annee ) AND ( MONTH(DATE_T) = $moi1 OR MONTH(DATE_T) = $moi2 ) ORDER BY DATE_T ASC");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            //            print_r($requete1);

            }
            
          }else{
            $requete1=$connexion->prepare("
                      SELECT DAY_T, DATE_T, DESTINATION FROM prog_transfert_global WHERE YEAR(DATE_T) = $annee AND MONTH(DATE_T) = $moi1 ORDER BY DATE_T ASC");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            //            print_r($requete1);

          }
          }else{
            $requete1=$connexion->prepare("
                      SELECT DAY_T, DATE_T, DESTINATION FROM prog_transfert_global WHERE YEAR(DATE_T) = $annee ORDER BY DATE_T ASC");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            //            print_r($requete1);
          }
          }else{
            $requete1=$connexion->prepare("
                      SELECT DAY_T, DATE_T, DESTINATION FROM prog_transfert_global WHERE YEAR(DATE_T) = $annee ORDER BY DATE_T ASC");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            //            print_r($requete1);

          }
          

        }

      }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
      ?>

      <table class="table  table-bordered col-10" >
  <thead class="thead-light">
    <tr>
      <th scope="col">يوم التنقل</th>
      <th scope="col">التاريخ</th>
      <th scope="col">الوجهة</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if (isset($requete1)) {
          for ($i=0; $i < count($requete1) ; $i++) { 
            echo'<tr><td>'.$requete1[$i][0].'</td>';
            echo'<td>'.$requete1[$i][1].'</td>';
            echo'<td>'.$requete1[$i][2].'</td>';
          }
        
    ?>
  </tbody>
</table>
<?php
if (count($requete1)!=0) {
echo'<button class="btn btn-secondary btn-lg" onclick="window.print();">imprimer</button>';
}
}
?>
  </center>
</body>
<!--button enter-->
<script type="text/javascript">
  function validerForm(){
    document.getElementById("formulaire").submit();
}
</script>
</html>