<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];
    $total = 0;
    $subtotal = 0;
    $shipping = 0;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | iGames.com </title>
    <link rel="stylesheet" href="vendor/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="cartstyle.css">
    <link rel="icon" href="resources/logo.png">
    <style>
        body {
            background-color: #252526;
            color: #fff;
        }

        .container-fluid {
            padding: 2rem;
        }

        .card {
            background-color: #1e1e1e;
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }

        .card img {
            transition: transform 0.3s;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        .btn {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #ff5722;
            transform: translateY(-3px);
        }

        .price {
            font-size: 1.5rem;
            color: #ff5722;
        }

        .checkout-btn {
            background-color: #ff5722;
            color: #fff;
            border: none;
            width: 100%;
            padding: 0.75rem;
            font-size: 1.25rem;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #e64a19;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "heder2.php"; ?>

            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="fw-bold">Cart <i class="bi bi-cart4 text-success"></i></h1>
                    </div>

                    <div class="col-12 col-lg-6 mb-3">
                        <input type="text" class="form-control fw-bold bg-dark text-light" placeholder="Search in Cart..." />
                    </div>
                    <div class="col-12 col-lg-2 mb-3 d-grid">
                        <button class="btn fw-bold text-light bg-danger">Search</button>
                    </div>
                </div>
            </div>

            <?php
            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='$user'");
            $cart_num = $cart_rs->num_rows;

            if ($cart_num == 0) {
            ?>
                <div class="col-12 text-center">
                    <h2 class="fw-bold">You have no items in your Cart yet.</h2>
                    <button class="btn btn-lg btn-primary mt-3" onclick="window.location='index.php'">Shop Now <i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            <?php
            } else {
            ?>
                <div class="col-12 col-lg-8 ">
                    <div class="row">
                        <?php
                        for ($x = 0; $x < $cart_num; $x++) {
                            $cart_data = $cart_rs->fetch_assoc();
                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();
                            $category_data = Database::search("SELECT * From `category` WHERE `cat_id`= '" . $cart_data["product_id"] . "'");
                            $category_rs = $category_data->fetch_assoc();
                            $age_data = Database::search("SELECT * From `agelimit` WHERE `age_id`= '" . $cart_data["product_id"] . "'");
                            $age_rs = $age_data->fetch_assoc();
                            $subtotal += $product_data["price"];
                            $images_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                            $images_data = $images_rs->fetch_assoc();
                            $download_rs = Database::search("SELECT COUNT(*) AS download_count FROM `invoice` WHERE product_id='" . $cart_data["product_id"] . "'");
                            $download_data = $download_rs->fetch_assoc();
                            $download_count = $download_data['download_count'];
                        ?>
                            <div class="card mb-3 col-12 bg-dark">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?php echo $images_data["img_path"]; ?>" class="img-fluid rounded-start" alt="Product Image">
                                    </div>
                                    <div class="col-md-5 ">
                                        <div class="card-body ">
                                            <h3 class="card-title text-white"><?php echo $product_data["title"]; ?></h3>
                                            <p class="card-text text-white">Price: Rs. <?php echo $product_data["price"]; ?></p>
                                            <p class="card-text text-white">Rating: 
                                                <span class="star">
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </span>
                                            </p>
                                            <p class="card-text text-white">Downloads: <?php echo $download_count; ?></p>
                                            <p class="card-text text-white">Category: <?php echo $category_rs['cat_name']; ?></p>
                                            <p class="card-text text-white">Age Limit: <?php echo $age_rs['limit']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-flex flex-column justify-content-center">
                                        <button class="btn btn-outline-success mb-2" onclick="paynow(<?php echo $product_data['id'] ?>);">Buy Now <i class="fa-solid fa-money-check-dollar"></i></button>
                                        <button class="btn btn-outline-danger" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove <i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-white">Order Summary</h3>
                            <hr>
                            <div class="products text-white">
                                <?php
                                $cart_rs->data_seek(0);
                                for ($x = 0; $x < $cart_num; $x++) {
                                    $cart_data = $cart_rs->fetch_assoc();
                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();
                                    $images_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                                    $images_data = $images_rs->fetch_assoc();
                                ?>
                                    <div class="d-flex justify-content-between align-items-center my-3">
                                        <img src="<?php echo $images_data["img_path"]; ?>" class="img-fluid rounded" style="width: 60px;">
                                        <span><?php echo $product_data["title"]; ?></span>
                                        <span class="price text-white">Rs. <?php echo $product_data["price"]; ?></span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="text-white">Total:</span>
                                <span class="price">Rs. <?php echo $subtotal; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="vendor/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>
<?php
} else {
    header("Location: noUser.php");
    exit();
}
?>
