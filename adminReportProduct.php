<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {

    $rs = Database::search("SELECT * FROM `product`");

    //   INNER JOIN `product_img` ON `product`.`img_path` = `img_path`. `img_path` "):"

    $num = $rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Custom CSS -->
      
        <title>Product Report</title>
    </head>

    <body>


        <div class="container mt-3">
            <a href="adminuser.php"><img src="resources/logo.png" height="25" /></a>
        </div>


        <div class="container mt-3">
            <h2 class="text-center">Product Report</h2>
            <table class="table table-bordered border-dark mt-5">
                <thead>
                    <tr>
                        <th> Id</th>
                        <th>Title</th>
                        <th>Image</th>

                        <th>Price</th>
                        <th>Category</th>
                        <th>Added Date</th>


                    </tr>
                </thead>

                <tbody>
                    <?php
                    for ($i = 0; $i < $num; $i++) {
                        $d = $rs->fetch_assoc();
                    ?>

                        <tr>
                            <td><?php echo $d["id"] ?></td>
                            <td><?php echo $d["title"] ?></td>
                            <td>
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
                            </td>

                            <td><?php echo $d["price"] ?></td>
                            <td><?php echo $d["category_cat_id"] ?></td>
                            <td><?php echo $d["datetime_added"] ?></td>


                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-outline-success col-2" onclick="window.print()"> Print</button>
        </div>

    </body>

    </html>

<?php
} else {
    echo ("You are not a valid Admin");
}
