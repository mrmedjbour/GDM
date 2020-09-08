<?php

if (isset($_POST['add_dm'])) {
    addDm();
}

if (isset($_POST['edit_dm'])){
    editDm();
}

if (isset($_POST['addDr'])){
    addDr();
}

if (isset($_POST['addSr'])){
    addSr();
}

if (isset($_POST['editSc'])){
    editSc();
}

if (isset($_POST['editDr'])){
    editDr();
}

function addDm(){
    global $db, $errors;
    $prenom     =   e($_POST['prenom']);
    $nom   =   e($_POST['nom']);
    $lieu   =   e($_POST['lieu']);
    $sexe   =   e($_POST['sexe']);
    $tel   =   e($_POST['tel']);
    $adresse   =   e($_POST['adresse']);
    $date   =   e($_POST['date']);
    $situation   =   e($_POST['situation']);
    $division   =   e($_POST['division']);
    $direction   =   e($_POST['direction']);
    $unite   =   e($_POST['unite']);
    $service   =   e($_POST['service']);
    $activite   =   e($_POST['activite']);
    $atelier   =   e($_POST['atelier']);
    $maladie_gen   =   e($_POST['maladie_gen']);
    $maladie_prof   =   e($_POST['maladie_prof']);
    $maladie_carc   =   e($_POST['maladie_carc']);
    $interventions   =   e($_POST['interventions']);
    $affectations   =   e($_POST['affectations']);
    $intoxications   =   e($_POST['intoxications']);
    $accidents   =   e($_POST['accidents']);
    $collateraux   =   e($_POST['collateraux']);
    $conjoints   =   e($_POST['conjoints']);
    $observation   =   e($_POST['observation']);
    if (empty($prenom) OR empty($nom) OR empty($sexe)) {
        array_push($errors, "insérer des données");
    }
    if (count($errors) == 0){
        $query = "INSERT INTO `dm` (`situation_famille`, `division`, `direction`, `unite`, `service`, `activite`, `atelier`, `maladie_gen`, `maladie_prof`, `maladie_carc`, `interventions`, `affectations`, `intoxications`, `accidents`, `collateraux`, `conjoints`, `observation`) 
                            VALUES ('$situation', '$division', '$direction', '$unite', '$service', '$activite', '$atelier', '$maladie_gen', '$maladie_prof', '$maladie_carc', '$interventions', '$affectations', '$intoxications', '$accidents', '$collateraux', '$conjoints', '$observation');";
        mysqli_query($db, $query);
        $id_dm = mysqli_insert_id($db);

        $query = "INSERT INTO `patient` (`nom_patient`, `prenom_patient`, `datenais_patient`, `lieunais_patient`, `sexe_patient`, `adresse_patient`, `tel_patient`, `id_dm`) 
                                 VALUES ('$nom', '$prenom', '$date', '$lieu', '$sexe', '$adresse', '$tel', $id_dm);";
        mysqli_query($db, $query);

        header('Location: dm.php');
    }
}

function editDm(){
    global $db, $errors;
    $id_dm     =   e($_POST['id_dm']);
    $prenom     =   e($_POST['prenom']);
    $date   =   e($_POST['date']);
    $nom   =   e($_POST['nom']);
    $lieu   =   e($_POST['lieu']);
    $sexe   =   e($_POST['sexe']);
    $tel   =   e($_POST['tel']);
    $adresse   =   e($_POST['adresse']);
    $situation   =   e($_POST['situation']);
    $division   =   e($_POST['division']);
    $direction   =   e($_POST['direction']);
    $unite   =   e($_POST['unite']);
    $service   =   e($_POST['service']);
    $activite   =   e($_POST['activite']);
    $atelier   =   e($_POST['atelier']);
    $maladie_gen   =   e($_POST['maladie_gen']);
    $maladie_prof   =   e($_POST['maladie_prof']);
    $maladie_carc   =   e($_POST['maladie_carc']);
    $interventions   =   e($_POST['interventions']);
    $affectations   =   e($_POST['affectations']);
    $intoxications   =   e($_POST['intoxications']);
    $accidents   =   e($_POST['accidents']);
    $collateraux   =   e($_POST['collateraux']);
    $conjoints   =   e($_POST['conjoints']);
    $observation   =   e($_POST['observation']);
    if (empty($prenom) OR empty($nom) OR empty($sexe)) {
        array_push($errors, "insérer des données");
    }
    if (count($errors) == 0){
        $query = "UPDATE `patient` 
                SET `nom_patient` = '$nom', 
                `prenom_patient` = '$prenom', 
                `datenais_patient` = '$date', 
                `lieunais_patient` = '$lieu', 
                `sexe_patient` = '$sexe', 
                `adresse_patient` = '$adresse', 
                `tel_patient` = '$tel'
                WHERE `patient`.`id_dm` = $id_dm";
        mysqli_query($db, $query);

        $query = "UPDATE `dm` 
                SET 
                `situation_famille` = '$situation', 
                `division` = '$division', 
                `direction` = '$direction', 
                `unite` = '$unite', 
                `service` = '$service', 
                `activite` = '$activite', 
                `atelier` = '$atelier', 
                `maladie_gen` = '$maladie_gen', 
                `maladie_prof` = '$maladie_prof', 
                `maladie_carc` = '$maladie_carc', 
                `interventions` = '$interventions', 
                `affectations` = '$affectations', 
                `intoxications` = '$intoxications', 
                `accidents` = '$accidents', 
                `collateraux` = '$collateraux', 
                `conjoints` = '$conjoints', 
                `observation` = '$observation' 
                WHERE `dm`.`id_dm` = $id_dm";
        mysqli_query($db, $query);

        header('Location: dm.php');
    }
}

