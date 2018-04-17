<?php

require 'PhpMyAdmin/connexion.php';

// ajout d'un produit
if (isset($_POST['pseudo'])) {
    $statement = $pdo->prepare("
        INSERT INTO player(Pseudo)
        VALUES(:Pseudo)
    ");

    $statement->bindValue(':Pseudo', $_POST['pseudo']);
    $statement->execute();

    header('Location: index.php');
    exit();
}

$template = 'player';
include 'src/layout.phtml';
