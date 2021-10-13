<?php
include_once(__DIR__ . '/../private/config.php');

include_once(PRIVATE_DIR . '/class/DB.php');
$todo = new DB('todo_list');

header('Content-type: application/json');

$output = [
    'status' => false
];
if (isset($_GET['api-name'])) {
    if ($_GET['api-name'] === "get-all") {
        $output = $todo->getAll();
        $output['api_name'] = "get-all";
    }
}






echo json_encode($output, JSON_PRETTY_PRINT);