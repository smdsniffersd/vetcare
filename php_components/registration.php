<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__. '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Неверный метод запроса']);
    exit;
}



$data = [
    'firstName' => $_POST['firstName'],
    'secondName' => $_POST['secondName'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'address' => $_POST['address'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    'created_at' => date('Y-m-d H:i:s'),
    'role_id' => '4'
];

try {
    $check = OneFetch('select id from users where email = ?', [$_POST['email']]);
    if (!$check) {
        $userID = insertRow('users', $data);
        $_SESSION['user_id'] = $userID;
        $_SESSION['user_name'] = $data['firstName'];
        echo json_encode([
            'status' => 'success',
            'message' => 'Регистрация успешна!',
            'redirect' => '/vetcare/user_account.php'
        ]);
    } else {
        echo 'пользователь уже зарегистрирован';
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ошибка при сохранении: ' . $e->getMessage()
    ]);
}
?>
