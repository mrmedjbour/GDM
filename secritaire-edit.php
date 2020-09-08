<?php
define('PAGETITLE', 'Modifier le profil secrétaire');
include './includes/head.php';

$stmt = $db->prepare("SELECT * 
                            FROM users 
                            WHERE id = ? AND profil_type='assistante'");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$dr = mysqli_fetch_assoc($stmt->get_result());

?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Modifier le profil secrétaire</h3>
    <div class="row mb-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">secrétaire</p>
                        </div>
                        <div class="card-body">
                            <form id="addDoctor" action="secritaire-edit.php?id=<?php echo $dr['id'];?>" method="post">
                                <input type="hidden" value="<?php echo $dr['id'];?>" name="id">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="prenom"><strong>Pérenom</strong></label><input class="form-control" type="text" id="prenom" value="<?php echo $dr['profil_prenom'];?>" placeholder="Prénom" name="prenom"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="nom"><strong>Nom</strong></label><input class="form-control" type="text" id="nom" value="<?php echo $dr['profil_nom'];?>" placeholder="Nom" name="nom"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="sexe"><strong>Sexe</strong><br></label>
                                            <select class="form-control" name="sexe" id="sexe">
                                                <option value="f" <?php if ($dr['profil_sexe'] == "f"){ echo "selected"; } ?>>Femme</option>
                                                <option value="m" <?php if ($dr['profil_sexe'] == "h" or $dr['profil_sexe'] == "m"){ echo "selected"; } ?>>homme</option></select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-1" for="tel"><strong>Num de tel</strong><br></label><input class="form-control" type="text" value="<?php echo $dr['profil_tel'];?>" placeholder="Num de tel"  id="tel" name="tel"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-2" for="adresse"><strong>Adresse</strong><br></label><input class="form-control" type="text" placeholder="Adresse" value="<?php echo $dr['profil_adresse'];?>" id="adresse" name="adresse"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-4" for="username"><strong>Nom d'utilisateur</strong></label><span class="ml-2 small">(<em>Ne peut pas contenir d'espaces au caractère spécial</em>)</span>
                                            <input class="form-control" type="text" id="username" value="<?php echo $dr['username'];?>" name="username" placeholder="Nom d'utilisateur"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-3" for="password"><strong>Mote de pass</strong><br></label><input class="form-control" type="password" id="password" name="password" placeholder="Mote de pass"></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary" type="submit"  value="addDr" name="editSc">Modifier</button></div>
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
