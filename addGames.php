<?php
session_start();
require "connection.php";
if (isset($_SESSION["au"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Game | Infinity Games</title>
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
                    <h1 class="text-center fw-bold">Add New Game</h1>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="category" class="form-label fw-bold">Select Game Category</label>
                            <select id="category" class="form-select">
                                <option value="0">Select Category</option>
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;
                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="age_limit" class="form-label fw-bold">Select Age Limit</label>
                            <select id="age_limit" class="form-select">
                                <option value="0">Select Age Limit</option>
                                <?php
                                $brand_rs = Database::search("SELECT * FROM `agelimit`");
                                $brand_num = $brand_rs->num_rows;
                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $brand_data["age_id"]; ?>">
                                        <?php echo $brand_data["limit"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="title" class="form-label fw-bold">Game Name</label>
                            <input type="text" id="title" class="form-control">
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="cost" class="form-label fw-bold">Game Price</label>
                            <div class="input-group">
                                <span class="input-group-text">LKR</span>
                                <input type="text" id="cost" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="fileUploader" class="form-label fw-bold">Game File</label>
                            <input type="file" id="fileUploader" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="desc" class="form-label fw-bold">Game Description</label>
                            <textarea id="desc" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Add Game Images</label>
                            <div class="row mb-3 text-center">
                                <div class="col-4">
                                    <img src="resources/empty.png" id="i0" class="img-fluid rounded">
                                </div>
                                <div class="col-4">
                                    <img src="resources/empty.png" id="i1" class="img-fluid rounded">
                                </div>
                                <div class="col-4">
                                    <img src="resources/empty.png" id="i2" class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3 text-center d-flex justify-content-center">
                                <input type="file" class="d-none" id="imageuploader" multiple />
                                <label for="imageuploader" class="col-6 btn btn-primary fw-bold" onclick="changeProductImage();">Upload Images</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="col-12 btn btn-primary" onclick="addProduct();">Save Game</button>
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
    echo ("You are not a valid user");
}
?>
