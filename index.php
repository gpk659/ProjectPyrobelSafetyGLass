<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 03-09-18
 * Time: 11:56
 */

require 'dbConnect.php';
session_start();
//$_SESSION['pseudo'];
//$_SESSION['id'];
$message ='';

if(isset($_SESSION["pseudo"])){header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');}

$sql='SELECT username FROM db_project_pyrobel.user';

$listUser=$db->query($sql);

if(isset($_SESSION["pseudo"])){
    header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');
}
/*if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
{
    $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>';
}*/
if($_POST) //On check le mot de passe
{
    $query=$db->prepare('SELECT iduser, username, password
        FROM db_project_pyrobel.user WHERE username = :pseudo');
    $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
    $query->execute();
    $data=$query->fetch();
    if ($data['password'] == $_POST['password']) // Acces OK !
    {
        $_SESSION['pseudo'] = $data['username'];
        $_SESSION['id'] = $data['iduser'];
        //$message = '<p>Bienvenue '.$data['username'].',vous êtes maintenant connecté!</p>';
        header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');
        exit();
    }else if($data['password'] != $_POST['password']) // Acces pas OK !
    {$message = '<p class="errorlogin">Une erreur s\'est produite pendant votre identification.<br /> Le mot de passe entré n\'est pas correct.'; //message mdp incorrect
    }else {$message = '<p class="errorlogin">error autre</p>';}

    $query->CloseCursor();
}
//echo $message;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Safety Glass Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="CSS/util.css">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
            <form class="login100-form validate-form" method="post" action="index.php">
					<span class="login100-form-title p-b-70">
						Connexion
					</span>
                <span class="login100-form-avatar">
						<img src="images/banner.png" alt="AVATAR">
                </span>
                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
                    <!--<input class="input100" type="text" name="pseudo">-->
                    <?php
                        echo "<select name='pseudo' class=\"input100\" size='1'>";
                            foreach ($listUser as $item){ echo "<option name='pseudo' value='".$item['username']."' id='".$item['idUser']."'>".$item['username']."</option>";}
                        echo "</select>";
                    ?>
                    <!--<span class="focus-input100" data-placeholder="Username"></span>-->
                </div>

                <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                    <input class="input100" type="password" name="password" required>
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>
                <div>
                    <?php echo $message; ?>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Se connecter
                    </button>
                </div>
                </ul>
            </form>
        </div>
    </div>
</div>
<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>

<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
