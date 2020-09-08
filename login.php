<?php
    include './includes/auth.php';

    if (isLoggedIn()) {
        header('location: dashboard.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Gestion Des Dossier Médical</title>
    <meta name="description" content="Gestion Des Dossier Médical">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image bg-login-page" style=""></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">D-Lab C.R.D</h4>
                                    <?php echo display_error(); ?>
                                </div>
                                <form class="user" action="login.php" method="POST">
                                    <div class="form-group">
                                        <select class="form-control form-control-lg form-login-select-user" name="loginType">
                                            <?php
                                            if (isset($_GET['type']) && ($_GET['type'] == "medecin" OR $_GET['type'] == "administrateur" OR $_GET['type'] == "assistante")){
                                                $typeLogin = $_GET['type'];
                                            }else{
                                                $typeLogin = 0;
                                            }

                                            ?>
                                            <option value="medecin" <?php if ($typeLogin == "medecin"){ echo "selected"; } ?>>Médecin</option>
                                            <option value="assistante" <?php if ($typeLogin == "assistante"){ echo "selected"; } ?>>Assistante</option>
                                            <option value="administrateur" <?php if ($typeLogin == "administrateur"){ echo "selected"; } ?>>Administrateur</option>
                                        </select>
                                    </div>
                                    <div class="form-group"><input class="form-control form-control-user" type="text" placeholder="Nom d'utilisateur" name="username" required></div>
                                    <div class="form-group"><input class="form-control form-control-user" type="password" placeholder="Mote de pass" name="password" required></div>
                                    <button class="btn btn-primary btn-block text-white btn-user" type="submit" name="login_submit">Login</button>
                                </form>
                            </div>
                        </div>
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