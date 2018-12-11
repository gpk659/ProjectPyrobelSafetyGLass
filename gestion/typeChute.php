<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 10-09-18
 * Time: 22:49
 */
require '../dbConnect.php';
/* requete sql pour afficher les types de chutes */

$sql="SELECT idTypeChute, nomTypeChute FROM mydb.typechute";


// SQL pour les types
$resulttype=$db->query($sql);

//SQL pour les sous types avec le type selectionné
//$resultsoustype=$db->query($sqlstype);

//foreach ($resulttype as $row){
   /* echo "<p>".$row['idTypeChute']. "\t";
    echo $row['nomTypeChute']. "\t </p>";*/
    //$group=$row['nomTypeChute'];

    $sqlstype=" SELECT idSousTypeChute, CONCAT (nomTypeChute,' - ',nomSousTypeChute) as nomStype
    FROM mydb.soustypechute INNER JOIN mydb.typechute
    ON idTypeChute = fk_typeChute ";
    $resultsoustype=$db->query($sqlstype);

/*
    echo " <label for=\"typeChoice".$row['idTypeChute']."\">".$row['nomTypeChute']."</label>
            <input type='radio' name='typechute' value=".$row['nomTypeChute']." required>";*/

    echo "<select class=\"form-control\" id='typechute' name='stype' size='1'>
            <option name='sousType' value='' disabled selected hidden>Selectionner un type...</option>";

    foreach ($resultsoustype as $item){
        echo " <option name='sousType' value=".$item['idSousTypeChute']." id=".$item['idSousTypeChute'].">".$item['nomStype']."</option>";
    }
    echo "</select>";

//}




