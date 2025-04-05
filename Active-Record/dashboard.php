<?php
session_start(); // Required to access $_SESSION

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    echo "<h1>Welcome back, ";
    foreach ($user as $key => $value){
        setcookie($key, $value, time() + 3600, "/");
        if ($key == "username"){
            echo $value;
        }
    }

    

} else {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./CSS/dashboard.css">
    <form action="logout">
        <input type="submit" >
    </form>
</head>
<body>

    
</body>
</html>