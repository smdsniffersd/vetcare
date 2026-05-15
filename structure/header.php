<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userauth']) && $_SESSION['userauth'] === true) {
    $loginText = 'Personal account';
    $loginhref = './user_account.php';
    $insession = true;
} else {
    $loginText = "Log in";
    $loginhref = 'javascript:void(0)';
    $insession = false;
}

?>
<header class="header-main">

    <div class="logo">
        <img class="img_logo" src="image/logo.png" alt="Our Logotip">
        <span class="logo_text">Vetcare</span>
    </div>

    <nav class="header_nav">

        <ul class="header_nav_ul">
            <li><a href=".">Home</a></li>
            <li><a href="Service_Page.php">Our Service</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>

    </nav>

    <div class="headerButtons">
        <div id="loginBtn" class="Contact_button"><a href="<?php echo $loginhref; ?>" class="loginBtnText"><?php echo $loginText; ?></a></div>
        <?php if ($insession): ?><a href="./php_components/loguot.php" class="logoutbutton">Log out</a><?php endif; ?>
    </div>

    <?php if ($insession):  ?>
        <script>
            window.userLoggedIn = true;
        </script>
        <div class="notification" id="notification">
            <div id="notificationDiv" class="notificationDiv">
                <div class="notificationBell" onclick="checkNotifications(this)"></div>
                <ul id="notificationUl" class="notificationUl">
                </ul>
            </div>

        </div>

    <?php else: ?><script>
            window.userLoggedIn = false;
        </script><?php endif; ?>

</header>
<header class="header-mobi">


    <a class="logo" href="index.html">
        <img class="img_logo" src="image/logo.png" alt="Our Logotip">
        <span class="logo_text">Vetcare</span>
    </a>

    <button class="menu-toggle" id="menuToggle">
        <img src="image/icons8-50.png" alt="icons8-50.png" class="icons8-50">
    </button>


    <ul class="dropdown-menu" id="dropdownMenu">
        <li><a href="index.html">Home</a></li>
        <li><a href="Service_Page.html">Our Service</a></li>
        <li><a href="about_us.html">About Us</a></li>
        <li><a class="Contact_button-mobi" href="contact_us.html">Contact Us</a></li>
        <li><button id="loginBtn">Log in</button></li>
    </ul>

</header>