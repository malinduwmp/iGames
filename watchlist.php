<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Watchlist | iGames.com</title>

        <link rel="stylesheet" href="vendor/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <link rel="icon" href="resources/logo.png">

    </head>

    <body>

        <div class="container-fluid">
            <div class="row btnn overflow-hidden">

                <?php include "heder2.php"; ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 rounded mb-2 animate__animated animate__fadeIn">
                            <div class="row">

                                <div class="col-12 d-lg-none mt-4 text-center">
                                    <label class="form-label fs-1 fw-bolder text-white text-center">Watchlist <i class="fa-solid fa-heart fa-lg" style="color: #ff0000;"></i></label>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <hr />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text"  class="form-control fw-bold border-0 text-light" placeholder="Search in Watchlist..." />
                                        </div>
                                        <div class="col-12 col-lg-2 mb-3 d-grid">
                                            <button class="btn fw-bold text-light">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>


                                <?php
                                $watclist_rs = Database::search("SELECT * FROM `watchlist` WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");
                                $watchlist_num = $watclist_rs->num_rows;

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 emptyCart"></div>
                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-1 fw-bold text-light animate__animated animate__fadeIn">You have no items in your watchlist yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-8 offset-2 col-lg-4 d-grid mb-3">
                                                <button class="btn_p fs-3 fw-bold" onclick="window.location='index.php'">Shop Now<i class="fa-solid fa-cart-shopping fa-lg"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $watchlist_num; $x++) {
                                        $watchlist_data = $watclist_rs->fetch_assoc();
                                    ?>
                                        <!-- have products -->
                                        <div class="col-12 col-lg-12">
                                            <div class="row">
                                                <div class="card mb-3 mx-0 mx-lg-2 col-12 bg-dark" >
                                                    <div class="row g-0 animate__animated animate__fadeIn">
                                                        <div class="col-md-4 offset-1 mt-2 bg-dark">

                                                            <?php
                                                            $img = array();
                                                            $images_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                                                            $images_data = $images_rs->fetch_assoc();
                                                            ?>

                                                            <img src="<?php echo $images_data["img_path"]; ?>" class="img-fluid rounded-start p-2" style="max-width: 200px;">
                                                        </div>
                                                        <div class="col-md-4 mt-1">
                                                            <div class="">
                                                                <?php
                                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watchlist_data["product_id"] . "'");
                                                                $product_data = $product_rs->fetch_assoc();
                                                                ?>

                                                                <h5 class="card-title fs-2 fw-bold text-light bg-dar"><?php echo $product_data["title"]; ?></h5>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-light">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-6 text-light">Rs. <?php echo $product_data["price"]; ?></span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-light">Rating :</span>&nbsp;&nbsp;
                                                                <span class="star">
                                                                    <i class="fas fa-star text-warning fs-6"></i>
                                                                    <i class="fas fa-star text-warning fs-6"></i>
                                                                    <i class="fas fa-star text-warning fs-6"></i>
                                                                    <i class="fas fa-star text-warning fs-6"></i>
                                                                    <i class="bi bi-star text-warning fs-6"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-lg-4">
                                                            <div class=" d-grid">
                                                                <a href="#" class="btn btn-outline-success
                                                            mb-2 fw-bold" onclick="paynow(<?php echo $product_data['id'] ?>);">Buy Now&nbsp; <i class="fa-solid fa-money-check-dollar"></i></a>
                                                                <a href="#" class="btn btn-outline-warning mb-2 fw-bold mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart &nbsp;<i class="fa-solid fa-cart-shopping"></i></a>
                                                                <a href="#" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);" class="btn btn-outline-danger fw-bold mb-2 mt-2">Remove &nbsp;<i class="fa-solid fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- have products -->
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "footer.php"; ?>

            </div>
        </div>

        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="vendor/js/bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <?php header("Location: nouser.php");
    exit();
    ?>
<?php
}
?>