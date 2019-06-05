<?php
require '../dbConnect.php';

if(isset($_GET['rack'])){

  echo "- SQL Modification Rack -";

  $idrack=$_GET['idr'];
  $abv=$_GET['abv'];
  $nomRack=$_GET['rackname'];
  $des=$_GET['des'];
  $lg=$_GET['longueur'];
  $lrg=$_GET['largeur'];

  try {
    $queryrack="UPDATE `safetyglass_db`.`rack` SET `abreviation` = '$abv', `nomRack` = '$nomRack', `description` = '$des', `largeur` = '$lrg', `longueur` = '$lg'
                WHERE (`idRack` = '$idrack')";
    $modifrack=$db->query($queryrack);
    echo "succes";
  }catch(PDOException $e){
    echo $modifrack . "<br>" . $e->getMessage();
  }

  header('Location: http://localhost/SafetyGlassProject/gestion/modification.php');
  exit();

}else if(isset($_GET['chute'])){

  echo "- SQL Modification Type Chute -";

  $idChute=$_GET['idc'];
  $epType=$_GET['epType'];
  $masseType=$_GET['masseType'];
  $codeAGC=$_GET['codeAGC'];
  $desCourte=$_GET['desCourte'];
  $desComplete=$_GET['desComplete'];

  try {
    $querychute="UPDATE `safetyglass_db`.`type` SET `epType` = '$epType', `masseType` = '$masseType', `codeAGCType` = '$codeAGC', `descriptionCourte` = '$desCourte', `descriptionComplete` = '$desComplete'
                WHERE (`idType` = '$idChute')";
    $modifchute=$db->query($querychute);
    echo "succes";
  }catch(PDOException $e){
    echo $modifchute . "<br>" . $e->getMessage();
  }

  header('Location: http://localhost/SafetyGlassProject/gestion/modification.php');
  exit();

}else if(isset($_GET['plateau'])){

  echo "- SQL Modification Plateau -";

  $idPlateau=$_GET['idp'];
  $numCadre=$_GET['numCadre'];
  $numPlateau=$_GET['numPlateau'];
  $largeur=$_GET['largeur'];
  $cmt=$_GET['cmt'];
  $date=$_GET['date'];
  $nomF=$_GET['nomF'];

  try {
    $queryplateau="UPDATE `safetyglass_db`.`plateau` SET `numCadre` = '$numCadre', `numPlateau` = '$numPlateau',
                          `largeur` = '$largeur', `hauteur` = '$hauteur', `commentaire` = '$cmt', `date` = '$date',
                          `nomFournisseur` = '$nomF'
    WHERE (`idPlateau` = '$idPlateau')";
    $modifPlateau=$db->query($queryplateau);
    echo "succes";
  }catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
  }

  header('Location: http://localhost/SafetyGlassProject/gestion/modification.php');
  exit();
}else{
  echo "error";
}
?>
