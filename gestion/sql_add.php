<?php

/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 12-09-18
 * Time: 16:12
 */

require '../dbConnect.php';

$num=$_GET['numChute'];
$hauteur=$_GET['hauteurChute'];
$largueur=$_GET['largeurChute'];
$lot=$_GET['numLot'];
$type=$_GET['stype'];
$date=date("Y-m-d");
$placement=$_GET['positionRack'];

echo "<p>$num</p><p>$hauteur</p><p>$largueur</p><p>$lot</p><p>$type</p><p>$date</p><p>$placement</p>";

$insertloss="INSERT INTO mydb.chute (nomChute, hauteur, largeur, numLot, type_idType, dateChute, fk_placement)


VALUES ('".$num."','".$hauteur."','".$largueur."','".$lot."','".$type."','".$date."','".$placement."')";


$addloss=$db->query($insertloss);

/*header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
exit();*/
