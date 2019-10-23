<?php
/**
 * User: Grégory
 * Date: 12-09-18
 * Time: 16:12
 */

 include 'head.inc.php';
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

  $countChutte="SELECT count(*)+1 as NB FROM `DB_Pyrobel`.`listechutte` WHERE emplacement_idEmplacement = '$emp'";
  $queryCount = $db->query($countChutte);
  foreach ($queryCount as $key) {
    $nb=$key['NB'];



  $insertloss="INSERT INTO `DB_Pyrobel`.`listechutte` (`largeur`, `hauteur`, `dateMiseStock`,`commentaire`, `positionEmp`, `plateau_idPlateau`, `emplacement_idEmplacement`, `type_idType`)

  VALUES ('".$largeur."','".$hauteur."','".$day."','".$comment."','$nb','".$plateau."','".$emp."','".$type."')";

  $addloss=$db->query($insertloss);
  //echo "succes";
  }
try {
  $sqllastentry="SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, numPlateau, descriptionCourte as type
              FROM  DB_Pyrobel.listechutte as listchutte,
                    DB_Pyrobel.emplacement as emp,
                    DB_Pyrobel.rack,  DB_Pyrobel.plateau,
                    DB_Pyrobel.type
              WHERE emplacement_idEmplacement = emp.idEmplacement
                    and rack_idRack = idRack
                    and plateau_idPlateau = idPlateau
                    and type_idType = idType
                    ORDER BY idChutte DESC LIMIT 1";

  $printloss=$db->query($sqllastentry);
  foreach ($printloss as $key) {
    $idchutte=$key['idChutte'];
    $hauteur=$key['ht'];
    $largeur=$key['lg'];
    $plateau=$key['numPlateau'];
    $type=$key['type'];

    echo "<div id=printbox class='printarea'>";
    echo "<p class='item'>N° : <span>$idchutte</span></p>";
    echo "<p>Type : <br><p class='item2'>$type</p></p>";
    echo "<p>Dimensions : <br><p class='item2'>$largeur X $hauteur</p> </p>";
    echo "<p class='item'>Plateau : <span>$plateau</span></p>";

    echo "</div>";
  }
  echo "<a href='http://localhost/SafetyGlassProject/gestion/acceuil.php'> >RETOUR</>";
}catch(PDOException $e){
  echo $editloss . "<br>" . $e->getMessage();
}  ?>
<script>
printContent('printbox');
function printContent(el){
 var restorepage = document.body.innerHTML;
 var printcontent = document.getElementById(el).innerHTML;
 document.body.innerHTML = printcontent;
 window.print();
 document.body.innerHTML = restorepage;
}
</script> <?php
  //header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
  exit();
}catch(PDOException $e){
  echo "<br>" . $e->getMessage();
}
