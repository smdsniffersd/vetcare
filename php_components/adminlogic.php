<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
$allowtabled = ['users', 'logs', 'personal', 'appointments', 'pets', 'medication_reminders'];
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
    'appointments' =>
    'select a.id, p.name as pet_name, per.first_name as Doctor_Name, per.second_name as Doctor_second_name, s.name as Service, u.firstName as name, u.secondName as last_name, a.status, a.date, a.time, a.time_at from appointments a
    left join users u ON u.id = a.user_id
    left join pets p ON u.id = p.owner_id
    left join services s ON a.service_id = s.id
    left join personal per ON a.doctor_id = per.id
    ORDER BY a.date DESC, a.time DESC',
    'pets' => 'select p.id, p.name, p.view, p.Breed, p.Age, p.weight, p.special_marks, u.firstName as OwnerName, u.secondName as OwnerLastName from pets p left join users u ON p.owner_id = u.id',
    'medication_reminders' => 'select mr.id, p.name as Pet_name, mr.scheduled_datetime, mr.is_taken, m.name as medicine from medication_reminders mr
    left join medicines m ON mr.medicine_id = m.id
    left join pets p ON mr.pet_id = p.id'
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
            if ($table === 'appointments') {

                $data = [
                    'firstName' => $input['user_first_name'],
                    'secondName' => $input['user_second_name'],
                    'petName' => $input['pet_name']
                ];
                $user_id_and_pet_id = AllFetch('SELECT u.id as user_id, p.id as pet_id 
                FROM users u INNER JOIN pets p ON p.owner_id = u.id 
                WHERE u.firstName =  :firstName
                AND u.secondName = :secondName 
                AND p.name = :petName', $data);
                if (empty($user_id_and_pet_id)) {
                    echo json_encode(['success' => false, 'message' => 'User or pet not found', 'data' => $user_id_and_pet_id]);
                    exit;
                }
                $data = [
                    'firstName' => $input['Doctor_Name'],
                    'secondName' => $input['Doctor_second_name'],
                ];
                $doctor_id = OneFetch('
                    select id from personal where first_name = :firstName and second_name = :secondName
                ', $data);
                if (empty($doctor_id)) {
                    echo json_encode(['success' => false, 'message' => 'Doctor not found']);
                    exit;
                }
                $data = [
                    'serviceName' => $input['Service'],
                ];
                $service_id = OneFetch('select id from services where name = :serviceName', $data);
                if (empty($service_id)) {
                    echo json_encode(['success' => false, 'message' => 'Service not found']);
                    exit;
                }
                $input = [
                    'user_id' => $user_id_and_pet_id[0]['user_id'],
                    'pet_id' => $user_id_and_pet_id[0]['pet_id'],
                    'doctor_id' => $doctor_id['id'],
                    'service_id' => $service_id['id'],
                    'date' => $input['date'],
                    'time' => $input['time'],
                    'status' => $input['status']

                ];
            }
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
