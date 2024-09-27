<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinity Games - Home</title>
    <link rel="icon" href="resources/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="row">
    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
    <div class="elfsight-app-6c880291-238e-4c4f-8f82-089ebc107966" data-elfsight-app-lazy></div>
            <!-- Header -->
            <header class="header navbar navbar-expand-lg navbar-light bg-black opacity-25 text-white" id="home-section">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="resources/logo.png" class="logo" alt="Infinity Game Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-white" id="navbarNav">
                    <ul class="navbar-nav ml-auto text-white"  >
                        <li class="nav-item ">
                            <a class="nav-link text-white fw-bold" href="#" style="cursor: pointer;" onclick="scrollToProducts()"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="#" style="cursor: pointer;" onclick="scrollTogame()"><i class="fa fa-gamepad" aria-hidden="true"></i> Games</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" style="cursor: pointer;" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" style="cursor: pointer;" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" style="cursor: pointer;" href="watchlist.php"><i class="fa fa-list" aria-hidden="true"></i> Watch List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" style="cursor: pointer;" href="advancedSearch.php"><i class="fa fa-search" aria-hidden="true"></i> Discover more</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 ml-lg-3" onsubmit="basicSearch(event, 1);">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" id="kw" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </header>
        <!-- End Header -->


        <!-- basicSearchResult -->
        <div class="container mt-5" id="basicSearchResult">
        <div class="row">

        </div>
        
        </div>
        <!-- basicSearchResult -->

        <!-- Banners -->
        <div class="banner" style="background-image: url('image/bac/v.jpg');">
            <!-- Content for GTA V -->
            <div class="content gtav active">
                <img src="image/logo/Gta_5_Wallpapers_Cartoon-removebg-preview.png" alt="" class="Game-title">
                <h4><span>GTA V</span><i>18+</i><span>Best Action Game</span><span>Now on Infinity Games</span></h4>
                <p>
                    In the sprawling metropolis of Retribution Heights, corruption runs deep, and power is bought with blood.
                    The city's fate rests in the hands of three unlikely allies, each with their own dark past and desperate motives.
                </p>
                <div class="button">
                    <a href="#" onclick="scrollTogame()"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Shop now</a>
                    <div class="trailer">
                        <video src="https://youtu.be/QkkoHAzjnUs?si=NCv_S2MB-rZB8z_W" muted controls="true" autoplay="true"></video>
                        <img src="image/—Pngtree—icon close button_4401093.png" alt="" class="close" onclick="toggleVideo();">
                    </div>
                </div>
            </div>
            <!-- End Content for GTA V -->

            <!-- Content for Assassin's Creed Shadows -->
            <div class="content acs">
                <img src="image/logo/Assassin's_Creed_Shadows_text_logo.svg.png" alt="" class="Game-title">
                <h4><span>Assassin's Creed Shadows</span><i>18+</i><span>Best Fighting Game</span><span>Now on Infinity Games</span></h4>
                <p>
                    In the sprawling metropolis of Retribution Heights, corruption runs deep, and power is bought with blood.
                    The city's fate rests in the hands of three unlikely allies, each with their own dark past and desperate motives.
                </p>
                <div class="button">
                    <a href="#" onclick="scrollTogame()"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Shop now</a>
                    <div class="trailer">
                        <video src="https://youtu.be/QkkoHAzjnUs?si=NCv_S2MB-rZB8z_W" muted controls="true" autoplay="true"></video>
                        <img src="image/—Pngtree—icon close button_4401093.png" alt="" class="close" onclick="toggleVideo();">
                    </div>
                </div>
            </div>
            <!-- End Content for Assassin's Creed Shadows -->

            <!-- Content for Ghost Of Tsushima -->
            <div class="content ghostoft">
                <img src="image/logo/kisspng-ghost-of-tsushima-playstation-4-sucker-punch-produ-ghost-of-tsushima-5b22a56683f255.5998584615289972225405.png" alt="" class="Game-title">
                <h4><span>Ghost Of Tsushima</span><i>18+</i><span>Best Action Game</span><span>Now on Infinity Games</span></h4>
                <p>
                    In the sprawling metropolis of Retribution Heights, corruption runs deep, and power is bought with blood.
                    The city's fate rests in the hands of three unlikely allies, each with their own dark past and desperate motives.
                </p>
                <div class="button">
                    <a href="#" onclick="scrollTogame()"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Shop now</a>
                    <div class="trailer">
                        <video src="https://youtu.be/QkkoHAzjnUs?si=NCv_S2MB-rZB8z_W" muted controls="true" autoplay="true"></video>
                        <img src="image/—Pngtree—icon close button_4401093.png" alt="" class="close" onclick="toggleVideo();">
                    </div>
                </div>
            </div>
            <!-- End Content for Ghost Of Tsushima -->

            <!-- Content for Call of Duty MW -->
            <div class="content codmw">
                <img src="image/logo/Call_of_Duty_Modern_Warfare_Logo.png" alt="" class="Game-title">
                <h4><span>Call of Duty MW</span><i>18+</i><span>Best Action Game</span><span>Now on Infinity Games</span></h4>
                <p>
                    In the sprawling metropolis of Retribution Heights, corruption runs deep, and power is bought with blood.
                    The city's fate rests in the hands of three unlikely allies, each with their own dark past and desperate motives.
                </p>
                <div class="button">
                    <a href="#" onclick="scrollTogame()"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Shop now</a>
                    <div class="trailer">
                        <video src="https://youtu.be/QkkoHAzjnUs?si=NCv_S2MB-rZB8z_W" muted controls="true" autoplay="true"></video>
                        <img src="image/—Pngtree—icon close button_4401093.png" alt="" class="close" onclick="toggleVideo();">
                    </div>
                </div>
            </div>
            <!-- End Content for Call of Duty MW -->

            <!-- Content for Forza Horizon Five -->
            <div class="content fh5">
                <img src="image/logo/Forza_Horizon_logo.svg.png" alt="" class="Game-title">
                <h4><span>Forza Horizon Five</span><i>18+</i><span>Best Action Game</span><span>Now on Infinity Games</span></h4>
                <p>
                    In the sprawling metropolis of Retribution Heights, corruption runs deep, and power is bought with blood.
                    The city's fate rests in the hands of three unlikely allies, each with their own dark past and desperate motives.
                </p>
                <div class="button">
                    <a href="#" onclick="scrollTogame()"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Shop now</a>
                    <div class="trailer">
                        <video src="https://youtu.be/QkkoHAzjnUs?si=NCv_S2MB-rZB8z_W" muted controls="true" autoplay="true"></video>
                        <img src="image/—Pngtree—icon close button_4401093.png" alt="" class="close" onclick="toggleVideo();">
                    </div>
                </div>
            </div>
            <!-- End Content for Forza Horizon Five -->

            <!-- carousel box -->
            <div class="container mt-5 carousel-container">
                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="image/poster/1.jpeg" class="d-block w-100" alt="..." onclick="changeBg('v.jpg', 'gtav')">
                        </div>
                        <div class="carousel-item">
                            <img src="image/poster/4.jpg" class="d-block w-100" alt="..." onclick="changeBg('2.jpeg', 'acs')">
                        </div>
                        <div class="carousel-item">
                            <img src="image/poster/3.jpg" class="d-block w-100" alt="..." onclick="changeBg('3.jpg', 'ghostoft')">
                        </div>
                        <div class="carousel-item">
                            <img src="image/poster/2.jpg" class="d-block w-100" alt="..." onclick="changeBg('4.jpg', 'codmw')">
                        </div>
                        <div class="carousel-item">
                            <img src="image/poster/5.webp" class="d-block w-100" alt="..." onclick="changeBg('5.jpg', 'fh5')">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- end carousel box -->
        </div>
        <!-- End Banners -->

    </div>
