<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinity Games | gamerlk</title>
    <link rel="icon" href="resources/logo.png">
    <link rel="stylesheet" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .game-item {
            background-color: #333;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .game-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .game-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            margin-top: 10px;
        }

        .game-price {
            font-size: 1.1rem;
            color: #ffc107;
            margin-top: 5px;
        }

        .game-feedback,
        .game-download {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Header -->
        <?php
        session_start();
        include "heder2.php";
        require "connection.php";

        if (isset($_SESSION["u"])) {
            $email = $_SESSION["u"]["email"];
            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $email . "'");
            $invoice_num = $invoice_rs->num_rows;
        ?>

            <!-- My Download Section -->
            <div class="row mt-3">
                <div class="offset-lg-3 col-lg-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Game">
                        <button class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>

            <!-- Game List -->
            <?php
            if ($invoice_num == 0) {
            ?>
                <div class="row mt-3">
                    <div class="col-12 text-center" style="height: 450px; background-color: #252526;">
                        <span class="fs-1 fw-bold text-light d-block" style="margin-top: 200px;">You have not purchased any games yet...</span>
                    </div>
                </div>
                <?php
            } else {
                while ($invoice_data = $invoice_rs->fetch_assoc()) {
                    $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON product.id = product_img.product_id INNER JOIN `product_path` ON product.id = product_path.product_id WHERE `id`='" . $invoice_data["product_id"] . "'");
                    $product_data = $details_rs->fetch_assoc();
                ?>
                    <div class="row mt-3 mt-5 game-item">
                        <div class="col-lg-1 mt-5">
                            <span class="fs-4 fw-bold text-white">#<?php echo $invoice_data["id"]; ?></span>
                        </div>
                        <div class="col-lg-2 ">
                            <img src="<?php echo $product_data["img_path"]; ?>" alt="Game Image" class="img-fluid rounded">
                        </div>
                        <div class="col-lg-1 mt-5">
                            <span class="fs-4 fw-bold text-white text-center game-title"><?php echo $product_data["title"]; ?></span>
                        </div>
                        <div class="col-lg-2 mt-5">
                            <span class="fs-4 fw-bold text-light game-price">Rs. <?php echo $invoice_data["total"]; ?></span>
                        </div>
                        <div class="col-lg-2 mt-5">
                            <span class="fs-4 fw-bold text-white"><?php echo $invoice_data["date"]; ?></span>
                        </div>
                        <div class="col-lg-2 mt-5">
                            <a href="<?php echo $product_data['path_product']; ?>" target="_blank" class="btn btn-success fw-bold game-download"><i class="fa-solid fa-download fa-lg"></i> Download</a>
                        </div>
                        <div class="col-lg-2 mt-5 ">
                            <button onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);" class="btn btn-primary fw-bold game-feedback"><i class="fa-solid fa-message"></i> Feedback</button>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <!-- Print and Footer Section -->
            <div class="row mt-4">
                <div class="offset-lg-3 col-lg-6 text-center">
                    <img src="resources/logo.png" alt="Infinity Games Logo" class="img-fluid">
                </div>
                <div class="col-lg-3 mt-2 mb-4">
                    <button onclick="printInvoice1();" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>

            <!-- Modal for Feedback -->
            <?php include "footer.php"; ?>

        <?php
        } else {
            require "banner.php";
        }
        ?>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="vendor/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function printInvoice1() {
            var invoiceContent = document.getElementById('invoice-content');
            if (invoiceContent) {
                var printWindow = window.open('', '', 'width=800,height=600');
                printWindow.document.write('<html><head><title>Print Invoice</title></head><body>');
                printWindow.document.write('<h1>Invoice</h1>');
                printWindow.document.write(invoiceContent.innerHTML);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            } else {
                console.error('Element with ID "invoice-content" not found.');
            }
        }
    });
</script>

</body>

</html>