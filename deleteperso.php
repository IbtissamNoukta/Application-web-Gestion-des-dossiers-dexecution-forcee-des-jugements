<?php session_start(); 
$serveur="localhost";
          $login="root";
          $pass="";
          try{
            $connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      if (isset($_SESSION['mat'])) {
        $mat=$_GET['mat'];
        echo $mat;
          $requete1=$connexion->prepare("
              DELETE FROM user WHERE MATRICULE='$mat'");
          $requete1->execute();
          header('Location:profiladmin.php');

     }else{
          exit("Echec") ;
      }
      
      }catch (PDOException $e) {
        echo  'Echec:'.$e->getmessage();  
      }
?>