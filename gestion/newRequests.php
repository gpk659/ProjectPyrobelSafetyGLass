<?php
include 'secure.php';
require '../dbConnect.php';

function elementNewLoss($new_r)
{
    require '../dbConnect.php';
    /* Request emplacement new loss */
    $empN="SELECT idEmplacement, nomUsine, u.description,  nomFichierPlan, nomZone, r.nomRack
           FROM  db_project_pyrobel.emplacement as e,
	         db_project_pyrobel.usine as u,
           db_project_pyrobel.zone as z,
           db_project_pyrobel.rack as rs

          WHERE e.usine_idUsine = u.idUsine
          and e.zone_idZone = z.idZone
	        and e.rack_idRack = r.idRack";
    /* Request operateur new loss */
    $opN="SELECT idOperateur, nomOp
          FROM db_project_pyrobel.listeoperateur as l,
          db_project_pyrobel.usine as u,
          db_project_pyrobel.zone as z

          WHERE l.usine_idUsine = u.idUsine
          and l.zone_idZone = z.idZone";
    /* Request plateau new loss*/
    $plateauN="SELECT idPlateau, numPlateau
               FROM db_project_pyrobel.plateau as p,
               db_project_pyrobel.emplacement as e,
               db_project_pyrobel.type as t

               WHERE p.emplacement_idEmplacement = e.idEmplacement
               and p.type_idType = t.idType";

   /* Sql type chute */
   $sqlTypeChute="SELECT idTypeChute, nomTypeChute FROM mydb.typechute";

    switch ($new_r) {
        case 'emp':
            $empSql = $db->query($empN);
            echo "<label for='emp'>Emplacement :</label>";
            echo "<select class=\"form-control\" id='emp' name='emp' size='1'>
                  <option name='emp' value='' disabled selected hidden>Sélectionner un emplacement...</option>";
            foreach ($empSql as $item){
                echo "<option name='emp' value=".$item['idEmplacement'].">".$item['nomUsine']."</option>";
            }
            echo "<select>";
            break;
        case 'op':
            $opSql = $db->query($opN);
            echo "<label for='op'>Opérateur :</label>";
            echo "<select class=\"form-control\" id='op' name='op' size='1'>
                  <option name='op' value='' disabled selected hidden>Sélectionner un opérateur...</option>";
            foreach ($opSql as $item){
                echo "<option name='op' value=".$item['idOperateur'].">".$item['nomOp']."</option>";
            }
            echo "<select>";
            break;
        case 'plateau':
            $plateauSql = $db->query($plateauN);
            echo "<label for='plateau'>Plateau :</label>";
            echo "<select class=\"form-control\" id='plateau' name='plateau' size='1'>
                  <option name='emp' value='' disabled selected hidden>Sélectionner un plateau...</option>";
            foreach ($plateauSql as $item){
                echo "<option name='plateau' value=".$item['idPlateau'].">".$item['numPlateau']."</option>";
            }
            echo "<select>";
            break;
        case 'typechute':
            echo "typechute";
            break;
        default:
            'error';
    }
}
