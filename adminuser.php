
<?php

session_start();
include "connection.php";
if (isset($_SESSION["au"])) {

?>

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management || Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    
<?php include 'adminnav.php'; ?>

         <!-- header -->
         <div class="header-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-12 text-center">
                                <h1 class="text-white fw-bold">Manage All User</h1>
                             
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end header -->

        <div class="col-2 mt-4 offset-1">
            <a href="adminReportUser.php"><button class="btn btn-outline-light col-12 fw-bold">User Report</button></a>
        </div>

        <div class="container offset-1 mt-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-dark py-2 text-end">
                        <span class="fs-5 fw-bold text-white">User Id</span>
                    </div>
                    <div class="col-2 col-lg-2 bg-secondary py-2">
                        <span class="fs-5 fw-bold">First Name</span>
                    </div>
                    <div class="col-2 col-lg-2 bg-dark py-2">
                        <span class="fs-5 fw-bold text-white">Last Name</span>
                    </div>
                    <div class="col-2 col-lg-2 bg-secondary py-2">
                        <span class="fs-5 fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-dark py-2">
                        <span class="fs-5 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-secondary py-2">
                        <span class="fs-5 fw-bold">Status</span>
                    </div>

                    <?php
                    $query = "SELECT * FROM `users`";
                    $pageno = isset($_GET["page"]) ? $_GET["page"] : 1;
                    $user_rs = Database::search($query);
                    $user_num = $user_rs->num_rows;
                    $results_per_page = 5;
                    $number_of_pages = ceil($user_num / $results_per_page);
                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);
                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();
                    ?>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-dark py-2 text-end">
                                <span class="fs-6 fw-bold text-white"><?php echo $x + 1; ?></span>
                            </div>
                            <div class="col-2 col-lg-2 bg-secondary py-2">
                                <span class="fs-6 fw-bold text-white"><?php echo $selected_data["fname"] ?></span>
                            </div>
                            <div class="col-2 col-lg-2 bg-dark py-2">
                                <span class="fs-6 fw-bold"><?php echo $selected_data["lname"] ?></span>
                            </div>
                            <div class="col-4 col-lg-2 bg-secondary py-2">
                                <span class="fs-6 fw-bold"><?php echo $selected_data["email"] ?></span>
                            </div>
                            <div class="col-2 d-none d-lg-block bg-dark  py-2">
                                <span class="fs-6 fw-bold text-white"><?php echo $selected_data["username"] ?></span>
                            </div>
                            <div class="col-2 d-none col-lg-2 d-lg-block bg-secondary py-2">
                                <?php if ($selected_data["status"] == 1) { ?>
                                <button class="col-12 btn btn-danger" id="ub<?php echo $selected_data['email']; ?>"
                                    onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                                <?php } else { ?>
                                <button class="btn btn-success col-12" id="ub<?php echo $selected_data['email']; ?>"
                                    onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    ?>

                    <div class="col-12 d-flex justify-content-center mt-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno - 1);
                                                                    } ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) { ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . $x; ?>"><?php echo $x; ?></a>
                                </li>
                                <?php } else { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . $x; ?>"><?php echo $x; ?></a>
                                </li>
                                <?php
                                    }
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno + 1);
                                                                    } ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
} else {
    echo "You are not a valid user";
}
?>
