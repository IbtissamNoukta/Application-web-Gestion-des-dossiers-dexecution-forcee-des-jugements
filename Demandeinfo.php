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
      }?>
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
      <a href="Progtransfert.php" class="nav-item nav-link"><i class="fas fa-car-side"></i><span>برنامج التنقلات</span></a>
      <a href="Demandeinfo.php" class="nav-item nav-link active"><i class="fa fa-info"></i><span>طلب المعلومات</span></a>
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

<table class="table  table-bordered col-10">
  <thead>
    <tr class="table-warning">
      <th scope="col"colspan="3"><center><strong>الإختيارات </strong></center></th>
    </tr>
  </thead>
  <tbody>
    <tr>
<form method="POST" id="formulaire" action="<?php echo($_SERVER['PHP_SELF']) ?>">
      <td><div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="رقم لوحة السيارة">
  <label class="form-check-label" for="exampleRadios1">&nbsp; &nbsp; &nbsp;رقم لوحة السيارة</label>
</div></td>
      <td><div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="رقم الحساب البنكي">
  <label class="form-check-label" for="exampleRadios2">&nbsp; &nbsp; &nbsp;رقم الحساب البنكي</label>
</div></td>
      <td><div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="العقارات المحفظة">
  <label class="form-check-label" for="exampleRadios3">&nbsp; &nbsp; &nbsp;العقارات المحفظة</label>
</div></td>
    </form>
    </tr>
 
  </tbody>
</table>
<!--<button class="btn btn-warning btn-lg" type="submit">طلب</button> <br>-->

<?php

if (isset($_POST['exampleRadios'])) {
$type_d=$_POST['exampleRadios'];

  //iddossier
  $requete1=$connexion->prepare("
              SELECT ID_DOS FROM demande_information WHERE TYPE_D= '$type_d'");
  $requete1->execute();
  $requete1=$requete1->fetchall();

?>


    <br><h3>لائحة بأسماء الملزمين بأداء الدين العمومي</h3><br>

          <table class="table  table-bordered col-10" lang="ar" dir="rtl">
  <thead class="thead-light">
    <tr>
      <th scope="col">الرقم الترتيبي</th>
      <th scope="col">رقم ملف التنفيد الزجري</th>
      <th scope="col">اسم الملزم بالدين العمومي</th>
      <th scope="col">رقم بطاقة التعريف الوطنية</th>
      <th scope="col"><?php if(isset($_POST['exampleRadios'])) echo $_POST['exampleRadios'];?></th>
    </tr>
  </thead>
  <tbody>
    <?php 
      for ($i=0; $i <count($requete1) ; $i++) { 
    $ID_DOS=$requete1[$i][0];
  //datadossier
  $requete2=$connexion->prepare("
              SELECT CIN, NUM_DOS__TRIBUNAL FROM dossier WHERE ID_DOS= $ID_DOS");
  $requete2->execute();
  $requete2=$requete2->fetchall();
  $CIN=$requete2[0][0];
  //datapersonne
  $requete3=$connexion->prepare("
              SELECT NOM, PRENOM FROM personne WHERE CIN= '$CIN'");
  $requete3->execute();
  $requete3=$requete3->fetchall();
  echo '<tr>
  <td>'.($i+1).'</td>
<td>'.$requete2[0][1].'</td>
<td>'.$requete3[0][0].' '.$requete3[0][1].'</td>
<td>'.$requete2[0][0].'</td>
<td></td>
  </tr>';
  }
  
}

 }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
    ?>
  </tbody>
</table>
<?php
if (isset($_POST['exampleRadios']) && count($requete1)!=0) {
echo'<button class="btn btn-secondary btn-lg" onclick="window.print();">imprimer</button>';
}
?>
  </center>
</body>
<!--button enter-->
<script type="text/javascript">
  document.onkeydown = function (e) {
    var keyCode = e.keyCode;
    if(keyCode == 13) {
        document.getElementById("formulaire").submit();
    }
};
</script>
</html>