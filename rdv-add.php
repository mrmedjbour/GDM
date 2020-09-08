<?php
    define('PAGETITLE', 'Ajouter Rendez-vous');
    include './includes/head.php';
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
                                        <form action="rdv-add.php" method="post">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label id="lieu-de-naissance-2" for="patientId"><strong>Patient</strong></label>
                                                        <select class="custom-select chosen" required style="color: #3e7aac;" name="id_patient" id="patientId">
                                                            <option selected disabled hidden>Patient</option>
                                                            <?php
                                                            $stmt = $db->prepare(getPatsSql());
                                                            $stmt->execute();
                                                            $result = $stmt->get_result();
                                                            while ($pat = mysqli_fetch_array($result)){
                                                                echo "<option value='".$pat['id_patient']."'>". $pat['prenom_patient'] .' '. $pat['nom_patient'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <label class="col-form-label" id="lieu-de-naissance-4" for="rdvDatePicker"><strong>Date / heure&nbsp;de rendez-vous</strong></label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group"><input class="flatpickr" required id="rdvDatePicker" type="text" name="date" placeholder="date et heur de rendez-vous.."></div>
                                                </div>
                                            </div>
<!--                                            <div class="form-row">-->
<!--                                                <div class="col">-->
<!--                                                    <div class="form-group">-->
<!--                                                        <label id="lieu-de-naissance-1" for="last_name"><strong>Médecin</strong><br></label>-->
<!--                                                        <select class="form-control">-->
<!--                                                            -->
<!--//                                                            $stmt = $db->prepare(getDrsSql());-->
<!--//                                                            $stmt->execute();-->
<!--//                                                            $result = $stmt->get_result();-->
<!--//                                                            while ($dr = mysqli_fetch_array($result)){-->
<!--//                                                                echo "<option value='".$dr['id']."'>". $dr['profil_prenom'] .' '. $dr['profil_nom'] . "</option>";-->
<!--//                                                            }-->
<!--//                                                            ?>-->
<!--                                                        </select>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                            <div class="form-group"><button class="btn btn-success" type="submit" name="add_rdv">Ajouter Rendez-vous</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include './includes/footer.php'; ?>