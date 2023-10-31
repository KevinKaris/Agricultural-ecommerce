<?php
        include '../DB-config/db-config.php';
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
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php 
$title = $details['product_title'];
include_once '../includes/preloader.html';
include_once '../includes/farmer-header.php'; ?>

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
            width: 100%;
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
            border-radius: 5px;
        }

        @media only screen and (max-width: 900px) {
            #content .product-details {
                min-width: 100%;
                max-height: 90%;
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

            .recommender {
                margin-top: 10vw;
                position: relative;
            }

            p {
                font-size: 4vmin;
            }

            .contact-modal {
                width: 80% !important;
                max-height: 120vmin;
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
            #comment-writting, #comment-writting2{
                padding: 0;
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
    <div id="content">
        <div class="container product-details bg-light p-2 row">
            <div class="col-md-8 image-holder column">
                <img loading="lazy" src="<?php echo '../' . $string_to_array[0]; ?>"
                    alt="<?php echo $string_to_array[0]; ?>">
                <div id="other-images" class="mt-2">
                    <?php
                    for ($i = 0; $i < count($string_to_array); $i++) { ?>
                        <img src="<?php echo '../' . $string_to_array[$i]; ?>">
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
                    </p>
                    <?php
                } ?>
                <p class='w-100'>
                    <?php echo 'Views: ' . $details['views']; ?>
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
                <a href="#comments">comments</a><br>
                <p class='w-100' id="farmer-names-paste"></p>
                <button class="btn btn-success w-100 p-2 get-contacts mb-2">Get farmer contacts</button>
            </div>
        </div>

        <!--map part-->
        <?php
        $WARD_SELECT = "SELECT * FROM wards_geocodes WHERE Ward = '".$details['specific_location']."'";
        $ward_run = mysqli_query($connection, $WARD_SELECT);
        $ward_rows = mysqli_num_rows($ward_run);
        if($ward_rows > 0){
            $ward_details = mysqli_fetch_assoc($ward_run);
        ?>
        <div id="description" class="mt-0" style="margin-bottom: 30px; display: none !important">
            <div id="description-details">
            <!-- <iframe src="https://www.google.com/maps/embed?q=2d<?php echo $ward_details['Longitude']?>!3d<?php echo $ward_details['Latitude']?>" "https://maps.google.com/maps?q='+rfq.latitude+','+rfq.longitude+'&hl=es;z=14&amp;output=embed" allowfullscreen="" width="800" height="600" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->

                <!-- <a href="https://www.google.com/maps?q=35.9503891,-0.1973308+&output=embed"></a> -->

                <!-- <div id="map">
      <a href="https://www.maptiler.com" style="position:absolute;left:10px;bottom:10px;z-index:999;"><img src="https://api.maptiler.com/resources/logo.svg" alt="MapTiler logo"></a>
    </div>
    <p><a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a></p>
    <script>
      var map = L.map('description-details').setView([37.6757024,-3.3918524], 15);
      L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=xinj6wTWg04tHLy3VyQd',{
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
      }).addTo(map);

      var marker = L.marker([40.7590403,-74.039271]).addTo(map);
      marker.bindPopup("<iframe src='https://www.google.com/maps?q=37.6757024,-3.3918524+&output=embed'></iframe>");
    </script> -->
            </div>
        </div>
        <?php }?>
    
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
            <h5><span></span>&nbsp;Comments</h5>
            <div class="container">
            </div>
            <div id="comment-writting">
                <form method="post" class="form-group" id="comment-form">
                    <input type=" hidden" name="user-email" value='<?php echo $data['email'] ?>' id="user_email">
                    <input type="hidden" name="user-id" value='<?php echo $data['id'] ?>' id="user_id">
                    <textarea type="text" name="comment-text" id="comment-textarea" rows="2"
                        placeholder="Comment..."></textarea><button type="submit" name="comment-post"
                        id="comment-post">Post</button>
                </form>
            </div>
            <div id="comment-writting2" class="comment-writting2">
                <form method="post" class="form-group" id="comment-form">
                    <input type=" hidden" name="user-email" value='<?php echo $data['email'] ?>' id="user_email">
                    <input type="hidden" name="user-id" value='<?php echo $data['id'] ?>' id="user_id">
                    <textarea type="text" name="comment-text" id="comment-textarea" rows="2"
                        placeholder="Reply..."></textarea><button type="submit" name="comment-post"
                        id="comment-post">Post</button>
                </form>
            </div>
            <div id="comment-notice"></div>
        </div>

        <div class="recommender container" style="margin-bottom: 1vw;">
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

                while ($row = mysqli_fetch_assoc($sql)) {
                    $image_string = $row['product_image'];
                    $string_to_array = explode(",", $image_string)
                        ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="product" method="get">
                            <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="../<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
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
                                    <?php if (!empty($row['stock_available'])) {
                                        echo "<p class='w-100 m-0 p-0'>
                                <?php echo 'Stock available. ' . $row[stock_available]; ?></p>";
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
    <?php $farmer_info = $details['farmer_id'];
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
                    <?php echo 'County: ' . $details2['county'] ?>
                </h6><br>
                <h6>
                    <?php echo 'Sub-county: ' . $details2['sub_county'] ?>
                </h6><br>
                <h6><i class="fa-solid fa-location-dot"></i>
                    <?php echo $details2['location'] ?>
                </h6><br>
                <a href="tel:<?php echo '+254' . $details2['phone_number'] ?>">
                    <h6 style="background: maroon; color: white;" class="w-50 btn"><i class="fa-solid fa-phone"></i>
                        Call</h6>
                </a><br>
                <button class="btn btn-outline-dark">close</button>
            </div>
        </div>
        <?php
    }
    ?>

    <?php
    //storing data into view behaviour table
    $INSERT = "INSERT INTO view_behaviour (user_email, user_county, user_subcounty, user_location, product_title, product_category, product_location) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $statement = $connection->prepare($INSERT);
    $statement->bind_param('sssssss', $data['email'], $data['county'], $data['sub_county'], $data['location'], $details['product_title'], $details['product_category'], $details['specific_location']);
    $statement->execute();
    ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.js"></script>
<script>
    //non-reply comment posting
$(document).ready(function () {
    $('#comment-post').on('click', function (e) {
        $(document).on('submit', '#comment-writting form', function (event) {
            event.preventDefault();
            if ($('#comment-textarea').val() == '') {
                $('#comment-notice').html('Write a comment...').css('color', 'red');
                $('#comment-notice').show();
            }
            else {
                $('#comment-notice').hide();
                var user_email = $('#user_email').val();
                var user_id = $('#user_id').val();
                var page_url = window.location.search;
                var comment_text = $('#comment-textarea').val();
                $.ajax({
                    url: "../Ajax/comment.php",
                    method: 'POST',
                    data: { user_email: user_email, user_id: user_id, page_url: page_url, comment_text: comment_text },
                    success: function (response) {
                        $('#comment-post').unbind('click');
                        $('#comment-textarea').empty();
                        $('.emojionearea.emojionearea-inline > .emojionearea-editor').empty();
                        fetch_comments();
                    }
                });
            }
        })
    });

        //fetching comments
        fetch_comments();
        function fetch_comments() {
            var user_email = $('#user_email').val();
            var user_id = $('#user_id').val();
            var page_url = window.location.search;
            $.ajax({
                url: "../Ajax/fetch_comment.php",
                method: 'POST',
                data: { user_email: user_email, user_id: user_id, page_url: page_url },
                success: function (response) {
                    $('#comments > .container').html(response);
                }
            });
            $.ajax({
                url: "../Ajax/fetch_comment_count.php",
                method: "POST",
                data: { page_url: page_url },
                success: function (response) {
                    $('#comments h5 > span').html(response);
                    if($('#comments h5 > span').html() == '0'){
                        $('#comment-writting').show();
                        $('#comment-writting2').hide();
                    }
                }
            });
        }

    //replying comment
    $(document).on('click', '#comment-message1 a', function(){
        $('#comment-writting').hide();
        $('#comment-writting2').show();
        $('.emojionearea.emojionearea-inline > .emojionearea-editor').focus();
        var parent_comment_id = $(this).find('input').val();
        $('.emojionearea.emojionearea-inline > .emojionearea-editor').blur(function(){
            $('#comment-writting').show();
            $('#comment-writting2').hide();
        })

        $('#comment-writting2 #comment-post').on('click', function (e){
            $(document).on('submit', '#comment-writting2 form', function (event){
                event.preventDefault();
                if ($('#comment-writting2 #comment-textarea').val() == '') {
                    $('.emojionearea.emojionearea-inline > .emojionearea-editor').focus();
                    $('#comment-notice').html('Write a comment...').css('color', 'red');
                    $('#comment-notice').show();
                }
                else{
                    $('#comment-notice').hide();
                    var user_email = $('#user_email').val();
                    var user_id = $('#user_id').val();
                    var comment_text = $('#comment-writting2 #comment-textarea').val();
                    var page_url = window.location.search;
                    $.ajax({
                        url: "../Ajax/reply_comment.php",
                        method: 'POST',
                        data: { user_email: user_email, user_id: user_id, comment_text: comment_text, parent_comment_id: parent_comment_id, page_url: page_url },
                        success: function (response) {
                            $('#comment-post2').unbind('click');
                            $('#comment-writting2 #comment-textarea').empty();
                            $('.emojionearea.emojionearea-inline > .emojionearea-editor').empty();
                            $('#comment-writting').show();
                            $('#comment-writting2').hide();
                            fetch_comments();
                        }
                    });
                }
            });
        });
    });

    //deleting a comment
    $(document).on('click', '#comment-message1 .fa-trash-alt', function(){
        var comment_id = $(this).find('input').val();
        $.ajax({
            url: "../Ajax/delete-comment.php",
            method: 'POST',
            data: {comment_id: comment_id},
            success: function (response) {
                fetch_comments();
            }
        });
    });
});

$(document).ready(function () {

    $('#comment-writting #comment-textarea').emojioneArea({
        inline: true,
        tonesStyle: "bullet"
    });

    $('#comment-writting2 #comment-textarea').emojioneArea({
        inline: true,
        tonesStyle: "bullet"
    });
});


//Search suggestion
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

    <script src="../main.js"></script>
</body>
<?php include '../includes/footer.html'; ?>

</html>