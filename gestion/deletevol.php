<?php
session_start();
include 'secure.php';
require "../dbConnect.php";

try {
  $idVol = $_GET['idVol'];
  $scriptdelvol ="DELETE FROM `listevolume`
                 WHERE `idListeVolume` = ".$idVol;
  $deleteVol=$db->query($scriptdelvol);
  echo "success!<br />";
  echo $scriptdelvol;
  header('Location: http://localhost/SafetyGlassProject/gestion/listvolume.php');
}
//catch exception
catch(Exception $e) {
  echo '<br />Message: ' .$e->getMessage();
}
