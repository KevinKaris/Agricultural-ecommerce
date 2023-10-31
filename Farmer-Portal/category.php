<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$category_value = $_GET['category-id'];
$title = $_GET['category-id'];
include_once '../includes/preloader.html';
include_once '../includes/farmer-header.php';
?>

<body>
    <style>
        #content {
            background: white;
        }

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
            max-height: 1.5em;
            text-align: left;
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
                height: 20vw;
            }

            .pictures .card .card-title {
                padding-top: 1.5vw;
            }
        }

        @media only screen and (max-width: 500px) {
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
    <div id="content">
        <?php
        include '../DB-config/db-config.php';
        //number of pages I want in every page 
        $items_per_page = 40;

        //which page is currently visited
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        //total records in the table
        $category_value = $_GET['category-id'];

        $total = "SELECT * FROM product WHERE product_category LIKE '%$category_value%'";
        $result = mysqli_query($connection, $total);
        $number_of_rows = mysqli_num_rows($result);

        //number of pages
        $number_of_pages = ceil($number_of_rows / $items_per_page);

        //offset
        $offset = ($page * $items_per_page) - $items_per_page;

        //fetching images now with limits
        
        $sql = "SELECT * FROM product WHERE product_category LIKE '%$category_value%' ORDER BY RAND() LIMIT $offset, $items_per_page";
        $execute = mysqli_query($connection, $sql);
        $number_of_rows = mysqli_num_rows($execute);
        ?>
        <div id="search-title" align="center">
            <?php echo $category_value; ?>
        </div>
        <div class="col-md-12 row-cols-3 row pt-3 pictures">
            <?php
            if ($number_of_rows <= 0) {
                $notice = '<h4 style = "padding-bottom: 30%; width: 100%;">No products under this category</h4>';
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
                                <img src="../<?php echo $string_to_array[0]; ?>"
                                    alt="<?php echo '../' . $string_to_array[0]; ?>">
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
            }
            if (isset($notice)) {
                echo $notice;
            } ?>
        </div>


        <!--pagination-->
        <div class="paging">
            <?php
            if ($page > 1) {
                echo '<a href="category?category-id=' . $category_value . '&page=1"><i class="fa-solid fa-angle-double-left"></i></a>';
                echo '<a href="category.php?category-id=' . $category_value . '&page=' . ($page - 1) . '"><i class="fa-solid fa-angle-left"></i></a>';
            }
            ?>
            <div class="pages">
                <?php
                for ($i = 1; $i <= $number_of_pages; $i++) {
                    if ($number_of_pages > 1) {
                        if ($i == $page) {
                            echo '<a href="category?category-id=' . $category_value . '&page=' . $i . '" id="on_page">' . $page . '</a>';
                        } else {
                            echo '<a href="category?category-id=' . $category_value . '&page=' . $i . '">' . $i . '</a>';
                        }
                    }
                }
                ?>
            </div>
            <?php
            if ($number_of_pages > $page) {
                echo '<a href="category?category-id=' . $category_value . '&page=' . ($page + 1) . '"><i class="fa-solid fa-angle-right"></i></a>';
                echo '<a href="category?category-id=' . $category_value . '&page=' . ($number_of_pages) . '"><i class="fa-solid fa-angle-double-right"></i></a>';
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
    </script>
    <script src="../main.js"></script>
</body>
<?php
include '../includes/footer.html';
?>

</html>