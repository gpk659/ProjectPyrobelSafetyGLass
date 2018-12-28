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

    $nomType = $_POST['nomType'];
    $epType = $_POST['epType'];
    $masseType = $_POST['masseType'];
    $codeAGCType = $_POST['codeAGCType'];
    $sousFamille = $_POST['sousFamille'];


    try {
        $sqlAddType = "INSERT INTO `db_project_pyrobel`.`type` (`idType`,`nomType`, `epType`, `masseType`, `codeAGCType`, `sousfamille_type_idSousFamille_Type`) 
                       VALUES ('51','$nomType','$epType','$masseType','$codeAGCType','$sousFamille')";

        $inserType = $db->query($sqlAddType);
        echo "reussi ?!";
        echo $sqlAddType;
    }catch (PDOException $e){
        echo $sqlAddType. "<br>". $e->getMessage();
    }
?>