
<script>
var message = confirm("Est-ce qu'il y a encore une chute ?");
if( message == true ) {
   console.log("ajout d'une chute");
   window.location.replace("http://localhost/SafetyGlassProject/gestion/newloss.php");
} else if(message == false) {
   console.log("pas de chutes restantes");
</script>
<?php
$id=$_GET['idChutte'];
$idVol=$_GET['idVol'];
$ht=$_GET['ht'];
$lg=$_GET['lg'];
$date=$_GET['date'];
$cmt=$_GET['cmt'];
$numcom=$_GET['numcom'];
$lettre=$_GET['lettre'];
$hfab=$_GET['hfab'];

echo $id;

?>
<script>
   //window.location.replace("http://localhost/SafetyGlassProject/gestion/listvolume.php");

}
</script>
