<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$title = 'My products';
include_once '../includes/preloader.html';
include_once '../includes/farmer-header.php';
?>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');

        #content {
            background: white;
            padding-bottom: 5%;
        }

        #products-title {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: baseline;
            margin-top: 3.5vw;
            width: 100%;
            padding-top: .5vw;
            padding-left: .5vw;
            padding-right: .5vw;
            background: rgb(12, 118, 84);
        }

        #products-title p {
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }

        #products-title a {
            float: inline-end;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }

        #content .card {
            width: 90%;
            height: 13.2vw;
            overflow-y: auto;
            overflow-x: hidden;
            font-family: 'Signika Negative', sans-serif;
        }
        #content .card .col-md-6{
            width: 50%!important;
        }
        #content .card .col-md-6 .card-text{
            width: 100%;
        }
        #content .card .card-body{
            display: flex!important;
            width: 100%!important;
            justify-content: flex-start!important;
            flex-direction: column!important;
        }

        table .buttons {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
        }

        table form {
            margin-right: 1vw;
        }

        #content .card img {
            height: 13.2vw;
            width: auto;
            border-radius: 0;
        }

        #content .card .card-title {
            font-weight: bold;
        }

        #content .card .card-footer {
            width: 100%;
        }
        #content .card .card-text{
            font-size: 12px;
        }
        #content .card .card-text p{
            margin-bottom: .5rem;
        }
        #content .card #description {
            width: 100%;
        }
        form button:hover {
            box-shadow: 0 0 2px black;
            color: white !important;
            transition: .3s all ease-in-out;
        }
        #table-container{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        table{
            width: 90%;
            border: 2px solid #6e6e6e;
            margin-top: 15px;
            border-radius: 3px !important;
            border-collapse: separate;
        }
        table th{
            font-family: 'Signika Negative', sans-serif;
            font-size: 14px;
            border-left: 2px solid #6e6e6e;
            border-right: 2px solid #6e6e6e;
            border-bottom: 2px solid #6e6e6e;
            padding-left: 15px;
        }
        table td > img{
            max-height: 50px !important;
            width: auto  !important;
            font-family: 'Nunito', sans-serif;
            /* margin-left: 50%;
            transform: translateX(-50%); */
        }
        table td{
            padding: 10px;
            border-bottom: 1px solid #9a9a9a;
            border-right: 1px dotted #b2b2b2;
        }

        @media only screen and (max-width: 900px) {
            #products-title p,
            #products-title a {
                font-size: 3vw;
            }
        }

        @media only screen and (max-width: 500px) {
            #table-container{
                overflow: auto !important;
            }
            #table-container::-webkit-scrollbar{
                width: 3px !important;
            }
            table{
                max-width: 90%;
                overflow: scroll !important;
            }
            table td > img{
                max-height: 30px;
            }
            table th{
                font-size: 11px;
                padding-left: 5px;
                border-left: 1px solid #6e6e6e;
                border-right: 1px solid #6e6e6e;
                border-bottom: 1px solid #6e6e6e;
            }
            table td{
                padding: 0;
                font-size: 11px;
                line-height: normal;
                text-overflow: ellipsis;
            }
            table form button{
                height: 20px !important;
                width: 20px !important;
                font-size: 10px !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
            #products-title {
                margin-top: 10vw;
            }

            #products-title p {
                font-size: 5vmin;
            }

            #content .card {
                height: 30vw;
            }

            #content .card img {
                width: auto;
                height: 30vw;
            }
        }
    </style>
    <div id="content">
        <div id="products-title" align="center">
            <p>Your Products</p>
        </div>

        <!--Update notification-->
        <?php
        if (isset($_SESSION['update-status'])) { ?>
            <div class="alert alert-primary mt-2" role="alert">
                <strong>
                    <?php echo $_SESSION['update-status']; ?>
                </strong>
            </div>
            <?php
            unset($_SESSION['update-status']);
        } ?>

        <!--post notification-->
        <?php
        if (isset($_SESSION['post-status'])) { ?>
            <div class="alert alert-primary mt-2" role="alert">
                <strong>
                    <?php echo $_SESSION['post-status']; ?>
                </strong>
            </div>
            <?php
            unset($_SESSION['post-status']);
        } ?>

        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM product WHERE farmer_id = $id";
        $execute_farmer_product = mysqli_query($connection, $sql);
        $num_of_rows = mysqli_num_rows($execute_farmer_product);?>
                <div id="table-container">
                 <table>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Price</th>
                        <th>Views</th>
                        <th>Date uploaded</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if ($num_of_rows == 0) {
                        $message2 = "<h4 style='padding-bottom: 30%;'>You have not yet uploaded any product!</h4>";
                    } else {
                    while ($row_details = mysqli_fetch_assoc($execute_farmer_product)) { ?>
                        <tr>
                            <td>
                            <?php
                            $image_string = $row_details['product_image'];
                            $string_to_array = explode(",", $image_string);
                            ?>
                            <img src="../<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>"
                                class="card-img">
                            </td>
                            <td><?php echo $row_details['product_title']; ?></td>
                            <td><?php echo $row_details['product_id']; ?></td>
                            <td><?php echo $row_details['product_price']; ?></td>
                            <td><?php echo $row_details['views']; ?></td>
                            <td><?php echo $row_details['upload_date']; ?></td>
                            <td>
                                <div class="buttons" align="center">
                                        <form action="edit" method="get">
                                            <input type="hidden" name="edit_id"
                                                value="<?php echo $row_details['product_id'] ?>">
                                            <button class="btn btn-sm bg-info rounded-circle" type="submit"
                                                name="edit_button"><i class="fas fa-pen"></i></button>
                                        </form>
                                        <form action="../server/delete-farmer-product.php" method="post">
                                            <input type="hidden" name="edit_id"
                                                value="<?php echo $row_details['product_id'] ?>">
                                            <button class="btn btn-sm bg-danger rounded-circle" type="submit"
                                                name="delete-button" onclick="return confirm('Are you sure?')"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                            </td>
                            <?php if (isset($message2)) {
                                echo "<br>$message2";
                            } ?>
                        </tr>
                        <?php
                        }
                        } ?>
                </table>
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