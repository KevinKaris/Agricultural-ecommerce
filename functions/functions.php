<?php
error_reporting(0);
include "DB-config/db-config.php";
//prices

function nairobi()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Nairobi' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function nakuru()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Nakuru' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function mombasa()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Mombasa' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function kisumu()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Kisumu' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function homabay()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Homa-bay' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function kirinyaga()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Kirinyaga' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function nyeri()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Nyeri' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function kakamega()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Kakamega' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function kisii()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Kisii' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function kitui()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Kitui' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function uasin_gishu()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Uasin-gishu' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}

function kajiado()
{
    global $connection;
    $SELECT = "SELECT DISTINCT * FROM prices WHERE county = 'Kajiado' GROUP BY product_name";
    $run = mysqli_query($connection, $SELECT);

    while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
            <td>
                <?php echo $row['product_name']; ?>
            </td>
            <td>
                <?php echo $row['market_name']; ?>
            </td>
            <td>
                <?php if (!empty($row['retail_price'])) {
                    echo $row['retail_price'];
                } else {
                    echo '-';
                } ?>
            </td>
            <td>
                <?php if (!empty($row['wholesale_price'])) {
                    echo $row['wholesale_price'];
                } else {
                    echo '-';
                } ?>
            </td>
        </tr>
        <?php
    }
}




//recommendation
function recommendation()
{
    global $connection;

    if (isset($_COOKIE['guest_id'])) {
        $SELECT = "SELECT * FROM view_behaviour WHERE user_email = '$_COOKIE[guest_id]'";
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
                            <img src="<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
                            <div class="card-title mt-2">
                                <p id="big"><strong>
                                        <?php echo $row['product_title']; ?>
                                    </strong></p>
                                <p id="big">
                                    <b>
                                        <?php echo 'Ksh. ' . $row['product_price']; ?>
                                    </b>
                                </p>
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
        } else {
            //getting the number of rows
            $fruit_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Fruits%' AND user_email = '$_COOKIE[guest_id]'");
            $fruit_row_num = mysqli_num_rows($fruit_row_num);

            $vegetable_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Vegetable%' AND user_email = '$_COOKIE[guest_id]'");
            $vegetable_row_num = mysqli_num_rows($vegetable_row_num);

            $cereal_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Cereals%' AND user_email = '$_COOKIE[guest_id]'");
            $cereal_row_num = mysqli_num_rows($cereal_row_num);

            $poutry_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Poutry%' AND user_email = '$_COOKIE[guest_id]'");
            $poutry_row_num = mysqli_num_rows($poutry_row_num);

            $cattle_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Cattle%' AND user_email = '$_COOKIE[guest_id]'");
            $cattle_row_num = mysqli_num_rows($cattle_row_num);

            $other_row_num = mysqli_query($connection, "SELECT * FROM view_behaviour WHERE product_category LIKE '%Other%' AND user_email = '$_COOKIE[guest_id]'");
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
                            <img src="<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
                            <div class="card-title mt-2">
                                <p id="big"><strong>
                                        <?php echo $row['product_title']; ?>
                                    </strong></p>
                                <p id="big">
                                    <b>
                                        <?php echo 'Ksh. ' . $row['product_price']; ?>
                                    </b>
                                </p>
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
        }
    } else {
        $SELECT = "SELECT * FROM product ORDER BY RAND() LIMIT 30";
        $sql = mysqli_query($connection, $SELECT);

        while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="card bg-light col-md-1 text-center">
                <form action="product" method="get">
                    <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row['product_id']; ?>">
                    <a onclick="javascript:this.parentNode.submit();">
                        <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_image']; ?>">
                        <div class="card-title mt-2">
                            <p id="big"><strong>
                                    <?php echo $row['product_title']; ?>
                                </strong></p>
                            <p id="big">
                                <b>
                                    <?php echo 'Ksh. ' . $row['product_price']; ?>
                                </b>
                            </p>
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
    }
}
?>