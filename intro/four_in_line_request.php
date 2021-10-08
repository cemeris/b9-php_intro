<?php

header('content-type: application/json');


if (isset($_GET['reset']) && $_GET['reset'] === "true") {
    $moves = [];
    resetGame();
}
elseif (
    isset($_GET['r']) && array_key_exists($_GET['r'], array_flip([1,2,3,4,5,6,7,8,9,10])) &&
    isset($_GET['c']) && array_key_exists($_GET['c'], array_flip([1,2,3,4,5,6,7,8,9,10]))
) {
    $moves = getGameState();
    $has_winner = isset($moves['win_symbol']);

    if (!$has_winner) {
        $r = (int)$_GET['r'];
        $c = (int)$_GET['c'];
        if (
            $r == 10 ||
            (isset($moves[$r + 1]) && isset($moves[$r + 1][$c]))
        ) {
            if (!isset($moves[$r]) || !isset($moves[$r][$c])) {
                if (!isset($moves['count']) || $moves['count'] % 2 == 0) {
                    $symbol = 'x';
                }
                else {
                    $symbol = 'o';
                }
                saveGameState($r, $c, $symbol, $moves);

                $winner = checkWinner($r, $c, $moves);
                if ($winner !== false) {
                    saveWinner($winner, $moves);
                }
            }
        }
    }
}
else {
    $moves = getGameState();
}

$output = [
    'status' => true
];

$output['buttons'] = '';
for($r = 1; $r <= 10; $r++) {
    for ($c = 1; $c <= 10; $c++) {
        $symbol = '';
        if (isset($moves[$r][$c])) {
            $symbol = $moves[$r][$c];
        }

        $class="";
        if (
            isset($moves['win_coords'][$r]) &&
            array_key_exists($c, $moves['win_coords'][$r])
        ) {
            $class="class='win_move'";
        }

        $output['buttons'] .= "<a href='?r=$r&c=$c' $class>$symbol</a>";
    }
}


$has_winner = isset($moves['win_symbol']);
if ($has_winner) {
    $output['message'] = "Winner is " . $moves['win_symbol'] . "!";
}

echo json_encode($output, JSON_PRETTY_PRINT);



/**
 * @return mixed
 *  ['coords'=> [10, 2], [10, 3], ...], 'symbol' => ('x' || 'o')] ||
 *  false
 */
function checkWinner($r, $c, $moves) {
    $symbol = $moves[$r][$c];

    $win_directions = [
        [[0,1], [0,-1]], // Horizontal
        [[1,0]], // Vertical
        [[-1,1], [1,-1]], // Dioganal 1 
        [[-1,-1], [1,1]], // Dioganal 2 ↘︎
    ];


    foreach ($win_directions as $direction) {
        $count = 0;
        $win_coords = [];
        foreach ($direction as $vector) {
            $matches = getMatches($r, $c, $moves, $vector);
            $count += $matches['count'];

            foreach ($matches['coords'] as $coordinate) {
                $win_coords[$coordinate[0]][$coordinate[1]] = null;
            }
        }
        if ($count >= 3) {
            $win_coords[$r][$c] = null;
            return [
                "symbol" => $symbol,
                "coords" => $win_coords
            ];
        }
    }

    return false;
}

/**
 * Saskaita gājiena simbolu skaitu noteiktajā virzienā
 * 
 * @param int $r
 * @param int $c
 * @param array $moves
 * @param array $vector
 * 
 * @return array 
 *  [
 *    'coords' => $coords,
 *    'count' => $count
 *  ]     
 * 
 * $coords = [[10, 2], [10, 3], ...]    
 */
function getMatches(int $r, int $c, array $moves, $vector) {
    $symbol = $moves[$r][$c];
    $count = 0;
    $coords = [];
    for ($i = 1; $i <= 3; $i++) {
        if (@$moves[$r += $vector[0]][$c += $vector[1]] == $symbol) {
            $count++;
            $coords[] = [$r, $c];
        }
        else {
            return [
                'coords' => $coords,
                'count' => $count
            ];
        }
    }

    return [
        'coords' => $coords,
        'count' => $count
    ];
}


/**
 * Saglabās gājienu ("x" vai "o" vērtību) failā un pievienot viņu iekš $data masīva
 * @param $r
 * @param $c
 * @param string $symbol
 * @param array &$data
 */
function saveGameState(int $r, int $c, string $symbol, array &$data) {
    $file_name = "fourinline_data.json";

    $data[$r][$c] = $symbol;

    if (isset($data['count'])) {
        $data['count']++;
    }
    else {
        $data['count'] = 1;
    }

    $json_value = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file_name, $json_value);
}

function saveWinner(array $winner, array &$data) {
    $file_name = "fourinline_data.json";

    $data['win_symbol'] = $winner['symbol'];
    $data['win_coords'] = $winner['coords'];
    
    $json_value = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file_name, $json_value);
}

/**
 * Dabūs masīvu ar visiem iepriekšējiem gājieniem no datu faila
 * @return array - masīvs ar "x", "o" vērtībām noteiktajās koordinātēs
 */
function getGameState() {
    $file_name = "fourinline_data.json";
    if (file_exists($file_name)) {
        $json_value = file_get_contents($file_name);
        $data = json_decode($json_value, true);
        return $data;
    }
    return [];
}

/**
 * Attiestāda datu saturu uz tukšu masīvu json formātā
 */
function resetGame() {
    $file_name = "fourinline_data.json";
    $json_value = "{}";
    file_put_contents($file_name, $json_value);
}