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

            $date_t = $_POST["dateT"];
            echo $date_t;
            $destination = $_POST["destination"];
            //$day_p=
            $dayofweek = date('w', strtotime($date_t));
            echo $dayofweek;
              switch ($dayofweek) {
                case 1:
                    $day_t="الإثنين";
                    break;
                case 2:
                    $day_t="الثلاثاء";
                    break;
                case 3:
                    $day_t="الأربعاء";
                    break;
                case 4:
                    $day_t="الخميس";
                    break;
                case 5:
                    $day_t="الجمعة";
                    break;
                case 6:
                    $day_t="السبت";
                    break;
                case 0:
                    $day_t="الأحد";
                    break;
            }
            $requete1=$connexion->prepare("
              INSERT INTO prog_transfert_global (DATE_T, DAY_T, DESTINATION) VALUES ('$date_t', '$day_t', '$destination')");
            $requete1->execute();
            header("location:AjouteTransfert.php?T=1");

          }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }

?>