<?php
    define('PAGETITLE', 'Dashboard');
    include './includes/head.php';
$today_date = date();
$stmt = $db->prepare("SELECT id_rdv,nom_patient,prenom_patient,profil_nom,profil_prenom,date_rdv,id_dm 
                                FROM rdv
                                INNER JOIN patient ON patient.id_patient = rdv.id_patient
                                INNER JOIN users ON rdv.id_medecin = users.id
                                WHERE archivier_rdv = 0 AND date_rdv > '$today_date'
                                ORDER BY rdv.date_rdv DESC");
$stmt->execute();
$rdvs = $stmt->get_result();


?>
            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3>
                </div>
                <div class="row">
                    <?php if(isAs()){ ?>
                    <div class="col-lg-6 mb-4">
                        <a class="text-decoration-none" href="rdv-add.php">
                            <div class="card text-white bg-primary shadow">
                                <div class="card-body">
                                    <p class="d-flex justify-content-center align-items-center m-0 font-weight-bold">Ajouter Rendez-vous<i class="fa fa-bookmark-o ml-2 fa-2x"></i></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if(isAdmin()){ ?>
                    <div class="col-lg-6 mb-4">
                        <a class="text-decoration-none" href="medecin-add.php">
                            <div class="card text-white bg-success shadow">
                                <div class="card-body">
                                    <p class="d-flex justify-content-center align-items-center m-0 font-weight-bold">Ajouter Médecin<i class="fa fa-user-md ml-2 fa-2x"></i></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <a class="text-decoration-none" href="secritaire-add.php">
                            <div class="card text-white bg-danger shadow">
                                <div class="card-body">
                                    <p class="d-flex justify-content-center align-items-center m-0 font-weight-bold">Ajouter Secrétaire<i class="fas fa-user-nurse ml-2 fa-2x"></i></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if(isDr()){ ?>
                        <div class="col-lg-6 mb-4">
                            <a class="text-decoration-none" href="dm-add.php">
                                <div class="card text-white bg-warning shadow">
                                    <div class="card-body">
                                        <p class="d-flex justify-content-center align-items-center m-0 font-weight-bold">Ajouter Un Dossier Médical<i class="fa fa-user-md ml-2 fa-2x"></i></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <?php if(isDr() OR isAs()){ ?>
                <div class="row">
                    <div class="col mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Les Rendez-vous récents</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                            <?php while ($rdv = mysqli_fetch_array($rdvs)) : ?>
                                <li class="list-group-item">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <h6 class="mb-0"><strong><?php echo $rdv['prenom_patient'].' '.$rdv['nom_patient']; ?></strong></h6><span class="text-danger"><?php echo date_format(date_create($rdv['date_rdv']),"Y/m/d H:i");?></span></div>
                                    </div>
                                </li>
                            <?php endwhile ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
<?php include './includes/footer.php'; ?>