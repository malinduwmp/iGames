<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {


?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Manage Games | gamerLk</title>

        <link rel="stylesheet" href="vendor/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="css/style.css" />

        <link rel="icon" href="resources/logo.png">

    </head>

    <body style="background-color: #252526;">

        <div class="container-fluid">
            <div class="row overflow-x-hidden btnn">
                <?php
                include "adminNav.php";
                ?>

                <!-- header -->
                <div class="header-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-12 text-center">
                                <h1 class="text-white fw-bold">Manage All Games</h1>
                                <button class="btn btn-primary col-10 mt-4" onclick="window.location='addGames.php'">Add New Game</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end header -->

                <!-- scearch aria -->
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Game" aria-label="Search Game" aria-describedby="button-addon2">
                                <button class="btn btn-primary btn-lg fw-bold" type="button" id="button-addon2">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- scearch aria -->


                <!-- game list -->
                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1  py-2 text-end d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">#</span>
                        </div>
                        <div class="col-2 d-none d-lg-block  py-2">
                            <span class="fs-4 fw-bold text-light">Game Image</span>
                        </div>
                        <div class="col-4 col-lg-2  py-2">
                            <span class="fs-4 fw-bold text-white">Title</span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block py-2">
                            <span class="fs-4 fw-bold text-light">Price</span>
                        </div>
                        <div class="col-2 col-lg-1 py-2">
                            <span class="fs-4 fw-bold text-white"><i class="fas fa-download"></i></span>
                        </div>
                        <div class="col-2 d-none d-lg-block py-2">
                            <span class="fs-4 fw-bold text-white">Added Date</span>
                        </div>
                        <div class="col-2 col-lg-1 "></div>
                        <div class="col-2 col-lg-1 "></div>
                    </div>
                </div>

                <?php
                $query = "SELECT * FROM `product`";
                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $product_rs = Database::search($query);
                $product_num = $product_rs->num_rows;

                $results_per_page = 15;
                $number_of_pages = ceil($product_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . "LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();
                ?>

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-2 col-lg-1 py-2 text-end d-none d-lg-block">
                                <span class="fs-5 fw-bold text-white"><?php echo $selected_data["id"]; ?></span>
                            </div>
                            <div class="col-2 d-none d-lg-block py-2 btnn" style="cursor: pointer;" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');">
                                <?php
                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                $image_num = $image_rs->num_rows;
                                if ($image_num == 0) {
                                ?>
                                    <img src="resources/logo.png" style="height: 40px; margin-left: 80px;" />
                                <?php
                                } else {
                                    $image_data = $image_rs->fetch_assoc();
                                ?>
                                    <img src="<?php echo $image_data["img_path"]; ?>" style="height: 40px; margin-left: 80px;" />
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-4 col-lg-2 py-2">
                                <span class="fs-5 fw-bold text-white btnn"><?php echo $selected_data["title"]; ?></span>
                            </div>
                            <div class="col-4 col-lg-2 d-lg-block  py-2">
                                <span class="fs-5 fw-bold text-light btnn">Rs.<?php echo $selected_data["price"]; ?></span>
                            </div>
                            <?php
                            $download_rs = Database::search("SELECT COUNT(*) AS download_count FROM `invoice` WHERE product_id='" . $selected_data["id"] . "'");
                            $download_data = $download_rs->fetch_assoc();
                            $download_count = $download_data['download_count'];
                            ?>
                            <div class="col-2 col-lg-1  py-2">
                                <span class="fs-5 fw-bold text-white"> <?php echo $download_count; ?></span>
                            </div>
                            <div class="col-2 d-none d-lg-block  py-2">
                                <span class="fs-6 fw-bold text-light"><?php echo $selected_data["datetime_added"]; ?></span>
                            </div>

                            <div class="col-2 col-lg-1  py-2 d-grid d-none d-lg-block d-lg-grid">
                                <?php
                                if ($selected_data["status_status_id"] == 1) {
                                ?>
                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');"><i class="fas fa-lock-open"></i></button>
                                <?php
                                } else {
                                ?>
                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');"><i class="fas fa-lock"></i></button>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-2 col-lg-1  py-2 d-grid">
                                <button onclick="sendId(<?php echo $selected_data['id']; ?>);" class="btn btn-danger">
                                    <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i></button>
                            </div>

                        </div>
                    </div>

                    <!-- game list -->



                    <!-- product modal -->
                    <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data["id"]; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark1">
                                <div class="modal-header border-dark">
                                    <h5 class="modal-title fw-bold text-light"><?php echo $selected_data["title"]; ?></h5>
                                    <button type="button" class="btn-close-whitie" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="offset-4 col-4">
                                        <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid" style="height: 150px;" />
                                    </div>
                                    <div class="col-12">
                                        <span class="fs-5 fw-bold text-light">Price :</span>&nbsp;
                                        <span class="fs-5 text-light">Rs. <?php echo $selected_data["price"]; ?></span><br />
                                        <span class="fs-5 fw-bold text-light">Description :</span>&nbsp;
                                        <span class="fs-6 text-light"><?php echo $selected_data["description"]; ?></span><br />
                                    </div>
                                </div>
                                <div class="modal-footer border-dark">
                                    <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product modal -->

                <?php

                }

                ?>

                <!--  pagination-->
                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center ">
                            <li class="page-item">
                                <a class="page-link pages bg-dark" <?php if ($pageno <= 1) {
                                                                        echo ("#");
                                                                    } else {
                                                                        echo "?page=" . ($pageno - 1);

                                                                    ?> " <?php
                                                                        } ?> aria-label=" Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php

                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                if ($y == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link pages" href="<?php echo "?page=" . ($y); ?>"> <?php echo $y; ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item ">
                                        <a class="page-link pages" href="<?php echo "?page=" . ($y); ?>"> <?php echo $y; ?></a>
                                    </li>
                            <?php
                                }
                            }

                            ?>

                            <li class="page-item ">
                                <a class="page-link pages bg-dark" href="<?php if ($pageno >= $number_of_pages) {
                                                                                echo ("#");
                                                                            } else {
                                                                                echo "?page=" . ($pageno + 1);
                                                                            ?>" <?php
                                                                            } ?> aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- pagination -->
                <!-- print gamelist -->
                <div class="col-12 offset-lg-3 a">
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                        </div>
                        <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                           <a href="adminReportProduct.php"><button class="btn btn-danger"><i class="fa fa-print"></i> &nbsp;&nbsp;Print</button></a> 
                        </div>

                    </div>
                </div>
                <!-- print gamelist -->


                <!-- manage category -->
                <hr />

                <div class="col-12 text-center">
                    <h1 class="text-white fw-bold">Manage Game Categories</h1>
                </div>

                <div class="col-12 mb-5 mt-4">
                    <div class="row gap-3 justify-content-center">

                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;
                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-dark rounded p-2">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <input type="text" class="form-control form-control-sm bg-transparent text-white border-0" readonly value="<?php echo $category_data["cat_name"]; ?>">
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <button onclick="removeCategory(<?php echo $category_data['cat_id']; ?>);" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 col-lg-3 border border-success rounded" style="cursor: pointer;" onclick="addNewCategory();">
                            <div class="row">
                                <div class="col-8 mt-2 mb-2">
                                    <input type="text" class="form-control form-control-sm bg-transparent text-white border-0" readonly value="Add new Game Category">
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                    <button class="btn btn-success btn-sm"><i class="bi bi-plus-square-fill"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr />
                <!-- manage category -->


                <!--category  modal  -->
                <div class="modal" tabindex="-1" id="addCategoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Add New Category</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <label class="form-label text-light">New Category Name : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold border-0 text-light" id="n" />
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label text-light">Enter Your Email : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control text-light border-0 fw-bold" id="e" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="verifyCategory();">Save New Category</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<!--category  modal-->


                <!-- modal cat -->
                <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Verification </h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label text-light">Enter Your Verification Code : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="txt" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="saveCategory();">Verify & Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal cat -->

                <!-- manage age limit -->
                <div class="col-12 text-center">
                    <h1 class="text-white fw-bold">Manage Age Limit</h1>
                </div>

                <div class="col-12 mb-5 mt-4">
                    <div class="row gap-3 justify-content-center">

                        <?php
                        $age_rs = Database::search("SELECT * FROM `agelimit`");
                        $age_num = $age_rs->num_rows;
                        for ($x = 0; $x < $age_num; $x++) {
                            $age_data = $age_rs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-dark rounded p-2">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <input type="text" class="form-control form-control-sm bg-transparent text-white border-0" readonly value="<?php echo $age_data["limit"]; ?>">
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <button onclick="removeAgeLimit(<?php echo $age_data['age_id']; ?>);" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 col-lg-3 border border-success rounded" style="cursor: pointer;" onclick="addAgeLimit();">
                            <div class="row">
                                <div class="col-8 mt-2 mb-2">
                                    <input type="text" class="form-control form-control-sm bg-transparent text-white border-0" readonly value="Add new Age Limit">
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                    <button class="btn btn-success btn-sm"><i class="bi bi-plus-square-fill"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- manage age limit -->



                <!-- modal age Limit -->
                <div class="modal" tabindex="-1" id="addAgeLimitModel">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Add New Game Age Limit</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <label class="form-label text-light"> New Game Age Name : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold border-0 text-light" id="type_name" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-light"> New Game Age value : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold border-0 text-light" id="type_id" />
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label text-light">Enter Your Email : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control text-light border-0 fw-bold" id="admin_email_t" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="verifyAge();">Save New Game Type</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- manage age limit -->


                <!--  modal age limit -->
                <div class="modal" tabindex="-1" id="addTypeVerificationModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Verification</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label text-light">Enter Your Verification Code : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="v_code" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="saveAge();">Verify & Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  modal age limit -->


            </div>
        </div>
        <script src="vendor/js/bootstrap.bundle.js"></script>

        <script src="script.js"></script>
    </body>

    </html>
<?php

} else {
    echo ("You are Not a valid user");
}

?>