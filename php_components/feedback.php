<?php
session_start();
require_once __DIR__ . '/../config.php';

$userfeedback = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['userID'])) {
        $userfeedback = [
            'user_id' => $_SESSION['userID'],
            'user_name' => $_SESSION['firstName'] . $_SESSION['secondName'],
            'user_email' => $_SESSION['email'],
            'message' => $_POST['message']
        ];
    } else {
        $userfeedback = [
            'user_name' => $_POST['name'],
            'user_email' => $_POST['email'],
            'message' => $_POST['message']
        ];
    }


    try{
        InsertRow('messages', $userfeedback);
    echo json_encode(['success' => true, 'message' => 'add message']);
    }
    catch (Error $e){
        echo json_encode(['success' => false, 'message' => 'Error' . $e->getMessage()]);
    }
    exit;
}
echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
exit;
?>