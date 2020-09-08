<?php
define('PAGETITLE', 'List des Médecin');
include './includes/head.php';

if (isset($_GET['action']) && $_GET['action'] == "remove" && isset($_GET['id'])){
    $m = $db->prepare("SELECT * FROM `users` WHERE profil_type='medecin' AND id=?");
    $m->bind_param("i", $_GET['id']);
    $m->execute();

    if ($m->get_result()->num_rows){
        $sup = $db->prepare("UPDATE `users` SET `deleted` = '1' WHERE `users`.`id` = ?");
        $sup->bind_param("i", $_GET['id']);
        $sup->execute();
    }

}

$stmt = $db->prepare("SELECT * FROM `users` WHERE profil_type='medecin' AND deleted=0");
$stmt->execute();
$drs = $stmt->get_result();



?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Médecin</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Médecin list</p>
                    </div>
                    <div class="card-body">
                        <div class="text-right"><a class="btn btn-info" role="button" href="medecin-add.php">Ajouter Médecin</a></div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-striped my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Nom/Prénom</th>
                                    <th>Num De Tel</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($dr = mysqli_fetch_array($drs)) : ?>
                                    <tr>
                                        <td class="font-weight-bold">

                                            <?php
                                            if ($dr['profil_sexe'] == "f"){
                                                echo '<img class="rounded-circle mr-2" width="30" height="30" src="assets/img/doctor.png">';
                                            }else{
                                                echo '<img class="rounded-circle mr-2" width="30" height="30" src="assets/img/doctor(1).png">';
                                            }
                                            echo $dr['profil_prenom'].' '.$dr['profil_nom'];
                                            ?>
                                        </td>
                                        <td><?php echo $dr['profil_tel'];?></td>
                                        <td>
                                            <a class="btn btn-danger btn-lg m-1" role="button" href="medecin.php?action=remove&id=<?php echo $dr['id'];?>"><i class="fa fa-remove"></i></a>
                                            <a class="btn btn-primary btn-lg m-1" role="button" href="medecin-edit.php?id=<?php echo $dr['id'];?>"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include './includes/footer.php'; ?>