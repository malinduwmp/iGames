<?php
session_start();
require "connection.php";
require_once 'vendor/autoload.php'; // Include the Stripe PHP library


if (isset($_GET['session_id']) && isset($_SESSION['u'])) {
    $session_id = $_GET['session_id'];

      

        // Verify payment status
        if ($checkout_session->payment_status === 'paid') {

            $fname = $_SESSION["u"]["fname"];
            $lname = $_SESSION["u"]["lname"];
            $mobile = $_SESSION["u"]["username"];
            $merchant_id = "1227443"; // Replace with your actual merchant ID
            $merchant_secret = "MzI5NTI0NTQzMzMzNjU2MDUwMDQxOTcxNzk0Njg1MzQ5MzIwMDE2NA=="; // Replace with your actual merchant secret
            $currency = "LKR";

            $hash = strtoupper(
                md5(
                    $merchant_id .
                        $order_id .
                        number_format($amount, 2, '.', '') .
                        $currency .
                        strtoupper(md5($merchant_secret))
                )
            );

            $array = [
                "id" => $order_id,
                "item" => $item,
                "amount" => $amount,
                "fname" => $fname,
                "lname" => $lname,
                "mobile" => $mobile,
                "umail" => $umail,
                "address" => "", // Empty as no physical delivery
                "city" => "", // Empty as no physical delivery
                "hash" => $hash,
                "currency" => $currency
            ];


            echo "Payment successful. Thank you for your purchase!";
        } else {
            echo "Payment failed. Please try again.";
        }
   
} else {
    // Handle session data missing error
    echo "Session data not found. Please try again.";
}
