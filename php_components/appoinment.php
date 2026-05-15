<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config.php';
// require_once __DIR__ . '/../php_components/notificationAppoinment.php';
file_put_contents(__DIR__ . '/debug.log', date('Y-m-d H:i:s') . "\n", FILE_APPEND);
file_put_contents(__DIR__ . '/debug.log', '$_POST: ' . print_r($_POST, true) . "\n", FILE_APPEND);
file_put_contents(__DIR__ . '/debug.log', '$_FILES: ' . print_r($_FILES, true) . "\n", FILE_APPEND);
file_put_contents(__DIR__ . '/debug.log', 'php://input: ' . file_get_contents('php://input') . "\n\n", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    try {
        if (isset($_SESSION['userauth']) && $_SESSION['userauth'] === true) {
            $appointment = [
                'user_id' => $_SESSION['userID'],
                'specific_condition' => $_POST['specific_condition'],
                'pet_type' => $_POST['pet_type'],
                'specific_service' => $_POST['specific_service'],
                'time' => $_POST['time'],
                'date' => $_POST['date']
            ];
            InsertRow('appointments', $appointment);
            echo json_encode(['success' => true, 'data' => 'there']);

            exit;
        } else {

            if (empty($_POST['email'])) {
                echo json_encode(['success' => false, 'message' => 'Email обязателен']);
                exit;
            }
            
            $email = $_POST['email'];
            $existingUser = OneFetch('SELECT id FROM users WHERE email = ?', [$email]);

            if ($existingUser) {
                $userID = $existingUser['id'];
            } else {
                $formData = [
                    'firstName' => $_POST['firstName'],
                    'secondName' => $_POST['secondName'],
                    'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                    'role_id' => '9'
                ];
                $userID = InsertRow('users', $formData);
            }

            $appointment = [
                'user_id' => $userID,
                'specific_condition' => $_POST['specific_condition'],
                'pet_type' => $_POST['pet_type'],
                'specific_service' => $_POST['specific_service'],
                'time' => $_POST['time'],
                'date' => $_POST['date']
            ];
            InsertRow('appointments', $appointment);

            echo json_encode(['success' => true]);
            exit;
        }
    } catch (Error $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}
echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
exit;
?>