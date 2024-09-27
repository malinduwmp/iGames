<?php
require "connection.php";

// Get the search parameters from the POST request
$search_txt = isset($_POST["t"]) ? $_POST["t"] : "";
$category = isset($_POST["cat"]) ? $_POST["cat"] : 0;
$agelimit = isset($_POST["b"]) ? $_POST["b"] : 0;
$price_from = isset($_POST["pf"]) ? $_POST["pf"] : "";
$price_to = isset($_POST["pt"]) ? $_POST["pt"] : "";
$sort = isset($_POST["s"]) ? $_POST["s"] : 0;
$page = isset($_POST["page"]) ? $_POST["page"] : 1;

// Start building the SQL query
$query = "SELECT * FROM `product` WHERE 1=1";

// Add conditions based on the search parameters
if (!empty($search_txt)) {
    $query .= " AND `title` LIKE '%" . $search_txt . "%'";
}

if ($category != 0) {
    $query .= " AND `category_cat_id`='" . $category . "'";
}

if ($agelimit != 0) {
    $query .= " AND `agelimit_id`='" . $agelimit . "'";
}

if (!empty($price_from)) {
    $query .= " AND `price` >= '" . $price_from . "'";
}

if (!empty($price_to)) {
    $query .= " AND `price` <= '" . $price_to . "'";
}

// Add sorting options
if ($sort == 1) {
    $query .= " ORDER BY `price` ASC";
} else if ($sort == 2) {
    $query .= " ORDER BY `price` DESC";
} else if ($sort == 3) {
    $query .= " ORDER BY `qty` ASC";
} else if ($sort == 4) {
    $query .= " ORDER BY `qty` DESC";
}

// Execute the query and get the total number of results
$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 2; // Change this value to set the number of results per page
$number_of_pages = ceil($product_num / $results_per_page);

// Ensure the current page is within the valid range
$page = max(1, min($page, $number_of_pages));
$page_results = ($page - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . max(0, $page_results));
$selected_num = $selected_rs->num_rows;
?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row justify-content-center gap-4">
            <?php
            if ($selected_num > 0) {
                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();
                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                    $product_img_data = $product_img_rs->fetch_assoc();
            ?>
                    <!-- card -->
                    <div class="card col-12 col-lg-2 mt-2 mb-2 border-0 x btnn" style="width: 18rem; background-color: #1e1e1e">
                        <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>">
                            <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail1 mt-2" style="height: 250px;" />
                        </a>
                        <div class="card-body ms-0 m-0 text-start">
                            <span style="font-size: 14px; color: #606063;"></span>
                            <h5 class="card-title fw-bold text-light" style="font-size: 14px; padding-top: 7px;"><?php echo $selected_data["title"]; ?></h5>
                            <div class="star">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <span class="card-text" style="padding-top: 7px; font-size: 15px; font-weight: 700; color: #81e6d9;">Rs. <?php echo $selected_data["price"]; ?> </span><br />
                            <div class="col-12">
                                <div class="row offset-8">
                                    <button onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);" class="col-3 btn mt-2 btn_c">
                                        <i class="fa-solid fa-heart fa-xl"></i>
                                    </button>
                                    <div class="col-1"></div>
                                    <button onclick="addToCart(<?php echo $selected_data['id']; ?>);" class="col-1 btn mt-2 btn_c">
                                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
            <?php
                }
            } else {
                echo "<div class='no-results'><h3>No products found matching your criteria.</h3></div>";
            }
            ?>
        </div>
    </div>
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link pages" <?php if ($page <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="advancedSearch(<?php echo ($page - 1) ?>);" <?php
                                                                                                    } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $page) {
                ?>
                        <li class="page-item active">
                            <a class="page-link pages" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link pages" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }
                ?>
                <li class="page-item">
                    <a class="page-link pages" <?php if ($page >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="advancedSearch(<?php echo ($page + 1) ?>);" <?php
                                                                                                    } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
