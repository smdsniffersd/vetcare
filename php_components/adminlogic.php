<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
$allowtabled = ['users', 'logs', 'personal', 'appointments', 'pets'];
$sql = [
    'users' => 'SELECT 
    u.id, 
    u.firstName as name, 
    u.secondName as last_Name, 
    u.email, 
    u.phone, 
    u.created_at, 
    r.name as role, 
    COUNT(p.id) as pet_count FROM users u  LEFT JOIN roles r ON r.id = u.role_id LEFT JOIN pets p ON p.owner_id = u.id GROUP BY u.id',
    'logs' => 'select id, userID, event, time from logs',
    'personal' => 'select p.id, p.first_name, p.second_name, p.phone_number, p.email, pr.name as profession_name from personal p left join professions pr ON pr.id = p.profession_id',
    'appointments' => 'select a.id, a.specific_service, a.pet_type, a.specific_condition, a.date, a.time, a.time_at, u.firstName as name, u.secondName as last_name
    from appointments a left join users u ON u.id = a.user_id ORDER BY a.date DESC, a.time DESC',
    'pets' => 'select p.id, p.name, p.view, p.Breed, p.Age, p.weight, p.special_marks, u.firstName as OwnerName, u.secondName as OwnerLastName from pets p left join users u ON p.owner_id = u.id
'
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents('php://input'), true);
    $table = $input['value'] ?? '';
    $action  = $input['action'];
    switch ($action) {
        case 'getUserInfo':
            if (!in_array($table, $allowtabled)) {
                echo json_encode(['success' => false, 'message' => "table `$table`isn in allowed"]);
                exit;
            }
            $sqlQuestion = $sql[$table];
            $data = AllFetch($sqlQuestion);
            echo json_encode(['success' => true, 'data' => $data, 'table_name' => $table]);
            break;
        case 'editRow':
            $table = $input['table'];
            $id = $input['id'];

            unset($input['action']);
            unset($input['table']);
            unset($input['id']);

            $result = update($table, $input, 'id', $id);
            echo json_encode($result);
            break;

        case 'deleteRow':
            $table = $input['table'];
            $column = $input['column'];
            $value = $input['value'];

            if (!in_array($table, $allowtabled)) {
                echo json_encode(['success' => false, 'message' => "Таблица $table не разрешена"]);
                exit;
            }

            $result = deleteRow($table, $column, $value);
            echo json_encode($result);
            break;

        case 'addRow':
            $table = $input['table'] ?? '';

            if (!in_array($table, $allowtabled)) {
                echo json_encode(['success' => false, 'message' => "Таблица $table не разрешена"]);
                exit;
            }
            unset($input['action']);
            unset($input['table']);

            try {
                $id = insertRow($table, $input);
                if ($id) {
                    echo json_encode(['success' => true, 'message' => 'Запись добавлена', 'id' => $id]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Ошибка: ' . $e->getMessage()]);
            }
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Not allowed input']);
    }
}
