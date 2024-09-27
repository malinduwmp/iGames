<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('fpdf.php');

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];
    $oid = $_GET["id"];
    
    // Include header
    include "heder2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | InfinityGames</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo.png">
    <style>
  
        .invoice {
            background-color: rgba(255, 255, 255, 0.2); /* Semi-transparent white background */
            backdrop-filter: blur(10px); /* Blur effect for modern browsers */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .invoice header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .invoice main {
            margin-top: 20px;
        }
        .invoice table {
            margin-top: 20px;
        }
        .invoice .notices {
            margin-top: 20px;
        }
        .invoice footer {
            margin-top: 20px;
            font-size: 14px;
        }
        .btn-print {
            background-color: #ff4d05;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice">
            <header>
                <div>
                    <a href="#" class="navbar-brand">
                        <img src="resources/logo.png" class="logo" alt="Infinity Game Logo">
                    </a>
                </div>
                <div class="company-details text-light">
                    <h3 class="text-end">iGames</h3>
                    <div class="text-end">Sri Lanka</div>
                    <div class="text-end">(+94) 71-265-4117</div>
                    <div class="text-end">iGames.com</div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                        <div class="address"><?php echo $umail; ?></div>
                    </div>
                    <?php
                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='$oid'");
                    if ($invoice_rs->num_rows > 0) {
                        $invoice_data = $invoice_rs->fetch_assoc();
                    ?>
                        <div class="col invoice-details">
                            <h1 class="invoice-id fw-bold text-end">INVOICE <?php echo $invoice_data["id"]; ?></h1>
                            <div class="date text-light text-end">Date of Invoice: <?php echo $invoice_data["date"]; ?></div>
                        </div>
                    <?php
                    } else {
                        echo "<div class='col invoice-details text-light'><h1 class='invoice-id fw-bold'>No Invoice Found</h1></div>";
                    }
                    ?>
                </div>
                <?php
                if ($invoice_rs->num_rows > 0) {
                ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">NAME OF THE GAMES</th>
                                <th class="text-right">PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no"><?php echo $invoice_data["id"]; ?></td>
                                <?php
                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();
                                ?>
                                <td class="text-left">
                                    <h3 class="fw-bold text-dark"><?php echo $product_data["title"]; ?></h3>
                                </td>
                                <td class="total">Rs. <?php echo $product_data["price"]; ?>.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="fw-bold">GRAND TOTAL: Rs. <?php echo $invoice_data["total"]; ?>.00</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="col-12 notices">
                        <div class="text-light fs-5">Download And enjoy . Go your MyGames page</div>
                        <div class="notice text-light clo-4" style="font-size: 20px;">
                            <a class="text-decoration-none fw-bold text-light badge bg-success" href="userGame.php" target="_blank"><?php echo $product_data["title"]; ?></a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </main>
            <footer class="text-light">
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
            <div class="col-12 mb-3 toolbar hidden-print">
                <div class="text-end">
                    <button onclick="window.print();" id="printInvoice" class="btn btn-print fw-bold"><i class="fa fa-print"></i> Print Invoice</button>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo "<h2 class='text-center text-light'>You are not logged in</h2>";
    }
    ?>
    <?php include "footer.php" ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="vendor/js/bootstrap.bundle.js"></script>
</body>
</html>
