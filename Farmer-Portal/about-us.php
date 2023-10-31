<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php 
$title = 'About';
include_once '../includes/preloader.html';
include_once('../includes/farmer-header.php') ?>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&family=Poppins:wght@500&display=swap');

        #content {
            background: white;
            margin-top: 5.5vw !important;
            padding: 0;
        }

        #content .title {
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            width: 100%;
            padding: .4vw;
        }

        #price .note {
            padding: 1vw;
            /*background: linear-gradient(to bottom, rgb(65, 165, 253), rgb(40, 146, 239), rgb(18, 119, 208), rgb(7, 97, 175));*/
            font-size: 1.1vw;
            font-family: 'Poppins', sans-serif;
        }

        #price .note a {
            text-decoration: none;
            color: rgb(10, 195, 136);
        }

        #price .note a:hover {
            text-decoration: underline;
        }

        #price form {
            margin-top: 5vw;
            width: 60%;
            height: auto;
            border: 3px ridge var(--text-color);
            margin-left: 50%;
            transform: translateX(-50%);
            background: rgb(233, 233, 233);
            border-radius: 5px;
            box-shadow: 0 0 5px grey;
        }

        #price form input,
        textarea {
            width: 90%;
            border-radius: 3px;
            border: 1px solid rgb(173, 173, 173);
            background: white;
            margin: 1.5vw 0 1.5vw 0;
            padding: 4px;
            font-family: 'Signika Negative', sans-serif;
            font-size: 1.1vw;
        }

        #price form input :-ms-input-placeholder {
            font-size: 0.8vw;
        }

        #price form>input::placeholder {
            color: #9c9c9c
        }

        #price form>textarea::placeholder {
            color: #9c9c9c
        }

        #price form button {
            width: 50%;
            margin-bottom: 1.5vw;
        }

        @media only screen and (max-width: 900px) {
            #content .title {
                margin-top: 4%;
                font-size: 4vw;
            }

            #price .note {
                font-size: 3vw;
            }

            #price form {
                width: 95%;
            }

            #price form input,
            textarea {
                font-size: 4vw;
            }
        }

        @media only screen and (max-width: 500px) {
            #content .title {
                margin-top: 10vw;
            }
        }
    </style>
    <div id="content">
        <div class="title" align="center">About Direct-Link</div>
        <div class="row m-3" id="price">
            <div class="note col-md-12">
                Welcome to Direct-Link, we connect farmers directly to buyers to eliminate exploitive middlemen. Farmers
                list/post their products, accompanied by their prices and location. Buyers are on the other hand able to
                view farmers' products and their conatacts. They are also able to post their product requests so that
                any farmers dealing with requested products are able to contact those buyers. We also display average <a
                    target="_blank" href="prices.php">market prices</a> for various products in various places.<br> This
                is intended to hint the buyer and the farmer on deciding the price at which to buy a product and the
                price to sell the product at respectively. We are currently working within the boundaries of Kenya. Our
                goal is to make Kenyan markets as near as the pocket of any farmer. Just as every one always keeps
                his/her phone in the pocket, so are markets through Direct-Link will right in your pocket, in your
                device. Likewise, buyers find products they deal with just with their devices. For any query contact us
                below. You can also find us the social platforms <a href="#socialmedia">below.</a>

                <?php
                if (isset($_SESSION['message-sent'])) { ?>
                <div class="alert alert-primary mt-2 w-100 col-12" role="alert" style="margin: 0 auto;">
                    <strong>
                        <?php echo $_SESSION['message-sent']; ?>
                    </strong>
                </div>
                <?php
                    unset($_SESSION['message-sent']);
                } ?>

                <form action="contact.php" method="post" align="center" class="col" id="form">
                    <div class="form-title x-2" id="form-title"><b>Contact Us</b></div>
                    <input type="name" name="name" placeholder="Enter your name..." required>
                    <input type="email" name="email" placeholder="Enter your email..." required>
                    <textarea name="message" id="" cols="50" rows="10" placeholder="Tell us something..."
                        required></textarea>
                    <button class="btn btn-warning" name="send-button" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        //search suggestion
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
    </script>
    <script src="../main.js"></script>
</body>
<?php
include_once('../includes/footer.html');
?>

</html>