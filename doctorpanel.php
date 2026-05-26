<?php

require_once __DIR__ . '';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
try {
    $role_id = OneFetch('select role_id from users where id = ?', [$_SESSION['userID']]);


    if (!isset($role_id)) {
        require_once __DIR__ . '/404Error.php';
        exit;
    }
} catch (Exception $e) {
    echo json_encode('Error: ', $e->getMessage());
}
if ($role_id['role_id'] === 2): ?>

    <html>

    <header>

        <meta charset="utf-8">
        <link rel="stylesheet" href="css/docpanel.css">

    </header>
    <body>
        
    <script src="./scripts/admin.js"></script>
    <script src="./scripts/docpanel.js"></script>
    </body>
    </html>

<?php endif; ?>