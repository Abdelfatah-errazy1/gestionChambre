<?php
require './config.php';


$statement = $bdd->prepare( "DELETE FROM memberAchat");
$statement->execute();

$statement = $bdd->prepare( "DELETE FROM achat");
$statement->execute();

$statement = $bdd->prepare("update  whatihave set money=0 where 1 ");

if ($statement->execute()) {
    header("Location: /gestionchamber/index.php");
}
    

?>