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
if(!empty($_FILES)){
    $file_name = $_FILES['photo']['name'];
    $file_extension = strrchr($file_name, ".");
    $file_tmp_name = $_FILES['photo']['tmp_name'];
    $file_dest = 'image_user/'.$file_name ;
    $extention_autorise = array('.png', '.PNG','.jpg','.JPG');
    if(in_array($file_extension, $extention_autorise)){
        if(move_uploaded_file($file_tmp_name, $file_dest )){
            echo "fichier envoyer avec succès";
        }else{
            echo "fichier nest pas envoyer ";
        }
    }else{
        echo "seulement les fichier png sont autorise";
    }
    $_SESSION ['toph'] = $file_dest;
 // echo $_SESSION ['toph'];
    
}
if(isset($_POST['matricule'])){
$Matricule=$_POST['matricule'];
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$Genre=$_POST['genre'];
$mdp1=$_POST['Password'];
$image=$_SESSION ['toph'];
$mdp2=$_POST['mpd'];
if($mdp1==$mdp2){
  $pass=password_hash($mdp1, PASSWORD_DEFAULT);//chifrer le mot de pass
    $requete1=$connexion->prepare("
              INSERT INTO user (MATRICULE, NOM, PRENOM, IMAGE, PROFIL, PASSWORD) VALUES ('$Matricule', '$nom', '$prenom', '$image', '$Genre', '$pass')");
    $requete1->execute();
    header("location:ajouteperso.php?error=1");
           }else{
            header("location:ajouteperso.php?error=2");
           }

  }
?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">

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
      <a href="profiladmin.php" class="nav-item nav-link"><i class="fa fa-users"></i><span>Accueil</span></a>
      <a href="Ajouteperso.php" class="nav-item nav-link active"><i class="fa fa-plus"></i><span>Ajouter un compte</span></a>
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


  

            <div class="col-sm-6 offset-md-3">
                          <div id="border" class="card mb-3 shadow">
                          <div class="card-body" >
                              <center>
          <h1 class="h3 mb-3"><B>Ajouter un profil</B></h1>
     
                       <?php  
                        if ( isset( $_REQUEST['error'] ) ) {
                 if($_REQUEST['error']==1){
                   echo' <div class="alert alert-success" role="alert">
                        contact est ajouter.
                      </div>';
                     
                 }else if ($_REQUEST['error']==2) {
                    echo' <div class="alert alert-danger" role="alert">
                      Veuillez verifier le mot de passe.
                      </div>';
                           }}?>
                         </center>
              
                      <form  enctype = "multipart/form-data"  method="post" >
                          
                            <center>
                            <div class="mb-3">
                              <label for="file-upload" class="label-file "><i class="fa fa-plus-circle" aria-hidden="true" style="font-size:130px; color:#5353c6;"></i> </label>
                             <input style="display:none;" id="file-upload" type="file" name="photo"  ><br/>
                               </div>
                             </center>
                             <div class="col-sm-12 offset-md-2">
                              <div class="mb-3"> 
                            <label class="form-label" for="inputZip">Matricule</label>
                            <input type="text" class="form-control col-sm-8" name="matricule" id="inputZip" placeholder="Entrer le matricule" required="">
                          </div>
                            <div class="mb-3">
                             <label class="form-label" for="inputFirstName">Prénom</label>
                            <input type="text" class="form-control col-sm-8" name="prenom" id="inputFirstName" placeholder="First name" required="">
                            </div>
                            <div class="mb-3">
                            <label for="inputLastName">NOM</label>
                            <input type="text" class="form-control col-sm-8" name="nom" id="inputLastName" placeholder="Last name" required="">
                            </div>
                            <div class="mb-3">
                             <label class="form-label" for="inputState">Genre</label>
                            <select id="inputState" name="genre" class="form-control col-sm-8" required="">
                            <option selected>Choisir....</option>
                            <option>admin</option>
                            <option>personnel</option>
                            </select>
                            <br>
                            <div class="mb-3">
                          <label class="form-label" for="inputState">Entrer le mot de passe</label>
                          <input type="password" class="form-control col-sm-8" name="Password" id="inputPasswordNew" required>
                          <label class="form-label" for="inputState">Confirmer le mot de passe</label>
                          <input type="password" class="form-control col-sm-8" name="mpd" id="inputPasswordNew" required>
                        </div>
                          </div>
                        </div>
                        <center><button  style="background-color:#5353c6;" name="save" type="submit" class="btn btn-secondary">Ajouter</button></center>
                          
                      </form>
                        
                </div>
              </div>
            </div>

</body>
</html>
<?php
}
      catch (PDOException $e) {
        echo  'Echec:'.$e->getmessage();  
      }
?>