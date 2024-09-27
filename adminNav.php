<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navigation | Infinity Games</title>
    <link rel="icon" href="resources/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="container-fluid py-3">
            <div class="row align-items-center">
                <div class="col-12 col-lg-3 logo text-center text-lg-start">
                    <img src="resources/logo.png" alt="Infinity Games Logo">
                    <!-- <span class="company-name ms-2">Infinity Games</span> -->
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="adminPanel.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="myGames.php"><i class="fas fa-cube"></i> Games</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="adminuser.php"><i class="fas fa-users"></i> Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-envelope"></i> Messages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-cogs"></i> Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="signoutA()";><i class="fa fa-sign-out" aria-hidden="true"></i></i>Sign Out </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>