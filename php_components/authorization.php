<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json');

session_start();


require_once __DIR__ . '/../config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    $user = OneFetch('select * from users where email = ?', [$login]);

    if ($user && password_verify($pass, $user['password'])) {

        $_SESSION['userID'] = $user['id'];
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['secondName'] = $user['secondName'] ?? '';
        $_SESSION['phone'] = $user['phone'] ?? '';
        $_SESSION['email'] = $user['email'] ?? '';
        $_SESSION['userauth'] = true;

        $log = [
            'userID' => $user['id'],
            'event' => 'authorization',
        ];

        error_log("Session saved: " . print_r($_SESSION, true));
        insertRow('logs', $log);

        echo json_encode(['success' => true, 'message' => 'authorization', 'auth_role' => $user['role_id']]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный логин или пароль']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
exit;
