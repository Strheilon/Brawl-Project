<?php

require 'PhpMyAdmin/connexion.php';

// ajout d'un match à la base de donnée
if (isset($_POST['match']) && isset($_POST['player']) && isset($_POST['player_win'])) {
    $player = explode(",", $_POST['player']);
    for ($i=0; $i < count($player); $i++) {
        $create = $pdo->prepare("
            SELECT Pseudo
            FROM player
            WHERE Pseudo = ?
        ");

        $create->execute([$player[$i]]);
        $post = $create->fetch();

        //ajout d'un joueur s'il n'est pas dans la base de donnée
        if ($post == false) {
            $game = $pdo->prepare("
                INSERT INTO player(Pseudo)
                VALUES(:Pseudo)
            ");

            $game->bindValue(':Pseudo', $player[$i]);
            $game->execute();
        }
    }

//faire un for

    for ($j=0; $j < count($player); $j++) {
        $match = $pdo->prepare("
            SELECT *
            FROM player
        ");
    }
    //ajout d'une victoire ou d'une défaite


    $match->execute();
    $post = $match->fetch();

    /*$game = $pdo->prepare("
        INSERT INTO player(Pseudo)
        VALUES(:Pseudo)
    ");

    $game->bindValue(':Pseudo', $player[$i]);
    $game->execute();*/

    //ajout à la base de donnée
    $statement = $pdo->prepare("
        INSERT INTO match_brawl(Name, Id_Player, Id_Victory)
        VALUES(:Name, :Id_Player, :Id_Victory)
    ");

    $statement->bindValue(':Name', $_POST['match']);
    $statement->bindValue(':Id_Player', $_POST['player']);
    $statement->bindValue(':Id_Victory', $_POST['player_win']);
    $statement->execute();

    header('Location: index.php');
    exit();
}

$template = 'match';
include 'src/layout.phtml';
