<meta charset="UTF-8" />
<?php
session_start(); 
if (isset($_SESSION['mat'])) {
        
     }else{
          exit("Echec");
      }
      $serveur="localhost";
          $login="root";
          $pass="";
          try{
            $connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id=$_GET['id'];
            //$matricule=$_SESSION['mat'];
            $idcat = $_GET["idcat"];
            $datecat = $_POST["datec"];
            $requete4=$connexion->prepare("
                      SELECT ID_CAT FROM correspondant WHERE ID_DOS=$id ORDER BY ID_CAT DESC");
              $requete4->execute();
              $requete4=$requete4->fetchall();
              if (($requete4[0][0]+1)==$idcat || (!isset($requete4[0][0])&& $idcat==1)) {


            if (isset($_POST["souscat"])) {
              $souscat = $_POST["souscat"];
              $requete2=$connexion->prepare("
                      SELECT ID_SOUSCAT FROM sous_categorie WHERE NOM_SOUSCAT='$souscat'");
              $requete2->execute();
              $requete2=$requete2->fetchall();
              $idsouscat=$requete2[0][0];
              $requete1=$connexion->prepare("
              INSERT INTO correspondant (ID_DOS, ID_CAT, ID_SOUSCAT,  DATE_CAT) VALUES ($id, $idcat, $idsouscat, '$datecat')");
            $requete1->execute();
            }else{
                $requete1=$connexion->prepare("
              INSERT INTO correspondant (ID_DOS, ID_CAT, ID_SOUSCAT,  DATE_CAT) VALUES ($id, $idcat,0 , '$datecat')");
            $requete1->execute();
            }
            header("location:cat_dossier.php?id=$id");
          }else{
            header("location:cat_dossier.php?id=$id&idcat=$idcat");
          }
           
          
          }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }

?>
          