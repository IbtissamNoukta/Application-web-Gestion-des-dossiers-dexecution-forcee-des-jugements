  <?php session_start(); 
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
            $id=$_SESSION['id'];

    if (isset($_POST['inlineCheckbox1'])) {
      $type="رقم لوحة السيارة";
      $requete1=$connexion->prepare("
              INSERT INTO demande_information (ID_DOS, TYPE_D) VALUES ($id, '$type')");
      $requete1->execute();

    }
    if (isset($_POST['inlineCheckbox2'])) {
      $type="رقم الحساب البنكي";
      $requete1=$connexion->prepare("
              INSERT INTO demande_information (ID_DOS, TYPE_D) VALUES ($id, '$type')");
      $requete1->execute();

    }
    if (isset($_POST['inlineCheckbox3'])) {
      $type="العقارات المحفظة";
      $requete1=$connexion->prepare("
              INSERT INTO demande_information (ID_DOS, TYPE_D) VALUES ($id, '$type')");
      $requete1->execute();

    }
    header("location:demande_info_dossier.php");

    }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
  ?>