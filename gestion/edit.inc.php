<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 30-10-18
 * Time: 11:26
 */

require '../dbConnect.php';
session_start();

echo "<p>Rack actuel : ".$_SESSION['rack']."</p>";
echo "<p>Nouveau rack : Rack Mistrello - M2</p>";


?> <a href="deplacement.php">Retour</a>
