<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 25-09-18
 * Time: 11:45
 */
session_start();

require '../../dbConnect.php';
include '../secure.php';

if(empty($_POST['username']) && empty($_POST['password'])){
    echo "Les champs sont vides!";
}else if($_POST['password'] == $_POST['password_conf']) {
    $username = $_POST['userName'];
    $password = $_POST['password'];

    try{
        $sqlAddUser = "INSERT INTO `db_project_pyrobel`.`user` (`username`, `password`) 
                       VALUES ('$username', '$password')";

        $insertUser = $db->query($sqlAddUser);
        header('Location: http://localhost/SafetyGlassProject/addpage.php');
    }catch (PDOException $e){
        echo $sqlAddUser. "<br>". $e->getMessage();
    }
}else{
    echo "<p>Les mots de passes ne sont pas identiques.</p><li><a href='../addpage.php' id=\"acceuil\">Retour</a></li>";
}
