<?php
session_start();

include '../DB-config/db-config.php';

$county = $_POST['county'];
$subcounty = $_POST['subcounty'];
$name = $_SESSION['search-name'];

if ($county != '--all counties--' && $subcounty != 'all subcounties') {
    $total = "SELECT * FROM product WHERE product_title LIKE '%$name%' AND sub_county_location = '$subcounty' AND county_location = '$county'";
    $result = mysqli_query($connection, $total);
    $number_of_rows = mysqli_num_rows($result);

    if ($number_of_rows == 0) {
        echo '<h4 style="margin-bottom: 20%;">No product matching filter!</h4>';
} else {
while ($row_details = mysqli_fetch_assoc($result)) {

$image_string = $row_details['product_image'];
$string_to_array = explode(",", $image_string);
?>
<div class="card bg-light col-md-1 text-center">
    <form action="product-details.php" method="get">
        <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row_details['product_id']; ?>">
        <a onclick="javascript:this.parentNode.submit();">
            <img src="<?php echo '../' . $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
            <div class="card-title mt-4">
                <p class="w-100 m-0 p-0"><strong>
                        <?php echo $row_details['product_title']; ?>
                    </strong></p>
                <p class="w-100 m-0 p-0">
                    <?php echo $row_details['product_keywords']; ?>
                </p>
                <p class="w-100 m-0 p-0">
                    <b>
                        <?php echo 'Ksh. ' . $row_details['product_price']; ?>
                    </b>
                </p>
                <?php if (!empty($row_details['stock_available'])) {
                echo "<p class='w-100 m-0 p-0'>
                <?php echo 'Stock available. ' . $row_details[stock_available]; ?></p>";
            } ?>
                <p class="w-100 m-0 p-0"><i class="fa-solid fa-location-dot"></i>
                    <?php echo $row_details['specific_location']; ?>
                </p>
            </div>
        </a>
    </form>
</div>
<?php
        }
    }
} elseif ($county != '--all counties--' && $subcounty == 'all subcounties') {
    $total = "SELECT * FROM product WHERE product_title LIKE '%$name%' AND county_location = '$county'";
    $result = mysqli_query($connection, $total);
    $number_of_rows = mysqli_num_rows($result);

    if ($number_of_rows == 0) {
        echo '<h4 style="margin-bottom: 20%;">No product matching filter!</h4>';
} else {
while ($row_details = mysqli_fetch_assoc($result)) {

$image_string = $row_details['product_image'];
$string_to_array = explode(",", $image_string);
?>
<div class="card bg-light col-md-1 text-center">
    <form action="product-details.php" method="get">
        <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row_details['product_id']; ?>">
        <a onclick="javascript:this.parentNode.submit();">
            <img src="<?php echo '../' . $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
            <div class="card-title mt-4">
                <p class="w-100 m-0 p-0"><strong>
                        <?php echo $row_details['product_title']; ?>
                    </strong></p>
                <p class="w-100 m-0 p-0">
                    <?php echo $row_details['product_keywords']; ?>
                </p>
                <p class="w-100 m-0 p-0">
                    <b>
                        <?php echo 'Ksh. ' . $row_details['product_price']; ?>
                    </b>
                </p>
                <?php if (!empty($row_details['stock_available'])) {
                echo "<p class='w-100 m-0 p-0'>
                <?php echo 'Stock available. ' . $row_details[stock_available]; ?></p>";
            } ?>
                <p class="w-100 m-0 p-0"><i class="fa-solid fa-location-dot"></i>
                    <?php echo $row_details['specific_location']; ?>
                </p>
            </div>
        </a>
    </form>
</div>
<?php
        }
    }
} elseif ($county == '--all counties--') {
    $total = "SELECT * FROM product WHERE product_title LIKE '%$name%'";
    $result = mysqli_query($connection, $total);
    $number_of_rows = mysqli_num_rows($result);

    if ($number_of_rows == 0) {
        echo '<h4 style="margin-bottom: 20%;">No product matching filter!</h4>';
} else {
while ($row_details = mysqli_fetch_assoc($result)) {

$image_string = $row_details['product_image'];
$string_to_array = explode(",", $image_string);
?>
<div class="card bg-light col-md-1 text-center">
    <form action="product-details.php" method="get">
        <input type="hidden" name="detail-id" id="detail-id" value="<?php echo $row_details['product_id']; ?>">
        <a onclick="javascript:this.parentNode.submit();">
            <img src="<?php echo '../' . $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
            <div class="card-title mt-4">
                <p class="w-100 m-0 p-0"><strong>
                        <?php echo $row_details['product_title']; ?>
                    </strong></p>
                <p class="w-100 m-0 p-0">
                    <?php echo $row_details['product_keywords']; ?>
                </p>
                <p class="w-100 m-0 p-0">
                    <b>
                        <?php echo 'Ksh. ' . $row_details['product_price']; ?>
                    </b>
                </p>
                <?php if (!empty($row_details['stock_available'])) {
                echo "<p class='w-100 m-0 p-0'>
                <?php echo 'Stock available. ' . $row_details[stock_available]; ?></p>";
            } ?>
                <p class="w-100 m-0 p-0"><i class="fa-solid fa-location-dot"></i>
                    <?php echo $row_details['specific_location']; ?>
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