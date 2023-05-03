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
      $_SESSION['id']=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
  <style>
 #border{
  border: 5px solid #996633;
  height: 300px ;
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
            //dossier
            $requete1=$connexion->prepare("
              SELECT CIN, NUM_DOS__TRIBUNAL, NOM_DOS,NUM_DOS_SUJET, NUM_DOS_NB, NUM_JUGE, DATE_JUGE, TYPE, DATE_NOTIF, PERIODE_CONTRAINTE, SOMME_TOTAL FROM dossier WHERE ID_DOS=$id ");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            $CIN=$requete1[0][0];
            //personne
            $requete2=$connexion->prepare("
              SELECT * FROM personne WHERE CIN ='$CIN'");
            $requete2->execute();
            $requete2=$requete2->fetchall();

    ?>
  
    <!--titre-->
  <center><h1>معلومات حول الملف</h1></center>
  <br>
    <!--slides-->
  <div id="carouselExampleIndicators"  class="carousel slide col align-self-center" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" >
      <div class="carousel-item active">
        <div style="background-color:#fff3e6;" id="border" dir="rtl" lang="ar">
          <center><h4>الملف</h4></center>
          <strong><label>رقم الملف بالمحكمة :</label></strong>
          <label><?php echo $requete1[0][1]; ?></label>
          <strong><label>إسم الملف :</label></strong>
          <label><?php echo $requete1[0][2]; ?></label>
          <strong><label>رقم الملف بالنيابة :</label></strong>
          <label><?php echo $requete1[0][4]; ?></label>
          <strong><label>رقم ملف الموضوع :</label></strong>
          <label><?php echo $requete1[0][3]; ?></label><br>
          <strong><label>حكم رقم :</label></strong>
          <label><?php echo $requete1[0][5]; ?></label>
          <strong><label>صادر في :</label></strong>
          <label><?php echo $requete1[0][6]; ?></label><br>
          <strong><label>نوعه :</label></strong>
          <label><?php echo $requete1[0][7]; ?></label><br>
          <strong><label>تاريخ التبليغ :</label></strong>
          <label><?php echo $requete1[0][8]; ?></label><br>
          <strong><label>مدة الإجبار :</label></strong>
          <label><?php echo $requete1[0][9]; ?></label><br>
        </div>
      </div>
      <div class="carousel-item"  >
        <div style="background-color:#ffe6cc;" id="border"  lang="ar" dir="rtl" >
          <center><h4>صاحب الملف</h4></center>
          <strong><label>الاسم العائلي  :</label></strong>
          <label><?php echo $requete2[0][1]; ?></label><br>
          <strong><label>الاسم الشخصي :</label></strong>
          <label><?php echo $requete2[0][2]; ?></label><br>
          <strong><label>أبوه :</label></strong>
          <label><?php echo $requete2[0][3]; ?></label>
          <strong><label>أمه :</label></strong>
          <label><?php echo $requete2[0][4]; ?></label><br>
          <strong><label>تاريخ الإزدياد :</label></strong>
          <label><?php echo $requete2[0][5]; ?></label>
          <strong><label>مكانه :</label></strong>
          <label><?php echo $requete2[0][6]; ?></label><br>
          <strong><label>رقم بطاقة التعريف الوطنية :</label></strong>
          <label><?php echo $requete2[0][0]; ?></label><br>
          <strong><label>الساكن :</label></strong>
          <label><?php echo $requete2[0][7]; ?></label><br>
          <strong><label>التهمة :</label></strong>
          <label><?php echo $requete2[0][8]; ?></label><br>
        </div>
      </div>
      <div class="carousel-item" >
        <div style="background-color:#ffdab3;" id="border" lang="ar" dir="rtl">
          <center><h4>الغرامة<h4></center>
          <strong><label>المبلغ الاجمالي :</label></strong>
          <label><?php echo $requete1[0][10]; ?></label><br>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div><br>
 <!-- <button onclick="window.print();"></button> --->
  <center><button id="btnPrint" class="btn btn-secondary btn-lg" onclick="imprimer()">imprimer</button></center>
      <?php
      }
      catch(PDOEXEPTION $e){
        echo'echec:'.$e->get_message();
      }
    ?>
</body>
</html>
    <script type="text/javascript">
       function imprimer() {
            var divContents = document.getElementById("carouselExampleIndicators").innerHTML;
            
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        };
    </script>