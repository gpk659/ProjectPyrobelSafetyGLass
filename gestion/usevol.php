<?php
  session_start();
  include 'secure.php';
  require "../dbConnect.php";
  include_once 'newRequests.php';

  $idVol = $_GET['idVol'];

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

<?php echo "ID Volume : " . $idVol;
