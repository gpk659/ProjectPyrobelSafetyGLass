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
    include_once 'newRequests.php';
  //  require "inc.requestsAdd.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */ include_once("menu.php"); ?>
<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />
<main>
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'addUser')"> Ajout Opérateur </button>
        <button class="tablinks" onclick="openCity(event, 'addType')"> Ajout Type </button>
        <button class="tablinks" onclick="openCity(event, 'addRack')"> Ajout Rack </button>
        <button class="tablinks" onclick="openCity(event, 'addEmp')"> Ajout Emplacement </button>
    </div>
<hr />
    <div id="addUser" class="tabcontent">
        <form action="add/addUser.php" method="post">
            <fieldset class="form_add">
                <!-- Menu ajout user -->
                <legend>Ajouter Un Opérateur</legend>
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
                <legend>Ajouter Un Type</legend>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nom Type</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nomType" placeholder="Nom Type" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Epaisseur</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="epType" placeholder="Epaisseur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kg/m²</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="masseType" placeholder="Kg/m²" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Code AGC</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="codeAGCType" placeholder="Code AGC"  required>
                    </div>
                </div>
                <div class="form-group row"><!-- Liste -option- type sous famille -->
                    <label class="col-sm-2 col-form-label">Nom sous famille</label>
                    <div class="col-sm-10">
                      <?php elementNewLoss('sousfamille'); ?>
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
                <legend>Ajouter Un Rack</legend>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Abréviation</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="abrev" placeholder="Abréviation" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Nom Position</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nomPos" placeholder="Nom Position" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="desc" placeholder="Description" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Largeur</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="largeur" placeholder="Largeur" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Longueur</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="longeur" placeholder="Longueur" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">X0</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="xo" placeholder="XO" required>
                    </div>
                </div>
                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Y0</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="yo" placeholder="YO" required>
                    </div>
                </div>

                <div  class="form-group row">
                    <label class="col-sm-2 col-form-label">Zone</label>
                    <div class="col-sm-10">
                        <?php elementNewLoss('zone'); ?>
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
                <legend>Ajouter Emplacement Usine</legend>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description emplacement</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="description" placeholder="Description emplacement" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Largeur pieds</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="largeur" min='0' placeholder="Largeur pieds" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Poids max</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="poids" min='0' placeholder="Poids max" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Usine</label>
                    <div class="col-sm-10">
                      <?php elementNewLoss('usine'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Zone</label>
                    <div class="col-sm-10">
                    <?php elementNewLoss('zone'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                      <?php elementNewLoss('rack');  ?>
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
