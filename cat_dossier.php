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
  <style type="text/css">
  #border{
    height: 270px ;
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

<center>
<div class="row col-12 ">
  <?php
          $id=$_SESSION['id'];
          $_SESSION['id']=$_GET['id'];
            //les categorie
            $requete1=$connexion->prepare("
              SELECT * FROM categorie");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            for ($i=0; $i <count($requete1); $i++) {
            //id categorie 
              $idcat[$i]=$requete1[$i][0];
              //date of today
              $today = date('Y-m-d');
              ?>

              <div class="col-sm-3 ">
                <?php
                  $requete3=$connexion->prepare("
                      SELECT ID_CAT, DATE_CAT,ID_SOUSCAT FROM correspondant Where ID_DOS=$id");
                  $requete3->execute();
                  $requete3=$requete3->fetchall();
                    if (isset($requete3[$i][0])) {
                      if ($idcat[$i]==$requete3[$i][0]) {
                        echo '<div id="border" class="card bg-warning mb-3" >';
                      }else{
                        echo '<div id="border" class="card bg-light mb-3" >';
                      } 
                    }else{
                    echo '<div id="border" class="card bg-light mb-3" >';
                    }
                
                 ?>
                  <div class="card-body" >
                      <form method="POST" action="addcat.php?id=<?php echo $id; ?>&idcat=<?php echo $idcat[$i]; ?>">
                      <h5  readonly class="card-title"><?php echo $idcat[$i]; ?></h5>
                      <p class="card-text"><?php echo $requete1[$i][1] ?></p>
                      <?php
                      
                      
                      if (isset($requete3[$i][0])) {
                        if ($idcat[$i]==$requete3[$i][0]) {
                          echo '<label type="date" >'.$requete3[$i][1].' </label><br>';
                        }else{
                          echo '<input name="datec" class="form-control" type="date" value="'.$today.'"></input><br>';
                        } 
                      }else{
                        echo '<input name="datec" class="form-control" type="date" value="'.$today.'"></input><br>';
                      }
                      if (isset($_GET['idcat'])) {
                        if ($_GET['idcat']==$idcat[$i]) {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>لا يمكن</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                        }

                      }
                       //select
                      


                        $requete2=$connexion->prepare("
                          SELECT * FROM sous_categorie WHERE ID_CAT=$idcat[$i]");
                        $requete2->execute();
                        $requete2=$requete2->fetchall();
                        if (count($requete2)>0) {
                          if (isset($requete3[$i][0])) {
                        if ($idcat[$i]==$requete3[$i][0]) {
                          $idsous=$requete3[$i][2];
                              $requete4=$connexion->prepare("
                              SELECT NOM_SOUSCAT FROM sous_categorie WHERE ID_SOUSCAT=$idsous");
                              $requete4->execute();
                              $requete4=$requete4->fetchall();
                          echo '<label type="text" >'.$requete4[0][0].' </label><br>';
                        }
                      }else{
                        echo '<select name="souscat">
                                  <option value="'.$requete2[0][2].'">'.$requete2[0][2].'</option>
                                  <option value="'.$requete2[1][2].'">'.$requete2[1][2].'</option>
                                </select>';
                      }

                          
                        }?>
                      <br><br>
                      <?php
                      if (isset($requete3[$i][0])) {
                        if ($idcat[$i]==$requete3[$i][0]) {
                          if ($requete3[$i][2]==0) {
                            echo'<br>';
                          }
                          
                            
                        }else{
                          echo'<button type="submit" class="btn btn-secondary">إضافة</button>';  
                        }
                      }else{
                          echo'<button type="submit" class="btn btn-secondary">إضافة</button>';

                      }
                      
                      ?>
                      
                    </form>
                    <?php
                    if (isset($requete3[$i][0])) {
                    
                    if ($idcat[$i]==1 && (!isset($requete3[$i+1][0]))) {
                            echo "<center><div class='btn-group' role='group' aria-label='Basic example'>
                            <button class='btn btn-secondary' onclick=\"window.location.href = 'transfert_dossier.php'\">برنامج التنقلات</button>
                            <button class='btn btn-secondary' onclick=\"window.location.href = 'demande_info_dossier.php'\">طلب المعلومات</button>
                          </div><center>";
                          }
                    if ($idcat[$i]==6) {
                            echo "<center><div class='btn-group' role='group' aria-label='Basic example'>
                            <button class='btn btn-secondary' onclick=\"window.location.href = 'paiement.php?SOUS_CAT=".$requete4[0][0]."'\">الدفع</button>
                          </div><center>";
                          }
                        }
                          ?>
                  </div>
                  
                </div>
              </div>
              <?php 
                }
            
            }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }

              ?>
  
</div>

</center>
                    


</body>
</html>