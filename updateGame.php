<?php
session_start();
require "connection.php";
if (isset($_SESSION["au"])) {

    if (isset($_SESSION["p"])) {
        $product = $_SESSION["p"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Game | Infinity Games</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="resources/logo.png">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "adminNav.php"; ?>
            <div class="col-12 mt-4">
                <h1 class="text-center fw-bold">Update Game</h1>
                <div class="row mt-3">
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="category" class="form-label fw-bold">Game Category</label>
                        <select id="category" class="form-select" disabled>
                            <?php
                            $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "'");
                            $category_data = $category_rs->fetch_assoc();
                            ?>
                            <option><?php echo $category_data["cat_name"]; ?></option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="age_limit" class="form-label fw-bold">Age Limit</label>
                        <select id="age_limit" class="form-select" disabled>
                            <?php
                            $age_rs = Database::search("SELECT * FROM `agelimit` WHERE `age_id`='" . $product["agelimit_age_id"] . "'");
                            $age_data = $age_rs->fetch_assoc();
                            ?>
                            <option><?php echo $age_data["limit"]; ?></option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="title" class="form-label fw-bold">Game Name</label>
                        <input type="text" id="title" class="form-control" value="<?php echo $product["title"]; ?>">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="cost" class="form-label fw-bold">Game Price</label>
                        <div class="input-group">
                            <span class="input-group-text">LKR</span>
                            <input type="text" id="cost" class="form-control" value="<?php echo $product["price"]; ?>">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="fileUploader" class="form-label fw-bold">Game File</label>
                        <?php
                        $file_rs = Database::search("SELECT * FROM `product_path` WHERE `product_id`='" . $product["id"] . "'");
                        $file_data = $file_rs->fetch_assoc();
                        ?>
                        <input type="file" id="fileUploader" class="form-control">
                        <small class="form-text fw-bolt text-muted text-white">Current file: <?php echo $file_data["path_product"]; ?></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="desc" class="form-label fw-bold">Game Description</label>
                        <textarea id="desc" rows="5" class="form-control"><?php echo $product["description"]; ?></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Game Images</label>
                        <div class="row mb-3 text-center">
                            <?php
                            $img = array();
                            $img[0] = "resources/empty.png";
                            $img[1] = "resources/empty.png";
                            $img[2] = "resources/empty.png";
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                            $img_num = $img_rs->num_rows;
                            for ($x = 0; $x < $img_num; $x++) {
                                $img_data = $img_rs->fetch_assoc();
                                $img[$x] = $img_data["img_path"];
                            }
                            ?>
                            <div class="col-4">
                                <img src="<?php echo $img[0]; ?>" id="i0" class="img-fluid rounded">
                            </div>
                            <div class="col-4">
                                <img src="<?php echo $img[1]; ?>" id="i1" class="img-fluid rounded">
                            </div>
                            <div class="col-4">
                                <img src="<?php echo $img[2]; ?>" id="i2" class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3 text-center d-flex justify-content-center">
                            <input type="file" class="d-none" id="imageuploader" multiple />
                            <label for="imageuploader" class="col-6 btn btn-primary fw-bold">Upload Images</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <input type="hidden" id="product_id" value="<?php echo $product["id"]; ?>">
                        <button class="col-12 btn btn-primary" onclick="updateProduct();">Update Game</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="vendor/js/bootstrap.bundle.js"></script>

</body>

</html>
<?php
    } else {
?>
<script>
    alert("Please select a product.");
    window.location = "myProducts.php";
</script>
<?php
    }
} else {
    echo ("You are not a valid user");
}
?>
