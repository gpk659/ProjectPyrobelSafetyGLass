/*
* Fichier avec le script de la page "Volumes à couper"
*
 */

 function deleteVol(numCom,qte) {
              console.log("Num commande: " + numCom +". Qté: "+ qte);
               var retVal = confirm("Voulez-vous vraiment supprimer le volume suivant : Num commande: "+ numCom +". Qté: "+ qte +" ?");
               if( retVal == true ) {
                  console.log("Suppression en cours...");
                  window.location.replace("http://localhost/SafetyGlassProject/gestion/deleteVol.php");
                  return true;
               } else {
                  console.log("Suppression annulée");
                  return false;
               }
            }
