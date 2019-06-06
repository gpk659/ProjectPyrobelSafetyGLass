
<script>
var message = confirm("Est-ce qu'il y a encore une chute ?");
if( message == true ) {
   console.log("ajout d'une chute");
   window.location.replace("http://localhost/SafetyGlassProject/gestion/newloss.php");
} else if(message == false) {
   console.log("pas de chutes restantes");


   window.location.replace("http://localhost/SafetyGlassProject/gestion/listvolume.php");
}
</script>
