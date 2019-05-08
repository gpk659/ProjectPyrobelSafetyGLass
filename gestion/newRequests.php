<?php
include 'secure.php';
require '../dbConnect.php';

function elementNewLoss($new_r)
{
    require '../dbConnect.php';
    /* Request emplacement new loss */
    /*$empN="SELECT idEmplacement, nomUsine, u.description,  nomFichierPlan, nomZone, r.nomRack
            FROM  safetyglass_db.emplacement as e, safetyglass_db.usine as u, safetyglass_db.zone as z, safetyglass_db.rack as r
            WHERE e.usine_idUsine = u.idUsine AND e.zone_idZone = z.idZone AND e.rack_idRack = r.idRack";*/
    $empN="SELECT idEmplacement, concat('- Description :  ',description,', Largeur Pied (mm) : ', largeurPied, ', Poids Max (kg) : ' , poidsMax) as infoemp
            FROM safetyglass_db.emplacement";

    /* Request operateur new loss */
    $opN="SELECT idOperateur, nomOp
          FROM safetyglass_db.listeoperateur as l, safetyglass_db.usine as u, safetyglass_db.zone as z
          WHERE l.usine_idUsine = u.idUsine AND l.zone_idZone = z.idZone";
    /* Request plateau new loss*/
    $plateauN="SELECT idPlateau, concat('- Num Cadre : ',numCadre, ', Num Plateau :', numPlateau,', Largeur : ',largeur,', Hauteur : ',hauteur) infoplateau
               FROM safetyglass_db.plateau";
    /* Rack */
    $rack="SELECT idRack, CONCAT(nomRack ,' - ', r.abreviation, ', Zone : ', nomZone) as nomRack
           FROM safetyglass_db.rack as r, safetyglass_db.zone as z
           WHERE r.zone_idZone = z.idZone";

    /* SQL type, soustypechute*/
    $sql="SELECT idType, nomType FROM safetyglass_db.type";
    $resulttype=$db->query($sql);

    $sqlstfamille="SELECT idSousFamille_Type, CONCAT (nomType,' - ',nomSousFamilleType) as nomStype
                   FROM safetyglass_db.sousfamille_type INNER JOIN safetyglass_db.type
                   ON idTypeChute = fk_typeChute";

    /* SQL Type */
    $sqlstype="SELECT idFammille_Type, nomFammille_Type FROM safetyglass_db.fammille_type;";
    $resultsoustype=$db->query($sqlstype);

    /* SQL Sous type */
    $sqlSousType="SELECT idType, concat('Description : ' ,descriptionCourte) as infotype
                  FROM safetyglass_db.type;";
    $resultSStype=$db->query($sqlSousType);

    // Usine
    $sqlUsine = "SELECT idUsine, nomUsine
                 FROM safetyglass_db.usine";
    $queryUsine = $db->query($sqlUsine);

    // Zone
    $sqlZone = "SELECT idZone, nomZone FROM safetyglass_db.zone;";
    $queryZone = $db->query($sqlZone);


    /* emplacement  */
    $sqlEmp = "SELECT idEmplacement, description
               FROM safetyglass_db.emplacement";
    $listEmpAdd = $db->query($sqlEmp);

    // sous famille liste
    $sqlSousFamille = "SELECT idSousFamille_Type, nomSousFamilleType
                       FROM safetyglass_db.sousfamille_type";
    /*
    * SWITCH pour gérer toutes les requetes SQL.
    * en fonction du nom.
    */
    switch ($new_r) {
        case 'emp':
            $empSql = $db->query($empN);
            echo "<label for='emp'> Emplacement : </label>";
            echo "<select class=\"custom-select\" id='emp' name='emp' size='1' required>
                    <option name='emp' value='' disabled selected hidden> Sélectionner un emplacement... </option>";
            foreach ($empSql as $item){
                echo "<option name='emp' value=".$item['idEmplacement'].">".$item['infoemp']."</option>";
            }
            echo "</select>";
            break;
        case 'op':
            $opSql = $db->query($opN);
            echo "<label for='op'> Opérateur : </label>";
            echo "<select class=\"custom-select\" id='op' name='op' size='1' required>
                    <option name='op' value='' disabled selected hidden> Sélectionner un opérateur... </option>";
            foreach ($opSql as $item){
                echo "<option name='op' value=".$item['idOperateur'].">".$item['nomOp']."</option>";
            }
            echo "</select>";
            break;
        case 'plateau':
            $plateauSql = $db->query($plateauN);
            echo "<label for='plateau'> Plateau : </label>";
            echo "<select class=\"custom-select\" id='plateau' name='plateau' size='1' required>
                    <option name='plateau' value='' disabled selected hidden> Sélectionner un plateau... </option>";
            foreach ($plateauSql as $item){
                echo "<option name='plateau' value=".$item['idPlateau'].">".$item['infoplateau']."</option>";
            }
            echo "</select>";
            break;
        case 'rack':
            $rackSql = $db->query($rack);
            echo "<label for='listrack'>Rack : </label>";
            echo "<select class=\"custom-select\" id='rack' name='listerack' size='1' required>
                    <option name='rack' value='' disabled selected hidden> Sélectionnez un rack... </option>";
            foreach ($rackSql as $key) {
                echo "<option name='rack' value=".$key['idRack'].">".$key['nomRack']."</option>";
            }
            echo "</select>";
            break;
        case 'typeChute':
            echo "<label for='stype'> Type :</label>";
            echo "<select class=\"custom-select\" id='typechute' name='stype' size='1' required>
                      <option name='sousType' value='' disabled selected hidden>Sélectionner un type...</option>";
            foreach ($resultsoustype as $item){
                echo " <option name='sousType' value=".$item['idFammille_Type']." id=".$item['idFammille_Type'].">".$item['nomFammille_Type']."</option>";
            }
            echo "</select>";
            break;
        case 'SoustypeChute':
            echo "<label for='stype'> Type de chute :</label>";
            echo "<select class=\"custom-select\" id='typechute' name='stype' size='1' required>
                      <option name='ssousType' value='' disabled selected hidden>Sélectionner un type...</option>";
            foreach ($resultSStype as $item){ /* idType,epType, masseType, codeAGCType, descriptionCourte , descriptionComplete */
                echo " <option name='sousType' value=".$item['idType']." id=".$item['idType'].">".$item['infotype']."</option>";
            }
            echo "</select>";
            break;

        case "zone":
            echo "<select class='custom-select' name='listZone' size='1' required>";
            echo "<option value='' disabled selected>Sélectionner une zone</option>";
              foreach ($queryZone as $item){
                echo "<option name='zone' value='".$item['idZone']."'>".$item['nomZone']."</option>";
              }
            echo "</select>";
            break;
        case "usine":
            echo "<select class='custom-select' name='usine' size='1' required>";
            echo "<option value='' disabled selected>Sélectionner une usine</option>";
              foreach ($queryUsine as $item){
                echo "<option name='usine' value='".$item['idUsine']."'>".$item['nomUsine']."</option>";
              }
            echo "</select>";
            break;
        case "sousfamille":
        $querySousFamille = $db->query($sqlSousFamille);

            echo "<select name='sousFamille' class='custom-select' size='1' required >";
            echo "<option value='' disabled selected>Sélectionner une sous famille</option>";
              foreach ($querySousFamille as $famille){
                echo "<option name='sousFamille' value='".$famille['idSousFamille_Type']."'>".$famille['nomSousFamilleType']."</option>";
              }
            echo "</select>";
            break;
        default:
            'error';
    }
}

//Fonction changement format de la date

function changeDate($dateLivraison){
  $dt = DateTime::createFromFormat('Y-m-d', $dateLivraison);
  echo $dt->format('D d/m');
}
