<?php
define('PAGETITLE', 'List des Secrétaire');
include './includes/head.php';

if (isset($_GET['action']) && $_GET['action'] == "remove" && isset($_GET['id'])){
    $m = $db->prepare("SELECT * FROM `users` WHERE profil_type='assistante' AND id=?");
    $m->bind_param("i", $_GET['id']);
    $m->execute();

    if ($m->get_result()->num_rows){
        $sup = $db->prepare("UPDATE `users` SET `deleted` = '1' WHERE `users`.`id` = ?");
        $sup->bind_param("i", $_GET['id']);
        $sup->execute();
    }
}

$stmt = $db->prepare("SELECT * FROM `users` WHERE profil_type='assistante' AND deleted=0");
$stmt->execute();
$scrs = $stmt->get_result();

?>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Secrétaire</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Secrétaire list</p>
            </div>
            <div class="card-body">
                <div class="text-right"><a class="btn btn-info" role="button" href="secritaire-add.php">Ajouter Secrétaire</a></div>
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
                        <?php while ($sc = mysqli_fetch_array($scrs)) : ?>
                            <tr>
                                <td class="font-weight-bold">
                                    <?php
                                    echo $sc['profil_prenom'].' '.$sc['profil_nom'];
                                    ?>
                                </td>
                                <td><?php echo $sc['profil_tel'];?></td>
                                <td>
                                    <a class="btn btn-danger btn-lg m-1" role="button" href="secritaire.php?action=remove&id=<?php echo $sc['id'];?>"><i class="fa fa-remove"></i></a>
                                    <a class="btn btn-primary btn-lg m-1" role="button" href="secritaire-edit.php?id=<?php echo $sc['id'];?>"><i class="fa fa-edit"></i></a>
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