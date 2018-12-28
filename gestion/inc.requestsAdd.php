<?php
include 'secure.php';
require "../dbConnect.php";

function addItem($addWord){

  /* emplacement  */
  $sqlEmp = "SELECT idEmplacementUsine, nomEmplacement
             FROM mydb.emplacementusine";
  $listEmpAdd = $db->query($sqlEmp);

  // sous famille liste
  $sqlSousFamille = "SELECT idSousFamille_Type, nomSousFamilleType
                     FROM db_project_pyrobel.sousfamille_type";

  // Usine
  $sqlUsine = "SELECT idUsine, nomUsine
               FROM db_project_pyrobel.usine";
  $queryUsine = $db->query($sqlUsine);

  // Zone
  $sqlZone = "SELECT idZone, description
              FROM db_project_pyrobel.zone";
  $queryZone = $db->query($sqlZone);

  // Rack
  $sqlRack = "SELECT idRack, description
              FROM db_project_pyrobel.rack";
  $queryRack = $db->query($sqlRack);

/*  switch ($addWord) {
    case 'sousfamille':
    //$querySousFamille = $db->query($sqlSousFamille);
        echo "<select name='sousFamille' class='custom-select' size='1' >";
        foreach ($querySousFamille as $famille){
            echo "<option name='sousFamille' value='".$famille['idSousFamille_Type']."'>".$famille['nomSousFamilleType']."</option>";
          }
        echo "<select>"; 
        break;
    case 'zone':
      echo "zone test";
      break;
    default:
      echo "default value.";
  }*/


  switch ($addWord) {
    case "sousfamille":
        echo "<select name='sousFamille' class='custom-select' size='1' >";
        echo "</select>";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "default value, fucking doesn't work!";
}
}
