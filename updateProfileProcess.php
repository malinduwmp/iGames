<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $user_email = $_SESSION["u"]["email"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $dob = $_POST["dob"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $user_email . "'");
    $user_num = $user_rs->num_rows;

    if($user_num == 1){

        Database::iud("UPDATE `users` SET `fname`='".$fname."',`lname`='".$lname."',`dob`='".$dob."',
                        `username`='".$username."' WHERE `email` = '" . $user_email . "'");

        echo ("success");

    }else{

        echo ("You are not a valid user");

    }

}


