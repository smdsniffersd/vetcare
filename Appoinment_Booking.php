<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';

?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <link rel="icon" type="image/png" sizes="16x16" href="image/small_lapka.png">
    <meta name="msapplication-TileImage" content="image/small_lapka.png">
    <title>Appoinment Booking</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Appoinment_Booking.css">
    <link rel="stylesheet" href="css/total_css.css">
    <link rel="stylesheet" href="css/css17.04.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <?php include __DIR__ . '/structure/header.php' ?>
    <main>
        <div class="Pet-text">

            <img src="image/first-line-img.jpg" alt="Pet-top-line" class="Pet-top-line">
            <div class="Hash_and_text">

                <span class="hesh-tag">#1Petcare in this country</span>
                <div class="Big-text">

                    <span class="Big-text-span">Easy Scheduling</span>
                    <span class="Big-text-span">for Your Pet's</span>
                    <span class="Big-text-span">Health Needs</span>
                </div>
            </div>
            <div class="Text-descr">
                <span class="Text-descr-span">Book appointments effortlessly and prioritize your pet's well-</span>
                <span class="Text-descr-span">being with our convenient online scheduling system</span>
            </div>
            <div class="button_class">
                <div>
                    <a href="Appoinment_Booking.php" class="Book">Book Appointment</a>
                    <a href="Pet_Health_Programs.php" class="Get">Get Started</a>
                </div>


            </div>
        </div>
        <div class="Pet-photo">


            <img class="top-image" src="image/main_img_3.jpg" alt="Cat">
            <div class="Pet-bottom-photo">
                <img class="bottom-left-image" src="image/main_img_2.jpg" alt="Cat">
                <img class="bottom-right-image" src="image/main_img_1.jpg" alt="Cat">


            </div>

        </div>


    </main>
    <?php include __DIR__ . '/structure/likefooter.php' ?>
    <section class="appointment-secstion">

        <div class="appointment-section-main-element">
            <div class="appointment-section-text-block">
                <div class="appointment-section-BIG-text-block">
                    <span class="appointment-section-BIG-text-block-span">Effortless Appointment</span>
                    <span class="appointment-section-BIG-text-block-span">Booking for Your Pet’s Care</span>
                </div>
                <div class="appointment-section-descr-text-block">
                    <span class="appointment-section-descr-text-block-span">Convenience at Your Fingertips—Book Your Visit Anytime, Anywhere</span>
                </div>
            </div>
            <form id="bookForm" class="app-form" autocomplete="off" method="POST">
                <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0) {
                    $formData = [

                        'firstName' => $_SESSION['firstName'],
                        'secondName' => $_SESSION['secondName'],
                        'phone' => $_SESSION['phone'],
                        'email' => $_SESSION['email'],


                    ];
                } else {
                    $formData = [
                        'firstName' => '',
                        'secondName' => '',
                        'phone' => '',
                        'email' => '',
                    ];
                } ?>
                <div class="app-form-group-input">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">First name</label>
                            <input type="text" id="name" name="firstName" minlength="6" value="<?php echo $formData['firstName'] ?>" required placeholder="Darlene" autofocus required>
                            <label for="name">Second name</label>
                            <input type="text" id="name" name="secondName" minlength="6" value="<?php echo $formData['secondName'] ?>" required placeholder="Robetson" required>
                        </div>
                        <div class="form-group">
                            <label for="pet-service">Specific service</label>
                            <input list="grooming-services" id="pet-service" name="specific_service" required placeholder="Pet Grooming" required>
                            <datalist id="grooming-services">
                                <option value="Hygienic haircut">
                                <option value="Model haircut">
                                <option value="Pet SPA">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="<?php echo $formData['email'] ?>" required placeholder="Darlenerobert@mail.com" required>
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo $formData['phone'] ?>" required placeholder="+7(999)1234567" required>
                        </div>
                        <div class="form-group">
                            <label for="pet-type">Your types of pets</label>
                            <input list="pet-types" id="pet-type" name="pet_type" placeholder="British Short Hair Cat" required>
                            <datalist id="pet-types">
                                <option value="British Short Hair Cat">
                                <option value="Small breeds">
                                <option value="Medium breeds">
                                <option value="Large breeds">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text-area">Write a Specific Condition</label>
                    <textarea id="text-area" name="specific_condition" placeholder="A urinary tract infection in cats is a common condition that affects the bladder and urinary system. It can cause discomfort and lead to more serious complications if untreated." required></textarea>
                </div>
                <input type="hidden" name="time" id="selectedTime">
                <input type="hidden" name="date" id="selectedDate">

                <div class="choose_a_date_section-main-element">
                    <div class="choose_a_date_section-text-element">
                        <div class="choose_a_date_section-BIG-text">
                            <span class="choose_a_date_section-BIG-text-span">Choose a Date for Your Pet’s</span>
                            <span class="choose_a_date_section-BIG-text-span">Appointment</span>
                        </div>

                        <span class="choose_a_date_section-small-text-span">Scheduling your pet’s care has never been easier. Select a convenient date and time that works best for you and your</span>
                        <span class="choose_a_date_section-small-text-span">furry friend.</span>
                    </div>
                </div>
                <?php include __DIR__ . '/structure/calendar.php' ?>
                
            </form>
        </div>



    </section>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
        <img src="image/icons8-вверх-64.png" alt="Up" class="progress-icon" />
    </div>
    <?php include __DIR__ . '/structure/footer.php' ?>
    <div class="modal-overlay" id="modalOverlay">
        <div class="model-window">
            <img src="image/calendar-model-window-img.png" alt="calendar-model-window-img" class="calendar-model-window-img">
            <div class="model-window-text">
                <span class="model-window-text">Thank you for booking with us!!</span>
                <span class="model-window-text">Your appointment has been successfully </span>
                <span class="model-window-text">scheduled</span>
                <button id="closeModalBtn">Далее</button>
            </div>
        </div>
    </div>
    <div class="NullDateTime" id="NullDateTime">
        Ты забыл выбрать время и дату!
    </div>
    <?php include './structure/chat-container.php' ?>
    <?php include __DIR__ . '/structure/login.php' ?>
    <?php include __DIR__ . '/structure/signUp.php' ?>
    <script src="scripts/Appoinment_Booking.js"></script>
    <script src="scripts/total_js.js"></script>
</body>

</html>