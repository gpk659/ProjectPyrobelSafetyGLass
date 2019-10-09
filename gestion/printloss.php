<?php
  session_start();
 include 'head.inc.php';

include 'secure.php';
require '../dbConnect.php';
include_once 'newRequests.php';



$chute=$_GET['chute'];

try {
  $getloss="SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, numPlateau, descriptionCourte as type
              FROM  DB_Pyrobel.listechutte as listchutte,
                    DB_Pyrobel.emplacement as emp,
                    DB_Pyrobel.rack,  DB_Pyrobel.plateau,
                    DB_Pyrobel.type
              WHERE emplacement_idEmplacement = emp.idEmplacement
                    and rack_idRack = idRack
                    and plateau_idPlateau = idPlateau
                    and type_idType = idType
                    and idChutte = $chute";

  $printloss=$db->query($getloss);

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
  //echo "succes";
  //header('Location: http://localhost/SafetyGlassProject/gestion/deplacement.php');

}catch(PDOException $e){
  echo $editloss . "<br>" . $e->getMessage();
}
 ?>

 <script>
 printContent('printbox');
 function printContent(el){
 	var restorepage = document.body.innerHTML;
 	var printcontent = document.getElementById(el).innerHTML;
 	document.body.innerHTML = printcontent;
 	window.print();
 	document.body.innerHTML = restorepage;
 }
 </script>

 <?php


 ?>
