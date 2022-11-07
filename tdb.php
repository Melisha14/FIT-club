<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper"><div style="display:none">

<?php 
session_start();
include('config.php');
include('base.php');

$res=$mysqli->query("SELECT * FROM adherent");
$mois=$mysqli->query("SELECT * FROM adherent WHERE MONTH(date_inscription)= 06");
$an=$mysqli->query("SELECT * FROM adherent WHERE YEAR(date_inscription)= 2022");
$abo=$mysqli->query("SELECT * FROM abonnement");

$search=!empty($_GET['search']) ? $_GET['search'] : '';


$un=!empty($search)? " WHERE nom LIKE '%" . $search . "%' ": '';
$query="SELECT * FROM produit ".$un;
$produit=$mysqli->query($query);

$deux=!empty($search)? " WHERE nom LIKE '%" . $search . "%' OR prenom LIKE '%" . $search . "%' ": '';
$query="SELECT * FROM adherent ".$deux;
$adherent=$mysqli->query($query);


$trois=!empty($search)? " WHERE nom LIKE '%" . $search . "%' OR prenom LIKE '%" . $search . "%' ": '';
$query="SELECT * FROM utilisateur ".$trois;
$utilisateur=$mysqli->query($query);

 ?>
</div>
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="width: 250px ;">
            <div class="container-fluid d-flex flex-column p-0"><img style="width: 220px;height: 230px;" src="assets/img/logo.png">
                <ul class="navbar-nav text-light" id="accordionSidebar" style="margin-top: 27px;">
                    <li class="nav-item"><a class="nav-link" href="tdb.php" style="padding-left: 30px ;"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="liste_utilisateurs.php" style="margin-top: 5px;padding-left: 30px ;"><i class="fas fa-table"></i><span>Liste utilisateurs</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="liste_adhérents.php" style="margin-top: 5px;padding-left: 30px ;"><i class="fas fa-table"></i><span>Liste adhérents</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="liste_produits.php" style="margin-top: 5px;padding-left: 30px ;"><i class="fas fa-table"></i><span>Liste produits</span></a></li>
                </ul>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="height: 50px ;">
                    <div class="container-fluid">
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php
echo $_SESSION['user_nom'].' '.$_SESSION['user_prenom'];
?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar<?php  echo $_SESSION['user_id'] ; ?>.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="utilisateur.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a><a class="dropdown-item" href="connexion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav><form action= "tdb.php" method="GET" class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
<div class="input-group"><input name="search" class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button></div>
</form></br></br>

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Tableau de bord</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2" style="height: 99px;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters" style="height: 68.7969px;">
                                        <div class="col me-2" style="height: 68.7969px;">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Nombre d'adhérents</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><?php 
  echo ''.$res->num_rows.' adhérents';
?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Nombre d'abonnements ce mois</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><?php
echo ''.$mois->num_rows.' inscris ce mois';
?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Nombre d'adherents cette année</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><?php
echo ''.$an->num_rows.' inscris cette année';
?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Nombre de renouvellement</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><?php
echo ''.$abo->num_rows.' renouvellement';
?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-euro-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card text-white bg-info shadow">
            <div class="card-body">
                <p class="m-0"><strong>PRODUITS</strong></p></br>
                <p class="text-white-50 small m-0">
<?php                                     
while($row = $produit->fetch_assoc()){?>
<ul style="list-style-type: none">
  <li><a href="produit.php?id=<?=$row['id']?>" style= "text-decoration: none"><?=$row['nom']?></a></li>
</ul>
<?php }
?>
 </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <p class="m-0"><strong>ADHERENTS</strong></p></br>
                <p class="text-white-50 small m-0"><?php                                     
while($row = $adherent->fetch_assoc()){?>
<ul style="list-style-type: none">
    <li><a href="adhérent.php?id=<?=$row['id']?>" style= "text-decoration: none"><?=$row['nom']?>&nbsp&nbsp<?=$row['prenom']?></a></li>
</ul>
<?php }
?>
</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <p class="m-0"><strong>UTILISATEURS</strong></p></br>
                <p class="text-white-50 small m-0">
<?php                                     
while($row = $utilisateur->fetch_assoc()){?>
<ul style="list-style-type: none">
    <li><a href="utilisateur.php?id=<?=$row['id']?>" style= "text-decoration: none"><?=$row['nom']?>&nbsp&nbsp<?=$row['prenom']?></a></li>
</ul>
<?php }
?></p>
            </div>
        </div>
    </div>
    
</div>              
                    
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © FIT-club 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>