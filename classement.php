<?php


require 'PhpMyAdmin/connexion.php';

$key = 0;
$value = 10;

$classement = $pdo->prepare("
    SELECT ID, Pseudo, NbMatch, NbVictory, NbDefeat
    FROM player
    ORDER BY NbVictory DESC
");

$classement->execute();
$class = $classement->fetchAll();

$classement = $pdo->prepare("
    SELECT ID, Pseudo, NbMatch, NbVictory, NbDefeat
    FROM player
    ORDER BY NbDefeat DESC
");

$classement->execute();
$defeat = $classement->fetchAll();

$classement = $pdo->prepare("
    SELECT ID, Pseudo, NbMatch, NbVictory, NbDefeat
    FROM player
    ORDER BY NbMatch DESC
");

$classement->execute();
$match = $classement->fetchAll();

$length = count($class)/10;

$template = 'classement';
include 'src/layout.phtml';
