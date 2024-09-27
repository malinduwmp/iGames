<?php
require "connection.php";

$text = $_POST["t"];
$select = $_POST["s"] ?? 0;
$ageLimit = $_POST["ageLimit"] ?? '';

$query = "SELECT * FROM `product`";

$conditions = [];
if (!empty($text)) {
    $conditions[] = "`title` LIKE '%" . $text . "%'";
}
if ($select != 0) {
    $conditions[] = "`category_cat_id`='" . $select . "'";
}
if (!empty($ageLimit)) {
    $conditions[] = "`agelimit_age_id`='" . $ageLimit . "'";
}
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

if (!empty($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 2;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

$selected_num = $selected_rs->num_rows;

for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();
    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
    $product_img_data = $product_img_rs->fetch_assoc();
?>
    <!-- card -->
    <div div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex row justify-content-center">
        <div class="card bg-dark text-white product-card ">
            <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>">
                <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail1 mt-2" style="height: 250px;" />
            </a>
            <div class="card-body ms-0 m-0 text-start">
                <span style="font-size: 14px; color: #606063;"></span>
                <h5 class="card-title text-white"><?php echo $selected_data["title"]; ?></h5>
                <span class="card-text text-white fw-bold"><?php echo $selected_data["price"]; ?> &nbsp; USD</span>
            </div>
        </div>
    </div>
    <!-- card -->
<?php
}
?>
<!-- Pagination Links -->
<nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination pagination-lg">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous" onclick="basicSearch(event, <?php echo $pageno - 1; ?>);">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        for ($x = 1; $x <= $number_of_pages; $x++) {
        ?>
            <li class="page-item"><a class="page-link" href="#" onclick="basicSearch(event, <?php echo $x; ?>);"><?php echo $x; ?></a></li>
        <?php
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next" onclick="basicSearch(event, <?php echo $pageno + 1; ?>);">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>