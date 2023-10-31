<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$title = $_GET['search'];
include_once '../includes/preloader.html';
include_once '../includes/buyer-header.php';
?>

<body>
    <style>
        .pictures {
            background-color: white;
        }

        #search-title {
            margin-top: 3.5vw;
            width: 100%;
            padding: .5vw;
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }

        .card {
            display: inline-block;
            width: 23.5%;
            height: 20vw;
            margin: 0.5vw;
            padding: 0.4vw;
            overflow: hidden;
        }

        .card p {
            width: 100%;
            margin: 0;
            padding: 0;
            font-size: .8em;
            text-overflow: ellipsis;
            overflow: hidden;
            line-height: 1.5em;
            text-align: left;
            max-height: 1.5em;
            font-weight: 500;
        }

        .card img {
            width: 100%;
            height: 12vw;
        }

        .card:hover {
            cursor: pointer;
            box-shadow: 0 0 15px grey;
            transition-duration: .5s;
        }

        .card .card-title {
            padding-top: .8vw;
            font-family: 'Signika Negative', sans-serif;
        }

        #content {
            background: white;
        }

        #filter {
            display: block;
            position: absolute;
            top: 10%;
            left: 5px;
            width: 9vmax;
            height: fit-content;
            padding: 3px;
            background: white;
            border-radius: 5px;
            z-index: 5;
        }

        #filter label {
            display: inline;
            text-align: center;
            width: 100%;
            height: fit-content;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 2vmin;
        }

        #filter select {
            display: inline;
            width: 100%;
            margin-bottom: 2vmin;
            border: 1px solid grey;
            border-radius: 3px;
        }

        #small-screen-filter {
            position: fixed;
            left: 10px;
            top: 10%;
            width: auto;
            height: auto;
            z-index: 5;
            display: none;
        }

        #small-screen-filter button {
            width: 40px;
            height: 40px;
            font-size: 2.5vmin;
            border: none;
            color: white;
            background: rgb(0, 84, 130);
            border-radius: 50%;
            box-shadow: 0 0 5px grey;
        }

        @media only screen and (max-width: 1200px) {
            #filter {
                display: none;
                left: 20%;
                width: 15vmax;
                box-shadow: 0 0 7px black;
            }

            #small-screen-filter {
                display: block;
            }
        }

        @media only screen and (max-width: 900px) {
            #content {
                padding: 0;
            }

            #search-title {
                margin-top: 10vw;
                font-size: 4vw;
            }

            .pictures {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }

            .pictures .card {
                width: 30% ;
                height: 40vw;
                margin: 1.3vw;
            }

            .pictures .card p {
                width: 100%;
                margin: 0;
                padding: 0;
                font-size: 2.2vw !important;
            }

            .pictures .card img {
                width: 100%;
                height: 22vw;
            }

            .pictures .card .card-title {
                padding-top: 2vw;
            }
        }

        @media only screen and (max-width: 500px) {
            #filter {
                width: 23vmax;
            }

            #filter label {
                font-size: 3vmin;
            }

            #small-screen-filter button {
                font-size: 3vmin;
            }

            .pictures {
                padding: 5vmin;
            }

            .pictures .card {
                width: 47%;
                height: 55vw;
            }

            .pictures .card p {
                font-size: 3vw !important;
            }

            .pictures .card img {
                height: 30vw;
            }

            .pictures .card .card-title {
                padding-top: 2.5vw;
            }
        }
    </style>
    <div id="filter">
        <label>Filter</label>
        <select name="select_county form-control" id="select_county">
            <option value="--all counties--">--all counties--</option>
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
        <select name="select_subcounty form-control " id="select_subcounty"></select>
    </div>
    <div id="small-screen-filter"><button align="center"><i class="fa fa-filter" aria-hidden="true"></i></button></div>
    <div id="content">
        <?php
        if (isset($_GET['search'])) {

            //number of pages I want in every page 
            $items_per_page = 40;

            //get the searched name
            $name = $_GET['search'];

            //which page is currently visited
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            //total records in the table
            $total = "SELECT * FROM product WHERE product_title LIKE '%$name%'";
            $result = mysqli_query($connection, $total);
            $number_of_rows = mysqli_num_rows($result);

            //number of pages
            $number_of_pages = ceil($number_of_rows / $items_per_page);

            //offset
            $offset = ($page * $items_per_page) - $items_per_page;

            //fetching images now with limits
            $sql = "SELECT * FROM product WHERE product_title LIKE '%$name%' LIMIT $offset, $items_per_page";
            $execute = mysqli_query($connection, $sql);
        }
        ?>
        <div id="search-title" align="center">You searched '
            <?php echo $name;
            $_SESSION['search-name'] = $name; ?>'
        </div>
        <div class="col-md-12 row-cols-3 row pt-3 pictures">
            <?php
            if ($number_of_rows <= 0) {
                $notice = '<h4 style="padding: 10vw;">No product matched your search. Try another word...</h4>';
            } else {
                while ($row_details = mysqli_fetch_assoc($execute)) {
                    $image_string = $row_details['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>
                    <div class="card bg-light col-md-1 text-center">
                        <form action="product" method="get">
                            <input type="hidden" name="detail-id" id="detail-id"
                                value="<?php echo $row_details['product_id']; ?>">
                            <a onclick="javascript:this.parentNode.submit();">
                                <img src="../<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>">
                                <div class="card-title mt-1">
                                    <p class="w-100 m-0 p-0" id="big"><strong>
                                            <?php echo $row_details['product_keywords']; ?>
                                        </strong></p>
                                    <p class="w-100 m-0 p-0" id="big">
                                        <b>
                                            <?php echo 'Ksh. ' . $row_details['product_price']; ?>
                                        </b>
                                    </p>
                                    <p class="w-100 m-0 p-0">
                                        <?php if (!empty($row_details['stock_available'])) {
                                            echo 'Stock available: ' . $row_details['stock_available'];
                                        } ?>
                                    </p>
                                    <p class="w-100 m-0 p-0"><i class="fa-solid fa-location-dot"></i>
                                        <?php echo ' ' . $row_details['specific_location'] . ' | ' . $row_details['county_location'] ?>
                                    </p>
                                </div>
                            </a>
                        </form>
                    </div>
                    <?php
                }
            } ?>
        </div>
        <?php
        if (isset($notice)) {
            echo $notice;
        }
        ?>


        <!--pagination-->
        <div class="paging">
            <?php
            if ($page > 1) {
                echo '<a href="search.php?search=' . $name . '&page=1"><i class="fa-solid fa-angle-double-left"></i></a>';
                echo '<a href="search.php?search=' . $name . '&page=' . ($page - 1) . '"><i class="fa-solid
                    fa-angle-left"></i></a>';
            }
            ?>
            <div class="pages">
                <?php
                for ($i = 1; $i <= $number_of_pages; $i++) {
                    if ($number_of_pages > 1) {
                        if ($i == $page) {
                            echo '<a href="search.php?search=' . $name . '&page=' . $i . '" id="on_page">' . $page . '</a>';
                        } else {
                            echo '<a href="search.php?search=' . $name . '&page=' . $i . '">' . $i . '</a>';
                        }
                    }
                }
                ?>
            </div>
            <?php
            if ($number_of_pages > $page) {
                echo '<a href="search.php?search=' . $name . '&page=' . ($page + 1) . '"><i class="fa-solid
                fa-angle-right"></i></a>';
                echo '<a href="search.php?search=' . $name . '&page=' . ($number_of_pages) . '"><i class="fa-solid
                    fa-angle-double-right"></i></a>';
            }
            ?>
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

        //search filter
        $(window).ready(function () {
            $('#filter > #select_county').on('change', function () {
                var subcounty = $('#filter > #select_subcounty').val();
                var county = $('#filter > #select_county').val();
                $.ajax({
                    url: '../Ajax/filter.php',
                    method: 'POST',
                    data: { county: county, subcounty: subcounty },
                    success: function (data) {
                        $('.pictures').html(data);
                    }
                });
            });
            $('#filter > #select_subcounty').on('change', function () {
                var subcounty = $('#filter > #select_subcounty').val();
                var county = $('#filter > #select_county').val();
                $.ajax({
                    url: '../Ajax/filter.php',
                    method: 'POST',
                    data: { county: county, subcounty: subcounty },
                    success: function (data) {
                        $('.pictures').html(data);
                    }
                });
            });
        });

        //subcounties
        $('#select_county').on('change', function () {

            var a = document.getElementById("select_county").value;

            if (a === 'Bomet') {
                var array = ['all subcounties', 'Sotik', 'Chepalungu', 'Bomet Central', 'Bomet East', 'Konoin'];
            }
            if (a === 'Baringo') {
                var array = ['all subcounties', 'Tiaty', 'Baringo North', 'Barindo Central', 'Baringo South', 'Mogotio', 'Eldama Ravine'];
            }
            if (a === 'Bungoma') {
                var array = ['all subcounties', 'Mt-Elgon', 'Sirisia', 'Kabuchai', 'Bumula', 'Kanduyi', 'Webuye East', 'Webuye West', 'Kimilili', 'Tongaren'];
            }
            if (a === 'Busia') {
                var array = ['all subcounties', 'Teso North', 'Teso South', 'Nambale', 'Matayos', 'Butula', 'Funyula', 'Budalangi'];
            }
            if (a === 'Elgeyo Marakwet') {
                var array = ['all subcounties', 'Marakwet North', 'Marakwet South', 'Marakwet East', 'Marakwet West'];
            }
            if (a === 'Embu') {
                var array = ['all subcounties', 'Igembe South', 'Igembe Central', 'Igembe North', 'Tigania West', 'Tigania East', 'North Imenti', 'Buuri', 'Central Imenti', 'South Imenti'];
            }
            if (a === 'Garissa') {
                var array = ['all subcounties', 'Garissa Township', 'Balambala', 'Dadaab', 'Fafi', 'Ijara'];
            }
            if (a === 'Homa Bay') {
                var array = ['all subcounties', 'Kasipul', 'Kabondo Kasipul', 'Karachuonyo', 'Rangwe', 'Homa bay Town', 'Ndhiwa', 'Suba North', 'Suba South'];
            }
            if (a === 'Isiolo') {
                var array = ['all subcounties', 'Isiolo North', 'Isiolo South'];
            }
            if (a === 'Kwale') {
                var array = ['all subcounties', 'Matuga', 'Lungalunga', 'Kinango', 'Msambweni'];
            }
            if (a === 'Kilifi') {
                var array = ['all subcounties', 'Kilifi North', 'Kilifi South', 'Kaloleni', 'Rabai', 'Ganze', 'Malindi', 'Magarini'];
            }
            if (a === 'Kirinyaga') {
                var array = ['all subcounties', 'Mwea', 'Gichugu', 'Ndia', 'Kirinyaga Central'];
            }
            if (a === 'Kiambu') {
                var array = ['all subcounties', 'Gatundu North', 'Gatundu South', 'Juja', 'Thika Town', 'Ruiru', 'Githunguri', 'Kiambu', 'Kiambaa', 'Kabete', 'Kikuyu', 'Limuru', 'Lari'];
            }
            if (a === 'Kajiado') {
                var array = ['all subcounties', 'Kajiado North', 'Kajiado South', 'Kajiado Central', 'Kajiado East', 'Kajiado West'];
            }
            if (a === 'Kericho') {
                var array = ['all subcounties', 'Kipkelion East', 'Kipkelion West', 'Ainamoi', 'Bureti', 'Belgut', 'Sigowet/Soin'];
            }
            if (a === 'Kakamega') {
                var array = ['all subcounties', 'Lugari', 'Likuyani', 'Malava', 'Lurambi', 'Navakholo', 'Mumias West', 'Mumias East', 'Matundu', 'Butere', 'Khwisero', 'Shinyalu', 'Ikolomani'];
            }
            if (a === 'Kisumu') {
                var array = ['all subcounties', 'Kisumu East', 'Kisumu West', 'Kisumu Central', 'Seme', 'Nyando', 'Muhoroni', 'Nyakach'];
            }
            if (a === 'Kisii') {
                var array = ['all subcounties', 'Bonchari', 'South Mugirango', 'Bomachoge Borabu', 'Bobasi', 'Bomachoge chache', 'Nyaribari Masaba', 'Nyaribari Chache', 'Kitutu Chache North', 'Kitutu Chache South'];
            }
            if (a === 'Laikipia') {
                var array = ['all subcounties', 'Laikipia North', 'Laikipia Central', 'Laikipia East', 'Laikipia West', 'Nyahururu'];
            }
            if (a === 'Kitui') {
                var array = ['all subcounties', 'Kitui East', 'Kitui West', 'Kitui Central', 'Kitui Rural', 'Kitui South', 'Mwingi North', 'Mwingi West', 'Mwingi Central'];
            }
            if (a === 'Lamu') {
                var array = ['all subcounties', 'Lamu East', 'Lamu West'];
            }
            if (a === 'Machakos') {
                var array = ['all subcounties', 'Masinga', 'Yatta', 'Matungulu', 'Kangundo', 'Mwala', 'Kathiani', 'Machakos Town', 'Mavoko'];
            }
            if (a === 'Makueni') {
                var array = ['all subcounties', 'Makueni', 'Kalungu', 'Mukaa', 'Kibwezi East', 'Kibwezi West', 'Kilome'];
            }
            if (a === 'Mandera') {
                var array = ['all subcounties', 'Mandera West', 'Mandera South', 'Banissa', 'Mandera North', 'Mandera East', 'Lafey'];
            }
            if (a === 'Meru') {
                var array = ['all subcounties', 'Igembe East', 'Igembe South', 'Igembe North', 'Igembe West', 'Buuri', 'Imenti South', 'Imenti North', 'Imenti Central'];
            }
            if (a === 'Migori') {
                var array = ['all subcounties', 'Rongo', 'Awendo', 'Suna East', 'Suna West', 'Uriri', 'Nyatike', 'Kuria West', 'Kuria East', 'Ntimaru', 'Mabera'];
            }
            if (a === 'Marsabit') {
                var array = ['all subcounties', 'Laisamis', 'North Norr', 'Moyale', 'Saku'];
            }
            if (a === 'Mombasa') {
                var array = ['all subcounties', 'Changamwe', 'Jomvu', 'Kisauni', 'Nyali', 'Likoni', 'Mvita'];
            }
            if (a === "Muranga") {
                var array = ['all subcounties', 'Kiharu', 'Mathioya', 'Kangema', 'Gatanga', 'Kigumo', 'Kahuro', "Murang'a South"];
            }
            if (a === 'Nairobi') {
                var array = ['all subcounties', 'Dagoretti South', 'Dagoretti Central', 'Embakasi East', 'Embakasi South', 'Embakasi North', 'Embakasi West', 'Kamukunji', 'Kasarani', 'KIbra', 'Langata', 'Makadara', 'Mathare', 'Roysambu', 'Ruaraka', 'Starehe', 'Westlands'];
            }
            if (a === 'Nakuru') {
                var array = ['all subcounties', 'Nakuru Town East', 'Nakuru Town West', 'Njoro', 'Molo', 'Gilgil', 'Naivasha', 'Kuresoi North', 'Kuresoi South', 'Rongai', 'Subukia', 'Bahati'];
            }
            if (a === 'Nandi') {
                var array = ['all subcounties', 'Mosop', 'Emgwen', 'Aldai', 'Tinderet', 'Nandi Hills', 'Chesumei'];
            }
            if (a === 'Narok') {
                var array = ['all subcounties', 'Transmara West', 'Transmara East', 'Narok North', 'Narok South', 'Narok West', 'Narok East'];
            }
            if (a === 'Nyamira') {
                var array = ['all subcounties', 'Nyamira South', 'Nyamira North', 'Borabu', 'Manga', 'Masaba North'];
            }
            if (a === 'Nyandarua') {
                var array = ['all subcounties', 'Kinangop', 'Kipipiri', 'ol Joro Orok', 'Ndaragwa', 'Ol Kalou'];
            }
            if (a === 'Nyeri') {
                var array = ['all subcounties', 'Nyeri Town', 'Mathira East', 'Mathira West', 'Tetu', 'Mukurweni', 'Kieni East', 'Kieni West', 'Othaya'];
            }
            if (a === 'Samburu') {
                var array = ['all subcounties', 'Samburu East', 'Samburu West', 'Samburu North'];
            }
            if (a === 'Siaya') {
                var array = ['all subcounties', 'Alego Usonga', 'Ugenya', 'Gem', 'Bondo​​', 'Ugunja', 'Rarieda​​'];
            }
            if (a === 'Taita Taveta') {
                var array = ['all subcounties', 'Voi', 'Mwatate', 'Wundanyi', 'Taveta'];
            }
            if (a === 'Tana River') {
                var array = ['all subcounties', 'Bura', 'Galole', 'Garsen'];
            }
            if (a === 'Tharaka Nithi') {
                var array = ['all subcounties', 'Tharatha North', 'Tharaka South', 'Chuka', 'Igambang’ombe', 'Muthambi', 'Maara'];
            }
            if (a === 'Trans Nzoia') {
                var array = ['all subcounties', 'Cherengany', 'Endebess', 'Kwanza', 'Kiminini', 'Saboti'];
            }
            if (a === 'Turkana') {
                var array = ['all subcounties', 'Loima', 'Turkana West', 'Turkana East', 'Turkana North', 'Turkana South', 'Turkana Central'];
            }
            if (a === 'Uasin Gishu') {
                var array = ['all subcounties', 'Soy', 'Tarbo', 'Ainabkoi', 'Kapseret', 'Kesses', 'Moiben'];
            }
            if (a === 'Vihiga') {
                var array = ['all subcounties', 'Emuhaya', 'Sabatia', 'Luanda', 'Hamisi', 'Vihiga'];
            }
            if (a === 'Wajir') {
                var array = ['all subcounties', 'Wajir North', 'Wajir South', 'Wajir East', 'Wajir West', 'Eldas', 'Tarbaj'];
            }
            if (a === 'West Pokot') {
                var array = ['all subcounties', 'West Pokot', 'North Pokot', 'Pokot South', 'Pokot Central'];
            }
            if (a === '--all counties--') {
                var array = [''];
            }

            var string = "";
            for (let i = 0; i < array.length; i++) {
                string = string + '<option value="' + array[i] + '">' + array[i] + '</option>';
            }
            document.getElementById('select_subcounty').innerHTML = string;
        });

        //filter for amall screens
        $(window).ready(function () {
            $('#small-screen-filter button').on('click', function () {
                $('#filter').toggle();
            });
        });
    </script>
    <script src="../main.js"></script>
</body>
<?php
include '../includes/footer.html';
?>

</html>