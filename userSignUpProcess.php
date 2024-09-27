<?php
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];

if (empty($email)) {
    echo "Please enter your Email Address.";
} else if (strlen($email) > 100) {
    echo "Incorrect Email Address.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Not a valid Email Address.";
} else if (empty($password)) {
    echo "Please enter your Password.";
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo "Incorrect password.";
} else if (empty($fname)) {
    echo "Please enter your First Name.";
} else if (empty($lname)) {
    echo "Please enter your Last Name.";
} else if (empty($username)) {
    echo "Please enter your Username.";
} else if ($gender == "0") {
    echo "Please select your Gender.";
} else if (empty($dob)) {
    echo "Please enter your Date of Birth.";
} else {
    $dobDate = new DateTime($dob);
    $today = new DateTime();

    if ($dobDate > $today) {
        echo "Date of birth cannot be in the future.";
    } else {
        // Perform additional server-side validations if needed
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $existingEmailQuery = Database::search("SELECT * FROM `users` WHERE `email`='$email'");
        if ($existingEmailQuery->num_rows > 0) {
            echo "Email is already registered.";
        } else {
            $existingUsernameQuery = Database::search("SELECT * FROM `users` WHERE `username`='$username'");
            if ($existingUsernameQuery->num_rows > 0) {
                echo "Username is already taken.";
            } else {
                Database::iud("INSERT INTO `users` (`fname`, `lname`, `email`, `password`, `joined_date`, `status`, `gender_id`, `dob`, `username`) 
                               VALUES ('$fname', '$lname', '$email', '$password', '$date', '1', '$gender', '$dob', '$username')");
                echo "success";
            }
        }
    }
}
?>

