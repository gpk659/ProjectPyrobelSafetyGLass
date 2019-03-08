<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 12-09-18
 * Time: 16:12
 */

require '../dbConnect.php';

$hauteur=$_GET['hauteurChute'];
$largeur=$_GET['largeurChute'];
$type=$_GET['stype'];
$day=date("Y-m-d");
$time=date("H:i:s");
$placement=$_GET['emp'];
$operateur=$_GET['op'];
$plateau=$_GET['plateau'];



$comment=$_GET['comment'];

echo "<p>$num</p><p>$hauteur</p><p>$largueur</p><p>$lot</p><p>$type</p><p>$date</p><p>$placement</p>";

$insertloss="INSERT INTO safetyglass_db.listchutte (largeur, hauteur, type_idType, dateMiseStock, heureMiseStock,plateau_idPlateau,listeoperateur_idOperateur,emplacement_idEmplacement);


VALUES ('".$largeur."','".$hauteur."','".$type."','".$day."','".$time."','".$date."','".$plateau."','".$operateur."','".$placement."','".$comment."')";


$addloss=$db->query($insertloss);

/*header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
exit();*/
