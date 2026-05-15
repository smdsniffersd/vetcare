<?php



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__. '/config.php';

if(isset($_SESSION['userID']) && $_SESSION['userID'] > 0){
$userID = $_SESSION['userID'] ?? null;


if ($userID) {
    $userSql = 'select firstName, secondName, phone, email, address from users where id = ?';
    $user = OneFetch($userSql, [$userID]);


    $sqlPetinfo = "select * from pets where owner_id = ?";
    $pets = OneFetch($sqlPetinfo, [$userID]);

    $Med = OneFetch('select * from medical_information where pets_id = ?', [$pets['id']]);
}
}
else{
    header('Location: ./404Error.php');
}
?>
    <html lang="eu">


    <head>
        <title>Account</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/png" sizes="16x16" href="image/small_lapka.png">
        <meta name="msapplication-TileImage" content="image/small_lapka.png">
        <link rel="stylesheet" href="css/css17.04.css">
        <link rel="stylesheet" href="css/user-account.css">
        
    </head>

    <body>

        <?php include './structure/header.php' ?>

        <main>

            <div class="info">

                <div class="info-of-person">
                    <div class="info_of_full_person">
                        <div class="header-info">
                            <span class="header-info-span">User Information</span>
                        </div>
                        <div class="person-spans-div">
                            <span class="info-of-person-span">Name: <?= htmlspecialchars($user['firstName']) ?> <?= htmlspecialchars($user['secondName']) ?></span>
                            <span class="info-of-person-span">Telephone number: <?= htmlspecialchars($user['phone']) ?></span>
                            <span class="info-of-person-span">Email: <?= htmlspecialchars($user['email']) ?></span>
                            <span class="info-of-person-span">Address: <?= htmlspecialchars($user['address']) ?></span>

                        </div>
                    </div>
                    <div class="info-of-Medical-information">
                        <div class="header-info">
                            <span class="header-info-span">Medical Information</span>
                        </div>
                        <div class="person-spans-div">
                            <span class="info-of-person-span">Las visit: <?= htmlspecialchars($Med['last_visit']) ?></span>
                            <span class="info-of-person-span">Vaccinations: <?= htmlspecialchars($Med['vaccinations']) ?></span>
                            <span class="info-of-person-span">Parasite treatments: <?= htmlspecialchars($Med['parasite_treatments']) ?></span>
                            <span class="info-of-person-span">Tests and results: <?= htmlspecialchars($Med['tests_and_results']) ?></span>
                            <span class="info-of-person-span">Prescribed medications and treatment regimens: <?= htmlspecialchars($Med['appointments']) ?></span>
                        </div>
                    </div>
                </div>
                <div class="info-of-pet">
                    <div class="header-info">
                        <span class="header-info-span">Pet Information</span>
                    </div>
                    <div>
                        <img src="image/excited-funny-redhaired-girl-wearing-yellow-rubber.png" alt="dog" class="dog-img">
                        <div class="info-of-pet-descr">
                            <span class="info-of-person-span">Name: <?= htmlspecialchars($pets['name']) ?></span>
                            <span class="info-of-person-span">View: <?= htmlspecialchars($pets['view']) ?></span>
                            <span class="info-of-person-span">Breed: <?= htmlspecialchars($pets['Breed']) ?></span>
                            <span class="info-of-person-span">Age: <?= htmlspecialchars($pets['Age']) ?> years old</span>
                            <span class="info-of-person-span">Weight: <?= htmlspecialchars($pets['weight']) ?> kg</span>
                            <span class="info-of-person-span">Special marks: <?= htmlspecialchars($pets['special_marks']) ?></span>
                        </div>
                    </div>


                </div>

            </div>

        </main>

    </body>

    </html>
