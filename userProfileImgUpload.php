<?php
include "connection.php";
session_start();
$user = $_SESSION["u"];
$user_email = $_SESSION["u"]["email"];

if (empty($_FILES["i"])) {
    echo "empty";
} else {
    $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    if (isset($_FILES["i"])) {
        $img = $_FILES["i"];
        $file_type = $img["type"];

        if (in_array($file_type, $allowed_image_extensions)) {
            $new_file_type = '';
            if ($file_type == "image/jpg") {
                $new_file_type = ".jpg";
            } elseif ($file_type == "image/jpeg") {
                $new_file_type = ".jpeg";
            } elseif ($file_type == "image/png") {
                $new_file_type = ".png";
            } elseif ($file_type == "image/svg+xml") {
                $new_file_type = ".svg";
            }

            $file_name = "resources/profile_img/" . $user_email . "_" . uniqid() . $new_file_type;
            if (move_uploaded_file($img["tmp_name"], $file_name)) {
                // Delete previous image file if exists
                $rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $user_email . "'");
                $image_num = $rs->num_rows;

                if ($image_num == 1) {
                    Database::iud("UPDATE `profile_img` SET `path`='" . $file_name . "' WHERE `users_email` = '" . $user_email . "'");
                } else {
                    Database::iud("INSERT INTO `profile_img`(`path`,`users_email`) VALUES ('" . $file_name . "','" . $user_email . "')");
                }
                echo $file_name; // Return the path of the uploaded file
            } else {
                echo "Failed to move the uploaded file.";
            }
        } else {
            echo "File type is not allowed.";
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
