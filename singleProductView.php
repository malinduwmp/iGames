<?php
require "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    // Fetch product data
    $product_rs = Database::search("
    SELECT p.id, p.price, p.description, p.title, p.datetime_added, 
           p.category_cat_id, p.status_status_id, p.agelimit_age_id,
           (SELECT GROUP_CONCAT(img_path) FROM product_img WHERE product_id = p.id) AS images
    FROM product p
    WHERE p.id = '" . $pid . "'
    ");

    if ($product_rs->num_rows == 1) {
        $product_data = $product_rs->fetch_assoc();

        // Fetch category name
        $category_rs = Database::search("SELECT cat_name FROM category WHERE cat_id = '{$product_data['category_cat_id']}'");
        $category_data = $category_rs->fetch_assoc();
        $category_name = $category_data['cat_name'];

        // Fetch age limit
        $agelimit_rs = Database::search("SELECT `limit` FROM agelimit WHERE age_id = '{$product_data['agelimit_age_id']}'");
        $agelimit_data = $agelimit_rs->fetch_assoc();
        $age_limit = $agelimit_data['limit'];

        // Fetch download count
        $download_rs = Database::search("SELECT COUNT(*) AS download_count FROM invoice WHERE product_id = '$pid'");
        $download_data = $download_rs->fetch_assoc();
        $download_count = $download_data['download_count'];

        // Fetch product images
        $images = explode(',', $product_data['images']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product_data["title"]); ?> | GamerLK</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/logo.png">
    <style>
        body {
            background-color: #1e1e1e;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .product-title {
            color: #81e6d9;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .product-price {
            color: #81e6d9;
            font-size: 2rem;
            font-weight: bold;
        }
        .badge {
            font-size: 1rem;
        }
        .feedback-container {
            background-color: #252526;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .card {
            background-color: #252526;
            border: none;
        }
        .card-title, .card-text {
            color: #fff;
        }
        .btn-primary, .btn-success, .btn-dark {
            width: 100%;
            margin-bottom: 10px;
        }
        .feedback {
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .breadcrumb {
            background-color: transparent;
        }
        .description-box {
            max-height: 200px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include "heder2.php"; ?>
        <div class="row mt-4">
            <div class="col-12 col-lg-6">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $img_path) : ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo htmlspecialchars($img_path); ?>" class="d-block w-100" alt="Product Image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb  bg-dark">
                        <li class="breadcrumb-item text-white"><a href="index.php" class="text-light">Home</a></li>
                        <li class="breadcrumb-item text-white"><a href="category.php?id=<?php echo $product_data['category_cat_id']; ?>" class="text-light"><?php echo htmlspecialchars($category_name); ?></a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page"><?php echo htmlspecialchars($product_data["title"]); ?></li>
                    </ol>
                </nav>
                <h1 class="product-title"><?php echo htmlspecialchars($product_data["title"]); ?></h1>
                <p class="product-price">Rs. <?php echo number_format($product_data["price"], 2); ?></p>
                <p class="badge bg-info">Age Limit: <?php echo htmlspecialchars($age_limit); ?></p>
                <p class="badge bg-secondary">Downloads: <?php echo htmlspecialchars($download_count); ?></p>
                <div class="mb-3">
                    <button class="btn btn-success" onclick="paynow(<?php echo $pid; ?>);">Buy Now</button>
                    <button class="btn btn-primary" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add To Cart</button>
                    <button class="btn btn-dark" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">Watchlist</button>
                </div>
                <h4>Description</h4>
                <div class="description-box">
                    <p><?php echo nl2br(htmlspecialchars($product_data["description"])); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 feedback-container">
                <h2 class="text-center">Feedbacks</h2>
                <?php
                $feedback_rs = Database::search("SELECT * FROM feedback WHERE product_id = '$pid'");
                while ($feedback_data = $feedback_rs->fetch_assoc()) :
                    $user_rs = Database::search("SELECT fname, lname FROM users WHERE email = '{$feedback_data['users_email']}'");
                    $user_data = $user_rs->fetch_assoc();
                ?>
                    <div class="feedback">
                        <h5><?php echo htmlspecialchars($user_data['fname'] . ' ' . $user_data['lname']); ?></h5>
                        <p><?php echo htmlspecialchars($feedback_data['feedback']); ?></p>
                        <span class="badge bg-<?php echo $feedback_data['type'] == 1 ? 'success' : 'danger'; ?>"><?php echo $feedback_data['type'] == 1 ? 'Positive' : 'Negative'; ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h2 class="text-center">Related Products</h2>
                <div class="d-flex justify-content-center flex-wrap">
                <?php
                    $related_rs = Database::search("
                        SELECT p.id, p.title, p.price, 
                               (SELECT img_path FROM product_img WHERE product_id = p.id LIMIT 1) AS img_path 
                        FROM product p 
                        WHERE p.id <> '$pid' AND p.status_status_id = 1 
                        GROUP BY p.id 
                        LIMIT 4
                    ");
                    while ($related_data = $related_rs->fetch_assoc()) :
                ?>
                    <div class="card mx-2 mb-4 product-card  bg-black" style="width: 18rem;">
                        <a href="singleProductView.php?id=<?php echo $related_data['id']; ?>">
                            <img src="<?php echo htmlspecialchars($related_data['img_path']); ?>" class="card-img-top" alt="Related Product Image">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($related_data['title']); ?></h5>
                            <p class="card-text">Rs. <?php echo number_format($related_data['price'], 2); ?></p>
                            <button class="btn btn-dark" onclick="addToWatchlist(<?php echo $related_data['id']; ?>);"><i class="bi bi-heart-fill"></i></button>
                            <button class="btn btn-primary" onclick="addToCart(<?php echo $related_data['id']; ?>);"><i class="bi bi-cart-fill"></i></button>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>
    </div>
    <script src="vendor/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>

<?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>
