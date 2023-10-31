<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$title = 'Edit';
include_once '../includes/preloader.html';
include_once '../includes/farmer-header.php';
?>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');

        #Post-title {
            margin-top: 3.5vw;
            width: 100%;
            padding: .5vw;
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }

        #content #container {
            width: 100%;
            background: white;
        }

        #container form img {
            width: 100%;
            height: 30vw;
        }

        #container form {
            width: 60%;
            height: auto;
            background: rgb(237, 236, 236);
            border: 4px ridge rgb(12, 118, 84);
            box-sizing: border-box;
            padding: 5px;
            margin-left: 20%;
            border-radius: 5px;
        }

        #container form label,
        select {
            width: 100%;
            font-family: 'Signika Negative', sans-serif;
        }

        #container form input,
        textarea,
        button {
            font-family: 'Signika Negative', sans-serif;
        }

        #container form .form-control {
            margin-bottom: 2vw;
        }

        .preview {
            max-height: auto;
            width: 100%;
            overflow-y: hidden;
            overflow-x: auto;
            white-space: nowrap;
        }

        .preview img {
            max-width: 10vmin;
            height: auto !important;
            margin-right: 5px;
        }

        @media only screen and (max-width: 900px) {
            #Post-title {
                margin-top: 6%;
                font-size: 4vw;
            }

            #container form {
                width: 95%;
                margin-left: 5%;
            }

            #container form img {
                height: 55vw;
            }
        }

        @media only screen and (max-width: 500px) {
            #Post-title {
                margin-top: 10vw;
            }
        }
    </style>
    <div id="content">
        <div id="Post-title" align="center">Edit Product</div>
        <div id="container" class="py-4 container1">
            <!--image size alert -->
            <?php if (isset($_SESSION['image-size'])) { ?>
                <div class="alert alert-primary mt-2 w-75 mx-5" role="alert"><strong>
                        <?php echo $_SESSION['image-size'];
                        unset($_SESSION['image-size']); ?>
                    </strong></div>
                <?php
            } ?>
            <?php
            if (isset($_GET['edit_button'])) {
                $edit_id = $_GET['edit_id'];

                $query = "SELECT * FROM product WHERE product_id = $edit_id";
                $execute = mysqli_query($connection, $query);

                foreach ($execute as $product_details) {
                    $image_string = $product_details['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>

                    <form action="../server/edit_product.php" method="post" enctype="multipart/form-data">
                        <img src="<?php echo '../' . $string_to_array[0] ?>" alt="<?php echo '../' . $string_to_array[0] ?>">
                        <input type="hidden" name="edit_id" value="<?php echo $product_details['product_id'] ?>">
                        <div class="form-control">
                            <label for="product-title">Enter Product Title</label>
                            <input type="text" class="form-control" name="product-title" placeholder="e.g Tomatoes"
                                value="<?php echo $product_details['product_title'] ?>" id="product-title">
                        </div>
                        <div class="form-control">
                            <label for="stock-available">Stock/Quantity Available</label>
                            <input type="text" class="form-control" name="stock-available"
                                placeholder="stock-available...e.g 300 KGS"
                                value="<?php echo $product_details['stock_available'] ?>" id="stock-available">
                        </div>
                        <div class="form-control">
                            <label for="product-category">Product Category</label>
                            <select name="product-category" id="product-category" class="form-control">
                                <option value="<?php echo $product_details['product_category'] ?>">
                                    <?php echo $product_details['product_category'] ?>
                                </option>
                                <option value="fruits">Fruits</option>
                                <option value="vegetables">Vegetables</option>
                                <option value="cereals">Cereals</option>
                                <option value="cattle">Cattle</option>
                                <option value="poutry">Poutry</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label for="product-expiry">Product Expiry (Optional)</label>
                            <input type="date" class="form-control" name="product-expiry" placeholder="Product Expiry"
                                value="<?php echo $product_details['product_expiry'] ?>" id="product-expiry">
                        </div>
                        <div class="form-control">
                            <label for="product-image">Product Image (you can upload several images)</label>
                            <input type="file" accept=".jpg, .png, .webp, .jpeg" class="form-control product-image"
                                name="product-image[]" id="product-image" multiple onchange="preview();">
                            <div class="preview"></div>
                        </div>
                        <div class="form-control">
                            <label for="product-price">Price per Unit</label>
                            <input type="text" class="form-control" name="product-price"
                                placeholder="e.g 50/kg, 1000/90kg, 20000/cow..."
                                value="<?php echo $product_details['product_price'] ?>" id="product-price">
                        </div>
                        <div class="form-control">
                            <label for="product-description">Product Description</label>
                            <textarea name="product-description" class="form-control" cols="30" rows="7"
                                id="product-description"><?php echo $product_details['product_description'] ?></textarea>
                        </div>
                        <div class="form-control">
                            <label for="product-keywords">Product Keywords</label>
                            <input type="text" class="form-control" name="product-keywords" placeholder="Products Keywords"
                                value="<?php echo $product_details['product_keywords'] ?>" id="product-keywords">
                        </div>
                        <div class="form-control">
                            <label for="product-location">Specific Location</label>
                            <input type="text" class="form-control" name="product-location" placeholder="Products location"
                                value="<?php echo $product_details['specific_location'] ?>" id="product-location">
                        </div>
                        <button class="btn btn-outline-success form-control" type="submit" id="update-button"
                            name="update-button">Update</button><br>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <script>
        //product image review
        function preview() {
            var preview = $('.product-image').get(0).files.length;
            for (var i = 0; i < preview; i++) {
                $('.preview').append("<img src = '" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        }
    </script>
    <script src="../main.js"></script>
</body>
<?php
include '../includes/footer.html';
?>

</html>