<?php
include './Classes/class-dao.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST['action'] === "login"){
    $username = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    if (!empty($username) && !empty($password)){
        $user = DAO::getLoginBy($username, $password);

        if ($user){
            session_start();    
            $_SESSION['user'] = $user;
            echo "success";

        } else {
            echo "Invalid Username or password";
        }
    } else {
        echo "Please enter both username and password";
    }


}

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST['action'] === "logout"){
    session_unset();
    
}


?>