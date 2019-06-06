<?php
/**
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
//$placement=$_GET['emp'];
$plateau=$_GET['plateau'];

$comment=$_GET['comment'];

echo "<p>Hauteur : $hauteur</p>
      <p>Largeur : $largeur</p>
      <p>Type : $type</p>
      <p>Day : $day</p>
      <p>Time : $time</p>
      <p>Plateau : $plateau</p>";

$insertloss="INSERT INTO `safetyglass_db`.`listechutte` (`largeur`, `hauteur`, `type_idType`, `dateMiseStock`, `heureMiseStock`,`commentaire`,`plateau_idPlateau`,`emplacement_idEmplacement`)


VALUES ('".$largeur."','".$hauteur."','".$type."','".$day."','".$time."','".$comment."','".$plateau."','1')";


//$addloss=$db->query($insertloss);

header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
exit();
