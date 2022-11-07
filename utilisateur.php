<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top"><div style="display:none">
    
<?php

include ('config.php');
include ('base.php');
session_start();

if(!empty($_SESSION['user_id'])){
    if(!empty($_POST)){
        // post
        $id =$_POST['id'];
        $nom  =$_POST['nom'];
        $prenom =$_POST['prenom'];
        $email =$_POST['email'];
        $telephone =$_POST['telephone'];

        if (!empty($_FILES['photo']['name'])) {

            $tmp_name = $_FILES["photo"]["tmp_name"];
            echo  $tmp_name;
            $photofile="C:/laragon/www/FIT-club/assets/img/avatars/avatar".$id.".png";
            echo $photofile;
            move_uploaded_file($tmp_name, $photofile);
            echo "Image sauvegardée".$_FILES['photo']['name'];
        }
  

        if($id>0){
            $query="UPDATE utilisateur SET nom = '" . $nom . "', prenom = '" . $prenom .   "', email = '" . $email . "', telephone = '" . $telephone . "'
            WHERE id=".$id;
        }
        else{
            $query="INSERT INTO utilisateur(nom, prenom, email, mot_de_passe, telephone) VALUES('". $nom ."', '". $prenom."', '". $email ."', '', '" . $telephone ."')";
        }  
                                                                      
        $mysqli->query($query);
    }
    else{
        // get
        $id=!empty($_GET['id']) ? $_GET['id'] : 0;
        $nom  ='';
        $prenom ='';
        $email ='';
        $telephone ='';

        if($id>0){
            $query="SELECT * FROM utilisateur WHERE id=" . $id;
            $res=$mysqli->query($query);
            if($res->num_rows>0){
                $row=$res->fetch_assoc();
                $nom  =$row['nom'];
                $prenom =$row['prenom'];
                $email =$row['email'];
                $telephone =$row['telephone'];
            }
            else {
                $id=0;
            }

        }
    }
}
else{
    header('Location: connexion.php');
}
?>

</div>
    <div id="wrapper" style="height: 750px;">
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
                <div class="container-fluid" style="height: 400px;">
                    <h3 class="text-dark mb-4">Utilisateur</h3><form method="POST" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="<?=$id?>" />
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/avatars/avatar<?=$id?>.jpeg" width="160" height="160" id="photo">
                                        <div class="mb-3">
                                        <span class="btnbtn-primary btn-file">
                                        <strong>Changer photo</strong> <input name="photo" type="file" onchange="previewPicture(this)" />
                                    </span></div></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card textwhite bg-primary text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card textwhite bg-success text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Mofification de l'utilisateur</p>
                                        </div>
                                        <div class="card-body"> <form method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="nom"><strong>Nom</strong><br></label><input class="form-control" type="text" id="nom" placeholder="DOE" name="nom" value="<?=$nom?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="prenom"><strong>Prenom</strong></label><input class="form-control" type="text" id="prenom" placeholder="John" name="prenom" value="<?=$prenom?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email</strong></label><input class="form-control" type="email" id="email" placeholder="fzhfzi@gmail.com" name="email" value="<?=$email?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="telephone"><strong>Téléphone</strong></label><input class="form-control" type="text" id="telephone" placeholder="00000000" name="telephone" value="<?=$telephone?>"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><button class="btn btn-primary" type="submit" style="margin-top: 8px;margin-left: 30px;">Valider</button>
                    </form>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © FIT-club 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div><script type="text/javascript" >
    // L'image img#image
    var image = document.getElementById("photo");
     
    // La fonction previewPicture
    var previewPicture  = function (e) {

        // e.files contient un objet FileList
        const [picture] = e.files

        // "picture" est un objet File
        if (picture) {
            // On change l'URL de l'image
            image.src = URL.createObjectURL(picture)
        }
    } 
</script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>