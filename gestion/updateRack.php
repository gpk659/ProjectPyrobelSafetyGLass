<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 26-09-18
 * Time: 17:28
 */
session_start();
include 'secure.php';

require '../dbConnect.php';

/*
UPDATE table
SET nom_colonne_1 = 'nouvelle valeur'
WHERE condition
    => $_GET['modifRack']
*/
$rack=$_GET['listerack'];
echo "session id : ";
$id=$_SESSION['idChutte'];
echo $id;


try {
  $query="SELECT idEmplacement FROM DB_Pyrobel.emplacement WHERE rack_idRack = '$rack'";
  $updaterack=$db->query($query);

  foreach ($updaterack as $key) {
    $emp=$key['idEmplacement'];
    echo "<br>Emp n° : ". $emp;

    try {
      $up="UPDATE DB_Pyrobel.listechutte SET emplacement_idEmplacement = '$emp' WHERE idChutte = '$id'";
      $modifrack=$db->query($up);
      header('Location: http://localhost/SafetyGlassProject/gestion/deplacement.php');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

} catch (\Exception $e) {
  echo $e->getMessage();
}
