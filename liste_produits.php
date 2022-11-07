<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper"><div style="display:none">
    
    <?php


include ('config.php');
include ('base.php');

session_start();

    if(!empty($_GET['action'])&&($_GET['action']=='delete')){
        if(!empty($_GET['id'])&&($_GET['id']>0)){
            $mysqli->query("DELETE FROM produit WHERE id=".$_GET['id']);
        }

    }
    $sort=!empty($_GET['sort']) ? $_GET['sort'] : "id";

    $dir=!empty($_GET['dir']) ? $_GET['dir'] : "ASC";

    $pg=!empty($_GET['pg']) ? $_GET['pg'] : 1;
    
    $nb=!empty($_GET['nb']) ? $_GET['nb'] : 10;

    $search=!empty($_GET['search']) ? $_GET['search'] : '';
        
    $result=$mysqli->query("SELECT count(*) as cnt FROM produit")->fetch_assoc();
    $count = $result['cnt'];
    
    $x=$nb*$pg;
    if($x>$count)
    {$pg=floor($count/$nb)+1;}
    
    $first=($pg-1)*$nb+1;
    $last=$first+$nb-1;
    if ($last>$count) {
        $last=$count;
    }
    
    $nb_page=floor($count/$nb)+1;
    $offset=$nb*($pg-1);
   
    $where=!empty($search)? " WHERE nom LIKE '%" . $search . "%' ": '';

    $query="SELECT * FROM produit ".$where." ORDER BY ".$sort." ".$dir." LIMIT ".$nb ." OFFSET ".$offset;
    $adherents=$mysqli->query($query);
    
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
                </nav>
                <div style="height: 50px;margin-bottom: 20px ;"> <form action= "liste_produits.php" method="GET" class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input name="search" class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button></div>
                        </form></div>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Listes produits</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Produits Info</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap" style="width: 455.5px;"><div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;
<select class="d-inline-block form-select form-select-sm">
 <option value="10" <?=$nb==10?'selected':''?>>10</option>
<option value="25" <?=$nb==25?'selected':''?>>25</option>
 <option value="50" <?=$nb==50?'selected':''?>>50</option>
<option value="100" <?=$nb==100?'selected':''?>>100</option>
</select>&nbsp;</label>
</div></div>
                                <div class="col-md-6" style="width: 455.5px;"><div class="col-md-6" style="width: 455.5px;">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><a class="btn btn-primary" role="button" href="produit.php?id=0" style="border-radius: 17px;">Ajouter</a></td></div>
                                </div></div>
                            </div><div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
    <table id="dataTable" class="table my-0">
        <thead>
            <tr>
                <th style="width: 10px;">Image</th>
                <th style="width: 10px;"><a href="liste_produits.php?sort=nom&nb=<?=$nb?>&pg=<?=$pg?>&dir=<?=$dir=='ASC'?'DESC':'ASC'?>">Nom</a><?=$sort=='nom'?$dir=='ASC'?'<i class="fas fa-sort-alpha-down"></i>':'<i class="fas fa-sort-alpha-down-alt"></i>':''?></th>
                <th style="width: 10px;"><a href="liste_produits.php?sort=duree&nb=<?=$nb?>&pg=<?=$pg?>&dir=<?=$dir=='ASC'?'DESC':'ASC'?>">Durée</a><?=$sort=='duree'?$dir=='ASC'?'<i class="fas fa-sort-alpha-down"></i>':'<i class="fas fa-sort-alpha-down-alt"></i>':''?></th>
                <th style="width: 10px;"><a href="liste_produits.php?sort=description&nb=<?=$nb?>&pg=<?=$pg?>&dir=<?=$dir=='ASC'?'DESC':'ASC'?>">Description</a><?=$sort=='description'?$dir=='ASC'?'<i class="fas fa-sort-alpha-down"></i>':'<i class="fas fa-sort-alpha-down-alt"></i>':''?></th>
                <th style="width: 10px;"><a href="liste_produits.php?sort=price&nb=<?=$nb?>&pg=<?=$pg?>&dir=<?=$dir=='ASC'?'DESC':'ASC'?>">Prix</a><?=$sort=='price'?$dir=='ASC'?'<i class="fas fa-sort-alpha-down"></i>':'<i class="fas fa-sort-alpha-down-alt"></i>':''?></th>
                <th style="width: 10px;">Modifier</th>
            </tr>
        </thead>
        <tbody>
<?php                                     
while($row = $adherents->fetch_assoc()){?>
<tr>
 <td><img class="rounded-circle me-2" width="100" height="80" src="assets/img/produits/produit<?=$row['id']?>.png">&nbsp;
 <td><?=$row['nom']?></td>
 <td><?=$row['duree']?></td>
 <td><?=$row['description']?></td>
 <td><?=$row['price']?></td>
<td><a class="btn btn-primary" role="button" href="produit.php?id=<?=$row['id']?>" style="border-radius: 17px;">Modifier</a>&nbsp&nbsp&nbsp&nbsp
 
<SCRIPT LANGUAGE="JavaScript">
function confirmation() {
var msg = "Êtes-vous sur de vouloir supprimer cet produit ?";
if (confirm(msg))
location.replace(tonscript.php);
}
</SCRIPT>

<a class="btn btn-primary" role="button" onClick="confirmation();" href="liste_produits.php?action=delete&id=<?=$row['id']?>&nb=<?=$nb?>&pg=<?=$pg?>" 
style="border-radius: 17px;">Supprimer</a></td>
</tr>
<?php }
?>
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Image</strong></td>
                <td><strong>Nom</strong></td>
                <td><strong>Durée</strong></td>
                <td><strong>Description</strong></td>
                <td><strong>Prix</strong></td>
                <td><strong>Modifier</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">  <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing <?=$first?> to <?=$last?> of <?=$count?></p></div>
                                <div class="col-md-6"><?php
include("liste_footer.php")
?></div>
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