<?php
session_start();
require_once __DIR__ . '/config.php';

?>
<html lang="eu">


<head>
    <title>Contact with us</title>

    <link rel="icon" type="image/png" sizes="16x16" href="image/small_lapka.png">
    <meta name="msapplication-TileImage" content="image/small_lapka.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/lo.css">
    <link rel="stylesheet" href="css/total_css.css">
    <link rel="stylesheet" href="css/css17.04.css">
</head>

<body>

    <?php include './structure/header.php' ?>

    <section class="first-section">
        <div>
            <div class="first-section-text">

                <p class="hesh-tag">#1Petcare in this country</p>
                <div class="first-section-BIG-text">

                    <span class="first-section-BIG-text-span">Compassionate Care,</span>
                    <span class="first-section-BIG-text-span">Dedicated to Your Pet's Wellness</span>

                </div>
                <div class="first-section-small-text">

                    <span class="first-section-small-text-span">Dedicated to providing expert pet care with love, trust, and personalized</span>
                    <span class="first-section-small-text-span">attention for every furry companion</span>

                </div>
            </div>
            <div class="button_class">

                <a href="Appoinment_Booking.html" class="Book">Book Appointment</a>
                <a href="Pet_Health_Programs.html" class="Get">Get Started</a>

            </div>
        </div>

        <img class="first-line-img" src="image/first-line-img.jpg" alt="">
        <div class="first-section-img">

            <img class="about_us_first_section-left" src="image/about_us_first_section-left.png" alt="about_us_first_section-left">
            <img class="about_us_first_section-midl" src="image/about_us_first_section-midl.png" alt="about_us_first_section-midl">
            <img class="about_us_first_section-right" src="image/about_us_first_section-right.png" alt="about_us_first_section-right">

        </div>

        <img class="underline-img" src="image/underline.png" alt="underline">
    </section>
    <section class="second-section">

        <div class="second-section-main-element">

            <div class="second-section-main-element-text-div">
                <span class="second-section-main-element-BIG-text-span">Connecting You with Care for</span>
                <span class="second-section-main-element-BIG-text-span">Your Beloved Pets</span>
                <span class="second-section-main-element-small-text-span">We’re here to answer your questions and provide support.</span>

                <form action="./php_components/feedback.php" method="POST" class="second-section-reg-data" id="contactForm">
                    <span class="second-section-main-element-name-span">Your Name</span>
                    <span>
                        <label for="name"></label>
                        <input type="text" id="name" minlength="6" name="name" required placeholder="Darlene Robertson" autofocus>
                    </span>

                    <span class="second-section-main-element-name-span">Your Email Address</span>
                    <span>
                        <label for="email"></label>
                        <input type="email" id="email" name="email" minlength="2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" required placeholder="Darlenerobert@mail.com">
                    </span>

                    <span class="second-section-main-element-name-span">Message</span>
                    <div class="chat-input-container">
                        <textarea class="chat-textarea" name="message" required placeholder="A urinary tract infection in cats is a common condition that affects the bladder and urinary system. It can cause discomfort and lead to more serious complications if untreated."></textarea>
                    </div>

                    <input type="submit" value="Send Message" class="second-section-send-message-button">
                </form>

            </div>
            <div class="second-section-img-text">
                <span class="second-section-Get-50-Discount">Get 50% Discount</span>
                <div class="second-section-img-text-first-div">

                    <div class="second-section-img-text-div">

                        <span class="second-section-img-BIG-text">Celebrate the Joy of Christmas with Your Pets!</span>
                        <span class="second-section-img-descr-text">This holiday season, let’s make it special for every member of the</span>
                        <span class="second-section-img-descr-text">family—including your furry friends!</span>
                    </div>
                    <img src="image/second-section-pointers.png" alt="second-section-pointers" class="second-section-pointers">
                </div>
            </div>
            <div class="overlayYourMessageSended" id="overlayYourMessageSended">
                <div class="overlayYourMessageSendedPlaceholder">
                    <span>Thank you <?php echo $_SESSION['firstName'] ?> for your message,</span>
                    <span>We will respond to it as soon as possible!</span>
                    <span> Wait your answer on your email.</span>
                    <button class="overlayYourMessageSendedButton" onclick="closeModal(this)">x</button>
                </div>

            </div>
            <div class="progress-wrap">
                <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                </svg>
                <img src="image/icons8-вверх-64.png" alt="Up" class="progress-icon" />
            </div>

        </div>

    </section>

    <?php include './structure/footer.php' ?>
    <?php include './structure/chat-container.php' ?>
    <?php include __DIR__ . '/structure/login.php' ?>
    <script src="scripts/total_js.js"></script>
</body>





</html>