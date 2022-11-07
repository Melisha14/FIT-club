<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FIT-club</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body><?php
include ('config.php');
$mysqli=new mysqli("$db_host","$db_user","$db_pass","$db_base");

if ($mysqli->connect_errno){
    echo "Echec lors de la connexion à MySQL : (".
    $mysqli->connect_errno.")".$mysqli->connect_error;
}
$mysqli->set_charset("utf8mb4");

?>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>