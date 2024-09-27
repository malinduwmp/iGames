<?php
require "connection.php";

if(isset($_GET["age_id"])){

    $aid = $_GET["age_id"];

    $age_rs = Database::search("SELECT * FROM `agelimit` WHERE `age_id` ='".$aid."'");

    if($age_rs->num_rows == 1){

        Database::iud("DELETE FROM `agelimit` WHERE `age_id` = '".$aid."'");
        echo ("deleted");
    }else{
        echo ("Please Try Again Later.");
    }

}

?>