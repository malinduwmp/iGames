<?php
        include "connection.php";

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $pageno = isset($_POST["p"]) ? (int)$_POST["p"] : 1;
        $results_per_page = 8;
        $offset = ($pageno - 1) * $results_per_page;

        // Ensure offset is not negative
        if ($offset < 0) {
            $offset = 0;
        }

        // Query to fetch products with required information and the first image for each product
        $q = "SELECT p.id, p.title, p.price, c.cat_name, a.`limit`, 
        (SELECT pi.img_path FROM product_img pi WHERE pi.product_id = p.id LIMIT 1) AS img_path
      FROM product p 
      INNER JOIN category c ON p.category_cat_id = c.cat_id 
      INNER JOIN agelimit a ON p.agelimit_age_id = a.age_id 
      WHERE p.status_status_id = 1 
      ORDER BY p.id ASC 
      LIMIT $results_per_page OFFSET $offset";

        $rs = Database::search($q);

        if (!$rs) {
            echo "No Product Here..";
        } else {
            echo '<div class="container mt-5" id="products-section">
            <div class="row" id="pid">';
            while ($d = $rs->fetch_assoc()) {

                echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center" >
        <div class="card bg-dark text-white product-card " >
            <a href="singleProductView.php?s=' . $d["id"] . '">
                <img src="' . $d["img_path"] . '" class="card-img-top product-img" alt="Product Image">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">' . $d["title"] . '</h5>
                <p class="card-text">Category: ' . $d["cat_name"] . '</p>
                <p class="card-text">Age Limit: ' . $d["limit"] . '</p>
                <p class="card-text text-success">Rs: ' . $d["price"] . '</p>
                <div class="d-flex justify-content-center mt-2">
                    <button class="btn btn-outline-danger watchlist-btn" onclick="addWatchlist(' . $d['id'] . ')">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
            </div>
        </div>
      </div>';
            }
            echo '</div></div>';

            // Pagination
            $q2 = "SELECT COUNT(*) as total FROM product WHERE status_status_id = 1";
            $rs2 = Database::search($q2);
            if (!$rs2) {
                die("Count query failed: " . Database::getLastInsertId()->error);
            }
            $total_records = $rs2->fetch_assoc()['total'];
            $num_of_pages = ceil($total_records / $results_per_page);

            echo '<div class="col-12 d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">';

            // Previous Page
            echo '<li class="page-item"><a class="page-link" ';
            if ($pageno <= 1) {
                echo "#";
            } else {
                echo 'onclick="loadProduct(' . ($pageno - 1) . ');"';
            }
            echo '>Previous</a></li>';

            // Page Numbers
            for ($y = 1; $y <= $num_of_pages; $y++) {
                echo '<li class="page-item ';
                if ($y == $pageno) {
                    echo 'active';
                }
                echo '"><a class="page-link" onclick="loadProduct(' . $y . ');">' . $y . '</a></li>';
            }

            // Next Page
            echo '<li class="page-item"><a class="page-link" ';
            if ($pageno >= $num_of_pages) {
                echo "#";
            } else {
                echo 'onclick="loadProduct(' . ($pageno + 1) . ');"';
            }
            echo '>Next</a></li>';

            echo '</ul></nav></div>';
        }
        ?>