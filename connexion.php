<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body class="bg-gradient-primary"><?php
include ('config.php');
include ('base.php');
$mysqli=new mysqli("$db_host","$db_user","$db_pass","$db_base");

if ($mysqli->connect_errno){
    echo "Echec lors de la connexion à MySQL : (".
    $mysqli->connect_errno.")".$mysqli->connect_error;
}
$mysqli->set_charset("utf8mb4");

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $req="SELECT * FROM utilisateur WHERE email='".
    $_POST['email']."' AND mot_de_passe=MD5('".
    $_POST['password'].$SEL_MDP."')";

 
    $res=$mysqli->query($req);
    if($res->num_rows>0){
    
    $row=$res->fetch_assoc();

    session_start();

    $_SESSION['user_nom']=$row['nom'];
    $_SESSION['user_prenom']=$row['prenom'];
    $_SESSION['user_id']=$row['id'];
    
    header('Location: tdb.php');
}
    else{
    $message_erreur='Authentification incorrecte';
    
    }
}

?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(&quot;assets/img/road-gea7e98bbd_1280.jpg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4"><br><span style="color: rgba(var(--bs-dark-rgb), var(--bs-text-opacity)) ; background-color: rgb(248, 249, 252);">&nbsp;Page de connexion</span><br><br></h4>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Login</button>
                                        <hr><a class="small" href="forget_mdp.php">Forgot Password?</a>
                                    </form><label class="form-label" style="width: 156px;height: 42px;"><br></label>
                                    <div class="text-center"><span class="text-danger">
<?php

if(!empty($message_erreur)){
    echo $message_erreur;
} 
?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>