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

<body><nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
<ul class="pagination">
 <li class="page-item <?=$pg==1?'disabled':''?>"><a class="page-link" aria-label="Previous" href="?pg=<?=$pg-1?>"><span aria-hidden="true">«</span></a></li>
<?php
for ($i=0; $i < $nb_page ; $i++) { ?>
<li class="page-item <?=$i==$pg-1?'active':''?>"><a class="page-link" href="?pg=<?=$i+1?>"><?=$i+1?></a></li> <?php  }
?>
<li class="page-item <?=$pg==$nb_page?'disabled':''?>"><a class="page-link" aria-label="Next" href="?pg=<?=$pg+1?>"><span aria-hidden="true">»</span></a></li>
</ul>
</nav>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>