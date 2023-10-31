<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php 
$title = 'Market prices';
include_once '../includes/preloader.html';
include_once('../includes/buyer-header.php');
include '../functions/functions.php'; ?>

<body>
    <style>
        #content {
            background: white;
            margin-top: 5.5vw !important;
            padding: 0;
        }

        #content .title {
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            width: 100%;
            padding: .4vw;
        }

        .regions {
            display: flex;
            justify-content: space-evenly;
        }

        .regions p {
            font-family: 2vw;
        }

        .regions .card-title {
            color: rgb(7, 97, 175);
        }

        #price .note {
            padding: 1vw;
            background: linear-gradient(to bottom, rgb(65, 165, 253), rgb(40, 146, 239), rgb(18, 119, 208), rgb(7, 97, 175));
            border-radius: 5px;
            color: white;
            font-size: 1.1vw;
        }

        #price .note a {
            text-decoration: none;
            color: rgb(60, 255, 193);
        }

        .regions .card p {
            margin-left: 50%;
            transform: translateX(-50%);
            width: 70%;
            font-size: 1vw;
            font-style: italic;
            font-family: 'Poppins', sans-serif;
        }

        .regions .card {
            width: 48%;
        }

        table {
            border: 2px solid #c2c2c2;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        table th,
        td {
            border: 1px solid #c2c2c2;
        }

        table tr {
            border-bottom: none;
            height: 2.5vw;
        }

        table th {
            font-size: 1vw;
            font-style: italic;
        }

        table td {
            font-size: 0.9vw
        }

        table tr:nth-child(odd) {
            background-color: #efefef;
        }
        #prices-search{
            width: 100%;
            margin-left: 50%;
            transform: translateX(-50%);
        }
        #prices-search form{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        #prices-search form select, #prices-search form input{
            width: 45%;
            margin: 10px;
            font-size: 1vw !important;
        }
        #prices-search #table{
            max-height: 50vh;
            overflow: scroll;
        }
        #prices-search #table::-webkit-scrollbar{
            width: 7px !important;
        }
        #prices-search #table h6{
            font-size: 1vw;
        }

        @media only screen and (max-width: 900px) {
            #content .title {
                margin-top: 4%;
                font-size: 4vw;
            }

            #price .note {
                font-size: 2.5vw;
            }

            .regions .card {
                width: 100%;
                left: 2vw
            }

            table td {
                font-size: 2vw;
            }

            table th {
                font-size: 2.5vw;
            }

            .regions .card p {
                font-size: 3vw;
            }
            #prices-search form select, #prices-search form input{
                width: 50%;
                margin: 10px;
                font-size: 2.5vw !important;
            }
            #prices-search #table::-webkit-scrollbar, .regions .card::-webkit-scrollbar{
                width: 3px !important;
            }
            #prices-search #table h6{
                font-size: 2.5vw;
            }
        }

        @media only screen and (max-width: 500px) {
            #content .title {
                margin-top: 10vw;
            }
            #prices-search form select, #prices-search form input{
                font-size: 3.5vw !important;
                margin: 5px;
            }
            table td {
                font-size: 3vw;
            }
        }
    </style>
    <div id="content">
        <div class="title" align="center">Product prices</div>
        <div class="row m-3" id="price">
            <div class="note col-md-12">
                Prices indicated are bound to change. We try our best to search for those prices and keep you updated whenever
                they changes. Note that there can be slight inaccuracy in those prices, however they should give you the
                average prices in the market. If the product you are interested in is not in the list, you can contact
                us <a href="about#form">here</a> for us to consider that product.
            </div>
            
            <!--Seaching for specific prices-->
            <div id="prices-search" class="mt-3">
                <form class="form-group">
                    <select name="searchby" id="searchby" class="form-control">
                        <option value="0">--Search By--</option>
                        <option value="county">County</option>
                        <option value="product">Product Name</option>
                        <option value="market">Market Name</option>
                    </select>
                    <input type="text" class="form-control" placeholder="Search...">
                </form>
                <div id="table" class="mt-3">
                    <table></table>
                </div>
            </div>

            <div class="regions row">
                <div class="nairobi card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Nairobi</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php nairobi(); ?>
                    </table>
                </div>
                <div class="nakuru card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Nakuru</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php nakuru(); ?>
                    </table>
                </div>
                <div class="mombasa card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Mombasa</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php mombasa(); ?>
                    </table>
                </div>
                <div class="kisumu card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Kisumu</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php kisumu(); ?>
                    </table>
                </div>
                <div class="eldoret card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Homa-bay</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php homabay(); ?>
                    </table>
                </div>
                <div class="eldoret card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Kirinyaga</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php kirinyaga(); ?>
                    </table>
                </div>
                <div class="Nyeri card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Nyeri</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php nyeri(); ?>
                    </table>
                </div>
                <div class="kakamega card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Kakamega</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php kakamega(); ?>
                    </table>
                </div>
                <div class="Kisii card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Kisii</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php kisii(); ?>
                    </table>
                </div>
                <div class="card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Kitui</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php kitui(); ?>
                    </table>
                </div>
                <div class="card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Uasin Gishu</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php uasin_gishu(); ?>
                    </table>
                </div>
                <div class="card col-md-5 my-4 p-2 bg-light">
                    <p align="center" class="card-title"><strong>Kajiado</strong></p>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Market Name</th>
                            <th>Retail (Ksh/kg)</th>
                            <th>Wholesale<br>(Ksh/kg)</th>
                        </tr>
                        <?php kajiado(); ?>
                    </table>
                </div>
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

            //price search ajax
            $('#prices-search form input').keyup(function(){
                if($('#prices-search form select').children('option:selected').val() == '0'){
                    alert("Select what you're searching with");
                }
                else if($(this).val() != ''){
                    var searchby = $('#prices-search > form select').children('option:selected').val();
                    var word = $(this).val();
                    $.ajax({
                        url: "../Ajax/priceSearch.php",
                        method: "get",
                        data: {searchby: searchby, word: word},
                        success: function (response) {
                            $('#prices-search > #table table').html(response);
                        }
                    });
                }
                else{
                    $('#prices-search > #table table').html('');
                }
            })
        });
    </script>
    <script src="../main.js"></script>
</body>
<?php
include_once '../includes/footer.html';
?>

</html>