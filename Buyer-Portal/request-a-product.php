<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<script src="../used libralies/tinymce/tinymce.min.js"></script>
<?php
$title = 'Request';
include_once '../includes/preloader.html';
include_once '../includes/buyer-header.php';
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

        #container form {
            width: 60%;
            height: 50%;
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
        button,
        select {
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
            height: auto;
            margin-right: 5px;
        }

        @media only screen and (max-width: 900px) {
            #Post-title {
                margin-top: 6%;
                font-size: 4vw;
            }

            #container form {
                width: 95%;
                margin-left: 2%;
            }
        }

        @media only screen and (max-width: 500px) {
            #Post-title {
                margin-top: 10vw;
            }
        }
    </style>
    <div id="content">
        <div id="Post-title" align="center">Request a product</div>
        <div id="container" class="py-4 container1">
            <!--image size alert -->
            <?php if (isset($_SESSION['image-size'])) { ?>
            <div class="alert alert-primary mt-2" role="alert"><strong>
                    <?php echo $_SESSION['image-size'];
    unset($_SESSION['image-size']); ?>
                </strong></div>
            <?php
}?>
            <form action="../server/request-a-product.php" method="post" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="product-title">Enter Product Title</label>
                    <input type="text" class="form-control product-title" name="product-title" placeholder="e.g oranges...">
                </div>
                <div class="form-control">
                    <label for="request-category">Product Request Category</label>
                    <select name="request-category" class="form-control request-category">
                        <option value="0">--Choose product Request category--</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Cereals">Cereals</option>
                        <option value="Cattle">Cattle</option>
                        <option value="Poutry">Poutry</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="stock-needed">Stock/Quantity needed</label>
                    <input type="text" class="form-control stock-needed" name="stock-needed" placeholder="stock-needed...e.g 300 KGS">
                </div>
                <div class="form-control">
                    <label for="product-image">Product Image Sample</label>
                    <input type="file" accept="image/*" class="form-control product-image" name="product-image"
                        onchange="preview();">
                    <div class="preview"></div>
                </div>
                <div class="form-control">
                    <label for="product-description">Product Description</label>
                    <textarea name="product-description" class="form-control product-description" cols="30" rows="7"
                        placeholder="Describe more about the product you want..."></textarea>
                </div>
                <div class="form-control">
                    <label for="preferred-location">Product Preferred Location (optional)</label>
                    <input type="text" class="form-control" name="preferred-location"
                        placeholder="Enter Product preferred location...">
                </div>
                <button class="btn btn-outline-success form-control" type="submit" id="post-button"
                    name="post-button">Post</button><br>
            </form>
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

            //adding editing features on product description textarea
            tinymce.init({
                selector: '.product-description'
            });


            //checking empty fields
            $('#post-button').on('click', function(e){
                if($('.product-title').val() == ''){
                    e.preventDefault();
                    $('.product-title').css('border', '1px solid red');
                    $('.product-title').on('change', function(){
                        $('.product-title').css('border', '1px solid green');
                    })
                }
                else if($('.request-category').children('option:selected').val() == '0'){
                    e.preventDefault();
                    $('.request-category').css('border', '1px solid red');
                    $('.request-category').on('change', function(){
                        $('.request-category').css('border', '1px solid green');
                    })
                }
                else if($('.stock-needed').val() == ''){
                    e.preventDefault();
                    $('.stock-needed').css('border', '1px solid red');
                    $('.stock-needed').on('change', function(){
                        $('.stock-needed').css('border', '1px solid green');
                    })
                }
                else if($('.product-image').val() == ''){
                    e.preventDefault();
                    $('.product-image').css('border', '1px solid red');
                    $('.product-image').on('change', function(){
                        $('.product-image').css('border', '1px solid green');
                    })
                }
                else if($('.product-description').val() == ''){
                    e.preventDefault();
                    $('.product-description').css('border', '1px solid red');
                    $('.product-description').on('change', function(){
                        $('.product-description').css('border', '1px solid green');
                    })
                }
            })
        });

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