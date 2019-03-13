/*
* Fichier avec le script de la page "Volumes à couper"
*
 */

 function deleteVol(numCom,qte,idVolparam) {
              console.log("Num commande: " + numCom +". Qté: "+ qte);
               var retVal = confirm("Voulez-vous vraiment supprimer le volume suivant : Num commande: "+ numCom +". Qté: "+ qte +" ?");
               if( retVal == true ) {
                  console.log("Suppression en cours...");
                  window.location.replace("http://localhost/SafetyGlassProject/gestion/deleteVol.php?idVol=" + idVolparam);
                  return true;
               } else if(retVal == false) {
                  console.log("Suppression annulée");
                  return false;
               }
            }
