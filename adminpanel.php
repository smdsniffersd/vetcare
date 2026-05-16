<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';
$role_id = OneFetch('select role_id from users where id = ?', [$_SESSION['userID']]);
if ($role_id['role_id'] === 1) {
} else {
    require_once __DIR__ . '/404Error.php';
}
?>


<html>

<header>

    <meta charset="utf-8">
    <link rel="stylesheet" href="css/adm.css">

</header>

<body>

    <header>
        <ul class="headerUl">
            <li onclick="getInfo(this)">users</li>
            <li onclick="getInfo(this)">personal</li>
            <li onclick="getInfo(this)">appointments</li>
            <li onclick="getInfo(this)">pets</li>
            <li onclick="getInfo(this)">logs</li>
            
        </ul>
    </header>
    <table class="mainOverlay" id="mainOverlay">
    </table>
<script src="./scripts/admin.js"></script>
</body>

</html>