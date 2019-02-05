<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 26-09-18
 * Time: 17:28
 */
session_start();
include 'secure.php';

require '../dbConnect.php';

/*
UPDATE table
SET nom_colonne_1 = 'nouvelle valeur'
WHERE condition
    => $_GET['modifRack']
*/
