<?php
session_start();
require_once __DIR__ . '/config.php';
?>
<html lang="eu">

<head>

    <title>Pet Health Programs</title>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/total_css.css">
    <link rel="stylesheet" href="css/css17.04.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/Pet_HealthProgramsNew.css">
    <link rel="icon" type="image/png" sizes="16x16" href="image/small_lapka.png">
    <meta name="msapplication-TileImage" content="image/small_lapka.png">

</head>


<body>

    <?php include './structure/header.php' ?>
    <section class="first-section">
        <div class="firstContentBlock">
            <div class="first-section-text">

                <p class="hesh-tag">#1Petcare in this country</p>
                <div class="first-section-BIG-text">

                    <span class="first-section-BIG-text-span">Healthy Pets, Happy Lives</span>
                    <span class="first-section-BIG-text-span">Care You Can Trust</span>

                </div>
                <div class="first-section-small-text">

                    <span class="first-section-small-text-span">Explore our comprehensive pet health programs designed to keep your </span>
                    <span class="first-section-small-text-span">furry friends thriving at every stage of life.</span>

                </div>
            </div>
            <div class="button_class">

                <a href="Appoinment_Booking.html" class="Book">Book Appointment</a>
                <a href="Pet_Health_Programs.html" class="Get">Get Started</a>

            </div>
        </div>

        <img class="first-line-img" src="image/first-line-img.jpg" alt="">
        <div class="first-section-img">

            <img class="about_us_first_section-left" src="image/a-woman-is-shown-in-a-friendly-interaction-with-dog.png" alt="about_us_first_section-left">
            <img class="about_us_first_section-midl" src="image/family-photo-with-a-little-dachshund-on-the-cafe-t.png" alt="about_us_first_section-midl">
            <img class="about_us_first_section-right" src="image/my-beautiful-small-best-friend.png" alt="about_us_first_section-right">

        </div>

        <img class="underline-img" src="image/underline.png" alt="underline">
    </section>
    <section class="second-section">
        <div>
            <div class="second-text-element">

                <div class="second-BIG-text-element">
                    <span class="second-BIG-text-element-span">Keep your pets happy and healthy,</span>
                    <span class="second-BIG-text-element-span">Join today for expert care</span>

                </div>
                <div class="second-descr-text-element">
                    <span class="second-descr-text-element">A Pet Health Program is a comprehensive plan designed to </span>
                    <span class="second-descr-text-element">ensure the well-being of pets through preventive care,</span>
                    <span class="second-descr-text-element">regular monitoring, and personalized treatments.</span>
                </div>

            </div>
            <div class="second-block-element">
                <div class="second-block-element-leftContainer">
                    <div class="second-block-element-left">
                    <div class="number-list">1</div>
                    <div class="second-block-element-left-text-element">
                        <span class="second-block-element-left-BIG-text-span">Regular Health Check-Ups</span>
                        <span class="second-block-element-left-descr-text-span">Routine veterinary examinations to monitor</span>
                        <span class="second-block-element-left-descr-text-span"> your pet’s overall health and detect issues early.</span>

                    </div>
                </div>
                </div>
                
                <div class="second-block-element-midle">
                    <div class="second-block-element-midle-photo">
                        <div class="second-block-element-midle-photoDisc">Disc 50%</div>
                    </div>
                    <div class="second-block-element-midle-text">
                        <div class="number-list">2</div>
                        <span class="second-block-element-midle-BIG-text">Regular Health Check-Ups</span>
                        <span class="second-block-element-midle-descr-text">Routine veterinary examinations to monitor </span>
                        <span class="second-block-element-midle-descr-text">your pet’s overall health and detect issues</span>
                        <span class="second-block-element-midle-descr-text">early.</span>
                        <div class="second-block-element-midle-cost-div">
                            <span class="second-block-element-midle-cost">$85,00</span>
                            <span class="second-block-element-midle-check">/Check</span>
                        </div>

                        <a href="Appoinment_Booking.html" class="Book">Book Appointment</a>
                    </div>
                </div>
                <div class="second-block-element-rigth">

                </div>
            </div>
        </div>

    </section>
    <?php include __DIR__ . '/structure/subscribes.php' ?>
    <section class="fourth-section">

        <div class="fourth-section-main-element">
            <div class="fourth-section-text-header">
                <span class="fourth-section-text-header-span">We always provide surprises and</span>
                <span class="fourth-section-text-header-span">excitement from each Program</span>
            </div>
            <div class="fourth-section-block-element">
                <img src="image/australian-cattle-dog-puppy-outdoor-blue-and-red.jpg" alt="Pet-Health-Programs-fourth-secstion-img" class="Pet-Health-Programs-fourth-secstion-img">
                <ul class="fourth-section-ul">
                    <li class="fourth-section-li">
                        <span class="fourth-section-BIG-text-span">Started Plan</span>
                        <span class="fourth-section-descr-text-span">Each package offers a variety of services designed to meet your pet's specific</span>
                        <span class="fourth-section-descr-text-span">needs, from routine check-ups to grooming and playtime.</span>
                    </li>
                    <li class="fourth-section-li"><span class="fourth-section-BIG-text-span">Comprehensive Service</span></li>
                    <li class="fourth-section-li"><span class="fourth-section-BIG-text-span">Essential Care Plan</span></li>
                    <li class="fourth-section-li"><span class="fourth-section-BIG-text-span">Premium Health Plan</span></li>
                </ul>
            </div>
        </div>

    </section>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
        <img src="image/icons8-вверх-64.png" alt="Up" class="progress-icon" />
    </div>
    <?php include './structure/footer.php' ?>
    <?php include './structure/chat-container.php' ?>
    <?php include __DIR__ . '/structure/login.php' ?>
    <script src="scripts/total_js.js"></script>
    <script src="scripts/index.js"></script>
</body>



</html>