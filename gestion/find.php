<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 16:14
 */
session_start();
include 'secure.php';
require '../dbConnect.php';
include_once 'newRequests.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php';
 ?>
<body>
<?php /* print_r($_SESSION); */
  include_once ("menu.php");
?>
<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />
<main>

    <h4 class="listechute">Liste des chutes</h4>
    <table id="findtable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Hauteur</th>
                <th>Largeur</th>
                <th>Date Mise en Stock</th>
                <th>Commentaire</th>
                <th>Position</th>
                <th>Plateau</th>
                <th>Emplacement</th>
            </tr>
        </thead>
        <tbody>
        <?php


            $sql = "SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, dateMiseStock, listchutte.commentaire as cmt,
                            positionEmp,plateau_idPlateau, concat(nomRack,' - ',abreviation) as rack, numPlateau
                    FROM safetyglass_db.listechutte as listchutte,
                         safetyglass_db.emplacement as emp,
                         safetyglass_db.rack, safetyglass_db.plateau
                    where emplacement_idEmplacement = emp.idEmplacement
                          and rack_idRack = idRack
                          and plateau_idPlateau = idPlateau;";

            $listChute = $db->query($sql);

                foreach ($listChute as $row) {
                        echo "<tr id=".$row['idChutte'].">
                                <td>" . $row['ht'] . "</td>
                                <td>" . $row['lg'] . "</td>
                                <td>" . $row['dateMiseStock'] . "</td>
                                <td>" . $row['cmt'] . "</td>
                                <td>" . $row['positionEmp'] . "</td>
                                <td>" . $row['numPlateau'] . "</td>
                                <td>" . $row['rack'] . "</td>";
                    }


        ?>
        </tbody>
        <tfoot>
          <tr>
              <th>Hauteur</th>
              <th>Largeur</th>
              <th>Date</th>
              <th>Commentaire</th>
              <th>Position</th>
              <th>Plateau</th>
              <th>Emplacement</th>
          </tr>
        </tfoot>

    </table>
</main>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
