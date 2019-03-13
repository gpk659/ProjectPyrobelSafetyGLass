<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   * Date: 04-09-18
   * Time: 16:15
   */
  session_start();
  include 'secure.php';
  require "../dbConnect.php";
  include_once 'newRequests.php';
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

  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'addVol')"> Ajouter un volume </button>
    <button class="tablinks" onclick="openCity(event, 'listVol')"> Liste volume </button>
    <button class="tablinks" onclick="openCity(event, 'listVolBon')"> Liste volumes faits </button>
  </div>


<div id="addVol" class="tabcontent"> <!-- Formulaire ajouter un volume -->
  <form action="index.html" method="post">
    <fieldset class="form_add">
      <legend> Ajout Volume </legend>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">NumCom</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="numCom" placeholder="Ex : 18,12345" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Qté totale de volume identique (x)</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" name="quantite" placeholder="x" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Numéro de ce volume dans la série (nnn)</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" name="numvol" placeholder="nnn" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Lettre</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="lettre" placeholder="Lettre" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Largeur</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" step="1" min="1" name="largeur" placeholder="Largeur (mm)" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Hauteur</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" step="1" min="1" name="hauteur" placeholder="Hauteur (mm)" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Façonnage</label>
        <div class="col-sm-10">
            <input class="form-control" type="textarea" name="faconnage" placeholder="Façonnage">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Commentaire</label>
        <div class="col-sm-10">
            <input class="form-control" type="textarea" name="comment" placeholder="Commentaire">
        </div>
      </div>

      <div class="boutonsubmit">
          <input type="submit" class="btn btn-primary" value="Ajouter">
      </div>
    </fieldset>
  </form>
</div>

<div id="listVol" class="tabcontent"> <!-- Tableau des volumes à faire -->
  <div class="statusvol">
    <table class="statustable">
      <tbody>
        <tr>
          <td></td>
          <td class="stylestatus">Urgent</td>
          <td class="stylestatus">J+1</td>
          <td class="stylestatus">J+2</td>
          <td class="stylestatus">J+3</td>
          <td class="stylestatus">J>3</td>
        </tr><tr>
          <td>Nb </td>
          <td class="stylestatus">1</td>
          <td class="stylestatus">2</td>
          <td class="stylestatus">3</td>
          <td class="stylestatus">4</td>
          <td class="stylestatus">5</td>
        </tr>
      </tbody>
    </table>
  </div>
  <h4 id="titrevol" class="listchuttex">Liste volumes à couper</h4>
  <table id="tableVolToDo" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Num Commande</th>
        <th>Qté</th>
        <th>Date Livraison</th>
        <th>Type Verre</th>
        <th>Largeur</th>
        <th>Hauteur</th>
        <th>Façonnage</th>
        <th>Commentaire</th>
        <th>Chute(s) suggérée(s)</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
          $sqllistvol = "SELECT idListeVolume,numCom,lettre,x,nnn,datelivraison,typeverre,largeur,hauteur,faconnage,commentaire,chutesug
                         FROM safetyglass_db.listevolume
                         ORDER BY numCom";
          $listVol = $db->query($sqllistvol);

              foreach ($listVol as $row) {

              $qte=$row['nnn'] ."/". $row['x'];
              $numcom=$row['numCom'] ." ". $row['lettre'];
              $idVol=$row['idListeVolume'];

                      echo "<tr class='lignetab'>
                              <td id=$idVol>$numcom</td>
                              <td>$qte</td>
                              <td>" . $row['datelivraison'] . "</td>
                              <td>" . $row['typeverre'] . "</td>
                              <td>" . $row['largeur'] . "</td>
                              <td>" . $row['hauteur'] . "</td>
                              <td>" . $row['faconnage'] . "</td>
                              <td>" . $row['commentaire'] . "</td>
                              <td>" . $row['chutesug'] . "</td>
                              <td><a href='usevol.php?idVol=".$idVol."'>Produire</a></td>
                              <td><button class=\"buttonvol\" type=\"button\" name=\"button\" onclick=\"deleteVol('$numcom','$qte','$idVol');\">Supprimer</button></td>
                              </tr>";
                  }
                  /* Utiliser : call a php sql script to use it */
                  /* Supprimer : call a php function with confirmation to delete */

      ?>
    </tbody>
  </table>
</div>
<div id="listVolBon" class="tabcontent"> <!-- Tableau des volumes faits -->
  <h4 class="listchuttex">Liste volumes faits</h4>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Num Commande</th>
        <th>Lettre</th>
        <th>Date Livraison</th>
        <th>Largeur</th>
        <th>Hauteur</th>
        <th>Commentaire</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $sqllistvolbon = "SELECT numCom,lettre,largeur,hauteur,datefabrication, commentaire
                          FROM safetyglass_db.listevolumesbons;";
          $listVolbon = $db->query($sqllistvolbon);

              foreach ($listVolbon as $row) {

                      echo "<tr class='lignetab'>
                              <td scope=\"row\">" . $row['numCom'] . "</td>
                              <td>" . $row['lettre'] . "</td>
                              <td>" . $row['datefabrication'] . "</td>
                              <td>" . $row['largeur'] . "</td>
                              <td>" . $row['hauteur'] . "</td>
                              <td>" . $row['commentaire'] . "</td>
                              </tr>";
                  }
      ?>
    </tbody>
  </table>
</div>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
