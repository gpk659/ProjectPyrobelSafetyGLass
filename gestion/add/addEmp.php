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


$description    = $_POST['description'];
$largeur        = $_POST['largeur'];
$poids          = $_POST['poids'];
$usine          = $_POST['usine'];
$zone           = $_POST['zone'];
$rack           = $_POST['rack'];

    try{
        $sqlAddEmp = "INSERT INTO `db_project_pyrobel`.`emplacement`(`idEmplacement`,`description`,`largeurPied`,`poidsMax`,`usine_idUsine`,`zone_idZone`,`rack_idRack`)
                      VALUES
                      ('5','$description','$largeur','$poids','$usine','$zone','$rack');";

        $insertEmp = $db->query($sqlAddEmp);

        //header('Location: http://localhost/SafetyGlassProject/addpage.php');

    }catch (PDOException $e){
        echo $sqlAddEmp. "<br>". $e->getMessage();
    }

?>