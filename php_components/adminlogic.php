<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
$allowtabled = ['users', 'logs', 'personal', 'appointments', 'pets'];
$sql = [
    'users' => 'select u.id, u.firstName as name, u.secondName as last_Name, u.email, u.phone, u.created_at, r.name as role from users u left join roles r ON r.id = u.role_id',
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
    if (!in_array($table, $allowtabled)) {
        echo json_encode(['success' => false, 'message' => "table `$table`isn in allowed"]);
        exit;
    }
    $sqlQuestion = $sql[$table];
    $data = AllFetch($sqlQuestion);
    echo json_encode(['success' => true, 'data' => $data]);
}
