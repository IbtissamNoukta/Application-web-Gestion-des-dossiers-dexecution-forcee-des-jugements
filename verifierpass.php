<meta charset="UTF-8" />
<?php
	$serveur= "localhost";
	$login="root";
	$pass="";
	session_start();
		$_SESSION['mat']=$_POST['mat'];
		$_SESSION['pass']=$_POST['pass'];
		$mat=$_SESSION['mat'];  
		//echo  $mat;
	if($_POST["remember"]=='1' || $_POST["remember"]=='on')
        {
            $hour = time() + 3600 * 24 * 30;
            setcookie('matricule', $_SESSION['mat'], $hour);
            setcookie('password', $_SESSION['pass'], $hour);
        }

			try {
				$connexion = new PDO("mysql:host=$serveur;dbname=dossier",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$r="SELECT PASSWORD, PROFIL from USER Where MATRICULE='$mat'";
               	$r=$connexion->prepare($r);
               	$r->execute();
               	$r=$r->fetchall();
				if (count($r)>0 && password_verify($_SESSION['pass'],$r[0][0]))
				{
					if ($r[0][1]=='admin') {
						header("location:profiladmin.php");
					}else{
						header("location:profiluser.php");
					}
				}else{
					header("location:Index.php?incorrect=1");
				}
			}
		 	catch (PDOException $e) {
				echo  'Echec:'.$e->getmessage();	
			}
				
?>