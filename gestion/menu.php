<div id="nav-test">
    <div id="nav-container">
        <ul>
            <li class="nav-li active-nav"><a href='acceuil.php'>Acceuil</a></li>
            <li class="nav-li"><a href='newloss.php'>Ajouter une nouvelle chute</a></li>
            <li class="nav-li"><a href='find.php'>Chercher une chute</a></li>
            <li class="nav-li"><a href='use.php'>Utiliser une chute</a></li>
            <li class="nav-li"><a href='deplacement.php'>Déplacement</a></li>
            <li class="nav-li"><a href='production.php'>Production</a></li>
            <?php
                if($_SESSION['pseudo'] == "admin"){ echo "<li class='nav-li'><a href='addpage.php'>Ajouter</a></li>"; }
            ?>
            <li class="nav-li"><a href='logout.php' >Déconnexion</a></li>
        </ul>
        <div id="line"></div>
    </div>
</div>
