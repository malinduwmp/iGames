<?php

session_start();
require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberme = $_POST["rememberme"];

if (empty($email)) {
    echo("Please enter your Email");
} else if (strlen($email) > 100) {
    echo("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("Invalid Email");
} else if (empty($password)) {
    echo("Please enter your password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo("Password must have between 5-20 characters");
} else {
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $d = $rs->fetch_assoc();
        if ($d['status'] == 1) {

            $_SESSION["u"] = $d;

            echo ("success");
            
            if ($rememberme == "true") {
                setcookie("email", $email, time() + (60 * 60 * 24 * 365), "/");
                setcookie("password", $password, time() + (60 * 60 * 24 * 365), "/");
            } else {
                setcookie("email", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }
        } else {
            echo ("Your account has been blocked. Contact iGames admin --> igamesinfos@gmail.com");
        }
    } else {
        echo ("Invalid Email Address or Password");
    }
}
