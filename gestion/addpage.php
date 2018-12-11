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

    $sqlEmp="SELECT idEmplacementUsine, nomEmplacement FROM mydb.emplacementusine";
    $listEmpAdd = $db->query($sqlEmp);
    /**
     * sous famille liste
     */
    $sqlSousFamille="SELECT idSousFamille_Type, nomSousFamilleType FROM db_project_pyrobel.sousfamille_type;";
    $querySousFamille=$db->query($sqlSousFamille);
    /**
     * Usine
     */
    $sqlUsine="SELECT idUsine, nomUsine FROM db_project_pyrobel.usine;";
    $queryUsine=$db->query($sqlUsine);
    /**
     * Zone
     */
    $sqlZone="SELECT idZone, description FROM db_project_pyrobel.zone;";
    $queryZone=$db->query($sqlZone);
    /**
     * Rack
     */
    $sqlRack="SELECT idRack, description  FROM db_project_pyrobel.rack;";
    $queryRack=$db->query($sqlRack);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */
    include_once("menu.php");
?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<main>
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'ajouter_user')">Ajout user</button>
        <button class="tablinks" onclick="openCity(event, 'addType')">Ajout type</button>
        <button class="tablinks" onclick="openCity(event, 'addRack')">Ajout rack</button>
        <button class="tablinks" onclick="openCity(event, 'addEmp')">Ajout emplacement</button>
    </div>

    <div id="ajouter_user" class="tabcontent">
        <form action="add/addUser.php" method="post">
            <fieldset>
                <!-- Menu ajout user -->
                <legend>Ajouter un utilisateur</legend>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nom utilisateur : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="userName" placeholder="Nom Utilisateur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mot de passe :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirmation mot de passe :</label>
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
            <fieldset>
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
                    <?php
                        echo "<select name='sousFamille' class='custom-select' size='1'>";
                            foreach ($querySousFamille as $item){
                                echo "<option name='sousFamille' value='".$item['idSousFamille_Type']."'>".$item['nomSousFamilleType']."</option>";
                            }
                        echo "</select>";
                    ?>
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
            <fieldset>
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
                        <select class="form-control" name='listZone'>
                        <?php
                        foreach ($queryZone as $item){
                            echo "<option name='zone' value='".$item['idZone']."'>".$item['description']."</option>";
                        }
                        ?>
                        </select>
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
            <fieldset>
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
                        <input class="form-control" type="number" name="largeur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Poids max :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="poids" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Usine :</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="usine" size="1">
                            <?php
                                foreach ($queryUsine as $item){
                                    echo "<option name='usine' value='".$item['idUsine']."'>".$item['nomUsine']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Zone :</label>
                    <div class="col-sm-10">
                            <select class="form-control" name="zone" size="1">
                                <?php
                                foreach ($queryZone as $itemzone){
                                    echo "<option name='zone' value='".$itemzone['idZone']."'>".$itemezone['description']."</option>";
                                }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Rack :</label>
                    <div class="col-sm-10">
                            <select class="form-control" name="rack" size="1">
                                <?php
                                foreach ($queryRack as $item){
                                    echo "<option name='rack' value='".$item['idRack']."'>".$item['description']."</option>";
                                }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="boutonsubmit">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </fieldset>
        </form>
    </div>
</main>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>

