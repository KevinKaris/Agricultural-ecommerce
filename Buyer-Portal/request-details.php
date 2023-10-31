<?php
include '../DB-config/db-config.php';
        $id = $_GET['detail-id'];

        //counting views
        $UPDATE = "UPDATE buyer_request SET views = views + 1 WHERE request_id = $id";
        $execute = mysqli_query($connection, $UPDATE);

        $SELECT = "SELECT * FROM buyer_request WHERE request_id = $id";
        $sql = mysqli_query($connection, $SELECT);
        $details = mysqli_fetch_assoc($sql);

        $image_string = $details['product_image'];
        $string_to_array = explode(",", $image_string);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php 
$title = $details['product_title'];
include_once '../includes/preloader.html';
include_once '../includes/buyer-header.php'; ?>

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
            width: 100%;
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
            font-family: 'Signika Negative', sans-serif;
        }

        .contact-modal {
            position: fixed;
            z-index: 2;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            background: transparent;
            box-shadow: 0 0 10px grey;
            width: 25%;
            max-height: 60%;
            border-radius: 5px;
            padding: 0 !important;
        }

        .contact button {
            color: black;
        }

        .contact {
            color: black;
            background: white;
            width: 100%;
            height: 100%;
            border-radius: 5px;
            padding: 5px;
        }

        .contact h6,
        strong {
            width: 100%;
            padding: 4px;
            border-radius: 5px;
            line-height: 0;
        }

        .contact .w-100 {
            color: black;
            cursor: pointer;
        }

        .contact strong {
            color: maroon;
        }

        #other-images {
            max-height: 14vmin;
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
                padding: 0!important;
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
                padding: 0!important;
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

            .contact-modal {
                width: 80% !important;
                max-height: 100vmin;
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
                height: 20%;
                top: 30%;
                font-size: 3.3vw;
            }
        }

        @media only screen and (max-width: 500px) {
            .contact-modal {
                width: 90% !important;
                max-height: 130vmin;
                font-size: 5.3vmin;
            }

            .contact h6 {
                font-size: 3.5vmin;
            }

            #comment-writting form {
                width: 100%;
                height: 35px;
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
            .notloggedin .pop {
                width: 70%;
                height: 21%;
                top: 25%;
                font-size: 3.8vw;
            }
            .recommender>#card-container h4{
                font-size: 14px;
            }
        }
    </style>
    <div id="content">
        <div class="container product-details bg-light p-2 row">
            <div class="col-md-8 image-holder column">
                <img loading="lazy" src="<?php echo '../' . $string_to_array[0] ?>"
                    alt="<?php echo $string_to_array[0] ?>">
            </div>
            <div class="col-md-4 column details" align="center">
                <p class='w-100'>
                <h5>
                    <?php echo $details['product_title'] ?>
                </h5>
                </p>
                <?php if (!empty($details['stock_needed'])) { ?>
                    <p class='w-100'>
                        <?php echo 'Stock needed. ' . $details['stock_needed']; ?>
                    </p>
                <?php } ?>
                <p class='w-100'>
                    <?php echo 'Views: ' . $details['views'] ?>
                </p>
                <p class='w-100 mb-1'><strong>Requested Product Description</strong></p>
                <p class='w-100'>
                    <?php echo $details['product_description'] ?>
                </p>
                <p class='w-100'><i class="fa-solid fa-location-dot"></i>
                    <?php echo 'Preferred location. ' . $details['preferred_location'] ?>
                </p>
                <p class='w-100' id="farmer-names-paste"></p>
                <button class="btn btn-success w-100 p-2 get-contacts mb-2">Get buyer contacts</button>
            </div>
        </div>
        <div class="recommender container" style="margin-bottom: 1vw;">
            <button id="left4"><i class="fa-solid fa-angle-left"></i></button>
            <button id="right4"><i class="fa-solid fa-angle-right"></i></button>
            <div id="recommender-heading" style="background-color: rgb(152, 6, 193);">Similar Requests<i
                    class="fa-solid fa-arrow-right mt-2"></i></div>
            <div class="card-container4 col-md-12 " id="card-container">
                <?php
                $title_holder = $details['request_category'];
                $SELECT = "SELECT * FROM buyer_request WHERE request_category LIKE '%$title_holder%' AND request_id != $id ORDER BY RAND()";
                $sql = mysqli_query($connection, $SELECT);
                $num_of_rows = mysqli_num_rows($sql);
                if ($num_of_rows == 0) {
                    $message = "<h4>No similar Request at the moment!</h4>";
                }

                while ($row = mysqli_fetch_assoc($sql)) {
                    $image_string = $details['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="request" method="get">
                            <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['request_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="../<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
                                <div class="card-title mt-2">
                                    <p id="big"><strong>
                                            <?php echo $row['product_title']; ?>
                                        </strong></p>
                                    <?php if (!empty($row['stock_needed'])) { ?>
                                        <p class='w-100 m-0 p-0'>
                                            <?php echo 'Stock needed. ' . $row['stock_needed']; ?>
                                        </p>
                                        <?php
                                    } ?>
                                    <p><i class="fa-solid fa-location-dot"></i>
                                        <?php echo 'Preferred location. ' . $row['preferred_location']; ?>
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
    <?php $buyer_info = $details['buyer_id'];
    $SELECT2 = "SELECT * FROM buyer_signup WHERE id = $buyer_info";
    $sql2 = mysqli_query($connection, $SELECT2);
    if (mysqli_num_rows($sql2) > 0) {
        $details2 = mysqli_fetch_assoc($sql2);
        ?>
        <div class="contact-modal">
            <div class="contact pt-3" align="center">
                <strong>Buyer contacts</strong><br><br>
                <h6 id="farmer-names">
                    <?php echo $details2['first_name'] . '  ' . $details2['last_name'] ?>
                </h6><br>
                <a href="tel:<?php echo '+254' . $details2['phone_number'] ?>">
                    <h6 style="background: maroon; color: white;" class="w-50 btn"><i class="fa-solid fa-phone"></i>
                        Call</h6>
                </a><br>
                <button class="btn btn-outline-dark">close</button>
            </div>
        </div>
    <?php }
    ?>
    <script>
        $(window).ready(function () {
            $(".search-input").keyup(function () {
                var txt = $(this).val();
                if (txt != '') {
                    $.ajax({
                        url: "../Ajax/search-suggestion.php",
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
                    $('#Search-button').click();
                });
            });
        });

        //opening modal
        $('.contact-modal').hide();
        $('.get-contacts').on('click', function () {
            if (sessionStorage) {
                $('.contact-modal').show();
            }
            else {
                if (confirm('You are not logged in. Log in?') == true) {
                    window.location.assign('../Auth/index.html');
                }
            }
        });

        //closing modal
        $('.contact button').on('click', function () {
            $('.contact-modal').hide();
        })

        //taking farmer's names and pasting in product details
        if($('#farmer-names').html()){
            var farmer_names = $('#farmer-names').html();
            $('#farmer-names-paste').html('Buyer: '+farmer_names);
        }
    </script>
    <script src="../main.js"></script>
</body>
<?php include '../includes/footer.html'; ?>

</html>