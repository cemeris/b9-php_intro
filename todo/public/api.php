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
    elseif ($_GET['api-name'] === "add") {
        if (isset($_POST['todo-description']) && is_string($_POST['todo-description'])) {
            $output = $todo->add([
                'description' => $_POST['todo-description']
            ]);
        }
        $output['api_name'] = "add";
    }
    elseif ($_GET['api-name'] === "delete") {
        if (isset($_GET['id']) && (int)$_GET['id'] == $_GET['id']) {
            $id = (int) $_GET['id'];
            $output = $todo->delete($id);
        }
        $output['api_name'] = "delete";
    }
}


echo json_encode($output, JSON_PRETTY_PRINT);