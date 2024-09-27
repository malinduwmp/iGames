<?php
session_start();
require "connection.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$category = $_POST["ca"];
$age_limit = $_POST["b"];
$title = $_POST["t"];
$cost = $_POST["cost"];
$desc = $_POST["desc"];
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$uploading_status = 0; // 0 Problem 

$length = sizeof($_FILES);

if ($length > 0 && $length <= 4) {
    // Wrap database operations in try-catch block
    try {
        Database::iud("INSERT INTO `product`(`price`,`description`,`title`,`datetime_added`,`category_cat_id`,`status_status_id`,`agelimit_age_id`) VALUES ('$cost', '$desc', '$title', '$date', '$category', '$status', '$age_limit')");

        // Fetch the last inserted product ID
        $product_id = Database::getLastInsertId();

        $allowed_img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $allowed_file_extensions = array("application/zip");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["img" . $x])) {
                $img_file = $_FILES["img" . $x];
                $file_extension = $img_file["type"];

                if (in_array($file_extension, $allowed_img_extensions)) {
                    $new_img_extension = "";

                    if ($file_extension == "image/jpg") {
                        $new_img_extension = ".jpg";
                    } elseif ($file_extension == "image/jpeg") {
                        $new_img_extension = ".jpeg";
                    } elseif ($file_extension == "image/png") {
                        $new_img_extension = ".png";
                    } elseif ($file_extension == "image/svg+xml") {
                        $new_img_extension = ".svg";
                    }

                    $file_name = "resources/game/" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                    if (move_uploaded_file($img_file["tmp_name"], $file_name)) {
                        Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES ('$file_name', '$product_id')");
                        $uploading_status = 1;
                    } else {
                        $uploading_status = 0;
                        echo ("Failed to move uploaded image file.");
                    }
                } else {
                    $uploading_status = 0;
                    echo ("Not an allowed image type uploaded.");
                }
            }
        }

        // Handle game file upload
        if (isset($_FILES["gameFile"])) {
            $game_file = $_FILES["gameFile"];
            $file_extension = $game_file["type"];

            if (in_array($file_extension, $allowed_file_extensions)) {
                $file_name = "resources/game/file/" . $title . "_game_" . uniqid() . ".zip";
                if (move_uploaded_file($game_file["tmp_name"], $file_name)) {
                    Database::iud("INSERT INTO `product_path`(`product_id`, `path_product`) VALUES ('$product_id', '$file_name')");
                    $uploading_status = 1;
                } else {
                    $uploading_status = 0;
                    echo ("Failed to move uploaded game file.");
                }
            } else {
                $uploading_status = 0;
                echo ("Not an allowed game file type uploaded.");
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    $uploading_status = 0;
    echo ("Invalid Image Count");
}

if ($uploading_status == 1) {
    echo ("success");
}
?>
