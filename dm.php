<?php
define('PAGETITLE', 'List des Dossier médical');
include './includes/head.php';

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] <> "archive"){

    $d = $db->prepare("SELECT * FROM patient INNER JOIN dm ON patient.id_dm = dm.id_dm WHERE dm.id_dm=?");
    $d->bind_param("i", $_GET['id']);
    $d->execute();

    if ($d->get_result()->num_rows){
        if ($_GET['action'] == "remove"){
            $sup = $db->prepare("UPDATE `dm` SET `deleted` = '1' WHERE `dm`.`id_dm` = ?");
            $sup->bind_param("i", $_GET['id']);
            $sup->execute();
            $sup = $db->prepare("UPDATE `patient` SET `deleted` = '1' WHERE `patient`.`id_dm` = ?");
            $sup->bind_param("i", $_GET['id']);
            $sup->execute();
        }elseif ($_GET['action'] == "archiver"){
            $sup = $db->prepare("UPDATE `dm` SET `archivier_dm` = '1' WHERE `dm`.`id_dm` = ?");
            $sup->bind_param("i", $_GET['id']);
            $sup->execute();
            $sup = $db->prepare("UPDATE `patient` SET `archivier_patient` = '1' WHERE `patient`.`id_dm` = ?");
            $sup->bind_param("i", $_GET['id']);
            $sup->execute();
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "archive") {
    $stmt = $db->prepare("SELECT patient.id_dm,nom_patient,prenom_patient,division,direction
                                FROM patient
                                INNER JOIN dm ON patient.id_dm = dm.id_dm
                                WHERE dm.deleted = 0 AND patient.deleted = 0 AND archivier_dm = 1 OR archivier_patient = 1
                                ORDER BY patient.id_patient DESC");
    $stmt->execute();
    $dms = $stmt->get_result();
}else{
    $stmt = $db->prepare("SELECT patient.id_dm,nom_patient,prenom_patient,division,direction
                                FROM patient
                                INNER JOIN dm ON patient.id_dm = dm.id_dm
                                WHERE archivier_dm = 0 AND dm.deleted = 0 AND patient.deleted = 0 && archivier_patient = 0
                                ORDER BY patient.id_patient DESC");
    $stmt->execute();
    $dms = $stmt->get_result();
}

?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Dossier médical</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Dossier médical list</p>
                    </div>
                    <div class="card-body">
                        <div class="text-right"><a class="btn btn-info" role="button" href="dm-add.php">Ajouter un dossier médical</a></div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-striped my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID-Dm</th>
                                    <th>Nom/Prénom</th>
                                    <th>Division/Direction</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($dm = mysqli_fetch_array($dms)) : ?>
                                <tr>
                                    <td>#<?php echo $dm['id_dm']; ?></td>
                                    <td class="font-weight-bold"><?php echo $dm['prenom_patient'].' '.$dm['nom_patient']; ?></td>
                                    <td><?php echo $dm['division']; ?>/<?php echo $dm['direction']; ?></td>
                                    <td>
                                        <a class="btn btn-danger m-1" role="button" href="dm.php?action=remove&id=<?php echo $dm['id_dm']; ?>"><i class="fa fa-remove"></i></a>
                                        <a class="btn btn-success m-1" role="button" href="dm-edit.php?id=<?php echo $dm['id_dm']; ?>"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-primary m-1" role="button" href="dm-edit.php?id=<?php echo $dm['id_dm']; ?>"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-dark m-1" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" href="dm.php?action=archiver&id=<?php echo $dm['id_dm']; ?>" title="Archiver">
                                            <i class="fa fa-archive"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile ?>
                                </tbody>
                            </table>
                        </div><a class="card-link" href="dm.php?action=archive">Afficher la list des dossier médical archivier</a></div>
                </div>
            </div>
        </div>
<?php include './includes/footer.php'; ?>