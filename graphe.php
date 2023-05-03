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

  <script src="https://kit.fontawesome.com/7d87fa7c4e.js" crossorigin="anonymous"></script>
    <!--graph-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <a href="graphe.php" class="nav-item nav-link active"><i class="fa fa-line-chart"></i><span>رسم بياني</span></a>
         
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
    <form id="formulaire" method="POST"  action="<?php echo($_SERVER['PHP_SELF']) ?>">
      <div class="form-row align-items-center">
        <div class="col-sm-4,5 my-1">
          <h3>مداخيل وحدة التبليغ و التحصيل من سنة</h3>
        </div>
          <div class="col-sm-1 my-1">

          <input type="number" size="4" class="form-control" name="anneemin" value="<?php if(isset($_POST['anneemin'])) echo $_POST['anneemin']; ?>" required>
        </div>
        <div class="col-sm-1 my-1">
          <h3>الى سنة</h3>
        </div>
          <div class="col-sm-1 my-1">
          <input type="number" size="4" class="form-control" name="anneemax" value="<?php if(isset($_POST['anneemax'])) echo $_POST['anneemax']; ?>" required>
        </div>
        <div class="col-sm-1 my-1">
          <h3>بالدرهم</h3>
        </div>
      </div>
     <!-- <p onKeyPress="if(event.keyCode == 13) validerForm();"></p>-->
    </form>
  </center>
  <?php
  if (isset($_POST['anneemin'])&& isset($_POST['anneemax'])) {
  $anneemin=$_POST['anneemin'];
  $anneemax=$_POST['anneemax'];
 
                $requete1=$connexion->prepare("
                      SELECT YEAR(DATE_P),SOMME FROM paiement WHERE YEAR(DATE_P) BETWEEN $anneemin AND $anneemax ");
                $requete1->execute();
                $requete1=$requete1->fetchall();
                $year='';
                $some='';
                for ($i=$anneemin; $i <=$anneemax ; $i++) { 
                  $som[$i]=0;
                  for ($j=0; $j <count($requete1) ; $j++) {
                      if ($i==$requete1[$j][0]) {
                        $som[$i]=$som[$i]+$requete1[$j][1];
                      }else{
                        $som[$i]=$som[$i]+0;
                      }
                }
                  if ($i==$anneemax) {
                    $year=$year.$i;
                    $some=$some.$som[$i];
                  }else{
                  $year=$year.$i.',';
                  $some=$some.$som[$i].',';
                    }
                }
                

                //echo $year;
                //echo $some;
                //$nb=$anneemax-$anneemin;
                


            
          echo '<div>
                  <canvas id="myChart"></canvas>
                </div>'; 
          echo '<center><button class="btn btn-secondary btn-lg" onclick="window.print();">imprimer</button></center>';        
      }
      }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
  ?>


</body>
<script type="text/javascript">
     // <block:setup:1>
const labels = [
  <?php echo $year; ?>
];
const data = {
  labels: labels,
  datasets: [{
    label: 'المجموع العام للمبالغ المدفوعة للخزينة الخاص بوحدة التبليغ والتحصيل',
    backgroundColor: 'rgb(255,204,0)',
    borderColor: 'rgb(255,204,0)',
    data: [<?php echo $some; ?>],
  }]
};
// </block:setup>

// <block:config:0>
const config = {
  type: 'line',
  data,
  options: {}
};
// </block:config>

module.exports = {
  actions: [],
  config: config,
};

</script>
<!--button enter-->
<script type="text/javascript">

  document.onkeydown = function (e) {
    var keyCode = e.keyCode;
    if(keyCode == 13) {
        document.getElementById("formulaire").submit();
    }
};

  // === include 'setup' then 'config' above ===

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );


</script>
</html>