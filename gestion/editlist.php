<?php

if($_GET['typem'] == "rack"){
  echo "Rack DATA GET<br />";
  echo "<br />abreviation : ". $_GET['abv'];
  echo "<br />Rack : ".$_GET['nomRack'];
  echo "<br />Description : ".$_GET['des'];
  echo "<br />Largeur : ".$_GET['lg'];
  echo "<br />Largeur : ".$_GET['lgr'];
}else if($_GET['typem'] == "plateau"){
  echo "Plateau DATA GET<br />";
  echo "<br />Num cadre : ".$_GET['numCadre'];
  echo "<br />Num Plateau : ".$_GET['numPlateau'];
  echo "<br />Largeur : ".$_GET['largeur'];
  echo "<br />Commentaire : ".$_GET['comment'];
  echo "<br />Date : ".$_GET['date'];
  echo "<br />Nom F : ".$_GET['nomF'];
}else if($_GET['typem'] == "chute"){
  echo "Chute DATA GET<br />";
  echo "<br />epType : ".$_GET['eptype'];
  echo "<br />Masse Type : ".$_GET['masstype'];
  echo "<br />Code AGC Type : ".$_GET['codeAGCType'];
  echo "<br />Description Courte : ".$_GET['descourte'];
  echo "<br />Description Complete : ".$_GET['descomp'];
}else{
  echo "Error";
}

 ?>
