<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require "connection.php";

if (!isset($_SESSION['email'])) {
    header('Location: userSignIn.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $dob = $_POST['dob'];
    $joined_date = date("Y-m-d H:i:s");
    $status = 1;

    // Debug statements
    error_log("Email: $email");
    error_log("First Name: $firstName");
    error_log("Last Name: $lastName");
    error_log("Username: $username");
    error_log("Gender: $gender");
    error_log("Country: $country");
    error_log("DOB: $dob");

    // Assuming a function or array to map country to country_id
    $country_id = 1; // Default value or replace with actual logic

    // Check if user already exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = Database::search($query);

    if ($result->num_rows == 0) {
        // Insert new user record
        $insertQuery = "INSERT INTO users (fname, lname, email, password, joined_date, status, gender_id, contry_contry_id , dob, username)
                        VALUES ('$firstName', '$lastName', '$email', '', '$joined_date', '$status', '$gender', '$country_id', '$dob', '$username')";
        Database::iud($insertQuery);
    } else {
        // Update existing user record
        $updateQuery = "UPDATE users SET fname='$firstName', lname='$lastName', username='$username', gender_id='$gender', country_country_id='$country_id', dob='$dob' WHERE email='$email'";
        Database::iud($updateQuery);
    }

    // Clear session data
    session_unset();
    session_destroy();

    // Redirect to index.php
    header('Location: index.php');
    exit();
}
?>
