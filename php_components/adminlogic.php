<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once __DIR__ . '/../config.php';
$allowtabled = ['users', 'logs', 'personal'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $table = $_POST['value'] ?? '';
    if(!in_array($table, $allowtabled)){
        echo json_encode(['success' => false, 'message' => 'table isn in allowed']);
    }
    AllFetch("SELECT * FROM `$table`");
}

?>