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

$comment=$_GET['comment'];

$type=$_GET['stype'];
$emp=$_GET['listerack'];
$plateau=$_GET['plateau'];

try {

  $insertloss="INSERT INTO `DB_Pyrobel`.`listechutte` (`largeur`, `hauteur`, `dateMiseStock`,`commentaire`, `positionEmp`, `plateau_idPlateau`, `emplacement_idEmplacement`, `type_idType`)

  VALUES ('".$largeur."','".$hauteur."','".$day."','".$comment."','1','".$plateau."','".$emp."','".$type."')";

  $addloss=$db->query($insertloss);
  echo "succes";
  header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
  exit();
}catch(PDOException $e){
  echo $addloss . "<br>" . $e->getMessage();
}
