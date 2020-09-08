<?php
include 'auth.php';

if (!isLoggedIn()) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo PAGETITLE; ?> - Gestion Des Dossier Médical</title>
    <meta name="description" content="Gestion Des Dossier Médical">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fa fa-stethoscope"></i></div>
                <div class="sidebar-brand-text mx-3"><span>G.D.M</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation"><a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>

                <?php if(isAdmin()){ ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="medecin.php"><i class="fas fa-user-md"></i><span><strong>Médecin</strong><br></span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="secritaire.php"><i class="fas fa-user-nurse"></i><span><strong>Secrétaire</strong><br></span></a></li>
                <?php } ?>
                <?php if(isDr()){ ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="rdv.php"><i class="far fa-bookmark"></i><span><strong>Rendez-vous</strong></span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="dm.php"><i class="fas fa-file-medical-alt"></i><span><strong>Dossier médical</strong></span></a></li>
                <?php } ?>
                <?php if(isAs()){ ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="rdv.php"><i class="far fa-bookmark"></i><span><strong>Rendez-vous</strong></span></a></li>
                <?php } ?>


                <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php"><i class="far fa-user-circle"></i><span>Logout</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1" role="presentation"></li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $_SESSION['user']['profil_prenom'] .' '. $_SESSION['user']['profil_nom']; ?></span><img class="border rounded-circle img-profile" src="assets/img/doctor.png"></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="logout.php">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>