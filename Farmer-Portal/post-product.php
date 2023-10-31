<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<script src="../used libralies/tinymce/tinymce.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<?php
$title = 'Post';
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

        #content {
            background: white;
        }

        #content #container {
            width: 100%;
        }

        #container form {
            width: 60%;
            height: 55%;
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
            height: auto;
            margin-right: 5px;
        }
        #ward-autocomplete p{
            width: 100%;
            font-size: 15px;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin-bottom: .7rem;
            cursor: pointer;
            border-radius: 5px;
        }
        #ward-autocomplete p:hover{
            background: #e9e9e9;
        }

        .payout {
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, .6);
            display: none;
        }

        .payout form {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            left: 50%;
            top: 30%;
            transform: translateX(-50%);
            background: white;
            border-radius: 7px;
            width: 40vmin;
            padding: 10px;
        }

        .payout form input,
        .payout form button {
            width: 100%;
            margin-bottom: 3vmin;
        }
        .payout span{
            width: 100%;
            display: flex;
            justify-content: flex-start;
        }
        .payout span p{
            display: flex !important;
            flex-direction: row !important;
            justify-content: baseline;
            width: 80% !important;
            font-size: 4vmin;
        }
        .payout span p>input{
            width: 15px;
            margin-bottom: 0 !important;
            margin-right: 20px;
        }
        .payout span p > img{
            height: 25px;
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

            .payout form {
                top: 20%;
                width: 90%;
                height: fit-content;
            }

            #content .form-control::placeholder {
                color: #c2c2c2;
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 500px) {
            #Post-title {
                margin-top: 10vw;
            }
        }
    </style>
    <div id="content">
        <div id="Post-title" align="center">Add a new product</div>
        <!--image size alert -->
        <?php
        if (isset($_SESSION['image-size'])) { ?>
            <div class="alert alert-primary mt-2 w-75 mx-5" role="alert" align="center">
                <strong>
                    <?php echo $_SESSION['image-size']; ?>
                </strong>
            </div>
            <?php
            unset($_SESSION['image-size']);
        } ?>
        <div id="container" class="py-4 container1">
            <form action="../server/post-product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo " $id"; ?>" name="farmer-id">
                <div class="form-control bg-warning">
                    <p><b>Note:</b> Small commission is charged based on quoted price of the
                        product. Charges apply for prices equal to or more than Ksh. 50.</p>
                </div>
                <div class="form-control">
                    <label for="product-title">Enter Product Title</label>
                    <input type="text" class="form-control product-title" name="product-title" placeholder="e.g Tomatoes">
                </div>
                <div class="form-control">
                    <label for="stock-available">Stock/Quantity Available</label>
                    <input type="text" class="form-control stock-available" name="stock-available"
                        placeholder="stock-available...e.g 300 KGS">
                </div>
                <div class="form-control">
                    <label for="product-category">Product Category</label>
                    <select name="product-category" class="form-control product-category">
                        <option value="0">--Choose product category--</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Cereals">Cereals</option>
                        <option value="Cattle">Cattle</option>
                        <option value="Poutry">Poutry</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="product-expiry">Product Expiry(Optional)</label>
                    <input type="date" class="form-control" name="product-expiry" placeholder="Product Expiry">
                </div>
                <div class="form-control">
                    <label for="product-image">Product Image (you can select multiple images. <b>Note:</b> The first
                        image
                        is used as the profile for product)</label>
                    <input type="file" accept=".jpg, .png, .webp, .jpeg" class="form-control product-image"
                        name="product-image[]" multiple onchange="preview();" value>
                    <div class="preview"></div>
                </div>
                <div class="form-control price">
                    <label for="product-price">Product price</label>
                    <input type="number" class="form-control amount" name="product-price-amount"
                        placeholder="Enter amount e.g 50, 1000, 20000...">
                    <input type="text" class="form-control price-unit" name="product-price-unit"
                        placeholder="Enter unit, e.g /kg, /liter, /head etc...">
                </div>
                <div class="form-control">
                    <label for="product-description">Product Description</label>
                    <textarea name="product-description" class="form-control product-description" cols="30" rows="7"></textarea>
                </div>
                <div class="form-control">
                    <label for="product-keywords">Product Keywords</label>
                    <input type="text" class="form-control product-keywords" name="product-keywords" placeholder="Products Keywords"
                        required>
                </div>
                <div class="form-control">
                    <label for="Product County Location">Product County Location</label>
                    <select name="county-location" id="county-location" class="form-control">
                        <option value="0">--Select county--</option>
                        <option value="Baringo">Baringo</option>
                        <option value="Bomet">Bomet</option>
                        <option value="Bungoma">Bungoma</option>
                        <option value="Busia">Busia</option>
                        <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
                        <option value="Embu">Embu</option>
                        <option value="Garissa">Garissa</option>
                        <option value="Homa Bay">Homa Bay</option>
                        <option value="Isiolo">Isiolo</option>
                        <option value="Kwale">Kwale</option>
                        <option value="Kilifi">Kilifi</option>
                        <option value="Kirinyaga">Kirinyaga</option>
                        <option value="Kiambu">Kiambu</option>
                        <option value="Kajiado">Kajiado</option>
                        <option value="Kericho">Kericho</option>
                        <option value="Kakamega">Kakamega</option>
                        <option value="Kisumu">Kisumu</option>
                        <option value="Kisii">Kisii</option>
                        <option value="Laikipia">Laikipia</option>
                        <option value="Kitui">Kitui</option>
                        <option value="Lamu">Lamu</option>
                        <option value="Machakos">Machakos</option>
                        <option value="Makueni">Makueni</option>
                        <option value="Mandera">Mandera</option>
                        <option value="Meru">Meru</option>
                        <option value="Migori">Migori</option>
                        <option value="Marsabit">Marsabit</option>
                        <option value="Mombasa">Mombasa</option>
                        <option value="Muranga">Muranga</option>
                        <option value="Nairobi">Nairobi</option>
                        <option value="Nakuru">Nakuru</option>
                        <option value="Nandi">Nandi</option>
                        <option value="Narok">Narok</option>
                        <option value="Nyamira">Nyamira</option>
                        <option value="Nyandarua">Nyandarua</option>
                        <option value="Nyeri">Nyeri</option>
                        <option value="Samburu">Samburu</option>
                        <option value="Siaya">Siaya</option>
                        <option value="Taita Taveta">Taita Taveta</option>
                        <option value="Tana River">Tana River</option>
                        <option value="Tharaka Nithi">Tharaka Nithi</option>
                        <option value="Trans Nzoia">Trans Nzoia</option>
                        <option value="Turkana">Turkana</option>
                        <option value="Uasin Gichu">Uasin Gichu</option>
                        <option value="Vihiga">Vihiga</option>
                        <option value="Wajir">Wajir</option>
                        <option value="West Pokot">West Pokot</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="Product Sub-county Location">Product Sub-county Location</label>
                    <select name="sub-county-location" class="form-control" id="sub-county-location"></select>
                </div>
                <div class="form-control">
                    <label for="Product specific Location">Product Location</label>
                    <input type="text" class="form-control" id="location" name="Product-specific-Location"
                        placeholder="Products location" autocomplete="off">
                        <div id="ward-autocomplete"></div>
                </div>
                <div class="commission" align="center">
                    <label>Your payable commission: Ksh. <span></span></label>
                    <button class="form-control btn btn-sm btn-warning w-25">Payout</button>
                </div>
                <div class="form-control">
                    <button type="submit" class="form-control btn btn-outline-success post-button" name="post-button">Post
                        Product</button>
                </div>
            </form>
        </div>
    </div>
    <div class="payout">
        <form action="../server/payout.php" method="post">
            <p>Pay Now</p>
            <?php $phone = '0' . $data['phone_number']; ?>
            <input type="hidden" name="user-id" value="<?php echo $data['phone_number']; ?>">
            <input type="number" name="amount" class="form-control" value="" id="amount">
            <span class="form-group">
                <p><input type="radio" checked value="mpesa"><img src="../images/mpesa.jpeg" alt=""></p>
            </span>
            <input type="number" name="phone" value="<?php echo $phone; ?>" class="form-control" required>
            <button class="form-control btn btn-info" type="submit" name="pay">Pay Now</button>
            <button class="form-control btn btn-sm btn-dark w-25 close">Close</button>
        </form>
    </div>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyDANjx3bosEtIyzJaoWs50Wnt6nt_1rmxU "></script>
    <script>
        $(window).ready(function () {

            //adding editing features on product description textarea
            tinymce.init({
                selector: '.product-description'
            });

            // //checking number of images uploaded
            // $('.product-image').on('change', function (e) {
            //     var number_of_images = $(this).get(0).files.length;

            //     if (number_of_images > 4) {
            //         // alert('You are only allowed to upload a maximum of 4 files');
            //         for (var i = 0; i < 4; i++) {
            //             alert($('.product-image').get(0).files[i].name);
            //         }
            //     }
            // });

            //search suggestion
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


            //checking that the fields are not empty
        $('.post-button').on('click', function(e){
            if($('.product-title').val() == ''){
                e.preventDefault();
                $('.product-title').css('border', '1px solid red');
                $('.product-title').on('change', function(){
                    $('.product-title').css('border', '1px solid green');
                })
            }
            else if($('.stock-available').val() == ''){
                e.preventDefault();
                $('.stock-available').css('border', '1px solid red');
                $('.stock-available').on('change', function(){
                    $('.stock-available').css('border', '1px solid green');
                })
            }
            else if($('.product-category').children("option:selected").val() == '0'){
                e.preventDefault();
                $('.product-category').css('border', '1px solid red');
                $('.product-category').on('change', function(){
                    $('.product-category').css('border', '1px solid green');
                })
            }
            else if($('.product-image').val() == ''){
                e.preventDefault();
                $('.product-image').css('border', '1px solid red');
                $('.product-image').on('change', function(){
                    $('.product-image').css('border', '1px solid green');
                })
            }
            else if($('.amount').val() == ''){
                e.preventDefault();
                $('.amount').css('border', '1px solid red');
                $('.amount').on('change', function(){
                    $('.amount').css('border', '1px solid green');
                })
            }
            else if($('.price-unit').val() == ''){
                e.preventDefault();
                $('.price-unit').css('border', '1px solid red');
                $('.price-unit').on('change', function(){
                    $('.price-unit').css('border', '1px solid green');
                })
            }
            else if($('.product-description').val() == ''){
                e.preventDefault();
                $('.product-description').css('border', '1px solid red');
                $('.product-description').on('change', function(){
                    $('.product-description').css('border', '1px solid green');
                })
            }
            else if($('.product-keywords').val() == ''){
                e.preventDefault();
                $('.product-keywords').css('border', '1px solid red');
                $('.product-keywords').on('change', function(){
                    $('.product-keywords').css('border', '1px solid green');
                })
            }
            else if($('#county-location').children("option:selected").val() == '0'){
                e.preventDefault();
                $('#county-location').css('border', '1px solid red');
                $('#county-location').on('change', function(){
                    $('#county-location').css('border', '1px solid green');
                })
            }
            else if($('#sub-county-location').children("option:selected").val() == '--select sub-county--'){
                e.preventDefault();
                $('#sub-county-location').css('border', '1px solid red');
                $('#sub-county-location').on('change', function(){
                    $('#sub-county-location').css('border', '1px solid green');
                })
            }
            else if($('#location').val() == ''){
                e.preventDefault();
                $('#location').css('border', '1px solid red');
                $('#location').on('change', function(){
                    $('#location').css('border', '1px solid green');
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


        //ward auto completion
        // $('#location').keyup(function(){
        //     var ward = $('#location').val();
        //     $.ajax({
        //         url: "../Ajax/ward-suggestion.php",
        //         method: 'get',
        //         data: {ward: ward},
        //         success: function (response) {
        //             $('#ward-autocomplete').html(response);

        //             $('#ward-autocomplete p').on('click', function(){
        //                 var paragraph_content = $(this).html();
        //                 $('#location').val(paragraph_content);
        //                 $('#ward-autocomplete').html('');
        //             })
        //             $('#location').blur(function(){
        //                 if($('#ward-autocomplete').html() == 'No such ward. Check you spelling...'){
        //                     $('#location').val('');
        //                 }
        //             })
        //         }
        //     });
        // })

        //Calculating commission to be charged
        setInterval(function () {
            var price = $('.price > .amount').val();
            if (price >= 50) {
                var commission = Math.round((5 * price) / 100);
                $('.commission span').html(commission);
                $('.payout #amount').val(commission);
                $('.commission button').prop('disabled', false);
            }
            else {
                $('.commission span').html("No charges :)");
                $('.commission button').prop('disabled', true);
            }
        }, 1000)

        //payout popup
        $('.commission button').click(function (e) {
            e.preventDefault();
            $('.payout').show();
            $('.payout #amount').prop('disabled', true);
        });
        $('.payout .close').click(function (e) {
            e.preventDefault();
            $('.payout').hide();
        });


        //subcounties
        $('#county-location').on('change', function () {

            var a = document.getElementById("county-location").value;

            if (a === 'Bomet') {
                var array = ['--select sub-county--', 'Sotik', 'Chepalungu', 'Bomet Central', 'Bomet East', 'Konoin'];
            }
            if (a === 'Baringo') {
                var array = ['--select sub-county--', 'Tiaty', 'Baringo North', 'Barindo Central', 'Baringo South', 'Mogotio', 'Eldama Ravine'];
            }
            if (a === 'Bungoma') {
                var array = ['--select sub-county--', 'Mt-Elgon', 'Sirisia', 'Kabuchai', 'Bumula', 'Kanduyi', 'Webuye East', 'Webuye West', 'Kimilili', 'Tongaren'];
            }
            if (a === 'Busia') {
                var array = ['--select sub-county--', 'Teso North', 'Teso South', 'Nambale', 'Matayos', 'Butula', 'Funyula', 'Budalangi'];
            }
            if (a === 'Elgeyo Marakwet') {
                var array = ['--select sub-county--', 'Marakwet North', 'Marakwet South', 'Marakwet East', 'Marakwet West'];
            }
            if (a === 'Embu') {
                var array = ['--select sub-county--', 'Igembe South', 'Igembe Central', 'Igembe North', 'Tigania West', 'Tigania East', 'North Imenti', 'Buuri', 'Central Imenti', 'South Imenti'];
            }
            if (a === 'Garissa') {
                var array = ['--select sub-county--', 'Garissa Township', 'Balambala', 'Dadaab', 'Fafi', 'Ijara'];
            }
            if (a === 'Homa Bay') {
                var array = ['--select sub-county--', 'Kasipul', 'Kabondo Kasipul', 'Karachuonyo', 'Rangwe', 'Homa bay Town', 'Ndhiwa', 'Suba North', 'Suba South'];
            }
            if (a === 'Isiolo') {
                var array = ['--select sub-county--', 'Isiolo North', 'Isiolo South'];
            }
            if (a === 'Kwale') {
                var array = ['--select sub-county--', 'Matuga', 'Lungalunga', 'Kinango', 'Msambweni'];
            }
            if (a === 'Kilifi') {
                var array = ['--select sub-county--', 'Kilifi North', 'Kilifi South', 'Kaloleni', 'Rabai', 'Ganze', 'Malindi', 'Magarini'];
            }
            if (a === 'Kirinyaga') {
                var array = ['--select sub-county--', 'Mwea', 'Gichugu', 'Ndia', 'Kirinyaga Central'];
            }
            if (a === 'Kiambu') {
                var array = ['--select sub-county--', 'Gatundu North', 'Gatundu South', 'Juja', 'Thika Town', 'Ruiru', 'Githunguri', 'Kiambu', 'Kiambaa', 'Kabete', 'Kikuyu', 'Limuru', 'Lari'];
            }
            if (a === 'Kajiado') {
                var array = ['--select sub-county--', 'Kajiado North', 'Kajiado South', 'Kajiado Central', 'Kajiado East', 'Kajiado West'];
            }
            if (a === 'Kericho') {
                var array = ['--select sub-county--', 'Kipkelion East', 'Kipkelion West', 'Ainamoi', 'Bureti', 'Belgut', 'Sigowet/Soin'];
            }
            if (a === 'Kakamega') {
                var array = ['--select sub-county--', 'Lugari', 'Likuyani', 'Malava', 'Lurambi', 'Navakholo', 'Mumias West', 'Mumias East', 'Matundu', 'Butere', 'Khwisero', 'Shinyalu', 'Ikolomani'];
            }
            if (a === 'Kisumu') {
                var array = ['--select sub-county--', 'Kisumu East', 'Kisumu West', 'Kisumu Central', 'Seme', 'Nyando', 'Muhoroni', 'Nyakach'];
            }
            if (a === 'Kisii') {
                var array = ['--select sub-county--', 'Bonchari', 'South Mugirango', 'Bomachoge Borabu', 'Bobasi', 'Bomachoge chache', 'Nyaribari Masaba', 'Nyaribari Chache', 'Kitutu Chache North', 'Kitutu Chache South'];
            }
            if (a === 'Laikipia') {
                var array = ['--select sub-county--', 'Laikipia North', 'Laikipia Central', 'Laikipia East', 'Laikipia West', 'Nyahururu'];
            }
            if (a === 'Kitui') {
                var array = ['--select sub-county--', 'Kitui East', 'Kitui West', 'Kitui Central', 'Kitui Rural', 'Kitui South', 'Mwingi North', 'Mwingi West', 'Mwingi Central'];
            }
            if (a === 'Lamu') {
                var array = ['--select sub-county--', 'Lamu East', 'Lamu West'];
            }
            if (a === 'Machakos') {
                var array = ['--select sub-county--', 'Masinga', 'Yatta', 'Matungulu', 'Kangundo', 'Mwala', 'Kathiani', 'Machakos Town', 'Mavoko'];
            }
            if (a === 'Makueni') {
                var array = ['--select sub-county--', 'Makueni', 'Kalungu', 'Mukaa', 'Kibwezi East', 'Kibwezi West', 'Kilome'];
            }
            if (a === 'Mandera') {
                var array = ['--select sub-county--', 'Mandera West', 'Mandera South', 'Banissa', 'Mandera North', 'Mandera East', 'Lafey'];
            }
            if (a === 'Meru') {
                var array = ['--select sub-county--', 'Igembe East', 'Igembe South', 'Igembe North', 'Igembe West', 'Buuri', 'Imenti South', 'Imenti North', 'Imenti Central'];
            }
            if (a === 'Migori') {
                var array = ['--select sub-county--', 'Rongo', 'Awendo', 'Suna East', 'Suna West', 'Uriri', 'Nyatike', 'Kuria West', 'Kuria East', 'Ntimaru', 'Mabera'];
            }
            if (a === 'Marsabit') {
                var array = ['--select sub-county--', 'Laisamis', 'North Norr', 'Moyale', 'Saku'];
            }
            if (a === 'Mombasa') {
                var array = ['--select sub-county--', 'Changamwe', 'Jomvu', 'Kisauni', 'Nyali', 'Likoni', 'Mvita'];
            }
            if (a === "Muranga") {
                var array = ['--select sub-county--', 'Kiharu', 'Mathioya', 'Kangema', 'Gatanga', 'Kigumo', 'Kahuro', "Murang'a South"];
            }
            if (a === 'Nairobi') {
                var array = ['--select sub-county--', 'Dagoretti South', 'Dagoretti Central', 'Embakasi East', 'Embakasi South', 'Embakasi North', 'Embakasi West', 'Kamukunji', 'Kasarani', 'KIbra', 'Langata', 'Makadara', 'Mathare', 'Roysambu', 'Ruaraka', 'Starehe', 'Westlands'];
            }
            if (a === 'Nakuru') {
                var array = ['--select sub-county--', 'Nakuru Town East', 'Nakuru Town West', 'Njoro', 'Molo', 'Gilgil', 'Naivasha', 'Kuresoi North', 'Kuresoi South', 'Rongai', 'Subukia', 'Bahati'];
            }
            if (a === 'Nandi') {
                var array = ['--select sub-county--', 'Mosop', 'Emgwen', 'Aldai', 'Tinderet', 'Nandi Hills', 'Chesumei'];
            }
            if (a === 'Narok') {
                var array = ['--select sub-county--', 'Transmara West', 'Transmara East', 'Narok North', 'Narok South', 'Narok West', 'Narok East'];
            }
            if (a === 'Nyamira') {
                var array = ['--select sub-county--', 'Nyamira South', 'Nyamira North', 'Borabu', 'Manga', 'Masaba North'];
            }
            if (a === 'Nyandarua') {
                var array = ['--select sub-county--', 'Kinangop', 'Kipipiri', 'ol Joro Orok', 'Ndaragwa', 'Ol Kalou'];
            }
            if (a === 'Nyeri') {
                var array = ['--select sub-county--', 'Nyeri Town', 'Mathira East', 'Mathira West', 'Tetu', 'Mukurweni', 'Kieni East', 'Kieni West', 'Othaya'];
            }
            if (a === 'Samburu') {
                var array = ['--select sub-county--', 'Samburu East', 'Samburu West', 'Samburu North'];
            }
            if (a === 'Siaya') {
                var array = ['--select sub-county--', 'Alego Usonga', 'Ugenya', 'Gem', 'Bondo​​', 'Ugunja', 'Rarieda​​'];
            }
            if (a === 'Taita Taveta') {
                var array = ['--select sub-county--', 'Voi', 'Mwatate', 'Wundanyi', 'Taveta'];
            }
            if (a === 'Tana River') {
                var array = ['--select sub-county--', 'Bura', 'Galole', 'Garsen'];
            }
            if (a === 'Tharaka Nithi') {
                var array = ['--select sub-county--', 'Tharatha North', 'Tharaka South', 'Chuka', 'Igambang’ombe', 'Muthambi', 'Maara'];
            }
            if (a === 'Trans Nzoia') {
                var array = ['--select sub-county--', 'Cherengany', 'Endebess', 'Kwanza', 'Kiminini', 'Saboti'];
            }
            if (a === 'Turkana') {
                var array = ['--select sub-county--', 'Loima', 'Turkana West', 'Turkana East', 'Turkana North', 'Turkana South', 'Turkana Central'];
            }
            if (a === 'Uasin Gishu') {
                var array = ['--select sub-county--', 'Soy', 'Tarbo', 'Ainabkoi', 'Kapseret', 'Kesses', 'Moiben'];
            }
            if (a === 'Vihiga') {
                var array = ['--select sub-county--', 'Emuhaya', 'Sabatia', 'Luanda', 'Hamisi', 'Vihiga'];
            }
            if (a === 'Wajir') {
                var array = ['--select sub-county--', 'Wajir North', 'Wajir South', 'Wajir East', 'Wajir West', 'Eldas', 'Tarbaj'];
            }
            if (a === 'West Pokot') {
                var array = ['--select sub-county--', 'West Pokot', 'North Pokot', 'Pokot South', 'Pokot Central'];
            }
            if (a === '0') {
                var array = [''];
            }

            var string = "";
            for (let i = 0; i < array.length; i++) {
                string = string + "<option>" + array[i] + "</option>";
            }
            document.getElementById('sub-county-location').innerHTML = string;
        });
    </script>
    <script src="../main.js"></script>
</body>
<?php include_once('../includes/footer.html'); ?>

</html>