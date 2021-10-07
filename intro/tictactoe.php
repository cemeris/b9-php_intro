<!doctype html>
<link rel="stylesheet" href="style.css">
<?php
    include "navigation.php";

    /**
     * Uzrakstīt uzvarēšanas gadījuma pārbaudi un
     * ja ir uzvarētājs tad parādīt paziņojumu kurš ir uzvarējis.
     * *1 Uzrakstīt kodu pareizajā vietā.
     * *2 Uzrakstīt pareizu kodu.
     * 
     * - Jāpārbauda kuri lauki ir aizpildīti
     * 
     */

    if (isset($_GET['reset']) && $_GET['reset'] === "true") {
        $moves = [];
        resetGame();
    }
    elseif (
        isset($_GET['id']) &&
        array_key_exists($_GET['id'], array_flip([1,2,3,4,5,6,7,8,9]))
    ) {
        $moves = getMoves();
        $id = $_GET['id'];
        if (!isset($moves[$id])) {
            if (count($moves) % 2 == 0) {
                $symbol = 'x';
            }
            else {
                $symbol = 'o';
            }

            saveMove($id, $symbol, $moves);

            $winner = checkWinner($symbol, $moves);
            if ($winner !== false) {
                echo "Winner is $winner!";
            }
        }
    }
    else {
        $moves = getMoves();
    }
?>

<div class="game_board">
    <?php

    for($i = 1; $i <= 9; $i++) {
        $symbol = '';
        if (isset($moves[$i])) {
            $symbol = $moves[$i];
        }

        echo "<a href='?id=$i'>$symbol</a>";
    }
    ?>
</div>
<a href="?reset=true" class="btn">Reset</a>

<?php

/**
 * @param string $symbol
 * @param array $moves
 * 
 * @return mixed 'x' or 'o' or false
 */
function checkWinner(string $symbol, array $moves) {
    $win_combinations = [
        [1,2,3],
        [4,5,6],
        [7,8,9],

        [1,4,7],
        [2,5,8],
        [3,6,9],

        [1,5,9],
        [3,5,7],
    ];

    foreach ($win_combinations as $combination) {
        if (
            @$moves[$combination[0]] == $symbol &&
            @$moves[$combination[1]] == $symbol &&
            @$moves[$combination[2]] == $symbol
        ) {
            return $symbol;
        }
    }
    
    return false;
}


/**
 * Saglabās gājienu ("x" vai "o" vērtību) failā data.json un pievienot viņu iekš $data masīva
 * @param $id
 * @param string $symbol
 * @param array &$data
 */
function saveMove(int $id, string $symbol, array &$data) {
    $file_name = "data.json";

    $data[$id] = $symbol;

    $json_value = json_encode($data);
    file_put_contents($file_name, $json_value);
}

/**
 * Dabūs masīvu ar visiem iepriekšējiem gājieniem no data.json faila
 * [
 *   "4" => "x",
 *   "5" => "o"
 * ]
 * @return array - masīvs ar "x", "o" vērtībām noteiktajās koordinātēs
 */
function getMoves() {
    $file_name = "data.json";
    if (file_exists($file_name)) {
        $json_value = file_get_contents($file_name);
        $data = json_decode($json_value, true);
        return $data;
    }
    return [];
}

/**
 * Attiestāda faila data.json saturu uz tukšu masīvu json formātā
 */
function resetGame() {
    $file_name = "data.json";
    $json_value = "{}";
    file_put_contents($file_name, $json_value);
}