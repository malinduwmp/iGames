<?php
session_start();

// If the user confirms logout, destroy the session and redirect to home page
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>Logout Confirmation | Infinity Games</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center my-5">
                <h1 class="fw-bold">Are you sure you want to sign out?</h1>
                <form method="POST">
                    <button type="submit" name="logout" class="btn btn-danger mt-3"><i class="fa-solid fa-sign-out-alt" onclick="signOut();"></i>&nbsp;Yes I Want</button>
                    <button type="button" class="btn btn-secondary mt-3" onclick="window.location='index.php'"><i class="fa-solid fa-home"  onclick="window.location='index.php'"></i>&nbsp;No Go Back To Home</button>
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/js/bootstrap.bundle.js"></script>
</body>
</html>
