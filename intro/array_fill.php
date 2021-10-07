<!doctype html>

<?php
include "navigation.php";

/*
Piemērs #0
    [0, 0, 0],
    [0, 0, 0],
    [0, 0, 0]
*/
$table = template();
showTable($table, 0);

/*
Piemērs #0++
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8]

    $table[0] = [0, 1, 2];
        $table[0][0] = 0;
        $table[0][1] = 1;
        $table[0][2] = 2;
    $table[1] = [3, 4, 5];
        $table[1][0] = 3;
        $table[1][1] = 4;
        $table[1][2] = 5;
    $table[2] = [6, 7, 8];
        $table[2][0] = 6;
        $table[2][1] = 7;
        $table[2][2] = 8;
*/

$table = template();

$i = 0;
for ($r = 0; $r <= 2; $r++) {
    for ($c = 0; $c <= 2; $c++) {
        $table[$r][$c] = $i++;
    }
}

var_dump($table);
showTable($table, "0++");

/*
Piemērs #1
    [x, x, x],
    [x, x, x],
    [x, x, x]
*/
$table = template();
for ($r = 0; $r <= 2; $r++) {
    for ($c = 0; $c <= 2; $c++) {
        $table[$r][$c] = "x";
    }
}

showTable($table, 1);

/*
Piemērs #2
    [x, 0, x],
    [x, 0, x],
    [x, 0, x]
*/

$table = template();

showTable($table, 2);
/*
Piemērs #3
    [x, x, x],
    [x, x, x],
    [0, 0, 0]
*/
/*
Piemērs #4
    [x, 0, 0],
    [0, x, 0],
    [0, 0, x]

    [0][0]
    [1][1]
    [2][2]
*/

$table = template();

for ($n = 0; $n <= 2; $n++) {
    $table[$n][$n] = "x";
}

showTable($table, 4);
/*
Piemērs #5
    [0, 0, x],
    [0, 0, x],
    [x, x, x]
*/

$table = template();
for ($c = 2; $c >= 0; $c--) {
    for ($r = 2; $r >= 0; $r--) {
        if ($r<2 && $c<2) {
            break;
        }
        $table[$r][$c] = "x";
    }
}

showTable($table, 5);
/*
Piemērs #6
    [6, 0, 5],
    [4, 0, 3],
    [2, 0, 1]
*/
$i = 1;
$table = template();

showTable($table, 6);
/*
Piemērs #7
    [8, 0, 5],
    [3, 0, 2],
    [1, 0, 1]
*/
/*
1+0=1
  0+1=1  
    1+1=2
      1+2=3
        2+3=5
*/

$table = template();

showTable($table, 7);
/*
Piemērs #8
    [5, -1, 1],
    [-8, 2, 0],
    [13, -3, 1]
*/


$table = template();

showTable($table, 8);


/*
Piemērs #9
    [1, 5, 8],
    [1, x, 13],
    [2, 3, 21]
*/

$table = template();

showTable($table, 9);

/*
Piemērs #10
    [a1, a2, a3],
    [b1, b2, b3],
    [c1, c2, c3]
*/

$table = template();

showTable($table, 10);


function template() {
    return [
        [0, 0, 0],
        [0, 0, 0],
        [0, 0, 0]
    ];
};

function showTable($table, $example_number) {
    echo "<h3>Example #$example_number</h3><pre>";
    foreach ($table as $row) {
        foreach ($row as $value) {
            echo $value . "  |  ";
        }
        echo '<br>';
    }
    echo "</pre><br><br>";
}