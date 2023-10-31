<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php 
include_once '../includes/preloader.html';
include '../includes/buyer-header.php'; ?>

<body>
    <div id="content" style="margin-bottom: 0!important;">
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

        <div id="slider">
            <?php
                $slide_sql = "SELECT id, image, product_id FROM ad_slider";
                $slider_run = mysqli_query($connection, $slide_sql);
            ?>
            <div id="slider-img">
                <?php
                while(($slider_details = mysqli_fetch_assoc($slider_run))){
                ?>
                <div class="slides" id="<?php echo 'slide'.$slider_details['id'] ?>">
                    <a href="<?php if($slider_details['product_id'] == '#'){ echo $slider_details['product_id'];}else{echo 'product?detail-id='.$slider_details['product_id'];}?>"><img src="<?php echo '../'.$slider_details['image']?>" alt="<?php echo 'image'.$slider_details['id'] ?>"></a>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="prices">
            <?php
            $SELECT = "SELECT product_name, retail_price FROM prices WHERE county = 'Nairobi' ORDER BY RAND() LIMIT 10";
            $run = mysqli_query($connection, $SELECT); ?>
            <a href="prices" style="text-decoration: none;">
                <div class="title" align="center">Market prices</div>
                <section align="center">Nairobi</section>
                <?php while ($row = mysqli_fetch_assoc($run)) { ?>
                    <p>
                        <?php echo $row['product_name'] . ': Ksh.' . $row['retail_price'] . '/kg' ?>
                    </p>
                    <?php
                } ?>
            </a>
        </div>

        <div class="recommender container">
            <button id="left"><i class="fa-solid fa-angle-left"></i></button>
            <button id="right"><i class="fa-solid fa-angle-right"></i></button>
            <div id="recommender-heading" style="background-color: rgb(230, 190, 35);">Recommended for you<i
                    class="fa-solid fa-arrow-right mt-2"></i></div>
            <div class="card-container col-md-12 " id="card-container">
                <?php
                $SELECT = "SELECT * FROM view_behaviour WHERE user_email = '$data[email]'";
                $sql = mysqli_query($connection, $SELECT);
                $num_of_rows = mysqli_num_rows($sql);
                if ($num_of_rows == 0) {
                    $SELECT = "SELECT * FROM product ORDER BY RAND() LIMIT 30";
                    $sql = mysqli_query($connection, $SELECT);
                    while ($row = mysqli_fetch_assoc($sql)) {
                        $image_string = $row['product_image'];
                        $string_to_array = explode(",", $image_string);
                        ?>
                        <div class="card bg-light col-md-1 text-center">
                            <form action="product" method="get">
                                <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                                <a onclick="javascript:this.parentNode.submit();">
                                    <img src="<?php echo '../' . $string_to_array[0]; ?>"
                                        alt="<?php echo $string_to_array[0]; ?>">
                                    <div class="card-title mt-2">
                                        <p id="big"><strong>
                                                <?php echo $row['product_title']; ?>
                                            </strong></p>
                                        <p id="big"><b>
                                                <?php echo 'Ksh. ' . $row['product_price']; ?>
                                            </b></p>
                                        <p>
                                            <?php echo $row['product_keywords']; ?>
                                        </p>
                                        <?php if (!empty($row['stock_available'])) { ?>
                                            <p class='w-100 m-0 p-0'>
                                                <?php echo 'Stock available. ' . $row['stock_available']; ?>
                                            </p>
                                            <?php
                                        } ?>
                                        <p><i class="fa-solid fa-location-dot"></i>
                                            <?php echo ' ' . $row['specific_location'] . ' | ' . $row['county_location'] ?>
                                        </p>
                                    </div>
                                </a>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    //getting the number of rows
                    $fruit_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Fruits%' AND user_email = '$data[email]'");
                    $fruit_row_num = mysqli_num_rows($fruit_row_num);

                    $vegetable_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Vegetable%' AND user_email = '$data[email]'");
                    $vegetable_row_num = mysqli_num_rows($vegetable_row_num);

                    $cereal_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Cereals%' AND user_email = '$data[email]'");
                    $cereal_row_num = mysqli_num_rows($cereal_row_num);

                    $poutry_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Poutry%' AND user_email = '$data[email]'");
                    $poutry_row_num = mysqli_num_rows($poutry_row_num);

                    $cattle_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Cattle%' AND user_email = '$data[email]'");
                    $cattle_row_num = mysqli_num_rows($cattle_row_num);

                    $other_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Other%' AND user_email = '$data[email]'");
                    $other_row_num = mysqli_num_rows($other_row_num);

                    //total
                    $total = $fruit_row_num + $vegetable_row_num + $cereal_row_num + $poutry_row_num + $cattle_row_num + $other_row_num;

                    //ratio
                    $fruit_row_num2 = ceil($fruit_row_num / $total * 30);
                    $vegetable_row_num2 = ceil($vegetable_row_num / $total * 30);
                    $cereal_row_num2 = ceil($cereal_row_num / $total * 30);
                    $poutry_row_num2 = ceil($poutry_row_num / $total * 30);
                    $cattle_row_num2 = ceil($cattle_row_num / $total * 30);
                    $other_row_num2 = ceil($other_row_num / $total * 30);

                    //fetching data now
                    $SELECT = "SELECT * FROM ((SELECT * FROM product WHERE product_category LIKE '%Fruits%' ORDER BY RAND() LIMIT $fruit_row_num2) UNION(SELECT * FROM product WHERE product_category LIKE '%Vegetables%' ORDER BY RAND() LIMIT $vegetable_row_num2) UNION(SELECT * FROM product WHERE product_category LIKE '%Cereals%' ORDER BY RAND() LIMIT $cereal_row_num2) UNION(SELECT * FROM product WHERE product_category LIKE '%Poutry%' ORDER BY RAND() LIMIT $poutry_row_num2) UNION(SELECT * FROM product WHERE product_category LIKE '%Cattle%' ORDER BY RAND() LIMIT $cattle_row_num2) UNION(SELECT * FROM product WHERE product_category LIKE '%Other%' ORDER BY RAND() LIMIT $other_row_num2) ORDER BY RAND())collection";

                    //execution
                    $sql = mysqli_query($connection, $SELECT);

                    while ($row = mysqli_fetch_assoc($sql)) {
                        $image_string = $row['product_image'];
                        $string_to_array = explode(",", $image_string);
                        ?>
                        <div class="card bg-light col-md-1 text-center">
                            <form action="product" method="get">
                                <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                                <a onclick="javascript:this.parentNode.submit();">
                                    <img src="<?php echo '../' . $string_to_array[0]; ?>"
                                        alt="<?php echo $string_to_array[0]; ?>">
                                    <div class="card-title mt-2">
                                        <p id="big"><strong>
                                                <?php echo $row['product_title']; ?>
                                            </strong></p>
                                        <p id="big"><b>
                                                <?php echo 'Ksh. ' . $row['product_price']; ?>
                                            </b></p>
                                        <p>
                                            <?php echo $row['product_keywords']; ?>
                                        </p>
                                        <?php if (!empty($row['stock_needed'])) { ?>
                                            <p class='w-100 m-0 p-0'>
                                                <?php echo 'Stock needed. ' . $row['stock_available']; ?>
                                            </p>
                                            <?php
                                        } ?>
                                        <p><i class="fa-solid fa-location-dot"></i>
                                            <?php echo ' ' . $row['specific_location'] . ' | ' . $row['county_location'] ?>
                                        </p>
                                    </div>
                                </a>
                            </form>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>

        <div class="recommender container">
            <button id="left2"><i class="fa-solid fa-angle-left"></i></button>
            <button id="right2"><i class="fa-solid fa-angle-right"></i></button>
            <div id="recommender-heading" style="background-color: rgb(0, 26, 130);">Lately Added Products<i
                    class="fa-solid fa-arrow-right mt-2"></i></div>
            <div class="card-container2 col-md-12 " id="card-container">
                <?php
                $SELECT = "SELECT * FROM product WHERE (DATEDIFF(CURDATE(), upload_date)) <= 60 ORDER BY RAND() LIMIT 30";
                $sql = mysqli_query($connection, $SELECT);
                $num_of_rows = mysqli_num_rows($sql);
                if ($num_of_rows == 0) {
                    $message1 = "<h4>No product recently added!</h4>";
                }

                while ($row = mysqli_fetch_assoc($sql)) {
                    $image_string = $row['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="product" method="get">
                            <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="<?php echo '../' . $string_to_array[0]; ?>"
                                    alt="<?php echo $string_to_array[0]; ?>">
                                <div class="card-title mt-2">
                                    <p id="big"><strong>
                                            <?php echo $row['product_title']; ?>
                                        </strong></p>
                                    <p id="big"><b>
                                            <?php echo 'Ksh. ' . $row['product_price']; ?>
                                        </b></p>
                                    <p>
                                        <?php echo $row['product_keywords']; ?>
                                    </p>
                                    <?php if (!empty($row['stock_available'])) { ?>
                                        <p class='w-100 m-0 p-0'>
                                            <?php echo 'Stock available. ' . $row['stock_available']; ?>
                                        </p>
                                        <?php
                                    } ?>
                                    <p><i class="fa-solid fa-location-dot"></i>
                                        <?php echo ' ' . $row['specific_location'] . ' | ' . $row['county_location'] ?>
                                    </p>
                                </div>
                            </a>
                        </form>
                    </div>
                    <?php
                } ?>
                <?php if (isset($message1)) {
                    echo $message1;
                } ?>
            </div>
        </div>

        <div class="recommender container">
            <button id="left3"><i class="fa-solid fa-angle-left"></i></button>
            <button id="right3"><i class="fa-solid fa-angle-right"></i></button>
            <div id="recommender-heading" style="background-color: rgb(156, 0, 159);">Featured Products<i
                    class="fa-solid fa-arrow-right mt-2"></i></div>
            <div class="card-container3 col-md-12 " id="card-container">
                <?php
                $SELECT = "SELECT * FROM product WHERE views > 1 ORDER BY views DESC LIMIT 30";
                $sql = mysqli_query($connection, $SELECT);
                $num_of_rows = mysqli_num_rows($sql);
                if ($num_of_rows == 0) {
                    $message2 = "<h4>No featured product yet!</h4>";
                }

                while ($row = mysqli_fetch_assoc($sql)) {
                    $image_string = $row['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="product" method="get">
                            <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="<?php echo '../' . $string_to_array[0]; ?>"
                                    alt="<?php echo $string_to_array[0]; ?>">
                                <div class="card-title mt-2">
                                    <p id="big"><strong>
                                            <?php echo $row['product_title']; ?>
                                        </strong></p>
                                    <p id="big"><b>
                                            <?php echo 'Ksh. ' . $row['product_price']; ?>
                                        </b></p>
                                    <p>
                                        <?php echo $row['product_keywords']; ?>
                                    </p>
                                    <?php if (!empty($row['stock_needed'])) { ?>
                                        <p class='w-100 m-0 p-0'>
                                            <?php echo 'Stock needed. ' . $row['stock_available']; ?>
                                        </p>
                                        <?php
                                    } ?>
                                    <p><i class="fa-solid fa-location-dot"></i>
                                        <?php echo ' ' . $row['specific_location'] . ' | ' . $row['county_location'] ?>
                                    </p>
                                </div>
                            </a>
                        </form>
                    </div>
                    <?php
                } ?>
                <?php if (isset($message2)) {
                    echo $message2;
                } ?>
            </div>
        </div>



        <div class="recommender container">
            <button id="left4"><i class="fa-solid fa-angle-left"></i></button>
            <button id="right4"><i class="fa-solid fa-angle-right"></i></button>
            <div id="recommender-heading" style="background-color: rgb(182, 23, 23);">Requested Products<i
                    class="fa-solid fa-arrow-right mt-2"></i></div>
            <div class="card-container4 col-md-12 " id="card-container">
                <?php
                $SELECT = "SELECT * FROM buyer_request ORDER BY RAND() LIMIT 30";
                $sql = mysqli_query($connection, $SELECT);
                $num_of_rows = mysqli_num_rows($sql);
                if ($num_of_rows == 0) {
                    $message3 = "<h4>No Request at the moment!</h4>";
                }

                while ($row = mysqli_fetch_assoc($sql)) {
                    $image_string = $row['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="request" method="get">
                            <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['request_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="<?php echo '../' . $string_to_array[0]; ?>"
                                    alt="<?php echo $string_to_array[0]; ?>">
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
                <?php if (isset($message3)) {
                    echo $message3;
                } ?>
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
<?php include_once '../includes/footer.html'; ?>

</html>