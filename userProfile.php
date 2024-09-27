<?php
session_start();

// Check if the user is not signed in
if (!isset($_SESSION["u"])) {
    // Redirect to index.php
    header("Location: index.php");
    exit(); // Make sure to exit after redirecting
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>Profile | Infinity Games</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php
            require "connection.php";
            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];
                $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON users.gender_id=gender.id WHERE `email`='" . $email . "'");
                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");
                $details_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
            ?>
                <div class="col-12 text-center my-4">
                    <h1 class="text-white fw-bold" style="font-family: spartan;">My Account</h1>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-lg-4 border-end">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resources/logo.png"  id="profileImgPreview" class="rounded mt-5" style="width:150px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" id="i" class="rounded mt-5" style="width:150px;" />
                                        <?php
                                        }

                                        ?>

                                <span class="text-light">
                                    <?php echo $details_data["id"] . "
                                     " . $details_data["username"]; ?>
                                     </span>
                                <span class="text-light"><?php echo $email; ?>
                                </span>
                                <div class="mb-3">
                                     <label for="imgUploader" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="imgUploader">
                                    <button class="btn btn-success mt-3 col-12" onclick="uploadImg();"><i class="fa-solid fa-image"  ></i>&nbsp; Upload</button>
                                </div>
                             
                                <button class="btn btn-primary col-12 mt-3" onclick="window.location='index.php'"><i class="fa-solid fa-home"></i>&nbsp;Home</button>
                                <button class="btn btn-primary col-12 mt-3" onclick="window.location='purchasingHistory.php'"><i class="fa-solid fa-clock-rotate-left"></i> &nbsp;Purchase History</button>
                                <button class="btn btn-danger col-12 mt-3" onclick="window.location='logout.php'"><i class="fa-solid fa-sign-out-alt"></i>&nbsp;Sign Out</button>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="p-3 py-5">
                                <div class="row">
                                    <h4 class="fw-bold text-center p-3">My Details</h4>
                                    <div class="col-6">
                                        <label class="form-label text-light">First Name</label>
                                        <input type="text" id="fname" style="background-color: #1e1e1e;" class="form-control text-light border-0" value="<?php echo $details_data["fname"]; ?>" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-light">Last Name</label>
                                        <input type="text" id="lname" style="background-color: #1e1e1e;" class="form-control text-light border-0" value="<?php echo $details_data["lname"]; ?>" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-light pt-2">User Name</label>
                                        <input type="text" id="username" style="background-color: #1e1e1e;" class="form-control text-light border-0" value="<?php echo $details_data["username"]; ?>" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-light pt-2">Date of Birth</label>
                                        <input type="date" id="dob" style="background-color: #1e1e1e;" class="form-control text-light text-muted border-0" value="<?php echo $details_data["dob"]; ?>" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-light pt-2">Password</label>
                                        <div class="input-group">
                                            <input type="password" style="background-color: #1e1e1e;" id="pw" readonly value="<?php echo $details_data["password"]; ?>" class="form-control text-danger text-muted border-0" aria-describedby="pwb">
                                            <span style="background-color: #1e1e1e;" class="input-group-text border-0" id="pwb" onclick="togglePasswordVisibility('pw', 'pwIcon');"><i class="fa-solid fa-eye" id="pwIcon"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-light pt-2">Email</label>
                                        <input type="text" id="email" style="background-color: #1e1e1e;" class="form-control text-light text-muted border-0" readonly value="<?php echo $email; ?>" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-light pt-2">Registered Date</label>
                                        <input type="text" style="background-color: #1e1e1e;" class="form-control text-light text-muted border-0" readonly value="<?php echo $details_data["joined_date"]; ?>" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-light pt-2">Gender</label>
                                        <input type="text" style="background-color: #1e1e1e;" class="form-control text-light text-muted border-0" readonly value="<?php echo $details_data["gender_name"]; ?>" />
                                    </div>
                                    <?php if ($details_data['status'] == 1) { ?>
                                    <div class="col-6">
                                        <label class="form-label text-light pt-2">Status</label>
                                        <input type="text" style="background-color: #1e1e1e; font-style: italic;" class="form-control text-success border-0" readonly value="You are an Active user" />
                                    </div>
                                    <?php } ?>
                                    <div class="col-12 d-grid mt-2 pt-4">
                                        <button class="btn btn-success mt-3" onclick="updateProfile();">Update My Profile</button>
                                        <button class="btn btn-danger mt-3" onclick="printUserProfile();">Print your data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo "<p class='text-center text-light'>You are not signed in.</p>";
            }
            ?>
        </div>
    </div>
    <?php require "footer.php"; ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
    function printUserProfile() {
        const userDetails = {
            id: "<?php echo $details_data['id']; ?>",
            username: "<?php echo $details_data['username']; ?>",
            fname: "<?php echo $details_data['fname']; ?>",
            lname: "<?php echo $details_data['lname']; ?>",
            dob: "<?php echo $details_data['dob']; ?>",
            email: "<?php echo $details_data['email']; ?>",
            joined_date: "<?php echo $details_data['joined_date']; ?>",
            gender: "<?php echo $details_data['gender_name']; ?>",
            status: "<?php echo ($details_data['status'] == 1) ? 'Active' : 'Inactive'; ?>",
            profileImg: "<?php echo !empty($image_data['path']) ? $image_data['path'] : 'resources/logo.png'; ?>"
        };

        const printWindow = window.open('', '', 'height=700,width=700');
        printWindow.document.write('<html><head><title>User Profile</title>');
        printWindow.document.write('<link rel="stylesheet" href="vendor/css/bootstrap.css" />');
        printWindow.document.write('<link rel="stylesheet" href="css/style.css" />');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="container">');
        printWindow.document.write('<h1 class="text-center">User Profile</h1>');
        printWindow.document.write('<img src="' + userDetails.profileImg + '" alt="Profile Image" class="rounded" style="width:150px;"/>');
        printWindow.document.write('<p><strong>ID:</strong> ' + userDetails.id + '</p>');
        printWindow.document.write('<p><strong>Username:</strong> ' + userDetails.username + '</p>');
        printWindow.document.write('<p><strong>First Name:</strong> ' + userDetails.fname + '</p>');
        printWindow.document.write('<p><strong>Last Name:</strong> ' + userDetails.lname + '</p>');
        printWindow.document.write('<p><strong>Date of Birth:</strong> ' + userDetails.dob + '</p>');
        printWindow.document.write('<p><strong>Email:</strong> ' + userDetails.email + '</p>');
        printWindow.document.write('<p><strong>Joined Date:</strong> ' + userDetails.joined_date + '</p>');
        printWindow.document.write('<p><strong>Gender:</strong> ' + userDetails.gender + '</p>');
        printWindow.document.write('<p><strong>Status:</strong> ' + userDetails.status + '</p>');
        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

</body>
</html>

       
