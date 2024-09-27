<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: userSignIn.php');
    exit();
}
?>

<html>
<head>
    <title>Additional Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<style>
 .box {
  width:100%;
  max-width:400px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
</style>
<body>
    <div class="container">
        <div class="box">
            <h3 align="center">Complete Your Profile</h3>
            <form method="post" action="saveUserInfo.php">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" value="<?php echo $_SESSION['firstName']; ?>" required readonly/>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" value="<?php echo $_SESSION['lastName']; ?>" required readonly/>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" required readonly/>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" class="form-control" required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Save" class="btn btn-success form-control"/>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
