<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');

Session::getInstance();

$t_manager = new Tournoi_tM_Controller();

$allTournaments = $t_manager->SelectAll();

if (isset($_GET['id'])) {
    $t_manager->DeleteTournament($_GET['id']);
    unset($_GET['id']);
}


$currentDate = time();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/global.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/Header-Blue.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/TableSearchSort.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/Filter.css">
    <link rel="stylesheet" href="/TPI_2021/src/public/assets/css/Footer-Basic.css">
    <link rel="shortcut icon" href="/TPI_2021/src/public/ressources/favicon.ico" type="image/x-icon">
    <title>Home</title>
</head>


<body class="d-flex flex-column min-vh-100">
    <!-- Barre de navigation -->
    <header class=" header-blue">
        <?php require_once('./src/public/views/struct/nav.php'); ?>
    </header>

    <section>
        <?php require_once('./src/public/views/struct/filterResults.php'); ?>
        <?php require_once('./src/public/views/struct/sectionCrudEnCours.php'); ?>
    </section>

    <section>
        <?php require_once('./src/public/views/struct/sectionCrudTermine.php'); ?>
    </section>

    <!-- Footer -->
    <?php require_once('./src/public/views/struct/footer.php'); ?>
    <!-- JS script for Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="/TPI_2021/src/public/assets/js/searchInputFilter.js" type="text/javascript"></script>

</body>

</html>