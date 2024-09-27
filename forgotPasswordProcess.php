<?php

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    if (empty($email)) {
        echo ("Please Enter Your email !!!");
    } else {
        $rs = Database::search("SELECT * FROM `users` WHERE `email` ='" . $email . "'");
        $n = $rs->num_rows;

        if ($n == 1) {

            $code = uniqid();

            Database::iud("UPDATE `users` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'igamesinfos@gmail.com';
                $mail->Password = 'cwjv xedp ajir oysq';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                //Recipients
                $mail->setFrom('igamesinfos@gmail.com', 'Reset Password');
                $mail->addReplyTo('igamesinfos@gmail.com', 'Reset Password');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'InfinityGames Forgot Password Verification Code';
                $mail->Body    = '<h1 style="color:green">Your Verification Code is : ' . $code . '</h1>';

                $mail->send();
                echo ("success");
            } catch (Exception $e) {
                echo ("Verification code sending failed: {$mail->ErrorInfo}");
            }
        } else {
            echo ("Invalid Email address");
        }
    }
}
?>
