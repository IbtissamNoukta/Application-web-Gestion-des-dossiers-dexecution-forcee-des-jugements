<?php session_start(); 
      if (isset($_SESSION['mat'])) {
        
     }else{
          exit("Echec") ;
      }

          $serveur="localhost";
          $login="root";
          $pass="";
          $MAT=$_SESSION['mat'];
          //dossier
          $NUM_DOS__TRIBUNAL = $_POST['NUM_DOS__TRIBUNAL'];
          $NOM_DOS = $_POST['NOM_DOS'];
          $NUM_DOS_NB = $_POST['NUM_DOS_NB'];
          $NUM_DOS_SUJET = $_POST['NUM_DOS_SUJET'];
          $NUM_JUGE = $_POST['NUM_JUGE'];
          $DATE_JUGE = $_POST['DATE_JUGE'];
          $TYPE = $_POST['TYPE'];
          $DATE_NOTIF = $_POST['DATE_NOTIF'];
          $PERIODE_CONTRAINTE = $_POST['PERIODE_CONTRAINTE'];

          //personne
           $CIN = $_POST['CIN'];
           $NOM = $_POST['NOM'];
           $PRENOM = $_POST['PRENOM'];
           $PERE = $_POST['PERE'];
           $MERE = $_POST['MERE'];
           $DATE_NAISSANCE = $_POST['DATE_NAISSANCE'];
           $LIEU_NAISSANCE = $_POST['LIEU_NAISSANCE'];
           $LIEU_RESIDENCE = $_POST['LIEU_RESIDENCE'];
           $CHARGE = $_POST['CHARGE'];

          //dossier-somme-total
           $SOMME_TOTAL = $_POST['SOMME_TOTAL'];


          try{
            $connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //le dossier
            $requete1=$connexion->prepare("
              INSERT INTO dossier (CIN, MATRICULE, NUM_DOS__TRIBUNAL, NOM_DOS, NUM_DOS_SUJET, NUM_DOS_NB, NUM_JUGE, DATE_JUGE, TYPE, DATE_NOTIF, PERIODE_CONTRAINTE, SOMME_TOTAL) VALUES ('$CIN', '$MAT', '$NUM_DOS__TRIBUNAL', '$NOM_DOS', '$NUM_DOS_SUJET', '$NUM_DOS_NB', '$NUM_JUGE', '$DATE_JUGE', '$TYPE', '$DATE_NOTIF', '$PERIODE_CONTRAINTE', $SOMME_TOTAL)");

            $requete1->execute();

            //personne
            $requete2=$connexion->prepare("
              INSERT INTO personne (CIN, NOM, PRENOM, PERE, MERE, DATE_NAISSANCE, LIEU_NAISSANCE, LIEU_RESIDENCE, CHARGE) VALUES ('$CIN', '$NOM', '$PRENOM', '$PERE', '$MERE', '$DATE_NAISSANCE', '$LIEU_NAISSANCE', '$LIEU_RESIDENCE', '$CHARGE')");

            $requete2->execute();
            header("location:AjouteDOS.php?X=1");

          }catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
      ?>