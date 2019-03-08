<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 16:15
 */
session_start();
include 'secure.php';
$_SESSION['rack']="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */
include_once "menu.php";
?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />
<form method="get" action="deplacement.php" >
    <fieldset>
        <legend>Recherche</legend>

        <label class="labelchute">Dimensions : </label>
        <div class="form-row">
            <div class="col">
                <input class="form-control" type="number" name="hauteur" placeholder="hauteur chute">
            </div>
            <div class="col">
                <input class="form-control" type="number" name="largeur" placeholder="largeur chute">
            </div>
        </div>

        <div class="form-group">
            <label class="labelchute">Rack : </label>
            <input class="form-control" type="text" name="rack" placeholder="numéro rack">
        </div>
        <div class="form-group">
            <label class="labelchute">Type chute :</label>
            <?php include 'typeChute.php'; ?>
        </div>
        <div class="boutonsubmit">
            <input type="submit" class="btn btn-primary" value="Rechercher">
        </div>
    </fieldset>
</form>
<h3 class="listechute">Modification</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Chute</th>
        <th scope="col">Hauteur</th>
        <th scope="col">Largeur</th>
        <th scope="col">Numéro du lot</th>
        <th scope="col">Date</th>
        <th scope="col">Position</th>
        <th scope="col">Emplacement</th>
        <th scope="col">Type</th>
        <th scope="col">Sous type</th>
        <th scope="col">Rack</th>
        <th scope="col">Modif rack</th>


    </tr>
    </thead>
    <tbody>
<?php
    /**
     * Created by PhpStorm.
     * User: Grégory
     * Date: 11-09-18
     * Time: 17:51
     */
    require '../dbConnect.php';

    if(isset($_GET['hauteur']) || isset($_GET['rack'])) {
        $hauteur = $_GET['hauteur'];
        $largeur = $_GET['largeur'];
        $rack = $_GET['rack'];
        $typechute = $_GET['stype'];

        $sql = "SELECT nomChute, hauteur, largeur, numLot, dateChute, numRack, nomEmplacement, nomTypeChute, nomSousTypeChute, positionEmplacement, idSousTypeChute
                   FROM mydb.placement as p,
                         mydb.emplacement as e,
                         mydb.rack as r,
                         mydb.emplacementUsine as eu,
                         mydb.chute as c,
                         mydb.type as t,
                         mydb.soustypechute as stc,
                         mydb.typechute as tc

                    WHERE  p.emplacement_idEmplacement = e.idEmplacement
                       and p.rack_idRack = r.idRack
                       and p.emplacementusine_idEmplacementUsine = eu.idEmplacementUsine
                       and c.fk_placement = p.idPlacement
                       and c.type_idType = t.idType
                       and t.sousTypeChute_idSousTypeChute = stc.idSousTypeChute
                       and t.typeChute_idTypeChute = tc.idTypeChute
                       and ((numRack = '".$rack."') or (hauteur = '".$hauteur."') or (largeur='".$largeur."') or (idSousTypeChute='".$typechute."'))
                    ORDER BY dateChute";

        $stmt=$db->prepare($sql);
        $stmt->execute();
        $listChute=$stmt->setFetchMode(PDO::FETCH_ASSOC);
        $listChute=$stmt->fetchAll();
        //var_dump($listChute);

        //print_r($listChute);

       //$count = $listChute->rowCount();

        $rackSql="SELECT idRack,numRack FROM mydb.rack";
        //$listRack=$db->query($rackSql);

        $test=$db->prepare($rackSql);
        $test->execute();
        $listRack=$test->setFetchMode(PDO::FETCH_ASSOC);
        $listRack=$test->fetchAll();

        //print_r($listRack);

        foreach ($listChute as $row) {
            if ($_GET['hauteur'] == $row['hauteur'] || $_GET['largeur'] == $row['largeur'] || $_GET['rack'] == $row['numRack'] || $_GET['stype'] == $row['idSousTypeChute'] ){
                echo "<tr class='lignetab'>
                                    <td scope=\"row\">" . $row['nomChute'] . "</td>
                                    <td>" . $row['hauteur'] . "</td>
                                    <td>" . $row['largeur'] . "</td>
                                    <td>" . $row['numLot'] . "</td>
                                    <td>" . $row['dateChute'] . "</td>
                                    <td>" . $row['positionEmplacement'] . "</td>
                                    <td>" . $row['nomEmplacement'] . "</td>
                                    <td>" . $row['nomTypeChute'] . "</td>
                                    <td>" . $row['nomSousTypeChute'] . "</td>
                                    <td>" . $row['numRack'] . "</td>";
                $_SESSION['rack']=$row['numRack'];
            }else {
                echo "<p style='color:red'>error</p>";
            }
            ?>
            <form action='edit.inc.php' method='post'>
            <?php
            echo "<td id='modifrack'><select class=\"form-control \" name='nomRack'>";
            foreach ($listRack as $rack){ echo "<option name='".$rack['numRack']."' value='" .$rack['idRack']. "' id='" .$rack['idRack']. "'>". $rack['numRack'] ."</option>"; }
            echo "</select><input class=\"btn btn-outline-success\" type='submit' value='Modifier'></td></tr>";
            ?>
            </form>

        <?php
        }
    }

?>
    </tbody>
</table>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
