<?php
define('PAGETITLE', 'Modifier le Dossier médical');
include './includes/head.php';

$stmt = $db->prepare("SELECT * 
                            FROM patient 
                            INNER JOIN dm ON patient.id_dm = dm.id_dm
                            WHERE dm.id_dm = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$dm = mysqli_fetch_assoc($stmt->get_result());

?>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Dossier médical</h3>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Information de dossier médical</p>
                            </div>
                            <div class="card-body">
                                <form action="dm-edit.php?id=<?php echo $dm['id_dm']; ?>" method="post">
                                    <input type="hidden" name="id_dm" value="<?php echo $dm['id_dm']; ?>">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="prenom"><strong>Pérenom</strong></label><input class="form-control" type="text" placeholder="Prénom" id="prenom" name="prenom" value="<?php echo $dm['prenom_patient']; ?>"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label for="nom"><strong>Nom</strong></label><input class="form-control" type="text" placeholder="Nom" id="nom" name="nom" value="<?php echo $dm['nom_patient']; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="date"><strong>date de naissance</strong><br></label><input class="form-control" type="date" id="date" name="date" value="<?php echo $dm['datenais_patient']; ?>"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance" for="lieu"><strong>lieu de naissance</strong><br></label><input class="form-control" type="text" placeholder="lieu de naissance" id="lieu" name="lieu" value="<?php echo $dm['lieunais_patient']; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="sexe"><strong>Sexe</strong><br></label>
                                                <select class="form-control" id="sexe" name="sexe">
                                                    <option value="Femme" <?php if (strtolower($dm['sexe_patient']) == "femme"){ echo "selected"; } ?>>Femme</option>
                                                    <option value="Homme" <?php if (strtolower($dm['sexe_patient']) == "homme"){ echo "selected"; } ?>>Homme</option>
                                                </select></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance-1" for="tel"><strong>Num de tel</strong><br></label><input class="form-control" type="text" placeholder="Num de tel"  id="tel" name="tel" value="<?php echo $dm['tel_patient']; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance-2" for="adresse"><strong>Adresse</strong><br></label><input class="form-control" type="text" id="adresse" placeholder="Adresse" value="<?php echo $dm['adresse_patient']; ?>" name="adresse"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance-10" for="situation"><strong>Situation de famille</strong><br></label>
                                                <select class="form-control" id="situation" name="situation">
                                                    <option value="marie" <?php if (strtolower($dm['situation_famille']) == "marie"){ echo "selected"; } ?>>Marié</option>
                                                    <option value="celibataire" <?php if (strtolower($dm['situation_famille']) == "celibataire"){ echo "selected"; } ?>>Célibataire</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="division"><strong>Division</strong></label>
                                                <select class="form-control" id="division" name="division">
                                                    <option value="CRD" <?php if ($dm['division'] == "CRD"){ echo "selected"; } ?>>CRD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="direction"><strong>Direction</strong></label>
                                                <select class="form-control" id="direction" name="direction">
                                                    <option value="D-INFO" <?php if ($dm['direction'] == "D-INFO"){ echo "selected"; } ?>>D-INFO</option>
                                                    <option value="D-GRH" <?php if ($dm['direction'] == "D-GRH"){ echo "selected"; } ?>>D-GRH</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="unite"><strong>Unite</strong><br></label><input class="form-control" id="unite" type="text" placeholder="Unite" value="<?php echo $dm['unite']; ?>" name="unite"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label id="lieu" for="service"><strong>service</strong><br></label><input class="form-control" type="text" id="service" value="<?php echo $dm['service']; ?>" placeholder="Service" name="service"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="activite"><strong>Activite</strong><br></label><input class="form-control" type="text" id="activite" value="<?php echo $dm['activite']; ?>" placeholder="Activité" name="activite"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label for="atelier"><strong>Atelier</strong><br></label><input class="form-control" id="atelier" type="text" value="<?php echo $dm['atelier']; ?>" placeholder="Atelier" name="atelier"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="maladie_gen"><strong>Maladie Gene</strong><br></label><input class="form-control" type="text" id="maladie_gen" value="<?php echo $dm['maladie_gen']; ?>" placeholder="Maladie Gen" name="maladie_gen"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance-5" for="maladie_prof"><strong>Maladie prof</strong><br></label><input id="maladie_prof" class="form-control" value="<?php echo $dm['maladie_prof']; ?>" type="text" name="maladie_prof" placeholder="Maladie prof"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="maladie_carc"><strong>Maladie caractere</strong><br></label><input class="form-control" type="text" id="maladie_carc" value="<?php echo $dm['maladie_carc']; ?>" placeholder="maladie caractere" name="maladie_carc"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label id="interventions" for="interventions"><strong>interventions chirurgicales</strong><br></label><input class="form-control" value="<?php echo $dm['interventions']; ?>" id="interventions" type="text" name="interventions" placeholder="Interventions"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="affectations"><strong>Affectations congénitales</strong><br></label><input class="form-control" type="text" id="affectations" value="<?php echo $dm['affectations']; ?>" placeholder="Affectations" name="affectations"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label  for="intoxications"><strong>intoxications (Tabac,Alcool..)</strong><br></label><input class="form-control" type="text" id="intoxications" value="<?php echo $dm['intoxications']; ?>" name="intoxications" placeholder="intoxication"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="accidents"><strong>Accidents</strong><br></label><input class="form-control" type="text" placeholder="Accidents" value="<?php echo $dm['accidents']; ?>" id="accidents" name="accidents"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance-8" for="collateraux"><strong>collatéraux</strong><br></label><input class="form-control" type="text" value="<?php echo $dm['collateraux']; ?>" name="collateraux" id="collateraux" placeholder="collatéraux"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="conjoints"><strong>Conjoints</strong><br></label><input class="form-control" type="text" placeholder="conjoints" value="<?php echo $dm['conjoints']; ?>" id="conjoints" name="conjoints"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label id="lieu-de-naissance-1" for="observation"><strong>Observation</strong><br></label><textarea class="form-control" placeholder="Observation.." rows="5" id="observation" name="observation"><?php echo $dm['observation']; ?></textarea></div>
                                        </div>
                                    </div>
                                    <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="edit_dm">Modifier le dossier médical</button></div>
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