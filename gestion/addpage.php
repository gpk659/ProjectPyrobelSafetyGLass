<?php
    /**
     * Created by PhpStorm.
     * User: Grégory
     * Date: 27-09-18
     * Time: 01:27
     */

    session_start();
    include 'secure.php';
    require "../dbConnect.php";
  //  require "inc.requestsAdd.php";


    function addItem($addWord){
      require "../dbConnect.php";

      /* emplacement  */
      $sqlEmp = "SELECT idEmplacement, description
                 FROM safetyglass_db.emplacement";
      $listEmpAdd = $db->query($sqlEmp);

      // sous famille liste
      $sqlSousFamille = "SELECT idSousFamille_Type, nomSousFamilleType
                         FROM safetyglass_db.sousfamille_type";

      // Usine
      $sqlUsine = "SELECT idUsine, nomUsine
                   FROM safetyglass_db.usine";
      $queryUsine = $db->query($sqlUsine);

      // Zone
      $sqlZone = "SELECT idZone, description
                  FROM safetyglass_db.zone";
      $queryZone = $db->query($sqlZone);

      // Rack
      $sqlRack = "SELECT idRack, description
                  FROM safetyglass_db.rack";
      $queryRack = $db->query($sqlRack);

/*  foreach ($querySousFamille as $famille){
      echo "<option name='sousFamille' value='".$famille['idSousFamille_Type']."'>".$famille['nomSousFamilleType']."</option>";
    }
    */

      switch ($addWord) {
        case "sousfamille":
            echo "<select name='sousFamille' class='custom-select' size='1' >";
              foreach ($querySousFamille as $famille){
                echo "<option name='sousFamille' value='".$famille['idSousFamille_Type']."'>".$famille['nomSousFamilleType']."</option>";
              }
            echo "</select>";
            break;
        case "zone":
            echo "<select class='custom-select' name='listZone' size='1'>";
              foreach ($queryZone as $item){
                echo "<option name='zone' value='".$item['idZone']."'>".$item['description']."</option>";
              }
            echo "</select>";
            break;
        case "usine":
            echo "<select class='custom-select' name='usine' size='1'>";
              foreach ($queryUsine as $item){
                echo "<option name='usine' value='".$item['idUsine']."'>".$item['nomUsine']."</option>";
              }
            echo "</select>";
            break;
        case "rack":
            echo "<select class='custom-select' name='rack' size='1'>";
              foreach ($queryRack as $item){
                echo "<option name='rack' value='".$item['idRack']."'>".$item['description']."</option>";
              }
            echo "</select>";
            break;
        default:
            echo "default value, fucking doesn't work!";
    }
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */ include_once("menu.php"); ?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<main>
  <hr />
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'addUser')"> Ajout User </button>
        <button class="tablinks" onclick="openCity(event, 'addType')"> Ajout Type </button>
        <button class="tablinks" onclick="openCity(event, 'addRack')"> Ajout Rack </button>
        <button class="tablinks" onclick="openCity(event, 'addEmp')"> Ajout Emplacement </button>
    </div>

    <div id="addUser" class="tabcontent">
        <form action="add/addUser.php" method="post">
            <fieldset class="form_add">
                <!-- Menu ajout user -->
                <legend>Ajouter un utilisateur</legend>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Nom utilisateur</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="userName" placeholder="Nom Utilisateur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Confirmation mot de passe</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password_conf" placeholder=" Confirmation Mot de passe" required>
                    </div>
                </div>
                <div class="boutonsubmit">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </fieldset>
        </form>
    </div>
    <div id="addType" class="tabcontent">
        <form action="add/addType.php" method="post">
            <fieldset class="form_add">
                <!-- Menu ajout type -->
                <legend>Ajouter un type</legend>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nom Type :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nomType" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Epaisseur :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="epType" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kg/m² :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="masseType" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Code AGC :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="codeAGCType" required>
                    </div>
                </div>
                <div class="form-group row"><!-- Liste -option- type sous famille -->
                    <label class="col-sm-2 col-form-label">Nom sous famille :</label>
                    <div class="col-sm-10">
                      <?php addItem('sousfamille'); ?>
                    </div>
                </div>
                <div class="boutonsubmit">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </fieldset>
        </form>
    </div>
    <div id="addRack" class="tabcontent">
        <form action="add/addRack.php" method="post">
            <fieldset class="form_add">
                <!-- Menu ajout rack -->
                <legend>Ajouter un rack</legend>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Abréviation :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="abrev" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Nom Position :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nomPos" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Description :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="desc" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Largeur :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="largeur" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Longueur :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="longeur" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">X0 :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="xo" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Y0 :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="yo" required>
                    </div>
                </div>

                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Zone :</label>
                    <div class="col-sm-10">
                        <?php addItem('zone'); ?>
                    </div>
                </div>
                <div class="boutonsubmit">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </fieldset>
        </form>
    </div>
    <div id="addEmp" class="tabcontent">
        <form action="add/addEmp.php" method="post">
            <fieldset class="form_add">
                <!-- Menu ajout emplacement usine -->
                <legend>Ajouter emplacement usine</legend>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description emplacement :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="description" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Largeur pieds :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="largeur" min='0' required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Poids max :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="poids" min='0' required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Usine :</label>
                    <div class="col-sm-10">
                      <?php addItem('usine'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Zone :</label>
                    <div class="col-sm-10">
                    <?php addItem('zone'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Rack :</label>
                    <div class="col-sm-10">
                    <?php addItem('rack'); ?>
                    </div>
                </div>
                <div class="boutonsubmit">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </fieldset>
        </form>
    </div>
</main>


<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
