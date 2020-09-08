<?php
define('PAGETITLE', 'List des Rendez-vous');
include './includes/head.php';


if (isset($_GET['action']) && isset($_GET['id'])){

    $r = $db->prepare("SELECT id_rdv FROM rdv WHERE id_rdv=?");
    $r->bind_param("i", $_GET['id']);
    $r->execute();

    if ($r->get_result()->num_rows){
        if ($_GET['action'] == "annuler"){
            $sup = $db->prepare("DELETE FROM rdv WHERE id_rdv = ?");
            $sup->bind_param("i", $_GET['id']);
            $sup->execute();
        }elseif ($_GET['action'] == "archiver"){
            $arch = $db->prepare("UPDATE rdv SET archivier_rdv = 1 WHERE id_rdv = ?");
            $arch->bind_param("i", $_GET['id']);
            $arch->execute();
        }elseif ($_GET['action'] == "affecter"){
            // affecter
            $id_patient = e($_GET['id']);
            $id_medecin = $_SESSION['user']['id'];
            echo $date_visite;
            $aff = $db->prepare("INSERT INTO `visite` (`id_patient`, `id_medecin`) 
                                                        VALUES ( ?, ?)");
            $aff->bind_param("ss", $id_patient,$id_medecin);
            $aff->execute();
        }
    }
}


if(isset($_GET['action']) && $_GET['action'] == "archive"){
    $stmt = $db->prepare("SELECT id_rdv,nom_patient,prenom_patient,profil_nom,profil_prenom,date_rdv,id_dm 
                                FROM rdv
                                INNER JOIN patient ON patient.id_patient = rdv.id_patient
                                INNER JOIN users ON rdv.id_medecin = users.id
                                WHERE archivier_rdv = 1
                                ORDER BY rdv.date_rdv DESC");
    $stmt->execute();
    $rdvs = $stmt->get_result();
}else{
    $stmt = $db->prepare("SELECT id_rdv,nom_patient,prenom_patient,profil_nom,profil_prenom,date_rdv,id_dm 
                                FROM rdv
                                INNER JOIN patient ON patient.id_patient = rdv.id_patient
                                INNER JOIN users ON rdv.id_medecin = users.id
                                WHERE archivier_rdv = 0
                                ORDER BY rdv.date_rdv DESC");
    $stmt->execute();
    $rdvs = $stmt->get_result();
}

if (isset($_GET['action']) && $_GET['action'] == "search" && isset($_GET['q'])){
    $q = $_GET['q'];
    //                    search
$stmt = $db->prepare("SELECT id_rdv,nom_patient,prenom_patient,profil_nom,profil_prenom,date_rdv,id_dm 
                                FROM rdv
                                INNER JOIN patient ON patient.id_patient = rdv.id_patient
                                INNER JOIN users ON rdv.id_medecin = users.id
                                WHERE nom_patient LIKE '%?%' OR prenom_patient LIKE '%?%' OR id_rdv LIKE '%?%' OR date_rdv LIKE '%?%' OR id_dm LIKE '%?%'
                                ORDER BY rdv.date_rdv DESC");
$stmt->bind_param("ssisi", $q,$q,$q,$q,$q);
$stmt->execute();
$rdvs = $stmt->get_result();
}

?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Rendez-vous</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Liste des rendez-vous</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div aria-controls="dataTable">
                                    <?php if (!isDr()){ ?>
                                        <a class="btn btn-success mb-1" role="button" href="rdv-add.php"><i class="fa fa-plus mr-1"></i>Rendez-vous</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter-1">
                                    <form action="rdv.php">
                                        <input type="hidden" name="action" value="search">
                                        <label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" name="q" placeholder="Search"></label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive-lg table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-striped table-bordered my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Rendez-vous</th>
                                    <th>Nom/Prénom</th>
                                    <th>Médecin</th>
                                    <th>Date/Heure</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($rdv = mysqli_fetch_array($rdvs)) : ?>
                                    <tr>
                                        <td width="10%"><?php echo $rdv['id_rdv']; ?></td>
                                        <td><strong><?php echo $rdv['prenom_patient'].' '.$rdv['nom_patient']; ?></strong></td>
                                        <td><?php echo $rdv['profil_prenom'].' '.$rdv['profil_nom']; ?></td>
                                        <?php
                                        $stmt = $db->prepare("SELECT * 
                                                                    FROM visite 
                                                                    WHERE id_patient = ?");
                                        $stmt->bind_param("s", $rdv['id_rdv']);
                                        $stmt->execute();
                                        $rdv_visit_count = $stmt->get_result()->num_rows;

                                        ?>
                                        <td class="text-success">
                                            <strong><?php echo date_format(date_create($rdv['date_rdv']),"Y/m/d H:i");?></strong>
                                            <br><span class="text-danger"><?php if ($rdv_visit_count){ echo "rendez-vous terminé"; } ?></span>
                                        </td>
                                        <td>
                                            <?php if(isDr()){ ?>
                                            <a class="btn btn-warning" role="button" href="dm-edit.php?id=<?php echo $rdv['id_dm'];?>" target="_blank"><i class="fa fa-file-text-o"></i></a>
                                            <?php   } ?>
                                            <?php if(isDr() && !$rdv_visit_count){ ?>
                                            <a class="btn btn-success" role="button" href="rdv.php?action=affecter&id=<?php echo $rdv['id_rdv'];?>"><i class="fa fa-check"></i></a>
                                            <?php   } ?>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-info m-1" data-toggle="dropdown" aria-expanded="false" type="button">&nbsp;<i class="fa fa-pencil"></i></button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item text-success" role="presentation" href="rdv-edit.php?id=<?php echo $rdv['id_rdv'];?>"><i class="fa fa-edit mr-1"></i><em>Modifier</em>&nbsp;</a>
                                                    <a class="dropdown-item text-gray-600" role="presentation" href="rdv.php?action=archiver&id=<?php echo $rdv['id_rdv'];?>"><i class="fa fa-archive mr-1"></i><em>Archiver</em>&nbsp;</a>
                                                    <a class="dropdown-item text-danger" role="presentation" href="rdv.php?action=annuler&id=<?php echo $rdv['id_rdv'];?>"><i class="fa fa-remove mr-1"></i>Annuler</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
<!--                        <div class="row">-->
<!--                            <div class="col">-->
<!--                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">-->
<!--                                    <ul class="pagination">-->
<!--                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>-->
<!--                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>-->
<!--                                        <li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--                                        <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>-->
<!--                                    </ul>-->
<!--                                </nav>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="row">
                            <div class="col"><a href="rdv.php?action=archive">Aficher la list des rendez-vous archivier</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include './includes/footer.php'; ?>