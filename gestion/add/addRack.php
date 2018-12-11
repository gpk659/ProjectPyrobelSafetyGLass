<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 25-09-18
 * Time: 11:45
 */
session_start();

require '../../dbConnect.php';
include '../secure.php';

    $abrev = $_POST['abrev'];
    $nomPos = $_POST['nomPos'];
    $desc = $_POST['desc'];
    $largeur = $_POST['largeur'];
    $longeur = $_POST['longeur'];
    $xo = $_POST['xo'];
    $yo = $_POST['yo'];
    $listZone = $_POST['listZone'];

try {
    $sqlAddRack = "INSERT INTO `db_project_pyrobel`.`rack`(`idRack`,`abreviation`,`nomPosition`,`description`,`largeur`,`longueur`,`X0`,`Y0`,`zone_idZone`)
                       VALUES ('51','$abrev','$nomPos','$desc','$largeur','$longeur','$xo','$yo','$listZone')";

    $inserRack = $db->query($sqlAddRack);
    echo "reussi ?!";
}catch (PDOException $e){
    echo $sqlAddRack. "<br>". $e->getMessage();
}
?>
?>