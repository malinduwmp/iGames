<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search | iGames.com</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo.png">
    <style>
        
        body {
            
            background-color: #252526;
            color: #fff;
        }
        .search-container {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 8px;
        }
        .search-container input, .search-container select {
            background-color: #2d2d30;
            color: #fff;
            border: none;
        }
        .search-container input::placeholder, .search-container select {
            color: #aaa;
        }
        .btn-primary {
            background-color: #ff4d05;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e84300;
        }
        .no-results {
            margin-top: 50px;
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>
            <div class="col-12 mt-3">
                <div class="search-container mx-auto col-lg-8">
                    <h2 class="text-center mb-4"><i class="fa fa-search" aria-hidden="true"></i> Advanced Search</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-select" id="c1">
                                <option value="0">Select Category</option>
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;
                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                    echo '<option value="'.$category_data["cat_id"].'">'.$category_data["cat_name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-select" id="b1">
                                <option value="0">Select Game Type</option>
                                <?php
                                $brand_rs = Database::search("SELECT * FROM `agelimit`");
                                $brand_num = $brand_rs->num_rows;
                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();
                                    echo '<option value="'.$brand_data["id"].'">'.$brand_data["limit"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-select" id="s">
                                <option value="0">SORT BY</option>
                                <option value="1">PRICE LOW TO HIGH</option>
                                <option value="2">PRICE HIGH TO LOW</option>
                                <option value="3">QUANTITY LOW TO HIGH</option>
                                <option value="4">QUANTITY HIGH TO LOW</option>
                            </select>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-primary" onclick="advancedSearch(0);"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div id="view_area" class="text-center">
                    <div class="no-results">
                        <i class="bi bi-search h1" style="font-size: 100px;"></i>
                        <h3>No Games Searched Yet...</h3>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="vendor/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
