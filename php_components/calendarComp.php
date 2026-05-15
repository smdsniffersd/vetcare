<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';




$today = new DateTime();
$day = date('j');
$days = [];
$daysInMonth = date('Y-m-t');


$startDate = new DateTime();
if ($startDate->format('w') != 0) {
    $startDate->modify('last sunday');
}
$dates = [];
for ($i = 0; $i < 35; $i++) {
    $date = clone $startDate;
    $date->modify("+$i days");
    $dates[] = $date;
}

$daysNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
$allTimes = ['10:00', '10:30', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $date = $data['date'] ?? null;
    
    $sql = 'SELECT DATE_FORMAT(time, "%H:%i") as time FROM appointments WHERE date = ?';
    
    try {
        $appointments = AllFetch($sql, [$date]);
        
        $bookedTimes = !empty($appointments) ? array_column($appointments, 'time') : [];

        $freeTimes = array_diff($allTimes, $bookedTimes);
        if($date < $today->format('Y-m-d')){
            $bookedTimes = $allTimes;
        }
        
        echo json_encode([
            'success' => true,
            'date' => $date,
            'book_times' => array_values($bookedTimes)
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    exit;
}
