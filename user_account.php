<?php



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';

$input = json_decode(file_get_contents('php://input'), true);

function getUsersPets($userID, $returnJson = false)
{
    try {
        $userSql = 'select firstName, secondName, phone, email, address from users where id = ?';
        $user = OneFetch($userSql, [$userID]);
        $sqlPetinfo = "select * from pets where owner_id = ?";
        $pets = AllFetch($sqlPetinfo, [$userID]);
        if (empty($pets)) {
            if ($returnJson) {
                $Med = [];
                echo json_encode([
                'success' => false,    
                'message' => 'User has no pets',
                ]);
                exit;
            }
            return [
                'success' => false,
                'message' => 'User has no pets',
                'user' => $user,
                'pets' => $pets
            ];
        } else {
            $petsID = array_column($pets, 'id');
            $placeholders = implode(',', array_fill(0, count($petsID), '?'));

            $Med = AllFetch("SELECT * FROM medical_information WHERE pets_id IN ($placeholders)", $petsID);
            if (empty($Med)) {
                if ($returnJson) {
                    echo json_encode(['success' => false, 'message' => 'Pets has not info', 'pets' => $pets]);
                    exit;
                }
                return [
                    'success' => false,
                    'message' => 'Pets has not info',
                    'user' => $user,
                    'pets' => $pets
                ];
            }
            if ($returnJson) {
                echo json_encode(['success' => true, 'pets' => $pets, 'Med' => $Med]);
                exit;
            }

            return [
                'success' => true,
                'user' => $user,
                'pets' => $pets
            ];
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
}

if ($input && isset($input['action'])) {
    switch ($input['action']) {
        case 'getInfoPet':
            $petID = $input['data'] ?? 0;
            try {
                $PetInfo = OneFetch('select * from medical_information where pets_id = ?', [$petID]);
                if ($PetInfo && !empty($PetInfo)) {
                    echo json_encode(['success' => true, 'data' => $PetInfo]);
                    exit;
                } else {
                    echo json_encode(['success' => false, 'data' => null]);
                    exit;
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
            break;
        case 'getUsersPets':
            getUsersPets($input['userID'], $input['flag']);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Unknown action']);
            exit;
    }
}

$user = [];
if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0) {
    $userID = $_SESSION['userID'] ?? null;


    if ($userID) {

        $user = getUsersPets($userID);
        $user = $user['user'];
    }
} else {
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
    <link rel="stylesheet" href="css/user-account.css">
    <link rel="stylesheet" href="css/css17.04.css">


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
                        <span class="header-info-span">Pets Information</span>
                    </div>
                    <span class="info-of-person-span" id="petHaventInfo"></span>
                    <div class="person-spans-div" id="personSpansDiv">
                        <span class="info-of-person-span" id="petLasvisit"></span>
                        <span class="info-of-person-span" id="petVaccinations"></span>
                        <span class="info-of-person-span" id="petVaccinationPreparations"></span>
                        <span class="info-of-person-span" id="petTratments"></span>
                        <span class="info-of-person-span" id="petTestResults"></span>
                        <span class="info-of-person-span" id="petPrescribed"></span>
                    </div>
                </div>
            </div>
            <div class="info-of-pet">
                <div class="header-info">
                    <span class="header-info-span">Pets</span>
                </div>
                <div>
                    <img src="image/excited-funny-redhaired-girl-wearing-yellow-rubber.png" alt="dog" class="dog-img">

                    <?php if (isset($pets) && !empty($pets)): ?>
                        <?php foreach ($pets as $pet): ?>
                            <div class="PetsName" onclick="getInfoPet(this)" data-pet-id="<?= htmlspecialchars($pet['id']) ?>"><?= htmlspecialchars($pet['name']) ?></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="Nopets">No pets have been added</div>
                    <?php endif; ?>
                </div>


            </div>

        </div>

    </main>
    <script src="./scripts/total_js.js"></script>
</body>

</html>