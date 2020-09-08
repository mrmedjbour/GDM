<?php
    include './includes/auth.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil - Gestion Des Dossier Médical</title>
    <meta name="description" content="Gestion Des Dossier Médical">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<body class="bg-gradient-primary" style="background: #fff;">
<div class="d-flex align-items-center" style="width: 100%;min-height: 100vh;background: url(&quot;assets/img/Doctor-and-Nurse-Characters.jpg&quot;) center center / cover no-repeat;box-shadow: inset 1000px 1000px rgba(0,109,208,0.45);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center text-white">
                <h1 class="font-weight-bold" style="text-shadow: 0px 0px;background: rgba(44,77,101,0.37);">Bienvenue sur Gestion des dossier médical G.D.M</h1>
            </div>
            <div class="col">
                <div>
                    <h1 class="text-white" style="font-size: 1.5rem;">Connecter comme:</h1>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-4"><span class="d-block fa-2x text-white">Médecin</span><a class="fa-6x bg-white p-2" href="login.php?type=medecin" style="border-style: solid;border-color: rgb(133,133,133);"><i class="fas fa-user-md text-success"></i></a></div>
                        <div
                            class="col-12 col-sm-6 col-md-4 text-center mb-4"><span class="d-block fa-2x text-white">Assistante</span><a class="fa-6x bg-white p-2" href="login.php?type=assistante" style="border-style: solid;border-color: rgb(133,133,133);"><i class="fas fa-user-nurse text-danger"></i></a></div>
                        <div
                            class="col-12 col-sm-6 col-md-4 text-center mb-4"><span class="d-block text-white fa-2x">Administrateur</span><a class="fa-6x bg-white p-2" href="login.php?type=administrateur" style="border-style: solid;border-color: rgb(133,133,133);"><i class="fas fa-user-tie text-dark"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="assets/js/script.min.js"></script>
</body>

</html>