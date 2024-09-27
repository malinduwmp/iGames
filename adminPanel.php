<?php
session_start();

require "connection.php";

if (isset($_SESSION["au"])) {
?>

    <?php

$today = date("Y-m-d");
$thismonth = date("m");
$thisyear = date("Y");

$a = 0; // Daily earnings
$b = 0; // Monthly earnings
$c = 0; // Today selling count
$e = 0; // Monthly selling count
$f = 0; // Total selling count

$invoice_rs = Database::search("SELECT * FROM `invoice`");
$invoice_num = $invoice_rs->num_rows;

for ($x = 0; $x < $invoice_num; $x++) {
    $invoice_data = $invoice_rs->fetch_assoc();

    $d = $invoice_data["date"];
    $pdate = date("Y-m-d", strtotime($d)); // Convert to Y-m-d format

    if ($pdate == $today) {
        $a += $invoice_data["total"]; // Update daily earnings
        $c++; // Increment today selling count
    }

    $pyear = date("Y", strtotime($d)); // Extract year
    $pmonth = date("m", strtotime($d)); // Extract month

    if ($pyear == $thisyear && $pmonth == $thismonth) {
        $b += $invoice_data["total"]; // Update monthly earnings
        $e++; // Increment monthly selling count
    }

    $f++; // Increment total selling count
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Infinity Games</title>
    <link rel="icon" href="resources/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'adminnav.php'; ?>

    <main class="container-fluid mt-4">
        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Sales Overview</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Sales: 350</p>
                        <p class="card-text">Today's Sales: 15</p>
                        <p class="card-text">Monthly Revenue: $12,500</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Recent Transactions</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <img src="resources/product1.jpg" alt="Product Image" class="me-2" style="width: 50px; height: auto;">
                                <div>
                                    <h6 class="mb-0">Game Title 1</h6>
                                    <p class="mb-0">$49.99</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <img src="resources/product2.jpg" alt="Product Image" class="me-2" style="width: 50px; height: auto;">
                                <div>
                                    <h6 class="mb-0">Game Title 2</h6>
                                    <p class="mb-0">$29.99</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <img src="resources/product3.jpg" alt="Product Image" class="me-2" style="width: 50px; height: auto;">
                                <div>
                                    <h6 class="mb-0">Game Title 3</h6>
                                    <p class="mb-0">$39.99</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

             
            </div>
            <div class="col-lg-9 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Sales Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Active Users</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Users: 1200</p>
                        <p class="card-text">Active Today: 800</p>
                        <p class="card-text">New Signups: 50</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2024 Infinity Games. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <!-- Custom Script -->
    <script src="js/script.js"></script>

    <script>
        // Sample Chart Data
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Monthly Sales ($)',
                    data: [5000, 6000, 8000, 7000, 9000, 10000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
<?php } ?>