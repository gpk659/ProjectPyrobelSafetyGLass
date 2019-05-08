<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   * Date: 04-09-18
   * Time: 16:13
   */
  session_start();
  include 'secure.php';
  include_once 'newRequests.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */
  include_once ("menu.php");
?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />
<main>
    <form id="formnewloss" action="sql_add.php" method="get">
        <fieldset>
            <legend>Ajouter une nouvelle chute</legend>
            <div class="form-group">
                <label for="hauteurcChute">Hauteur :</label>
                <input class="form-control" id="hauteurchute" type="number" name="hauteurChute" min="1" max="3210" step="1" placeholder="Valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="largeurChute">Largeur :</label><input class="form-control" id="largeurchute" type="number" name="largeurChute" min="1" max="2250" step="1" placeholder="Valeur en mm" required>
            </div>
            <div class="form-group">
               <?php elementNewLoss('SoustypeChute'); ?>
            </div>
            <div class="form-group">
                <?php elementNewLoss('rack');  ?>
            </div>
<hr>
            <div class="form-group">
                <?php elementNewLoss('plateau');  ?>
            </div>

            <div>
              <label for="">Nouveau plateau : </label>
              <input type="text" class="form-control" name="numcadre" value="" placeholder="Num Cadre">
              <input type="text" class="form-control" name="numPlateau" value="" placeholder="Num Plateau">
              <input type="text" class="form-control" name="largeur" value="" placeholder="Largeur">
              <input type="text" class="form-control" name="hauteur" value="" placeholder="Hauteur">
            </div>
            <hr>
            <div class="form-group">
                <label>Commentaire :</label>
                <textarea class="form-control" rows="4" cols="70" id="comment" name="comment" placeholder="Votre commentaire ici..." required></textarea>
            </div>
            <!-- dois se faire automatiquement -->
            <!--<div>
                <label>Emplacement dans le rack : </label>
                <input type="number" id="position" name="positionRack" required min="1">
            </div>-->
            <div class="boutonsubmit">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="button" id="printbutton" class="btn btn-primary">Imprimer</button>
            </div>
        </fieldset>
    </form>

</main>
<script>
    $(document).ready(function(){
        $("#printbutton").click(function(){
            //$("#formnewloss").printArea({ mode: 'popup', popClose: true });

            $("#formnewlos").dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Imrprimer ?": function(){
                        $(this).dialog("close");
                    },
                    Cancel: function(){
                        $(this).dialog("close");
                    }
                }
            });
        });
    });
</script>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
