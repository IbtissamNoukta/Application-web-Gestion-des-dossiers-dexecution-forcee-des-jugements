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
    $id=$_SESSION['id'];
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

	<center lang="ar" dir="rtl">
    <?php
 
          $SOUS_CAT=$_GET['SOUS_CAT'];
            $requete1=$connexion->prepare("
                SELECT NUM_DOS__TRIBUNAL, SOMME_TOTAL FROM dossier WHERE ID_DOS=$id");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            $somme_total=$requete1[0][1];
          
    ?>
      <h3>الملف رقم : <?php echo $requete1[0][0];?> , نوعه : <?php echo $SOUS_CAT; ?></h3><br>
      <?php
      if ( isset( $_REQUEST['error'] ) ) {
                 if($_REQUEST['error']==1){
                   echo' <div class="alert alert-danger col-10" role="alert">
                        أدخل جميع المعلومات
                      </div>';
                     
                 }else if ($_REQUEST['error']==2) {
                    echo' <div class="alert alert-danger col-10" role="alert">
                      تمت اعادة رقم الوصل
                      </div>';
                           }
      }
       ?>
      <table class="table  table-bordered col-10" lang="ar" dir="rtl">
  <thead class="thead-light">
    <tr>
      <th scope="col">رقم الوصل</th>
      <th scope="col">تاريخ الدفع</th>
      <th scope="col">المبلغ</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($SOUS_CAT=="تنفيذ كلي") {
      $requete2=$connexion->prepare("
                SELECT ID_PAIEMENT, DATE_P FROM paiement WHERE ID_DOS=$id");
      $requete2->execute();
      $requete2=$requete2->fetchall();
      if(count($requete2)==0){
       echo '<tr>
      <form id="formulaire" method="POST" action="addpaiement.php?SOUS_CAT='.$SOUS_CAT.'">
        <td><input name="idpaiement" class="form-control" type="text" required=""></input></td>
        <td><input name="dateP" class="form-control" type="date" required=""></input></td>
        <td>'.$somme_total.'</td>
        <!--button enter-->
      </form>
    </tr>
  </tbody>
</table>'; 
}else{
  echo'<tr><td>'.$requete2[0][0].'</td>
        <td>'.$requete2[0][1].'</td>
        <td>'.$somme_total.'</td>
    </tr>
  </tbody>
</table>';
}
}else{
  $requete2=$connexion->prepare("
                SELECT ID_PAIEMENT, DATE_P, SOMME FROM paiement WHERE ID_DOS=$id");
      $requete2->execute();
      $requete2=$requete2->fetchall();
      if(count($requete2)!=0){
        $sommeP=0;
        for ($i=0; $i <count($requete2) ; $i++) { 
          echo'<tr><td>'.$requete2[$i][0].'</td>
        <td>'.$requete2[$i][1].'</td>
        <td>'.$requete2[$i][2].'</td>
    </tr>';
$sommeP=$sommeP+$requete2[$i][2];
        }
        $S=$somme_total-$sommeP;
      if ($S>0) {
        echo '<tr>
      <form id="formulaire" method="POST" action="addpaiement.php?SOUS_CAT='.$SOUS_CAT.'">
        <td><input name="idpaiement" class="form-control" type="text" required=""></input></td>
        <td><input name="dateP" class="form-control" type="date" required=""></input></td>
        <td><input name="sommep" max='.$S.' class="form-control" type="number" value='.$S.' required=""></input></td>
        <!--button enter-->
      </form>
    </tr>
  </tbody>
</table>';
      }else{
        echo'</tbody>
</table>';
      }
        
        
}else{
  echo '<tr>
      <form id="formulaire" method="POST" action="addpaiement.php?SOUS_CAT='.$SOUS_CAT.'">
        <td><input name="idpaiement" class="form-control" type="text" required=""></input></td>
        <td><input name="dateP" class="form-control" type="date" required=""></input></td>
        <td><input name="sommep" max='.$somme_total.' class="form-control" type="number" value='.$somme_total.' required=""></input></td>
        <!--button enter-->
        
      </form>
    </tr>
  </tbody>
</table>';
}
}
}catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
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