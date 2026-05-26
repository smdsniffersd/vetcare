<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['userID'])) {
    require_once __DIR__ . '/404Error.php';
    exit;
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
if ($role_id['role_id'] === 1): ?>


    <html>

    <header>

        <meta charset="utf-8">
        <link rel="stylesheet" href="css/adm.css">

    </header>

    <body id="adminbody">

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

        <div class="overlayGetInfoPets" id="overlayGetInfoPets">
        </div>
        <div class="overlayGetInfoPetsAddPetOverlay" id="overlayGetInfoPetsAddPetOverlay">
            <form method="POST" class="overlayGetInfoPetsAddPetOverlayForm" id="overlayGetInfoPetsAddPetOverlayForm">
                <span class="AddPetOverlaySpan">Add pet</span>
                <div class="inputDiv">
                    <div class="inputDivBlock">
                        <label for="nameInputAddPet" class="inputLabelAddPet" id="nameLabelAddPet">Name</label>
                        <input type="text" placeholder="Name" id="nameInputAddPet" class="inputAddPet" required name="name">
                        <label for="viewsInputAddPet" class="inputLabelAddPet" id="viewsLabelAddPet"></label>Views</label>
                        <input type="text" placeholder="Views" id="viewsInputAddPet" class="inputAddPet" required name="view">
                        <label for="breedInputAddPet" class="inputLabelAddPet" id="breedLabelAddPet"></label>Breed</label>
                        <input type="text" placeholder="Breed" id="breedInputAddPet" class="inputAddPet" required name="Breed">
                    </div>
                    <div class="inputDivBlock">
                        <label for="ageInputAddPet" class="inputLabelAddPet" id="ageLabelAddPet"></label>Age</label>
                        <input type="number" step="0.1" placeholder="5.3" id="ageInputAddPet" class="inputAddPet" required name="Age">
                        <label for="weightInputAddPet" class="inputLabelAddPet" id="wightLabelAddPet"></label>Weight</label>
                        <input type="number" step="0.1" placeholder="5.5" id="weightInputAddPet" class="inputAddPet" required name="weight">
                        <label for="smInputAddPet" class="inputLabelAddPet" id="smLabelAddPet"></label>Special marks</label>
                        <input type="text" placeholder="Special marks" id="smInputAddPet" class="inputAddPet" required name="special_marks">
                    </div>
                    <input type="hidden" name="action" value="addPetForm">
                    <input type="hidden" name="owner_id" id="owner_id" value="">

                </div>


                <button type="submit" class="OverlaySubmitButton" id="OverlaySubmitButton" form="overlayGetInfoPetsAddPetOverlayForm">Save</button>
            </form>
        </div>
        <div class="overlaySuccessAddPet" id="overlaySuccessAddPet"></div>
        <div class="overlayDeleteUser" id="overlayDeleteUser">
            <span class="overlayDeleteUserSpan" id="overlayDeleteUserSpan">Your sure want delete this user?</span>
            <div class="overlayDeleteUserDiv" id="overlayDeleteUserDiv">
                <div class="overlayDeleteUserAnswer" id="overlayDeleteUserAnswerNo" onclick="deleteUser(this)">No</div>
                <div class="overlayDeleteUserAnswer" id="overlayDeleteUserAnswerYes" onclick="deleteUser(this)" data-userid="">Yes</div>
            </div>

        </div>
        <div id="editModal" class="editModal"></div>
        

        <script src="./scripts/admin.js"></script>
    </body>

    </html>

<?php else: ?>
    <?php require_once __DIR__ . '/404Error.php'; ?>
<?php endif; ?>