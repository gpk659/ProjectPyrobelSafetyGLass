<?php
  session_start();
  include 'secure.php';
  require "../dbConnect.php";
  include_once 'newRequests.php';

  $idVol = $_GET['idVol'];

  function rendementEst($lgVol, $lgChute, $htVol, $htChute){
    global $codeCss;
    $rendement=(($lgVol+$htVol)*2)/(($lgChute+$htChute)*2)*100;
    echo round($rendement);
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */ include_once "menu.php"; ?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />

<?php /*echo "ID Volume : " . $idVol;*/
$hauteur;
$largeur;
$numerocom;
$numlettre;
$sqlUseVol = "SELECT idListeVolume,numCom,lettre,x,nnn,datelivraison,typeverre,largeur,hauteur,faconnage,commentaire,chutesug
              FROM safetyglass_db.listevolume
              WHERE idListeVolume = ".$idVol;

$listUseVol = $db->query($sqlUseVol);

foreach ($listUseVol as $row) {
  $qte=$row['nnn'] ."/". $row['x'];
  $numcom=$row['numCom'] ." ". $row['lettre'];
  $numerocom=$row['numCom'];
  $numlettre=$row['lettre'];
  $idVol=$row['idListeVolume'];
  $hauteur=$row['hauteur'];
  $largeur=$row['largeur'];
  echo "<button type='button' class='backUseVol'> < Retour </button>
  <div class='useVolContainer'>
          <div class='useVolinfo'>
          <h5>Détails Volume :</h5>
          <li><span>Num Commande :</span> $numcom</li>
          <li><span>Qté :</span> $qte</li>
          <li><span>Date Livraison :</span> ".$row['datelivraison']."</li>
          <li><span>Type :</span> ".$row['typeverre']."</li>
          <li><span>Largeur : </span>".$row['largeur']."</li>
          <li><span>Hauteur :</span> ".$row['hauteur']."</li>
          <li><span>Façonnage :</span> ".$row['faconnage']."</li>
          <li><span>Commentaire :</span> ".$row['commentaire']
          ."</li></div>";
}
?>
          <div class="useVolchutes">
            <h5>Chutes à utiliser :</h5>
            <table id="usevoltable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Chute</th>
                        <th>Hauteur</th>
                        <th>Largeur</th>
                        <th>Date Mise en Stock</th>
                        <th>Commentaire</th>
                        <th>Rendement</th>
                        <th>Emplacement</th>
                        <th>Position</th>
                        <th></th>
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
                                    and plateau_idPlateau = idPlateau
                                    and (listchutte.largeur  >= '$largeur' and listchutte.hauteur >= '$hauteur')";

                      $listChute = $db->query($sql);

                          foreach ($listChute as $row) {
                            $idchute=$row['idChutte'];
                            $ht=$row['ht'];
                            $lg=$row['lg'];
                            $cmt='fait';
                            $datefab=date('Y-m-d');
                                  echo "<tr id=".$row['idChutte'].">
                                          <td>".$row['idChutte']."</td>
                                          <td>" . $row['ht'] . "</td>
                                          <td>" . $row['lg'] . "</td>
                                          <td>" . $row['dateMiseStock'] . "</td>
                                          <td>" . $row['cmt'] . "</td>
                                          <td>";
                                          rendementEst($largeur, $row['lg'], $hauteur, $row['ht']);

                                          echo " %</td>
                                          <td>".$row['rack']."</td>
                                          <td>" . $row['positionEmp'] . "</td>
                                          <td>
                                          <td> <a href='usevolchute.php?idChutte=$idchute&idVol=$idVol&ht=$ht&lg=$lg&date=$datefab&cmt=$cmt&numcom=$numerocom&lettre=$numlettre'>Utiliser</a> </td>";
                              }
                  ?>
                </tbody>
            </table>
          </div>
        </div>
