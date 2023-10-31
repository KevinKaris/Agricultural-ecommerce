<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php 
$title = 'Transport services';
include_once '../includes/preloader.html';
include_once '../includes/farmer-header.php'; ?>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&family=Poppins:wght@500&display=swap');

        #content {
            background: white;
            margin-top: 5.7vw !important;
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
        #price{
            width: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #price .note {
            padding: 1vw;
            font-size: 1vw;
            font-family: 'Poppins', sans-serif;
            width: 100%;
        }

        #price .note a {
            text-decoration: none;
            color: rgb(10, 195, 136);
        }

        #price .note a:hover {
            text-decoration: underline;
        }
        #price .note > div{
            display: flex;
            flex-direction: row;
            width: 80%;
            justify-content: space-between;
        }
        #price .note > div > form{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 80%;
        }
        #price .note > div > form > select{
            margin-right: 15px;
        }
        #price table{
            width: 100%;
            border: 2px solid #858585;
            margin-top: 15px;
            max-height: 100vw;
            overflow: scroll;
        }
        #price table tr th{
            border: 2px solid #858585;
            padding: 7px;
        }
        #price table tr td{
            border-right: 1px solid #d1d1d1;
            border-bottom: 1px solid #d1d1d1;
            padding: 7px;
        }
        #price table tr td > a{
            background: #0256aa;
            color: #fff !important;
            text-decoration: none !important;
        }
        #outer{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 999;
            background: rgba(0, 0, 0, .5);
            display: none;
        }

        #outer > #register{
            position: absolute;
            width: 40%;
            height: auto;
            background: #fff;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 6px #858585;
            border: 1px solid #858585;
            padding: 10px;
            border-radius: 5px;
        }
        #outer > #register > input, #outer > #register > select{
            margin-bottom: 15px;
        }
        #outer > #register > button{
            float: right;
        }
        #outer > #register .fa-xmark{
            float: right;
        }
        #outer > #register .fa-xmark:hover{
            cursor: pointer;
        }
        @media only screen and (max-width: 900px) {
            #outer > #register{
                width: 60%;
            }
            #price{
                width: 100%;
            }
            #price .note > div > form > select, #price .note > div > form > input{
                font-size: 10px;
                padding: 1px !important;
            }
            #price .note > div >button{
                font-size: 10px;
                padding: 2px !important;
            }
            #price .note > div{
                width: 100%;
            }
            #price .note > div > form{
                width: 100%;
            }
            #content .title {
                margin-top: 4%;
                font-size: 4vw;
            }

            #price .note {
                font-size: 2.5vw;
            }
        }

        @media only screen and (max-width: 500px) {
            #outer > #register{
                width: 85%;
            }
            #content .title {
                margin-top: 10vw;
            }
        }
    </style>
    <div class="cookie">
        <div class="pop" align="center">This website uses cookies in order to offer you the most relevant information.
            We also use them to improve user experience when exploring the website.<br>
            <button class="btn w-50 mt-5 bg-dark">Got it</button>
        </div>
    </div>
    <div id="outer">
    <form action="../server/transport.php" method="post" class="form-group" id="register">
                <h4>Transporter registration<i class="fa-solid fa-xmark"></i></h4>
                <input type="text" class="form-control name" name="name" placeholder="Your name...">
                <select name="county" id="county" class="form-control">
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
                <input type="text" class="form-control route" name="route" placeholder="Your operation route...">
                <input type="text" class="form-control vehicle" name="vehicle" placeholder="Vehicle type. E.g trailer...">
                <input type="tel" class="form-control phone" name="phone" placeholder="Your phone number...">
                <button class="btn btn-success" type="submit" id="register-button" name="register">Register</button>
            </form>
    </div>
    <div id="content">
        <div class="title" align="center">Transport Services</div>
        <div class="row my-3" id="price">
            <div class="note col-12">

                <!--Register notification-->
                <?php
                if(isset($_SESSION['transporter-info'])){?>
                    <div class="alert alert-primary mt-0 w-75 p-1 response-alert3" role="alert">
                    <strong><?php echo $_SESSION['transporter-info']; unset($_SESSION['transporter-info']);?></strong>
                    </div>
                <?php }?>

                <div>
                    <form action="#" method="get" class="form-group">
                        <select name="" id="" class="form-control">
                            <option value="0">--Search by--</option>
                            <option value="county">County</option>
                            <option value="route">Route</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                    <button class="btn btn-success" style="float: right" id="new-transporter">Register</button>
                </div>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>County</th>
                        <th>Route</th>
                        <th>Vehicle type</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $transporter_sql = "SELECT * FROM transporter";
                    $transporter_run = mysqli_query($connection, $transporter_sql);
                    while($transporter = mysqli_fetch_assoc($transporter_run)){?>
                        <tr>
                            <td><?php echo $transporter['name'];?></td>
                            <td><?php echo $transporter['county'];?></td>
                            <td><?php echo $transporter['route'];?></td>
                            <td><?php echo $transporter['vehicle'];?></td>
                            <td><a href="<?php echo 'tel:'.$transporter['phone'];?>" class="btn">Call</a></td>
                        </tr>
                    <?php }?>
                </table>
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


            //register popup
            $('#new-transporter').on('click', function(){
                $('#outer').show();
                $('#register h4 > .fa-xmark').on('click', function(){
                    $('#outer').hide();
                })
            })

            //validating form
            $(document).on('click', '#register-button',function(e){
                if($('#register >.name').val() == ''){
                    e.preventDefault();
                    $('#register .name').css('border', '1px solid red');
                    $('#register .name').on('change', function(){
                        $('#register .name').css('border', '1px solid green');
                    })
                }
                else if($('#register > #county').children("option:selected").val() == '0'){
                    e.preventDefault();
                    $('#register > #county').css('border', '1px solid red');
                    $('#register > #county').on('change', function(){
                        $('#register > #county').css('border', '1px solid green');
                    })
                }
                else if($('#register > .route').val() == ''){
                    e.preventDefault();
                    $('#register .route').css('border', '1px solid red');
                    $('#register .route').on('change', function(){
                        $('#register .route').css('border', '1px solid green');
                    })
                }
                else if($('#register > .vehicle').val() == ''){
                    e.preventDefault();
                    $('#register .vehicle').css('border', '1px solid red');
                    $('#register .vehicle').on('change', function(){
                        $('#register .vehicle').css('border', '1px solid green');
                    })
                }
                else if($('#register > .phone').val() == ''){
                    e.preventDefault();
                    $('#register .phone').css('border', '1px solid red');
                    $('#register .phone').on('change', function(){
                        $('#register .phone').css('border', '1px solid green');
                    })
                }
            })


            //transporter searching ajax
                $('#price .note form > input').keyup(function(){
                    if($('#price .note form > select').children('option:selected').val() == "0"){
                        alert("Select what you're searching with");
                    }
                    else{
                        var selectBy = $('#price .note form > select').children('option:selected').val();
                        var word = $(this).val();
                        $.ajax({
                            url: "../Ajax/transporter_search.php",
                            method: 'GET',
                            data: {selectBy: selectBy, word: word},
                            success: function (response) {
                                $('table').html(response);
                            }
                        });
                    }
                })
            
            })
    </script>
    <script src="../main.js"></script>
    <?php $_SESSION['page_url'] = basename($_SERVER['REQUEST_URI']); ?>
</body>
<?php
include_once '../includes/footer.html';
?>

</html>