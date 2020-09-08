<?php
define('PAGETITLE', 'Modifier le Rendez-vous');
include './includes/head.php';

if (isset($_POST['edit_rdv'])){
    $stmt = $db->prepare("UPDATE rdv SET date_rdv = ? WHERE id_rdv = ?");
    $stmt->bind_param("si", $_POST['date'],$_POST['id_rdv']);
    $stmt->execute();
}

$stmt = $db->prepare("SELECT id_rdv,nom_patient,prenom_patient,profil_nom,profil_prenom,date_rdv 
                                FROM rdv
                                INNER JOIN patient ON patient.id_patient = rdv.id_patient
                                INNER JOIN users ON rdv.id_medecin = users.id
                                WHERE id_rdv = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$rdv = mysqli_fetch_assoc($stmt->get_result());
?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Ajouter Rendez-vous</h3>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Rendez-vous</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="rdv-edit.php?id=<?php echo $rdv['id_rdv']; ?>" method="post">
                                            <input type="hidden" name="id_rdv" value="<?php echo $rdv['id_rdv']; ?>">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label id="lieu-de-naissance-2" for="last_name"><strong>Patient</strong><br></label>
                                                        <input class="form-control" type="text" name="Patient" value="<?php echo $rdv['prenom_patient'].' '.$rdv['nom_patient']; ?>" disabled readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <label class="col-form-label" id="lieu-de-naissance-4" for="rdvDatePicker"><strong>Date / heure&nbsp;de rendez-vous</strong></label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group"><input class="flatpickr" required id="rdvDatePicker" type="text" name="date" value="<?php echo date_format(date_create($rdv['date_rdv']),"Y/m/d H:i"); ?>"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label id="lieu-de-naissance-1" for="last_name"><strong>Médecin</strong><br></label>
                                                        <input class="form-control" type="text" name="doctor" value="<?php echo $rdv['profil_prenom'].' '.$rdv['profil_nom']; ?>" disabled readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-success" type="submit" name="edit_rdv">Modifier le Rendez-vous</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include './includes/footer.php';?>