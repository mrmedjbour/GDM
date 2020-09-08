<?php
define('PAGETITLE', 'Ajouter un Secrétaire');
include './includes/head.php';

?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Ajouter secrétaire</h3>
    <div class="row mb-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Secrétaire</p>
                        </div>
                        <div class="card-body">
                            <form id="addDoctor" action="secritaire.php" method="post">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="prenom"><strong>Pérenom</strong></label><input class="form-control" type="text" id="prenom" placeholder="Prénom" name="prenom"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="nom"><strong>Nom</strong></label><input class="form-control" type="text" id="nom" placeholder="Nom" name="nom"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="sexe"><strong>Sexe</strong><br></label>
                                            <select class="form-control" name="sexe" id="sexe">
                                                <option value="f">Femme</option>
                                                <option value="m" selected="">homme</option></select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-1" for="tel"><strong>Num de tel</strong><br></label><input class="form-control" type="text" placeholder="Num de tel"  id="tel" name="tel"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-2" for="adresse"><strong>Adresse</strong><br></label><input class="form-control" type="text" placeholder="Adresse" id="adresse" name="adresse"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-4" for="username"><strong>Nom d'utilisateur</strong></label><span class="ml-2 small">(<em>Ne peut pas contenir d'espaces au caractère spécial</em>)</span>
                                            <input class="form-control" type="text" id="username" name="username" placeholder="Nom d'utilisateur"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label id="lieu-de-naissance-3" for="password"><strong>Mote de pass</strong><br></label><input class="form-control" type="password" id="password" name="password" placeholder="Mote de pass"></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary" type="submit"  value="addSr" name="addSr">Ajouter</button></div>
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
