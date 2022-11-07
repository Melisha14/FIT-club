<?php
@session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>FIT-club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel= "shortcut icon" href="images/favicon.png">
</head>

<body>

<header>
    <ul>
	<nav>
        	<div>
                <a href="tdb.php"><img src="images/logo.png"width="200", height="200"/></a>
            </div>
            <div>
                <a href="tdb.php">Dashboard</a>
                <a href="liste_utilisateurs.php">Liste utilisateurs</a>
                <a href="liste_adherents.php">Liste adhérents</a>
                <a href="liste_produits.php">Liste produits</a>
            </div>

            <?php 
            if(empty($_SESSION['user_id'])){
			
			echo '<a href="connexion.php">Connexion</a>';
			}
			else{
				echo '<a href="utilisateur.php"> '.$_SESSION['user_nom'].' '.$_SESSION['user_prenom'].'</a>';	
			}
			?>
	
	</nav>	

    </ul>
		
</header>