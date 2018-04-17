<?php

//	Connexion à la base de données
try{
	$pdo = new PDO
	(
		'mysql:host=localhost;dbname=php;charset=UTF8',
		"root",
		'ynov',
	    [
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	    ]
    );
}
catch(PDOException $e){
	die("Erreur: ".$e->getMessage());
}
