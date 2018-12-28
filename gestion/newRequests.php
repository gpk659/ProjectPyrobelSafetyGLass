<?php
include 'secure.php';
require '../dbConnect.php';

function elementNewLoss($new_r)
{
    require '../dbConnect.php';
    /* Request emplacement new loss */
    $empN="
Select idEmplacement, nomUsine, u.description,  nomFichierPlan, nomZone, r.nomRack

from  safetyglass_db.emplacement as e,
	    safetyglass_db.usine as u,
      safetyglass_db.zone as z,
      safetyglass_db.rack as r

where e.usine_idUsine = u.idUsine
      and e.zone_idZone = z.idZone
	    and e.rack_idRack = r.idRack";
    /* Request operateur new loss */
    $opN="
SELECT idOperateur, nomOp
FROM safetyglass_db.listeoperateur as l,
  safetyglass_db.usine as u,
  safetyglass_db.zone as z

where l.usine_idUsine = u.idUsine
      and l.zone_idZone = z.idZone";
    /* Request plateau new loss*/
    $plateauN="
SELECT idPlateau, numPlateau
FROM safetyglass_db.plateau as p,
     safetyglass_db.emplacement as e,
     safetyglass_db.type as t
WHERE p.emplacement_idEmplacement = e.idEmplacement
      and p.type_idType = t.idType";

    switch ($new_r) {
        case 'emp':
            $empSql = $db->query($empN);
            echo "<label for='emp'> Emplacement :</label>";
            echo "<select class=\"custom-select\" id='emp' name='emp' size='1'>
                  <option name='emp' value='' disabled selected hidden>Sélectionner un emplacement...</option>";
            foreach ($empSql as $item){
                echo "<option name='emp' value=".$item['idEmplacement'].">".$item['nomUsine']."</option>";
            }
            echo "</select>";
            break;
        case 'op':
            $opSql = $db->query($opN);
            echo "<label for='op'>Opérateur :</label>";
            echo "<select class=\"custom-select\" id='op' name='op' size='1'>
                  <option name='op' value='' disabled selected hidden>Sélectionner un opérateur...</option>";
            foreach ($opSql as $item){
                echo "<option name='op' value=".$item['idOperateur'].">".$item['nomOp']."</option>";
            }
            echo "</select>";
            break;
        case 'plateau':
            /*$plateauSql = $db->query($plateauN);
            echo "<label for='plateau'>Plateau :</label>";
            echo "<select class=\"form-control\" id='plateau' name='plateau' size='1'>
                  <option name='emp' value='' disabled selected hidden>Sélectionner un plateau...</option>";
            foreach ($plateauSql as $item){
                echo "<option name='plateau' value=".$item['idPlateau'].">".$item['numPlateau']."</option>";
            }
            echo "</select>";*/
            break;
        default:
            'error';
    }
}