function editDr(){
    global $db, $errors;
    $id = e($_POST['id']);
    $prenom     =   e($_POST['prenom']);
    $nom   =   e($_POST['nom']);
    $tel   =   e($_POST['tel']);
    $sexe   =   e($_POST['sexe']);
    $username   =   e($_POST['username']);
    $password   =   e($_POST['password']);
    $adresse   =   e($_POST['adresse']);

    if (empty($prenom) OR empty($nom) OR empty($sexe) OR empty($username)) {
        array_push($errors, "insérer des données correct");
    }
    if (count($errors) == 0){
        $sql = "UPDATE `users` 
                SET `username` = '$username', 
                `profil_nom` = '$nom', 
                `profil_prenom` = '$prenom', 
                `profil_tel` = '$tel', 
                `profil_sexe` = '$sexe', 
                `profil_adresse` = '$adresse' 
                WHERE `users`.`id` = $id";

        if (isset($password)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `users` 
                SET `username` = '$username', 
                `profil_nom` = '$nom', 
                `profil_prenom` = '$prenom', 
                `profil_tel` = '$tel', 
                `profil_sexe` = '$sexe', 
                `profil_adresse` = '$adresse', 
                `password` = '$password'
                WHERE `users`.`id` = $id";
        }
        echo mysqli_query($db, $sql);
        $_SESSION['success']  = "Médecin ajouter!!";
        header("Location: medecin.php");
    }else{
        header("Location: medecin-edit.php?id=$id");
    }
}

function editSc(){
    global $db, $errors;
    $id = e($_POST['id']);
    $prenom     =   e($_POST['prenom']);
    $nom   =   e($_POST['nom']);
    $tel   =   e($_POST['tel']);
    $sexe   =   e($_POST['sexe']);
    $username   =   e($_POST['username']);
    $password   =   e($_POST['password']);
    $adresse   =   e($_POST['adresse']);

    if (empty($prenom) OR empty($nom) OR empty($sexe) OR empty($username)) {
        array_push($errors, "insérer des données correct");
    }
    if (count($errors) == 0){
        $sql = "UPDATE `users` 
                SET `username` = '$username', 
                `profil_nom` = '$nom', 
                `profil_prenom` = '$prenom', 
                `profil_tel` = '$tel', 
                `profil_sexe` = '$sexe', 
                `profil_adresse` = '$adresse' 
                WHERE `users`.`id` = $id";

        if (isset($password)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `users` 
                SET `username` = '$username', 
                `profil_nom` = '$nom', 
                `profil_prenom` = '$prenom', 
                `profil_tel` = '$tel', 
                `profil_sexe` = '$sexe', 
                `profil_adresse` = '$adresse', 
                `password` = '$password'
                WHERE `users`.`id` = $id";
        }
        echo mysqli_query($db, $sql);
        $_SESSION['success']  = "Médecin ajouter!!";
        header("Location: secritaire.php");
    }else{
        header("Location: secritaire-edit.php?id=$id");
    }
}

function addDr(){
    global $db, $errors;
    $prenom     =   e($_POST['prenom']);
    $nom   =   e($_POST['nom']);
    $tel   =   e($_POST['tel']);
    $sexe   =   e($_POST['sexe']);
    $username   =   e($_POST['username']);
    $password   =   e($_POST['password']);
    $adresse   =   e($_POST['adresse']);

    if (empty($prenom) OR empty($nom) OR empty($sexe) OR empty($username) OR empty($password)) {
        array_push($errors, "insérer des données correct");
    }
    if (count($errors) == 0){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`username`, `profil_nom`, `profil_prenom`, `profil_type`, `profil_tel`, `profil_sexe`, `password`, `profil_adresse`) 
                               VALUES ('$username', '$nom', '$prenom', 'medecin', '$tel', '$sexe', '$password', '$adresse')";
        mysqli_query($db, $query);
        $_SESSION['success']  = "Médecin ajouter!!";
        echo "dz";
        header('Location: medecin.php');
    }else{
        echo "ddd";
        header('Location: medecin-add.php');
    }
}

function addSr(){
    global $db, $errors;
    $prenom     =   e($_POST['prenom']);
    $nom   =   e($_POST['nom']);
    $tel   =   e($_POST['tel']);
    $sexe   =   e($_POST['sexe']);
    $username   =   e($_POST['username']);
    $password   =   e($_POST['password']);
    $adresse   =   e($_POST['adresse']);

    if (empty($prenom) OR empty($nom) OR empty($sexe) OR empty($username) OR empty($password)) {
        array_push($errors, "insérer des données correct");
    }
    if (count($errors) == 0){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`username`, `profil_nom`, `profil_prenom`, `profil_type`, `profil_tel`, `profil_sexe`, `password`, `profil_adresse`) 
                               VALUES ('$username', '$nom', '$prenom', 'assistante', '$tel', '$sexe', '$password', '$adresse')";
        mysqli_query($db, $query);
        $_SESSION['success']  = "assistante ajouter!!";
        echo "dz";
        header('Location: secritaire.php');
    }else{
        echo "ddd";
        header('Location: secritaire-add.php');
    }
}