<?php

if(isset($_GET['rack'])){

  echo "- SQL Modification Rack";

}else if(isset($_GET['chute'])){

  echo "- SQL Modification Chute";

}else if(isset($_GET['plateau'])){

  echo "- SQL Modification Plateau";

}else{
  echo "error";
}
?>


UPDATE `safetyglass_db`.`plateau` SET `largeur` = '32101', `hauteur` = '22501', `nomFournisseur` = 'AGC1' 
WHERE (`idPlateau` = '0');
