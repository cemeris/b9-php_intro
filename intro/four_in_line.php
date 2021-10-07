<!doctype html>
<link rel="stylesheet" href="style.css">

<?php
    include("navigation.php");
/*
    Spēles noteikumi
    1. Jāsakrai 4 simboli vienā līnijā (rindā, kolonā vai pa dioaganāli)
    2. Var veikt gājienu tikai brīvajās šūnās apakšējā rindā vai tieši virs jau aizpildītās šunas.

    Uzdevuma posmi:
    ✅1. Laukuma izveide
    ✅2. Koordināsu sistēma linkiem
    ✅3. Vai simbols tiek ievietots atļautajā šūnā.
    ✅4. Symbolu ievietošanu klikšņķa brīdī
        ✅4.1 Ieveitot "x"
        ✅4.2 Ievietot pareizo symbolu.
    ✅5. Saglabā gājienus
    ✅6. Izvadīt visus iepriekšējos gājienus.
    ✅7. Reset funkcionalitāte;
    8. Pārbauda vai ir uzvarētājs (vai ir sakrāti 4 simboli)
        8.1. Aprakstīt kombināci (4 rindā, 4 kolonā, 4 pirmajā dioganāle, 4 otrajā dioganālē);
        8.2. Uzvarētāja noteikšana ja ir 4 pēc kārtas rindā.
            8.2.1 Validācija ja pēdējais gājiens ir pa kreisi no iepriekšējiem

    ✅Drīkst sākt aizpildīt no apakšejās līnijas vai
    ✅kad ir ievietots symbols tad var aizpildīt arī virs tā.

    Pirms mēs ievietojam vērtību.
*/

?>

<div class="message">
    <?php
    /*
    $has_winner = isset($moves['win_symbol']);
    
    if ($has_winner) {
        echo "Winner is " . $moves['win_symbol'] . "!";
    }
    */
    ?>

</div>

<div class="game_board four-in-line">

<?php

?>
</div>

<a href="?reset=true" class="btn">Reset</a>

<script src="request.js"></script>
<script src="four_in_line.js"></script>