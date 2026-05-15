<div id="loginOverlay">
        <div id="loginWindow">
            <h2>Log in</h2>
            <form action="/php_components/authorization.php" method="post" id="loginForm">
                <input type="text" name="email" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="from_div_login">
                    <button type="submit">Log in</button>
                    <button type="button" id="registration">Sign up</button>
                    <button type="button" id="cancelBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

<?php include './structure/signUp.php'; ?>


