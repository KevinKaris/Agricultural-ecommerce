<?php session_start(); error_reporting(0);?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgb(12, 118, 84)">
    <link href="../used libralies/css/bootstrap.min.css" rel="stylesheet">
    <script src="../used libralies/js/bootstrap.bundle.min.js"></script>
    <script src="../used libralies/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css-files/homepage.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css">
    <?php
    if(!empty($title)){
        echo '<title>'.$title.'</title>';
    }
    else{
        echo '<title>Link directly | Direct-Link</title>';
    }
    ?>
    <header class="navbar fixed-top shadow">
        <nav class="col-md-12 top-nav">
            <div>
                <a href="transport"class="mx-2" style="border-right: 1px solid #dddddd;"><i class="fa-solid fa-truck-fast"></i> Transport Services</a>
                <a href="#socialmedia"><i class="fa-regular fa-address-book"></i> Contact Us</a>
            </div>
            <div>
                <a href="#"><i class="fab fa-google-play"></i>Playstore</a>
                <a href="#" style="border-left: 1px solid #dddddd;"><i class="fa-brands fa-apple"></i> Appstore</a>
                <a href="#" style="border-left: 1px solid #dddddd;"><i class="fa-solid fa-rectangle-ad"></i> Advertise more with us</a>
            </div>
        </nav>
        <nav class="col-md-12">
            <a href="about" id="about"><i class="fa-solid fa-people-group"></i> About us</a>
            <a href="help" id="help"><i class="fa-regular fa-circle-question"></i> Help</a>
            <a href="../Buyer-Portal/request-product" id="requests"><i class="fa-solid fa-file-signature"></i>
                Request a product</a>
            <!-- <div class="comments" id="comments1">
                // include '../DB-config/db-config.php';

                // $UNREAD = "SELECT * FROM comments WHERE status = 0";
                // $run = mysqli_query($connection, $UNREAD);
                // $count = mysqli_num_rows($run);
                <button type="button" class="btn btn-sm"><i class="fa-solid fa-comment"></i>
                <mark>10</mark>
                </button>
                <div class="each-comment">
                    
                    // while($each_row = mysqli_fetch_assoc($run)){
                        // $url = $each_row['page_url'];
                        // $url_components = parse_url($url);
                        // parse_str($url_components['query'], $params);
                        // $product_id = $params['detail-id'];

                        // $product_query = "SELECT * FROM product WHERE id = '$product_id'";
                        // $execute = mysqli_query($connection, $product_query);
                        // $product_row = mysqli_fetch_assoc($execute)
                    <a href='' class="py-2 px-2"></a>
                </div>
            </div> -->

            <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle"><i class="fa-solid fa-user-check"></i>
                    <?php if (isset($_SESSION['id']) && time() - $_SESSION['login-time'] <= 21600 && isset($_SESSION['idbuyeremail'])) {
                        include '../DB-config/db-config.php';
                        $id = $_SESSION['id'];
                        $SELECT = "SELECT * FROM buyer_signup WHERE id = $id";

                        $result = mysqli_query($connection, $SELECT);
                        $num_of_rows = mysqli_num_rows($result);
                        $data = mysqli_fetch_assoc($result);
                        $username = 'Hi, ' . $data['first_name'];

                        //badges
                        $SELECT2 = "SELECT * FROM buyer_request WHERE buyer_id = $id";
                        $result2 = mysqli_query($connection, $SELECT2);
                        $num_of_rows2 = mysqli_num_rows($result2);
                        if ($num_of_rows2 > 0) {
                            $present_rows = $num_of_rows2;
                        } else {
                            $num_of_rows2 = null;
                        }
                    } elseif (time() - $_SESSION['login-time'] >= 12600) {
                            session_unset();
                            $_SESSION['expiry'] = '<b>Session ended. PLease log in<b>';
                            //header('location: ../buyer/buyer-login-signup.php');
                            echo '<script>window.location.assign("../buyer/buyer-login-signup.php")</script>';
                    } ?>
                    <word>
                        <?php echo $username; ?>
                    </word>
                </button>
                <div class="dropdown-items">
                    <a href="requests" class="py-2 px-2">Requests <span class="badge bg-primary">
                            <?php if (isset($present_rows)) {
                                echo $num_of_rows2;
                            } ?>
                        </span></a>
                    <a href="profile" class="py-2 px-2">Profile</a>
                    <a href="../server/blogout.php" class="py-2 px-2">Logout</a>
                </div>
            </div>
            <div id="search">
                <form action="../buyer/search" method="get" class="form-group" autocomplete="off" id="search_form">
                    <input class="form-control w-75 search-input" type="text"
                        placeholder="Search fruits, vegetables, cereals, cattle, poutry..." name="search"
                        required><button id="Search-button" class="btn btn-success form-control w-25 mx-4 shadow"
                        type="submit" name="search-button"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;
                        <span>Search</span></button><button id="close-search"><i class="fa-solid fa-xmark"></i></button>
                </form>
                <div id="search-suggestion" class="mt-2 shadow"></div>
            </div>
            <a href="#" id="mobile-search-opener"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="home" title="home page" id="logo" class="nav-brand"><img src="../images/logo-removebg.png"
                    alt=""></a>
            <a href="javascript:void();" id="bars"><i class="fas fa-bars" id="open-menu"></i></a>
        </nav>
        <section class="col-4">
            <a href="javascript:void();" id="close" align="center"><i class="fa-solid fa-xmark"></i></a>
            <a href="request-product"><i class="fa-solid fa-file-signature"></i> Request a
                product</a>
            <!-- <div class="comments" id="comments2">
                <button type="button" class="btn btn-sm"><i class="fa-solid fa-comment"></i>&nbsp;Comments&nbsp;&nbsp;
                <mark>10</mark></button>
                <div class="each-comment">
                    <a href="profile" class="py-2 px-2">Profile</a>
                    <a href="../server/blogout.php" class="py-2 px-2">Logout</a>
                </div>
            </div> -->
            <a href="prices"><i class="fa-solid fa-shop"></i> Market prices</a>
            <a href="transport"><i class="fa-solid fa-truck-fast"></i> Transport Services</a>
            <a href="#"><i class="fab fa-google-play"></i> Playstore</a>
            <a href="#"><i class="fa-brands fa-apple"></i> Appstore</a>
            <a href="#"><i class="fa-solid fa-rectangle-ad"></i> Advertise more with us</a>
            <a href="about"><i class="fa-solid fa-people-group"></i> About us</a>
            <a href="help"><i class="fa-regular fa-circle-question"></i> Help</a>
            <div class="categories">
                <div class="title" align="center">Product categories</div>
                <form action="category" method="get">
                    <input type="hidden" name="category-id" value="Vegetable">
                    <button type="submit">Vegetables</button>
                </form>
                <form action="category" method="get">
                    <input type="hidden" name="category-id" value="Cereals">
                    <button type="submit">Cereals</button>
                </form>
                <form action="category" method="get">
                    <input type="hidden" name="category-id" value="Fruits">
                    <button type="submit">Fruits</button>
                </form>
                <form action="category" method="get">
                    <input type="hidden" name="category-id" value="Poutry">
                    <button type="submit">Poutry</button>
                </form>
                <form action="category" method="get">
                    <input type="hidden" name="category-id" value="Cattle">
                    <button type="submit">Cattle</button>
                </form>
                <form action="category" method="get">
                    <input type="hidden" name="category-id" value="Other">
                    <button type="submit">Other</button>
                </form>
            </div>
        </section>
    </header>
</head>