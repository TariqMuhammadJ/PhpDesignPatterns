<?php 

if (isset($_SESSION['user'])){
    session_start();
    session_unset();
    session_destroy();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Record Practice</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <main>
        <div class="login" id="login-form">
            <form action="" class="login-form" id="login-form-real">
            <h1>Welcome to the Active Record Pattern</h1>
                <div class="form-email">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-password">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <input type="submit" value="Login">
            </form>
            <div class="alert" id="alert">
                <p id="alert-paragraph"></p>
            </div>
        </div>
    </main>
    <script src="./JS/script.js"></script>
</body>
</html>
