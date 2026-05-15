<?php

require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <title>Our Service</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/css17.04.css">
    <link rel="stylesheet" href="css/Service_Page.css">
    <link rel="stylesheet" href="css/total_css.css">
    <link rel="icon" type="image/png" sizes="16x16" href="image/small_lapka.png">
    <meta name="msapplication-TileImage" content="image/small_lapka.png">
</head>

<body>

    <?php include __DIR__ . '/structure/header.php'; ?>
    <main>
        <div class="Pet-text">

            <img src="image/first-line-img.jpg" alt="Pet-top-line" class="Pet-top-line">
            <div class="Hash_and_text">

                <span class="hesh-tag">#1Petcare in this country</span>
                <div class="Big-text">
                    <span class="Big-text-span">Comprehensive</span>
                    <span class="Big-text-span">Pet Care Tailored to</span>
                    <span class="Big-text-span">Every Need</span>
                </div>
            </div>
            <div class="Text-descr">
                <span class="Text-descr-span">Discover expert services designed to nurture, heal, and ensure</span>
                <span class="Text-descr-span">the happiness of your beloved pets</span>
            </div>
            <div class="button_class">
                <a href="Appoinment_Booking.html" class="Book">Book Appointment</a>
                <a href="Pet_Health_Programs.html" class="Get">Get Started</a>
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
    <?php include __DIR__ . '/structure/likefooter.php'; ?>
    <section class="top_priority_always">
        <div class="eiwei">
            <div class="top_priority_always-header">
                <div class="BIG-text-priority">
                    <span class="BIG-text-priority-span">Your Pet's Happiness, Our </span>
                    <span class="BIG-text-priority-span">Top Priority Always!</span>
                </div>
                <div class="small-text-priority">
                    <span class="small-text-priority-span">Discover personalized care and expert services designed to keep your furry</span>
                    <span class="small-text-priority-span">friends healthy, happy, and full of joy</span>
                </div>
            </div>
            <div class="Pet-service-ul_and-img">
                <img class="pet-service-img pet-service-img-mobi" src="image/australian-cattle-dog-puppy-outdoor-blue-and-red-2.png" alt="pet-service-img">
                <ul class="Services-ul">
                    <li>
                        <span class="Services-Big-span-ul">Comprehensive Services</span>
                        <span class="Services-small-span-ul">From grooming and training to medical check-ups and daycare, we offer all-in-one</span>
                        <span class="Services-small-span-ul">solutions for your pet’s well-being.</span>
                    </li>
                    <li><span class="Services-Big-span-ul">Certified Experts</span></li>
                    <li><span class="Services-Big-span-ul">State of the-Art Facilities</span></li>
                    <li><span class="Services-Big-span-ul">Trusted by Pet Owners</span></li>
                </ul>
                <img class="pet-service-img" src="image/australian-cattle-dog-puppy-outdoor-blue-and-red-2.png" alt="pet-service-img">
            </div>
            <div class="progress-wrap">
                <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                </svg>
                <img src="image/icons8-вверх-64.png" alt="Up" class="progress-icon" />
            </div>
        </div>

    </section>
    <?php include __DIR__ . '/structure/ourservice.php' ?>
    <section class="Pamper">

        <div class="main-element">

            <div class="text-element">
                <div class="pamper-text-links-arrow">
                    <a class="pamper-left-arrow-a"><img src="image/pamper-left-arrow.png" alt="pamper-left-arrow"></a>
                    <a class="pamper-rigth-arrow-a"><img src="image/pamper-rigth-arrow.png" alt="pamper-rigth-arrow"></a>
                </div>
                <div class="pamper-BIG-text">
                    <span class="pamper-BIG-text-span">Pamper Your Pet with Our</span>
                    <span class="pamper-BIG-text-span">Expert Grooming Services</span>
                </div>
                <div class="pamper-orange-all">
                    <div class="pamper-orange">
                        <span class="pamper-orange-span">Bath & Blow Dry</span>
                        <span class="pamper-orange-span">Nail Trimming</span>
                    </div>
                    <div class="pamper-orange">
                        <span class="pamper-orange-span">Ear Cleaning</span>
                        <span class="pamper-orange-span">Stylish Haircuts</span>
                        <span class="pamper-orange-span">Brush-Outs</span>
                    </div>
                </div>
                <div class="pamper-descr-text">
                    <span class="pamper-descr-text-span">At Vet care, our professional grooming services are</span>
                    <span class="pamper-descr-text-span">designed to keep your furry friends looking and</span>
                    <span class="pamper-descr-text-span">feeling their absolute best.</span>
                </div>
                <div class="pamper-text-links-book">
                    <a href="Appoinment_Booking.html" class="Book book-cost">Book Appointment</a>
                    <div>
                        <a>
                            <span>Large Breeds (40-80 lbs):</span>
                            <span class="pamper-text-links-book-span-special"> $70</span>

                            <img src="image/pamper-small-bottom-arrow.png" alt="pamper-small-bottom-arrow" class="pamper-small-bottom-arrow">
                        </a>
                    </div>

                </div>
            </div>
            <div class="gallery">
                <div class="main-image">
                    <img id="main-img" src="image/pamper-img.png" alt="Main image">
                </div>
                <div class="thumbnails">
                    <img class="thumbnail" src="image/pamper-small-img.png" alt="Thumbnail 1">
                    <img class="thumbnail" src="image/pamper-small-img-2.png" alt="Thumbnail 2">
                    <img class="thumbnail" src="image/pamper-small-img-3.png" alt="Thumbnail 3">
                </div>
                <script src="script.js"></script>
            </div>

    </section>
    <?php include __DIR__ . '/structure/footer.php'; ?>
    <?php include __DIR__ . '/structure/chat-container.php'; ?>
    <?php include __DIR__ . '/structure/login.php' ?>
    <?php include __DIR__ . '/structure/signUp.php' ?>
    <script src="scripts/total_js.js"></script>
    <script src="scripts/script.js"></script>
</body>

</html>