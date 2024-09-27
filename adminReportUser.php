<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {

    $rs = Database::search("SELECT * FROM `users` ");
    // INNER JOIN `user_type` ON `users`.`user_type_id` = `user_type`.`utype_id`
    //  ORDER BY `users`. `id` ASC");
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
       
        <title>User Report</title>
    </head>

    <body class="bg-light">
 

           
        <div class="container mt-3">
            <a href="adminuser.php"><img src="resources/logo.png" height="25" /></a>
        </div>


        <!-- </div> -->
        <div>
            <div class="container mt-3">
                <h2 class="text-center">User Report</h2>
                <table class=" mt-5 table table-bordered border-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>User Name</th>
                            <th>Joined Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < $num; $i++) {
                            $d = $rs->fetch_assoc();
                        ?>

                            <tr>
                                <td></td> 
                                <td><?php echo $d["fname"] ?></td>
                                <td><?php echo $d["lname"] ?></td>
                                <td><?php echo $d["email"] ?></td>
                                <td><?php echo $d["dob"] ?></td>
                                <td><?php echo $d["username"] ?></td>
                                <td><?php echo $d["joined_date"] ?></td>
                                <td><?php
                                    if ($d["status"] == 1) {
                                        echo ("Active");
                                    } else {
                                        echo ("Inactive");
                                    }
                                    ?></td>


                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-outline-success col-2" onclick="window.print()"> Print</button>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        </body>

    </html>

<?php
} else {
    echo ("You are not a valid Admin");
}
