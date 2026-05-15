<?php
require_once __DIR__ . '/../config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userauth'])) {
    try {
        $sql = 'select * from appointments where user_id = ?';
        $appointments = AllFetch($sql, [$_SESSION['userID']]);
        $appointmentsArray = [];

        if ($appointments) {
            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime('+1 day'));
            foreach ($appointments as $app) {
                if ($tomorrow === $app['date'] || $today === $app['date']) {
                    
                    $appointmentsArray[] = [
                        'date' => (new DateTime($app['date']))->format('M j'),
                        'time' =>  (new DateTime($app['time']))->format('H:i'),
                        'specific_service' => $app['specific_service']
                    ];
                }
            }
        }

        echo json_encode(['success' => true, 'data' => $appointmentsArray]);
    } catch (Error $e) {
        echo json_encode(['success' => false, 'error' => $e]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'user isn`t in DB']);
}
