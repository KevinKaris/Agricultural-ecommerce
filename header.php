<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgb(12, 118, 84)">
    <link href="used libralies/css/bootstrap.min.css" rel="stylesheet">
    <script src="used libralies/js/bootstrap.bundle.min.js"></script>
    <script src="used libralies/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css-files/homepage.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
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
                <a href="#" id="advertise" style="border-left: 1px solid #dddddd;"><i class="fa-solid fa-rectangle-ad"></i> Advertise more with us</a>
            </div>
        </nav>
        <nav class="col-md-12">
            <a href="about" id="about"><i class="fa-solid fa-people-group"></i> About us</a>
            <a href="#" id="help"><i class="fa-regular fa-circle-question"></i> Help</a>
            <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle"><i class="fa-regular fa-user mx-2"></i><word>Account</word></button>
                <div class="dropdown-items">
                    <a href="Auth/" class="py-2 px-2">Login/Signup</a>
                </div>
            </div>
            <div id="search">
                <form action="search" method="get" class="form-group" autocomplete="off">
                    <input class="form-control w-75 search-input" type="text" placeholder="Search fruits, vegetables, cereals, cattle, poutry..." name="search" required><button id="Search-button" class="btn btn-success form-control w-25 mx-4 text-center shadow" type="submit" name="search-button"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;<span>Search</span></button><button id="close-search"><i class="fa-solid fa-xmark"></i></button>
                </form>
                <div id="search-suggestion" class="mt-2 shadow"></div>
            </div>
            <a href="#" id="mobile-search-opener"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="home" title="home page" id="logo"><img src="images/logo-removebg.png" alt=""></a>
            <a href="javascript:void();" id="bars"><i class="fas fa-bars" id="open-menu"></i></a>
        </nav>
        <section class="col-4">
            <a href="javascript:void();" id="close" align="center"><i class="fa-solid fa-xmark"></i></a>
            <a href="prices"><i class="fa-solid fa-shop"></i> Market prices</a>
            <a href="transport"><i class="fa-solid fa-truck-fast"></i> Transport Services</a>
            <a href="#"><i class="fab fa-google-play"></i> Playstore</a>
            <a href="#"><i class="fa-brands fa-apple"></i> Appstore</a>
            <a href="#" id="advertise"><i class="fa-solid fa-rectangle-ad"></i> Advertise more with us</a>
            <a href="about"><i class="fa-solid fa-people-group"></i> About us</a>
            <a href="#"><i class="fa-regular fa-circle-question"></i> Help</a>
            <div class="categories">
                <div class="title" align="center">Product categories</div>
                    <form action="category.php" method="get">
                        <input type="hidden" name="category-id" value="Vegetable">
                        <button type="submit">Vegetables</button>
                    </form>
                    <form action="category.php" method="get">
                        <input type="hidden" name="category-id" value="Cereals">
                        <button type="submit">Cereals</button>
                    </form>
                    <form action="category.php" method="get">
                        <input type="hidden" name="category-id" value="Fruits">
                        <button type="submit">Fruits</button>
                    </form>
                    <form action="category.php" method="get">
                        <input type="hidden" name="category-id" value="Poutry">
                        <button type="submit">Poutry</button>
                    </form>
                    <form action="category.php" method="get">
                        <input type="hidden" name="category-id" value="Cattle">
                        <button type="submit">Cattle</button>
                    </form>
                    <form action="category.php" method="get">
                        <input type="hidden" name="category-id" value="Other">
                        <button type="submit">Other</button>
                    </form>
            </div>
        </section>
    </header>
</head>
<style>
    .notloggedin {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, .4);
            z-index: 999;
            overflow: hidden;
            transition-duration: 1s;
            display: none;
        }

        .notloggedin .pop {
            position: absolute;
            width: 20vw;
            height: 12vw;
            background: white;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px;
            box-sizing: border-box;
            border: 6px solid rgb(255, 133, 133);
            box-shadow: 0 0 20px rgb(255, 160, 160);
            font-size: 1.1vw;
            font-family: 'Signika Negative', sans-serif;
            border-radius: 5px;
        }

        .notloggedin .pop #options {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            font-size: inherit;
            font-family: inherit;
            color: white;
        }

        .notloggedin .pop #options button,
        .notloggedin .pop #options a {
            color: white;
        }
        @media only screen and (max-width: 900px){
            .notloggedin .pop {
                width: 55%;
                height: 23%;
                top: 35%;
                font-size: 3.3vw;
            }
        }
        @media only screen and (max-width: 500px){
            .notloggedin .pop {
                width: 70%;
                height: 30%;
                top: 28%;
                font-size: 3.8vw;
            }
        }
</style>
    <div class="notloggedin">
        <div class="pop mt-5" align="center"><b>You are not logged in!</b><br><br> Log in/Sign up?<br>
            <div id="options" class="mt-3"><button class="btn w-25 bg-primary yes">Yes</button><button
                    class="btn w-25 bg-dark no">No</button></div>
        </div>
    </div>
<script>
    //opening modal
    $('.contact-modal').hide();
        $('#advertise').on('click', function () {
            if (sessionStorage.user) {
                $('.contact-modal').show();
            }
            else {
                $('.notloggedin').show();
                $('.yes').on('click', function () {
                    window.location.assign('Auth/');
                });
                $('.no').on('click', function () {
                    $('.notloggedin').hide();
                });
            }
        });
</script>