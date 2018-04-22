<?php

require 'PhpMyAdmin/connexion.php';

$check = false;
$error = 0;

// ajout d'un match à la base de donnée
if (isset($_POST['match']) && isset($_POST['player']) && isset($_POST['player_win'])) {
    $player = explode(",", $_POST['player']);
    if (count($player) >= 2 && count($player) <=4) {
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
    }

    $victory = $_POST['player_win'];

    for ($i=0; $i < count($player); $i++) {
        if ($player[$i] == $victory) {
            $check = true;
            $pseudo_victory = $pdo->prepare("
                UPDATE player
                SET NbVictory = NbVictory+1
                WHERE Pseudo = ?
            ");

            $pseudo_victory->execute([$victory]);
        } else {
            $pseudo_defeat = $pdo->prepare("
                UPDATE player
                SET NbDefeat = NbDefeat+1
                WHERE Pseudo = ?
            ");

            $pseudo_defeat->execute([$player[$i]]);
        }
        $pseudo_match = $pdo->prepare("
            UPDATE player
            SET NbMatch = NbDefeat+NbVictory
            WHERE Pseudo = ?
        ");

        $pseudo_match->execute([$player[$i]]);
    }



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
}

$template = 'match';
include 'src/layout.phtml';
