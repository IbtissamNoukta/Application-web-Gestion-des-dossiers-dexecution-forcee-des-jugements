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

            $date_p = $_POST["dateP"];
            echo $date_p;
            $destination = $_POST["destination"];
            //$day_p=
            $dayofweek = date('w', strtotime($date_p));
            echo $dayofweek;
              switch ($dayofweek) {
                case 1:
                    $day_p="الإثنين";
                    break;
                case 2:
                    $day_p="الثلاثاء";
                    break;
                case 3:
                    $day_p="الأربعاء";
                    break;
                case 4:
                    $day_p="الخميس";
                    break;
                case 5:
                    $day_p="الجمعة";
                    break;
                case 6:
                    $day_p="السبت";
                    break;
                case 0:
                    $day_p="الأحد";
                    break;
            }
            $requete1=$connexion->prepare("
              INSERT INTO programme__transfert (ID_DOS, DATE_P, DAY_P, DESTINATION) VALUES ($id, '$date_p', '$day_p', '$destination')");
            $requete1->execute();
            header("location:transfert_dossier.php?id=$id");

          }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }

?>