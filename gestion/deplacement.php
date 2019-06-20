<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   * Date: 04-09-18
   * Time: 16:15
   */
  session_start();
  include 'secure.php';
  require '../dbConnect.php';
  include_once 'newRequests.php';
  $_SESSION['rack']="";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
  <?php include 'head.inc.php'; ?>
  <body>
    <?php /* print_r($_SESSION); */
      include_once "menu.php";
    ?>

    <header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
    <hr />
    <h3 class="listechute">Liste des chutes</h3>
    <table id="modiftable" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th>Id Chute</th>
              <th>Hauteur</th>
              <th>Largeur</th>
              <th>Date Mise en Stock</th>
              <th>Commentaire</th>
              <th id="typelistchute">Type de verre</th>
              <th>Position</th>
              <th>Plateau</th>
              <th>Rack</th>
              <th>Modification Rack</th>
          </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, dateMiseStock, listchutte.commentaire as cmt,
                      positionEmp,plateau_idPlateau, abreviation as rack, numPlateau, descriptionCourte as type, emplacement_idEmplacement as idEmp
              FROM  DB_Pyrobel.listechutte as listchutte,
                    DB_Pyrobel.emplacement as emp,
                    DB_Pyrobel.rack,  DB_Pyrobel.plateau,
                    DB_Pyrobel.type
              WHERE emplacement_idEmplacement = emp.idEmplacement
                    and rack_idRack = idRack
                    and plateau_idPlateau = idPlateau
                    and type_idType = idType";

      //$qte="SELECT count(*) as qte FROM db_pyrobel.listechutte group by emplacement_idEmplacement";

      $listChute = $db->query($sql);
              //print_r($listRack);
              foreach ($listChute as $row) {
                $idemp= $row['idEmp'];

                $sqlnbchutte = "SELECT count(*) as nb
                               FROM DB_Pyrobel.listechutte
                               WHERE emplacement_idEmplacement = $idemp
                               GROUP BY emplacement_idEmplacement";
                $nbchutte = $db->query($sqlnbchutte);

              foreach ($nbchutte as $key) {
                  $nb=$key['nb'];
                
                echo "<tr id=".$row['idChutte'].">
                        <td>".$row['idChutte']."</td>
                        <td>" . $row['ht'] . "</td>
                        <td>" . $row['lg'] . "</td>
                        <td>" . $row['dateMiseStock'] . "</td>
                        <td>" . $row['cmt'] . "</td>
                        <td>" . $row['type'] . "</td>
                        <td>" . $row['positionEmp'] . "/$nb</td>
                        <td>" . $row['numPlateau'] . "</td>
                        <td>" . $row['rack'] . "</td>";
                $_SESSION['rack']=$row['rack'];

                  $rack="SELECT idRack, CONCAT(nomRack ,' - ', r.abreviation) as nomRack
                         FROM  DB_Pyrobel.rack as r,  DB_Pyrobel.zone as z
                         WHERE r.zone_idZone = z.idZone";
                         $rackSql = $db->query($rack);
                         $modifrack='';
                  echo "<td id='modifrack'>";
                  echo "<select class=\"custom-select\" id='rack' name='listerack' size='1'>
                          <option name='rack' value='' disabled selected hidden> Sélectionnez un rack... </option>";
                  foreach ($rackSql as $key) {
                    $modifrack=$row['idRack'];
                      echo "<option name='rack' value=".$key['idRack'].">".$key['nomRack']."</option>";
                  }
                  echo "</select><a href='edit.inc.php'>
                                  <i class='far fa-edit'></i>
                                 </a></td>";
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
