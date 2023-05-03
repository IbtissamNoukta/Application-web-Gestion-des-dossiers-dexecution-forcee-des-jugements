<?php session_start(); 
if (isset($_SESSION['mat'])) {
  }else{
          exit("Echec") ;
      }
      if (isset($_GET['mat'])) {
      $mat_user=$_GET['mat'];
    }
$serveur="localhost";
          $login="root";
          $pass="";
          try{
            $connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
  //echo $_SESSION ['toph'];
  }
if(isset($_POST['matricule'])&&($_POST['matricule']!="")){
$Matricule=$_POST['matricule'];
$requete2=$connexion->prepare("
              UPDATE user SET MATRICULE= '$Matricule' WHERE MATRICULE= '$mat_user'");
    $requete2->execute();
    $mat_user=$Matricule;
    //header("location:modifperso.php?error=1&mat=".$mat_user."");
}

if(isset($_POST['prenom'])&&($_POST['prenom']!="")){
 
$prenom=$_POST['prenom'];
$requete2=$connexion->prepare("
              UPDATE user SET PRENOM= '$prenom' WHERE MATRICULE='$mat_user'");
    $requete2->execute();
    //header("location:modifperso.php?error=1&mat=".$mat_user."");
}

if(isset($_POST['nom'])&&($_POST['nom']!="")){
$nom=$_POST['nom'];
$requete2=$connexion->prepare("
              UPDATE user SET NOM= '$nom' WHERE MATRICULE='$mat_user'");
    $requete2->execute();
    //header("location:modifperso.php?error=1&mat=".$mat_user."");
    }

if(isset($_POST['genre'])&&($_POST['genre']!="")){
$Genre=$_POST['genre'];
$r=$connexion->prepare("
  SELECT PROFIL FROM user WHERE MATRICULE='$mat_user'");
  $r->execute();
  $r=$r->fetchall();
  if($r[0][0]!=$Genre){
    $requete2=$connexion->prepare("
              UPDATE user SET PROFIL= '$Genre' WHERE MATRICULE='$mat_user'");
    $requete2->execute();
    $G=1;//pour global condition
  }
    //header("location:modifperso.php?error=1&mat=".$mat_user."");
    }

if(isset($file_dest)&&($file_dest!="image_user/")){
$requete2=$connexion->prepare("
              UPDATE user SET IMAGE='$file_dest' WHERE MATRICULE='$mat_user'");
    $requete2->execute();
    //header("location:modifperso.php?error=1&mat=".$mat_user."");
    }

if(isset($_POST['Password'])&& isset($_POST['mpd'])&&($_POST['Password']!="")&&($_POST['mpd']!="")){
$mdp1=$_POST['Password'];
$mdp2=$_POST['mpd'];
if($mdp1==$mdp2){
  $pass=password_hash($mdp1, PASSWORD_DEFAULT);//chifrer le mot de pass
    $requete2=$connexion->prepare("
              UPDATE user SET PASSWORD= '$pass' WHERE MATRICULE='$mat_user'");
    $requete2->execute();
    //header("location:modifperso.php?error=1&mat=".$mat_user."");
  }
    }
    if (((isset($_POST['Password'])&&($_POST['Password']!=""))&&(isset($_POST['mpd'])&&($_POST['mpd']!="")))||(isset($file_dest)&&($file_dest!="image_user/"))|| isset($G)||(isset($_POST['nom'])&&($_POST['nom']!=""))||(isset($_POST['prenom'])&&($_POST['prenom']!=""))||(isset($_POST['matricule'])&&($_POST['matricule']!=""))) {
      header("location:modifperso.php?error=1&mat=".$mat_user."");
    }elseif(!isset($_POST['Password'])|| !isset($_POST['mpd']) || ($_POST['Password']!=$_POST['mpd']) ){
      header("location:modifperso.php?error=2&mat=".$mat_user."");
    }else{
      header("location:modifperso.php?error=3&mat=".$mat_user."");
    }
    
} catch (PDOException $e) {
        echo  'Echec:'.$e->getmessage();  
      }

?>