<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinity Games - User Header</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles for the header */
        body {
            background: linear-gradient(to right, #141E30, #243B55);
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            margin: 0;
        }
        .header-bar {
            background-color: #2c3e50; /* Dark background color */
            color: #ffffff; /* White text color */
            padding: 10px 0;
            position: relative;
        }
        .header-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-bar .site-name {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .header-bar .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
        }
        .header-bar .user-profile .username {
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
        }
        .header-bar .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #2c3e50;
            border: 1px solid #ffffff;
            padding: 10px;
            display: none;
            z-index: 1000;
            width: 160px; /* Adjust the width of the dropdown menu */
        }
        .header-bar .dropdown-menu a {
            display: block;
            color: #ffffff;
            text-decoration: none;
            margin-bottom: 5px;
        }
        .header-bar .dropdown-menu a:hover {
            text-decoration: underline;
        }
        .header-bar .my-profile {
            position: relative;
        }
        .header-bar .my-profile .profile-icon {
            border-radius: 50%;
            background-color: #3498db; /* Profile icon background color */
            color: #ffffff; /* Icon color */
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .header-bar .my-profile .profile-icon i {
            font-size: 1.2rem;
        }
        .header-bar .my-profile .dropdown-menu {
            position: absolute;
            top: 50px; /* Adjust the dropdown position relative to profile icon */
            right: 0;
        }
        .header-bar .my-profile.active .dropdown-menu {
            display: block;
        }
        @media (max-width: 768px) {
            .header-bar .container {
                flex-direction: column;
                align-items: stretch;
            }
            .header-bar .user-profile {
                margin-top: 10px;
                justify-content: center;
            }
            .header-bar .site-name {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header-bar">
        <div class="container">
            <div class="site-name">iGames.com</div>
            <div class="user-profile">
                <?php
                session_start();
                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];
                    ?>
                    <div class="username"><?php echo $data["username"]; ?></div>
                    <div class="my-profile">
                        <div class="profile-icon" onclick="toggleDropdown()">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="index.php">Home</a>
                            <a href="userGame.php">History</a>
                            <a href="userProfile.php">Account</a>
                            <a href="#">Help</a>
                            <a href="logout.php" ">Sign Out</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <a href="userSignIn.php" class="text-decoration-none">Sign In or Register</a>
                    <div class="my-profile">
                        <div class="profile-icon" onclick="window.location='userSignIn.php'">
                            <i class="fa fa-user   aria-hidden="true""></i>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-primary" role="button" onclick="window.location='userGame.php'">My Games</button>
            </div>
        </div>
    </div>

    <!-- Your content here -->

    <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            var profile = document.querySelector('.my-profile');
            profile.classList.toggle('active');
        }

        function signOut() {
            console.log('Signing out...');
        }
    </script>
</body>
</html>
