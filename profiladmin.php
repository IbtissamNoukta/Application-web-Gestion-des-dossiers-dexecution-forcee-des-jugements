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
  <style type="text/css">
.avatar {
  vertical-align: middle;
  width: 200px;
  height: 200px;
  border-radius: 50%;
}
  </style>
  <link rel="icon" type="image/png" href="image/icone.svg" />
  <title>ProfilUser</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom 
  <!- CSS -->
  <link rel="stylesheet" type="text/css" href="css/stylenavadmin.css">
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
      <a href="profiladmin.php" class="nav-item nav-link active"><i class="fa fa-users"></i><span>Accueil</span></a>
      <a href="Ajouteperso.php" class="nav-item nav-link"><i class="fa fa-plus"></i><span>Ajouter un compte</span></a>
      <div class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action"><img src="<?php echo $r0[0][2]; ?>" class="avatar" alt="Avatar"></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item"><i class="fa fa-user-o"></i><?php echo $r0[0][0].' '.$r0[0][1]; ?></a>
          <div class="divider dropdown-divider"></div>
          <a href="Deconnexion.php" class="dropdown-item"><i class="fa fa-sign-out">&#xE8AC;</i>Déconnexion</a>
        </div>
      </div>
    </div>
  </div>
</nav>
<br>

	<center>
    <div class="row col-12 ">
    
    <?php
     $requete1=$connexion->prepare("
              SELECT MATRICULE, NOM, PRENOM, IMAGE FROM user WHERE MATRICULE!='$mat'");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            for ($i=0; $i <count($requete1) ; $i++) { 
              echo'<div class="col-sm-3 "><div id="border" class="card mb-3 shadow">
              <div class="card-body">
              <img class="rounded-circle z-depth-2 avatar" alt="Avatar" data-holder-rendered="true" src="'.$requete1[$i][3].'" class="card-img-top">
              <h5 style="margin-top:10%;" readonly class="card-title">'.$requete1[$i][0].'</h5>
              <p class="card-text">'.$requete1[$i][1].' '.$requete1[$i][2].'</p>
              <div class="offset-md-9 ">';
                 echo" <i class='fas fa-user-edit' type='button' onclick=\"window.location.href = 'modifperso.php?mat=".$requete1[$i][0]."'\"></i>&nbsp;&nbsp;";
                  echo'<i class="fas fa-trash" style="color:red;" type="button" data-toggle="modal" data-target="#exampleModal'.$i.'"></i>
              </div>
              
              ';
              ?>
                <!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">supprimer le compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        voulez vous vraiment supprimer ce compte?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?php
        echo "<button type='button' class='btn btn-danger' onclick=\"window.location.href = 'deleteperso.php?mat=".$requete1[$i][0]."'\">supprimer</button>";
        ?>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</div>
<!-- fin Modal -->
<?php
            }
    ?>
</div>
  </center>
</body>
</html>
<?php
}
      catch (PDOException $e) {
        echo  'Echec:'.$e->getmessage();  
      }
?>