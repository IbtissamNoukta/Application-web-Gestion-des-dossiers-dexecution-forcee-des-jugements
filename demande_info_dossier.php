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
  <!-- jQuery, #Popper.js -->
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/jquery-3.3.1.slim.min.js"></script>
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/popper.min.js"></script>
  <script rel="stylesheet" type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
  <script src="https://kit.fontawesome.com/7d87fa7c4e.js" crossorigin="anonymous"></script>


  
  

</head>

<body>
	<!--navbar-->
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


<?php
            $id=$_SESSION['id'];
            //cin 
            $requete1=$connexion->prepare("
                      SELECT CIN FROM dossier WHERE ID_DOS=$id");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            $CIN=$requete1[0][0];
            //nom et prenom
            $requete2=$connexion->prepare("
                      SELECT NOM, PRENOM FROM personne WHERE CIN='$CIN'");
            $requete2->execute();
            $requete2=$requete2->fetchall();

          
            ?>

  <center lang="ar" dir="rtl">
    <h2>طلب المعلومات عن <?php echo $requete2[0][0].' '.$requete2[0][1];?> صاحب(ة) بطاقة التعريف الوطنية <?php echo $CIN;?> :</h2>
    <br><br>
    <?php
    $requete3=$connexion->prepare("
        SELECT ID_D FROM demande_information WHERE ID_DOS=$id");
    $requete3->execute();
    $requete3=$requete3->fetchall();
    if (count($requete3)!=0) {
      echo'<div class="alert alert-success alert-dismissible fade show col-10" role="alert">
                              <strong>تم الإختيار بنجاح</strong>
                            </div>';
    }
    ?>
<!--information-->
<form method="POST" action="demande_info_dossierDB.php">
<table class="table  table-bordered col-10">
  <thead>
    <tr class="table-warning">
      <th scope="col"colspan="3"><center><strong>الإختيارات </strong></center></th>
    </tr>
  </thead>
  
  <tbody>
    
    <tr>
      <td><div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="inlineCheckbox1" id="inlineCheckbox1" value="option1">
  <label class="form-check-label" for="inlineCheckbox1">رقم لوحة السيارة</label>
</div></td>
      <td><div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="inlineCheckbox2" id="inlineCheckbox2" value="option2">
  <label class="form-check-label" for="inlineCheckbox2">رقم الحساب البنكي</label>
</div></td>
      <td><div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="inlineCheckbox3" id="inlineCheckbox3" value="option3">
  <label class="form-check-label" for="inlineCheckbox3">العقارات المحفظة</label>
</div></td>
    
    </tr>
    
  
  </tbody>
</form>
</table>
<?php
    if (count($requete3)==0) {
      echo '<button class="btn btn-warning btn-lg" type="submit">طلب</button>';
    }

    }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
?>
  

  </center>
</body>
</html>