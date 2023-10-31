<?php session_start(); 

include 'DB-config/db-config.php';
$id = $_GET['detail-id'];

//counting views
$UPDATE = "UPDATE product SET views = views + 1 WHERE product_id = $id";
$execute = mysqli_query($connection, $UPDATE);

$SELECT = "SELECT * FROM product WHERE product_id = $id";
$sql = mysqli_query($connection, $SELECT);
$details = mysqli_fetch_assoc($sql);

$image_string = $details['product_image'];
$string_to_array = explode(",", $image_string);
?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="images/logo-removebg.png">
<link rel="stylesheet" href="fontawesome/css/all.css">
<?php
$title = $details['product_title'];
include_once 'includes/preloader.html';
include_once 'header.php'; ?>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');

        #content {
            margin-top: 1vw;
            padding-top: 1vw;
        }

        #content .product-details {
            width: 100%;
            max-height: 50vw;
            margin: 3vw;
            background: #ffffff!important;
            border-radius: 5px;
        }

        #content .product-details .image-holder>img {
            min-width: 70%;
            max-height: 35vw;
        }

        #content .product-details .details {
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
        }
        #farmer-names-paste{
            font-size: 14px;
        }

        p {
            width: 100%;
            font-family: 'Signika Negative', sans-serif;
        }

        .contact-modal {
            position: fixed;
            z-index: 2;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
        }

        .contact button {
            color: white;
        }

        .contact {
            position: absolute;
            z-index: 2;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            background: rgba(0, 0, 0, .7);
            width: 30%;
            height: 60%;
            border-radius: 5px;
            padding: 5px;
        }

        .contact h6,
        strong {
            width: 100%;
            padding: 4px;
            border-radius: 5px;
        }

        .contact .w-100 {
            color: black;
            cursor: pointer;
        }

        .contact strong {
            color: aquamarine;
        }

        #other-images {
            max-height: 10vmin;
            white-space: nowrap;
            max-width: fit-content;
            display: flex;
            flex-direction: row;
            align-items: center;
            overflow-x: scroll;
        }

        #other-images::-webkit-scrollbar {
            height: 7px;
        }

        #other-images::-webkit-scrollbar-track {
            background-color: rgb(254, 195, 84);
        }

        #other-images>img {
            display: block;
            max-height: 7vmin !important;
            width: auto !important;
            margin: 3px;
            cursor: pointer;
            border: 3px solid transparent;
            border-radius: 5px;
        }

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

        @media only screen and (max-width: 900px) {
            #content .product-details {
                min-width: 100%;
                max-height: 90%;
            }

            #description p {
                font-size: 18px;
            }

            .details p,
            .details h5 {
                font-size: 18px;
            }

            #comments #comment-message1,
            #comments #comment-message2 {
                font-size: 18px;
            }

            #comments #comment-message1 i,
            #comments #comment-message2 i {
                font-size: 18px;
            }

            #comment-writting form {
                height: 45px;
            }

            #comment-writting {
                height: 70px;
            }

            #comment-writting form {
                width: 80%;
            }

            #content .product-details .image-holder {
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 100%;
                margin-top: 20px;
            }

            #content .product-details .image-holder>img {
                min-width: 70%;
                max-height: 80vw;
            }

            #content .product-details .details {
                width: 100%;
                max-height: 150vw;
                overflow-y: scroll;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: rgb(232, 255, 252);
                font-size: 3vw;
            }

            #content .product-details .details::-webkit-scrollbar {
                width: 7px;
            }

            .recommender {
                margin-top: 10vw;
                position: relative;
            }

            p {
                font-size: 4vmin;
            }

            .contact {
                width: 80% !important;
                height: 100vmin;
                font-size: 5vmin;
                padding: 5px;
            }

            .contact h6 {
                font-size: 3vmin;
            }

            .contact button {
                font-size: 3.2vmin;
            }

            #other-images {
                max-height: 20vmin !important;
            }

            #other-images>img {
                max-height: 12vmin !important;
            }

            .notloggedin .pop {
                width: 55%;
                height: 23%;
                top: 35%;
                font-size: 3.3vw;
            }
        }

        @media only screen and (max-width: 500px) {
            .contact {
                width: 90% !important;
                height: 130vmin;
                font-size: 5.3vmin;
            }

            .contact h6 {
                font-size: 3.5vmin;
            }

            .notloggedin .pop {
                width: 70%;
                height: 30%;
                top: 28%;
                font-size: 3.8vw;
            }
            #comment-writting, #comment-writting2{
                padding: 0;
            }

            #comment-writting form {
                width: 100%;
                height: 35px;
            }

            #comments #comment-message1,
            #comments #comment-message2 {
                width: 95%;
            }
            .details p, .details h5{
                font-size: 14px;
                margin-bottom: .7rem;
            }
            #description h5, #comments h5{
                font-size: 15px;
            }
            #description p{
                font-size: 14px;
            }
            #content .product-details .details a{
                font-size: 14px;
            }
            .emojionearea .emojionearea-picker{
                height: 200px;
                width: 260px;
                overflow-x: hidden;
                overflow-y: hidden;
            }
            .recommender>#card-container h4{
                font-size: 14px;
            }
        }
    </style>
    <div class="cookie">
        <div class="pop" align="center">This website uses cookies in order to offer you the most relevant information.
            We also use them to improve user experience when exploring the website.<br>
            <button class="btn w-50 mt-5 bg-dark">Got it</button>
        </div>
    </div>
    <div class="notloggedin">
        <div class="pop mt-5" align="center"><b>You are not logged in!</b><br><br> Log in/Sign up?<br>
            <div id="options" class="mt-3"><button class="btn w-25 bg-primary yes">Yes</button><button
                    class="btn w-25 bg-dark no">No</button></div>
        </div>
    </div>
    <div id="content">
        <div class="container product-details bg-light p-2 row">
            <div class="col-md-8 image-holder column">
                <img src="<?php echo $string_to_array[0] ?>" alt="<?php echo $string_to_array[0] ?>">
                <div id="other-images" class="mt-2">
                    <?php
                    for ($i = 0; $i < count($string_to_array); $i++) { ?>
                        <img src="<?php echo $string_to_array[$i]; ?>">
                        <?php
                    } ?>
                </div>
            </div>
            <div class="col-md-4 column details" align="center">
                <p class='w-100'>
                <h5>
                    <?php echo $details['product_title'] ?>
                </h5>
                </p>
                <p class='w-100'>
                    <?php echo 'Ksh.' . $details['product_price'] ?>
                </p>
                <p class='w-100'>
                    <?php echo $details['product_keywords'] ?>
                </p>
                <?php if (!empty($details['stock_available'])) { ?>
                    <p class='w-100'>
                        <?php echo 'Stock available. ' . $details['stock_available']; ?>
                    </p>
                    <?php
                } ?>
                <?php if (!empty($details['stock_expiry'])) { ?>
                    <p class='w-100'>
                        <?php echo 'Product expiry. ' . $details['stock_expiry']; ?>
                    </p>";
                    <?php
                } ?>
                <p class='w-100'>
                    <?php echo 'Views: ' . $details['views'] ?>
                </p>
                <p class='w-100'>County: 
                    <?php echo $details['county_location'] ?>
                </p>
                <p class='w-100'>Sub-County: 
                    <?php echo $details['sub_county_location'] ?>
                </p>
                <p class='w-100'><i class="fa-solid fa-location-dot"></i>
                    <?php echo $details['specific_location'] ?>
                </p>
                <a href="#commenth5">comments</a><br>
                <p class='w-100' id="farmer-names-paste"></p>
                <button class="btn btn-success w-100 p-2 get-contacts mb-2">Get farmer contacts</button>
            </div>
        </div>

        <!--Details part-->
        <div id="description" class="mt-0">
            <h5>Description</h5>
            <div id="description-details">
                <p>
                    <?php echo $details['product_description'] ?>
                </p>
            </div>
        </div>

        <!--comments section -->
        <div id="comments" class="mb-4">
            <h5 id="commenth5"><span></span>&nbsp;Comments</h5>
            <div class="container">
            </div>
        </div>

        <div class="recommender container mt-4" style="margin-bottom: 1vw;">
            <button id="left4"><i class="fa-solid fa-angle-left"></i></button>
            <button id="right4"><i class="fa-solid fa-angle-right"></i></button>
            <div id="recommender-heading" style="background-color: rgb(152, 6, 193);">Related Products<i
                    class="fa-solid fa-arrow-right mt-2"></i></div>
            <div class="card-container4 col-md-12 " id="card-container">
                <?php
                $category_id = $details['product_category'];
                $SELECT = "SELECT * FROM product WHERE product_category LIKE '%$category_id%' AND product_id != $id ORDER BY RAND() LIMIT 30";
                $sql = mysqli_query($connection, $SELECT);
                $num_of_rows = mysqli_num_rows($sql);
                if ($num_of_rows == 0) {
                    $message = "<h4>No Product related to the above product yet!</h4>";
                }

                while ($row = mysqli_fetch_assoc($sql)) { ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="product" method="get">
                            <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_image']; ?>">
                                <div class="card-title mt-4">
                                    <p class="w-100 m-0 p-0" id="big"><strong>
                                            <?php echo $row['product_title']; ?>
                                        </strong></p>
                                    <p class="w-100 m-0 p-0">
                                        <?php echo $row['product_keywords']; ?>
                                    </p>
                                    <p class="w-100 m-0 p-0" id="big">
                                        <?php echo 'Ksh. ' . $row['product_price']; ?>
                                    </p>
                                    <?php if (!empty($row['stock_available'])) { ?>
                                        <p class='w-100 m-0 p-0'>
                                            <?php echo 'Stock available. ' . $row['stock_available']; ?>
                                        </p>
                                        <?php
                                    } ?>
                                    <p class="w-100 m-0 p-0"><i class="fa-solid fa-location-dot"></i>
                                        <?php echo ' ' . $row['specific_location'] . ' | ' . $row['county_location'] ?>
                                    </p>
                                </div>
                            </a>
                        </form>
                    </div>
                    <?php
                } ?>
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </div>
        </div>
    </div>
    <?php if (isset($details['farmer_id'])) {
        $farmer_info = $details['farmer_id'];
        $SELECT2 = "SELECT * FROM farmer_signup WHERE id = $farmer_info";
        $sql2 = mysqli_query($connection, $SELECT2);
        if (mysqli_num_rows($sql2) > 0) {
            $details2 = mysqli_fetch_assoc($sql2);
            ?>
            <div class="contact-modal">
                <div class="contact pt-3" align="center">
                    <strong>Farmer contacts</strong><br><br>
                    <h6 id="farmer-names">
                        <?php echo $details2['first_name'] . '  ' . $details2['last_name'] ?>
                    </h6><br>
                    <h6>
                        <?php echo $details2['email'] ?>
                    </h6><br>
                    <h6>
                        <?php echo 'County: ' . $details2['county'] ?>
                    </h6><br>
                    <h6>
                        <?php echo 'Sub-county: ' . $details2['sub_county'] ?>
                    </h6><br>
                    <h6><i class="fa-solid fa-location-dot"></i>
                        <?php echo $details2['location'] ?>
                    </h6><br>
                    <a href="tel:<?php echo '+254' . $details2['phone_number'] ?>">
                        <h6 style="background: aquamarine; color: black;" class="w-50 btn"><i class="fa-solid fa-phone"></i>
                            Call</h6>
                    </a><br>
                    <button class="btn btn-outline-light">close</button>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <?php
    //storing data into view behaviour table
    if (!isset($_COOKIE['guest_id'])) {
        //setting cookie
        $new_key = uniqid() . '_' . uniqid() . '_' . gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $encrypted_key = md5($new_key);

        //checking where the unique id is stored in the db
        $SELECT = "SELECT user_email FROM view_behaviour WHERE user_email = '$encrypted_key'";
        $sql = mysqli_query($connection, $SELECT);
        $row_number = mysqli_num_rows($sql);

        if ($row_number == 0) {
            $INSERT = "INSERT INTO view_behaviour (user_email, product_title, product_category, product_location) VALUES (?,?, ?, ?)";

            $statement = $connection->prepare($INSERT);
            $statement->bind_param('ssss', $encrypted_key, $details['product_title'], $details['product_category'], $details['specific_location']);
            $statement->execute();
            $statement->close();
            setcookie('guest_id', $encrypted_key, time() + (5 * 365 * 24 * 60 * 60), '/');
        }
    } else {
        $INSERT = "INSERT INTO view_behaviour (user_email, product_title, product_category, product_location) VALUES (?,?, ?, ?)";

        $statement = $connection->prepare($INSERT);
        $statement->bind_param('ssss', $_COOKIE['guest_id'], $details['product_title'], $details['product_category'], $details['specific_location']);
        $statement->execute();
        $statement->close();
    }
    ?>

<!--Handling comment -->
<script>
        $(document).ready(function () {
                //calling the function
                fetch_comments();

                //fetching comments
                function fetch_comments() {
                    var page_url = window.location.search;
                    $.ajax({
                        url: "Ajax/guest-fetch-comment.php",
                        method: 'POST',
                        data: { page_url: page_url },
                        success: function (response) {
                            $('#comments > .container').html(response);
                        }
                    });
                    //counting comments
                    $.ajax({
                        url: "Ajax/fetch_comment_count.php",
                        method: "POST",
                        data: { page_url: page_url },
                        success: function (response) {
                            $('#comments h5 > span').html(response);
                        }
                    });
                }
        });
    </script>


    <script>
        $(window).ready(function () {
            $(".search-input").keyup(function () {
                var txt = $(this).val();
                if (txt != '') {
                    $.ajax({
                        url: "ajax/search-suggestion.php",
                        method: 'POST',
                        data: { txt: txt },
                        success: function (data) {
                            $('#search-suggestion').html(data);
                        }
                    });
                } else {
                    $('#search-suggestion').html('');
                }
                $(document).on('click', "#search-suggestion a", function () {
                    $('.search-input').val($(this).text());
                    $('#search-suggestion').html('');
                });
            });
        });

        //opening modal
        $('.contact-modal').hide();
        $('.get-contacts').on('click', function () {
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
                })
            }
        });

        //closing modal
        $('.contact button').on('click', function () {
            $('.contact-modal').hide();
        });

        //viewing other images
        $('#other-images > img').on('click', function (e) {
            e.preventDefault();
            var newurl = $(this).attr('src');

            $('.image-holder > img').attr('src', newurl);
        });
        //adding border to matching images
        setInterval(function () {
            var bigurl = $('.image-holder > img').attr('src');
            $('#other-images > img').each(function () {
                if ($(this).attr('src') == (bigurl)) {
                    $(this).css('border', '3px solid rgb(186, 22, 22)');
                    $(this).css('opacity', '1');
                }
                else {
                    $(this).css('border', '3px solid transparent');
                    $(this).css('opacity', '.6');
                }
            });
        }, 200);


        //taking farmer's names and pasting in product details
        if($('#farmer-names').html()){
            var farmer_names = $('#farmer-names').html();
            $('#farmer-names-paste').html('Farmer: '+farmer_names);
        }
    </script>
    <script src="main.js"></script>
    <?php $_SESSION['page_url'] = basename($_SERVER['REQUEST_URI']); ?>
</body>
<?php include 'includes/guest-footer.html'; ?>

</html>