</div>


<!-- Load Products -->
<div class="container mt-5" id="prsectionq">
    <!-- Products will be loaded here -->
    <?php
    include "connection.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $pageno = isset($_POST["p"]) ? (int)$_POST["p"] : 1;
    $results_per_page = 8;
    $offset = ($pageno - 1) * $results_per_page;

    // Ensure offset is not negative
    if ($offset < 0) {
        $offset = 0;
    }

    // Query to fetch products with required information and the first image for each product
    $q = "SELECT p.id, p.title, p.price, c.cat_name, a.`limit`, 
        (SELECT pi.img_path FROM product_img pi WHERE pi.product_id = p.id LIMIT 1) AS img_path
      FROM product p 
      INNER JOIN category c ON p.category_cat_id = c.cat_id 
      INNER JOIN agelimit a ON p.agelimit_age_id = a.age_id 
      WHERE p.status_status_id = 1 
      ORDER BY p.id ASC 
      LIMIT $results_per_page OFFSET $offset";

    $rs = Database::search($q);

    if (!$rs) {
        echo "No Product Here..";
    } else {
        echo '<div class="container mt-5" id="products-section">
            <div class="row" id="pid">';
        while ($d = $rs->fetch_assoc()) {

            echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center" >
        <div class="card bg-dark text-white product-card " >
            <a href="singleProductView.php?id=' . $d["id"] . '">
                <img src="' . $d["img_path"] . '" class="card-img-top product-img" alt="Product Image">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">' . $d["title"] . '</h5>
                <p class="card-text">Category: ' . $d["cat_name"] . '</p>
                <p class="card-text">Age Limit: ' . $d["limit"] . '</p>
                <p class="card-text text-success">Rs: ' . $d["price"] . '</p>
                <div class="d-flex justify-content-center mt-2">
                    <button class="btn btn-outline-danger watchlist-btn" onclick="addToWatchlist(' . $d['id'] . ');">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
            </div>
        </div>
      </div>';
        }
        echo '</div></div>';

        // Pagination
        $q2 = "SELECT COUNT(*) as total FROM product WHERE status_status_id = 1";
        $rs2 = Database::search($q2);
        if (!$rs2) {
            die("Count query failed: " . Database::getLastInsertId()->error);
        }
        $total_records = $rs2->fetch_assoc()['total'];
        $num_of_pages = ceil($total_records / $results_per_page);

        echo '<div class="col-12 d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">';

        // Previous Page
        echo '<li class="page-item"><a class="page-link" ';
        if ($pageno <= 1) {
            echo "#";
        } else {
            echo 'onclick="loadProduct(' . ($pageno - 1) . ');"';
        }
        echo '>Previous</a></li>';

        // Page Numbers
        for ($y = 1; $y <= $num_of_pages; $y++) {
            echo '<li class="page-item ';
            if ($y == $pageno) {
                echo 'active';
            }
            echo '"><a class="page-link" onclick="loadProduct(' . $y . ');">' . $y . '</a></li>';
        }

        // Next Page
        echo '<li class="page-item"><a class="page-link" ';
        if ($pageno >= $num_of_pages) {
            echo "#";
        } else {
            echo 'onclick="loadProduct(' . ($pageno + 1) . ');"';
        }
        echo '>Next</a></li>';

        echo '</ul></nav></div>';
    }
    ?>
</div>
<!-- End Load Products -->

<button class="scroll-to-top-btn" onclick="scrollToTop()">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<?php include "footer.php"; ?>

<!-- scripts -->
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

<script>
    // JavaScript functions for interactions
    function toggleNav() {
        const nav = document.querySelector('.nav');
        nav.classList.toggle('active');
    }

    function toggleVideo() {
        const trailer = document.querySelector('.trailer');
        trailer.classList.toggle('active');
    }

    function changeBg(image, game) {
        const banner = document.querySelector('.banner');
        banner.style.backgroundImage = `url('image/bac/${image}')`;

        document.querySelectorAll('.content').forEach(content => {
            content.classList.remove('active');
        });

        const activeContent = document.querySelector(`.content.${game}`);
        activeContent.classList.add('active');
    }

    // Automatically change background when carousel item changes
    $('#carouselExample').on('slid.bs.carousel', function() {
        const activeItem = document.querySelector('.carousel-item.active img');
        const bgImage = activeItem.getAttribute('onclick').match(/'([^']+)'/)[1];
        const gameClass = activeItem.getAttribute('onclick').match(/'([^']+)'/g)[1].replace(/'/g, '');
        changeBg(bgImage, gameClass);
    });
</script>

</body>

</html>