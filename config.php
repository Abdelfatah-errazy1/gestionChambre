<?php
try {
	$bdd= new PDO("mysql:host=localhost;dbname=gestionchambre","root","");
	}catch(PDOException $e){
	echo $e->getMessage();
	}
?>