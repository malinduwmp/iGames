<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin LogIn | Infinity Game</title>
    <link rel="icon" href="resources/logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
     <!-- Bootstrap CSS -->

</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="logo">
                <img src="resources/logo.png" alt="Infinity Game Logo">
            </div>
            <!-- signin div -->
            <div class="card p-4">
                <h2 class="text-center mb-4 text-white">Admin Log In</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="e" placeholder="Put Your Email address">
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary col-12" onclick="adminVerification();">Send Verification Code</button>
                    <a href="index.php" class="link-custom">or back to Home Page ?</a>
                </div>
                <!-- signin div -->
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verificationModalLabel">Admin Verification</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="vcode" class="form-label">Enter Your Verification Code</label>
                    <input type="text" id="vcode" class="form-control" placeholder="Verification Code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark "  data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Verification Modal -->

    <!-- footer -->
    <div class="footer">
        <p>&copy; 2024 InfinityGames.com | All Rights Reserved</p>
    </div>
    <!-- footer -->

    <script src="script.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="vendor/js/bootstrap.js"></script>
    <!-- Bootstrap Bundle with Popper -->
</body>

</html>
