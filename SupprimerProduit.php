<?php
require './config.php';
$id = $_GET['id'];

$ql = "DELETE FROM memberAchat WHERE  achat=:id";
$statement = $bdd->prepare($ql);
$statement->execute([":id" => $id]);
$ql = "DELETE FROM achat WHERE  id=:id";
$statement = $bdd->prepare($ql);

if ( $statement->execute([":id" =>$id])) {
    header("Location: /gestionchamber/lesProduit.php");
}
    

?>