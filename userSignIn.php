<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css" />
    <link rel="stylesheet" href="vendor/css/bootstrap.css" />
    <link rel="icon" href="resources/logo.png">
    <title>Infinity Games - User Sign In/Up</title>
    <style>
        .auth-box {
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body class="userAuthBody">
    <div class="container auth-container">
        <!-- logo -->
        <div class="row justify-content-center ">
            <div class="logo">
                <img src="resources/logo.png" alt="Infinity Game Logo">
            </div>
        </div>
        <!-- end logo -->

        <!-- signin box -->
        <div class="col-10 box align-container-center" id="signInBox">
            <div class="row g-3">
                <div class="col-12 text-center ">
                    <br /><br />
                    <p class="title1">Sign In to your Account</p>
                    <span class="text-danger" id="msg2"></span>
                </div>

                <?php
                $email = isset($_COOKIE["email"]) ? $_COOKIE["email"] : "";
                $password = isset($_COOKIE["password"]) ? $_COOKIE["password"] : "";
                ?>

                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" placeholder="Enter your Email address" />
                </div>

                <div class="col-12">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" placeholder="Enter your Email Password" />
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password2', 'toggleIcon');">
                            <i class="fa-solid fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="rememberme" />
                        <label class="form-check-label">Remember Me</label>
                    </div>
                </div>

                <div class="col-6 text-end">
                    <a href="#" class="link-light" onclick="forgotPassword();">Forgot Password?</a>
                </div>

                <div class="col-12 d-grid">
                    <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                </div>

                <div class="col-12 text-center">
                    <a>Don't have an Infinity Games account?</a>
                    <a href="#" class="link-primary" onclick="changeView();">Signup</a>
                    <br /> <br />
                </div>
            </div>
        </div>
        <!-- end signin box -->

        <!-- signup box -->
        <div class="col-12 box align-container-center d-none" id="signUpBox">
            <div class="row g-3">
                <div class="col-12 text-center">
                    <br /><br />
                    <p class="title1">Create New account</p>
                </div>

                <div class="col-12 d-none" id="msgdiv">
                    <div class="alert" id="alertdiv">
                        <i class="fs-5" id="msg"></i>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" placeholder="Enter your first name" />
                </div>

                <div class="col-12 col-lg-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" placeholder="Enter your Last name" />
                </div>

                <div class="col-12">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter your Username" />
                </div>

                
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your Email address" />
                </div>

                <div class="col-12">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="signUpPassword" placeholder="Enter your password" />
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('signUpPassword', 'toggleIconSignUp');">
                            <i class="fa-solid fa-eye" id="toggleIconSignUp"></i>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <label class="form-label">Gender</label>
                    <select class="form-control" id="gender">
                        <option value="0">Select your Gender</option>
                        <?php
                        require "connection.php";
                        $rs = Database::search("SELECT * FROM `gender`");
                        while ($d = $rs->fetch_assoc()) {
                            echo "<option value='{$d['id']}'>{$d['gender_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 col-lg-6">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob">
                </div>

                <div class="col-12 d-grid">
                    <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                </div>

                <div class="col-12 text-center">
                    <a>Have an Infinity Games account?</a>
                    <a href="#" class="link-primary" onclick="changeView();">SignIn</a>
                    <br /><br />
                </div>
            </div>
        </div>
        <!-- end sign up box -->

        <!-- modal -->
        <div class="modal" tabindex="-1" id="forgotPasswordModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white ">Forgot Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label text-white">New Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="npi" />
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('npi', 'e1');"><i class="fa-solid fa-eye" id="e1"  ></i></button>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-white">Re-type Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="rnp" />
                                    <button class="btn btn-outline-secondary" type="button"  onclick="togglePasswordVisibility('rnp', 'e2');"><i class="fa-solid fa-eye" id="e" ></i></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-labeltext-white">Verification Code</label>
                                <input type="password" class="form-control" id="vc" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- footer -->
        <div class="col-12 fixed-bottom">
            <p class="text-center">&copy; 2024 infinityGames.com || All Right Reserved.</p>
        </div>
        <!-- footer -->

    </div>

    <script src="script.js"></script>
    <script src="vendor/js/bootstrap.bundle.js"></script>

</body>

</html>