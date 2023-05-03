<meta charset="UTF-8" />
<?php
session_start(); 
if (isset($_SESSION['mat'])) {
        
     }else{
          exit("Echec");
      }
    $SOUS_CAT=$_GET['SOUS_CAT'];
    if ($SOUS_CAT=="تنفيذ كلي") {
    	$idsouscat=4;
    }else{
      $idsouscat=3;
    }
    
    $id=$_SESSION['id'];
    
      $serveur="localhost";
          $login="root";
          $pass="";
          try{
            $connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if (isset($_POST['sommep'])) {
              $somme=$_POST['sommep'];
            }else{
            $requete1=$connexion->prepare("
                SELECT SOMME_TOTAL FROM dossier WHERE ID_DOS=$id");
            $requete1->execute();
            $requete1=$requete1->fetchall();
            $somme=$requete1[0][0];
            }

            $requete3=$connexion->prepare("
                SELECT ID_PAIEMENT FROM paiement");
            $requete3->execute();
            $requete3=$requete3->fetchall(); 
            for ($i=0; $i <count($requete3) ; $i++) { 
              if ($requete3[$i][0]==$_POST['idpaiement']) {
                header("location:paiement.php?error=2&SOUS_CAT=$SOUS_CAT");
              }
            }

            if (isset($somme)&&isset($_POST['idpaiement'])&&isset($_POST['idpaiement'])&&($_POST['idpaiement']!="")) {
              $id_paiement=$_POST['idpaiement'];
              $date_p=$_POST['dateP'];
            
            //add paiement total
            $requete2=$connexion->prepare("
              INSERT INTO paiement (ID_PAIEMENT, ID_SOUSCAT, ID_DOS, DATE_P, SOMME) VALUES ('$id_paiement', $idsouscat, $id, '$date_p', $somme)");
            $requete2->execute();
              header("location:paiement.php?SOUS_CAT=$SOUS_CAT");
            }else{
              header("location:paiement.php?error=1&SOUS_CAT=$SOUS_CAT");
            }

      }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }

?>