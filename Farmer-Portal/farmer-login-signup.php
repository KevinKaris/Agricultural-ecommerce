<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo-removebg.png">
    <link href="../used libralies/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="../used libralies/js/bootstrap.bundle.min.js"></script>
    <script src="../used libralies/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <title>Farmer Login/Signup</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');

        :root {
            --text-color: rgb(12, 118, 84);
        }
        .form-control:focus{
            border-color: rgba(0, 144, 58, 0.244) !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 144, 58, 0.244) !important;
        }

        body {
            background: rgba(0, 0, 0, .4)url('../images/farmer-login.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: darken;
        }

        .form-group {
            background: white;
            position: absolute;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            margin-top: 20%;
            margin-left: 50%;
            transform: translate(-50%, -50%);
            width: 40%;
            height: 50%;
            box-shadow: 0 0 8px gray;
            border-radius: 5px;
            overflow-y: auto;
        }

        #farmer-signup {
            top: 7%;
            height: 85%;
        }

        #farmer-login {
            height: 55%;
            overflow: hidden;
        }

        .form-group h4 {
            background: var(--text-color);
            color: white;
            width: 100%;
            border-radius: 5px 5px 0 0;
            padding: 3px;
            font-family: 'Secular One', sans-serif;
            font-size: 1.5vw;
        }

        .form-group p,
        button {
            font-size: 1.2vw;
        }

        .form-group .form-control {
            width: 90%;
            margin-top: 2vw;
            font-family: 'Signika Negative', sans-serif;
            font-size: 1.1vw;
        }

        .form-control::placeholder {
            color: #9c9c9c;
        }

        .form-group button {
            margin-bottom: 1vw;
        }

        a {
            text-decoration: none;
            color: blue;
            font-family: 'Signika Negative', sans-serif;
            font-size: 1.2vw;
        }

        a:hover {
            text-decoration: underline;
        }
        #loginbutton > .fa-circle-notch, #signup-button > .fa-circle-notch{
            display: none;
        }
        #loginbutton span, #signup-button span{
            display: block;
        }
        .response-alert, .response-alert2, .response-alert3{
            display: none;
        }
        #forgot-password-form{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 20;
            background: rgba(0, 0, 0, .9);
            display: none;
        }
        #forgot-password-form > form{
            position: absolute;
            margin-top: 10%;
            width: 40%;
            height: fit-content;
            margin-left: 50%;
            transform: translateX(-50%);
            background: #fff;
            border-radius: 5px;
            padding: 15px;
        }
        #forgot-password-form >form .form-control{
            width: 100%;
            margin-top: 15px;
        }
        #forgot-password-form > form h5{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        #email-sent-notification{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: #f2f2f2;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .animated-check {
            height: 5em;
            width: 5em
        }

        .animated-check path {
            fill: none;
            stroke: #7ac142;
            stroke-width: 4;
            stroke-dasharray: 23;
            stroke-dashoffset: 23;
            animation: draw 1s linear forwards;
            stroke-linecap: round;
            stroke-linejoin: round
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0
            }
        }

        @media only screen and (max-width: 900px) {
            body {
                background-repeat: repeat;
            }

            .form-group {
                top: 40%;
                width: 90%;
                height: 40% !important;
            }

            #farmer-login {
                font-size: 3vw;
            }

            .form-group h4 {
                font-size: 5vw;
            }

            .form-group p,
            button {
                font-size: 3vw;
            }

            .form-group p {
                margin-top: 10%;
            }

            .form-group .form-control {
                font-size: 3.5vw;
            }

            a {
                font-size: 3vw;
            }

            #farmer-signup {
                top: 40%;
                font-size: 3vw;
                height: 75% !important;
            }
            #forgot-password-form > form{
                width: 60%;
            }
            .wrapper {
                margin-top: 100px;
            }
        }

        @media only screen and (max-width: 500px) {
            .form-group {
                top: 30% !important;
                height: 80vmin !important;
            }
            #forgot-password-form > form{
                width: 90%;
                margin-top: 5%;
            }
            .wrapper {
                margin-top: 100px;
            }
            #email-sent-notification{
                padding: 15px;
            }
        }
    </style>
    <div class="form-group" id="farmer-login" align="center">
        <form action="../server/farmer-login.php" method="post">
            <h4>Farmer Login</h4><br>
            <!--checking session-->
            <?php
            if (isset($_SESSION['expiry'])) { ?>
                <div class="alert alert-danger mt-0 w-75 p-1" role="alert">
                    <strong>
                        <?php echo $_SESSION['expiry']; ?>
                    </strong>
                    <?php unset($_SESSION['expiry']); ?>
                </div>
                <?php
            } ?>

            <!--signing up notification-->
            <div class="alert alert-danger mt-0 w-75 p-1 response-alert" role="alert">
                <strong></strong>
            </div>
            <div class="alert alert-primary mt-0 w-75 p-1 response-alert2" role="alert">
                <strong></strong>
            </div>

            <input type="tel" placeholder="Enter your phone number..." class="form-control" name="phone-number" id="loginphone">
            <input type="password" placeholder="Enter password..." class="form-control" name="password" id="loginpassword"><br>
            <a href="#" id="forgot-password">Forgot password?</a><br>
            <button class="btn btn-outline-success form-control" id="loginbutton" type="submit"><span>Login</span><i class="fas fa-circle-notch fa-spin"></i></button>
            <p id="signup-link">Have no account? <a href="javascript:void();">Signup</a></p>
        </form>
    </div>
    <!--farmer signup-->
    <div class="form-group" id="farmer-signup" align="center">
        <form action="../server/farmer-signup.php" method="post">
            <h4>Farmer Signup</h4>
            <!--signing up notification-->
            <div class="alert alert-danger mt-0 w-75 p-1 response-alert3" role="alert">
                <strong></strong>
            </div>
            <input type="name" name="first-name" placeholder="Enter First name..." class="form-control"
                name="first-name" id="signupfname">
            <input type="name" name="last-name" placeholder="Enter Second name..." class="form-control" name="last-name" id="signuplname">
            <input type="email" placeholder="Enter a valid email..." class="form-control" name="email" id="signupemail">
            <input type="tel" placeholder="Enter phone number..." class="form-control" name="phone-number" id="signupphone">
            <select name="county" id="county" class="form-control">
                <option value="0">--select county--</option>
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
                <select>
                    <select name="sub-county" id="sub-county" class="form-control">
                        <option value="0">--select sub county--</option>
                    </select>
                    <input type="tel" placeholder="Enter your location..." class="form-control" name="location" id="signuplocation">
                    <input type="password" placeholder="Enter password..." class="form-control password" name="password" id="signuppassword">
                    <input type="password" placeholder="Confirm password..." class="form-control con-password"
                        name="con-password" id="signupconfpassword">
                    <div id="message"></div><br>
                    <p id="login-link">Have account? <a href="javascript: void();">Log in</a></p>
                    <button class="btn btn-outline-success form-control" type="submit"
                        id="signup-button"><span>Signup</span><i class="fas fa-circle-notch fa-spin"></i></button><br>
        </form>
    </div>

    <div id="forgot-password-form">
        <form action="../server/fsendEmail.php" method="post" class="form-group">
            <h5>Forgot Password <a href="javascript:void();"class="btn"><i class="fa-solid fa-xmark"></i></a></h5>
            <label for="email">Enter your regitered email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email...">
            <button type="submit" class="btn btn-primary form-control" id="forgot-submit">Submit</button>
        </form>
    </div>
    <div id="email-sent-notification">
        <div class="wrapper"> <svg class="animated-check" viewBox="0 0 24 24">
            <path d="M4.1 12.7L9 17.6 20.3 6.3" fill="none" /> </svg>
        </div>
        <h4 class="text-center">A reset password link has been sent to your email!</h4>
        <p class="text-center">Go ahead and click it to reset your password!</p>
    </div>
    <script>
        $(window).ready(function () {
            //forgot password form validation
            $('#forgot-submit').on('click', function(e){
                e.preventDefault();
                if($('#forgot-password-form form #email').val() == ''){
                    $('#forgot-password-form form #email').css('border-color', 'red');
                }
                else{
                    //send email for forgot password ajax
                    var email = $('#forgot-password-form form #email').val();
                    $.ajax({
                        method: 'post',
                        url: "../server/fsendEmail.php",
                        data: {email: email},
                        success: function (response) {
                            if(response == '0'){
                                alert('Message not sent!');
                            }
                            else if(response == '1'){
                                $('#email-sent-notification').css('height', '100%');
                            }
                            else{
                                alert('That email is not registered!');
                            }
                        }
                    });
                    alert('Wait for response');
                    $('#forgot-password-form').fadeOut(500);
                }
            })

            //displaying forgot password form
            $('#forgot-password').on('click', function(){
                $('#forgot-password-form').fadeIn(300);
                $('#forgot-password-form h5 > a').on('click', function(){
                    $('#forgot-password-form').fadeOut(300);
                })
            })

            //login ajax
            $('#loginbutton').on('click', function(e){
                e.preventDefault();
                var data = $('#farmer-login form').serialize();
                if($('#loginphone').val() != '' && $('#loginpassword').val() != ''){
                    $('#loginbutton span').css('display', 'none');
                    $('#loginbutton .fa-circle-notch').css('display', 'block');
                    $('#loginbutton').prop('disabled', true).css('opacity', '.5');
                    $.ajax({
                        url: "../server/farmer-login.php",
                        method: 'POST',
                        data: data,
                        success: function (response) {
                            if(response == 'Incorrect phone number'){
                                $('.response-alert strong').html(response);
                                $('.response-alert').show();
                                $('#loginbutton span').css('display', 'block');
                                $('#loginbutton .fa-circle-notch').css('display', 'none');
                                $('#loginbutton').prop('disabled', false).css('opacity', '1');
                            }
                            else if(response == 'Incorrect password'){
                                $('.response-alert strong').html(response);
                                $('.response-alert').show();
                                $('#loginbutton span').css('display', 'block');
                                $('#loginbutton .fa-circle-notch').css('display', 'none');
                                $('#loginbutton').prop('disabled', false).css('opacity', '1');
                            }
                            else if(response == 'decrypted'){
                                window.location.assign('home'); 
                            }
                        }
                    });
                }
            })

            //Signup ajax
            $('#signup-button').on('click', function(e){
                e.preventDefault();
                var data = $('#farmer-signup form').serialize();
                if($('#signupphone').val() != '' && $('#signupemail').val() != '' && $('#signuplname').val() != '' && $('#signupfname').val() != '' && $('.password, .con-password').val() != '' && $('#signuplocation').val() != '' && $('#county').children("option:selected").val() != '0' && $('#sub-county').children("option:selected").val() != '--sub county--'){
                    $('#signup-button span').css('display', 'none');
                    $('#signup-button .fa-circle-notch').css('display', 'block');
                    $('#signup-button').prop('disabled', true).css('opacity', '.5');
                    $.ajax({
                        url: "../server/farmer-signup.php",
                        method: 'POST',
                        data: data,
                        success: function (response) {
                            if(response == 'Signup was successful. Now log in...'){
                                $('.response-alert2 strong').html(response);
                                $('.response-alert2').show();
                                $('#farmer-login').fadeIn(800);
                                $('#farmer-signup').hide();
                            }
                            else if(response == 'Your email exists.'){
                                $('.response-alert3 strong').html(response);
                                $('.response-alert3').show();
                                $('#signup-button span').css('display', 'block');
                                $('#signup-button .fa-circle-notch').css('display', 'none');
                                $('#signup-button').prop('disabled', false).css('opacity', '1');
                            }
                        }
                    });
                }
                
            })


            //interchanging between login and signup forms
            $('#farmer-signup').hide();

            $('#farmer-login #signup-link a').on('click', function () {
                $('#farmer-login').hide();
                $('#farmer-signup').fadeIn(800);
            });
            $('#farmer-signup #login-link a').on('click', function () {
                $('#farmer-login').fadeIn(800);
                $('#farmer-signup').hide();
            });

            //showing errors when fields are empty on login forms
            $('#loginbutton').on('click', function(e){
                if($('#loginphone').val() == ''){
                    e.preventDefault();
                    $('#loginphone').css('border', '1px solid red');
                    $('#loginphone').on('change', function(){
                        $('#loginphone').css('border', '1px solid green');
                    })
                }
                else if($('#loginpassword').val() == ''){
                    e.preventDefault();
                    $('#loginpassword').css('border', '1px solid red');
                    $('#loginpassword').on('change', function(){
                        $('#loginpassword').css('border', '1px solid green');
                    })
                }
            });

            //showing errors when signup inputs
            $('#signup-button').on('click', function(e){
                if($('#signupfname').val() == ''){
                    e.preventDefault();
                    $('#signupfname').css('border', '1px solid red');
                    $('#signupfname').on('change', function(){
                        $('#signupfname').css('border', '1px solid green');
                    })
                }
                else if($('#signuplname').val() == ''){
                    e.preventDefault();
                    $('#signuplname').css('border', '1px solid red');
                    $('#signuplname').on('change', function(){
                        $('#signuplname').css('border', '1px solid green');
                    })
                }
                else if($('#signupemail').val() == ''){
                    e.preventDefault();
                    $('#signupemail').css('border', '1px solid red');
                    $('#signupemail').on('change', function(){
                        $('#signupemail').css('border', '1px solid green');
                    })
                }
                else if($('#signupphone').val() == ''){
                    e.preventDefault();
                    $('#signupphone').css('border', '1px solid red');
                    $('#signupphone').on('change', function(){
                        $('#signupphone').css('border', '1px solid green');
                    })
                }
                else if( $('#county').children("option:selected").val() == '0'){
                    e.preventDefault();
                    $('#county').css('border', '1px solid red');
                    $('#county').on('change', function(){
                        $('#county').css('border', '1px solid green');
                    })
                }
                else if( $('#sub-county').children("option:selected").val() == '--sub county--'){
                    e.preventDefault();
                    $('#sub-county').css('border', '1px solid red');
                    $('#sub-county').on('change', function(){
                        $('#sub-county').css('border', '1px solid green');
                    })
                }
                if($('#signuplocation').val() == ''){
                    e.preventDefault();
                    $('#signuplocation').css('border', '1px solid red');
                    $('#signuplocation').on('change', function(){
                        $('#signuplocation').css('border', '1px solid green');
                    })
                }
            });
        });

        //compare passwords
        $('#signup-button').on('click', function () {
            if ($('.password').val() == $('.con-password').val() && $('.password, .con-password').val() != '') {
                $('.password, .con-password').css('border-color', 'green');
            }
            else if($('.password').val() == $('.con-password').val() && $('.password, .con-password').val() == ''){
                $('#message').html('Password empty').css('background', '#ffa5a5').css('margin-top', '5px').css('width', '90%');
                $('.password, .con-password').css('border-color', 'red');
                $('#signup-button').prop('disabled', true);
            }
            else {
                $('#message').html('Password mismatched! recheck.').css('background', '#ffa5a5').css('margin-top', '5px').css('width', '90%');
                $('.con-password').css('border-color', 'red');
                $('#signup-button').prop('disabled', true);
            }
            // setInterval(function(){
            //     if ($('.password').val() == $('.con-password').val()) {
            //         $('.password, .con-password').css('border-color', 'green');
            //         $('#signup-button').prop('disabled', false);
            //         $('#message').hide();
            //     }
            // }, 1000);
        });

        //checking password pattern
        setInterval(function () {
            $('.con-password').focus(function () {
                $pass_val = $('.password').val();

                if ($pass_val.match(/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/)) {
                    $('#signup-button').prop('disabled', false);
                    $('#message').html('Nice!').css('background', 'rgb(179, 247, 179)').css('margin-top', '5px').css('width', '90%');
                }
                else {
                    $('#message').html('<li>The password must contain at least 8 characters</li><li>At least one capital letter</li><li>At least one lowercase letter</li><li>At least one number</li>').css('background', '#ffa5a5').css('margin-top', '5px').css('width', '90%');
                    $('#signup-button').prop('disabled', true);
                }
            });
        }, 1000);

        $('#county').on('change', function () {

            var a = document.getElementById("county").value;

            if (a === 'Bomet') {
                var array = ['--sub county--', 'Sotik', 'Chepalungu', 'Bomet Central', 'Bomet East', 'Konoin'];
            }
            if (a === 'Baringo') {
                var array = ['--sub county--', 'Tiaty', 'Baringo North', 'Barindo Central', 'Baringo South', 'Mogotio', 'Eldama Ravine'];
            }
            if (a === 'Bungoma') {
                var array = ['--sub county--', 'Mt-Elgon', 'Sirisia', 'Kabuchai', 'Bumula', 'Kanduyi', 'Webuye East', 'Webuye West', 'Kimilili', 'Tongaren'];
            }
            if (a === 'Busia') {
                var array = ['--sub county--', 'Teso North', 'Teso South', 'Nambale', 'Matayos', 'Butula', 'Funyula', 'Budalangi'];
            }
            if (a === 'Elgeyo Marakwet') {
                var array = ['--sub county--', 'Marakwet North', 'Marakwet South', 'Marakwet East', 'Marakwet West'];
            }
            if (a === 'Embu') {
                var array = ['--sub county--', 'Igembe South', 'Igembe Central', 'Igembe North', 'Tigania West', 'Tigania East', 'North Imenti', 'Buuri', 'Central Imenti', 'South Imenti'];
            }
            if (a === 'Garissa') {
                var array = ['--sub county--', 'Garissa Township', 'Balambala', 'Dadaab', 'Fafi', 'Ijara'];
            }
            if (a === 'Homa Bay') {
                var array = ['--sub county--', 'Kasipul', 'Kabondo Kasipul', 'Karachuonyo', 'Rangwe', 'Homa bay Town', 'Ndhiwa', 'Suba North', 'Suba South'];
            }
            if (a === 'Isiolo') {
                var array = ['--sub county--', 'Isiolo North', 'Isiolo South'];
            }
            if (a === 'Kwale') {
                var array = ['--sub county--', 'Matuga', 'Lungalunga', 'Kinango', 'Msambweni'];
            }
            if (a === 'Kilifi') {
                var array = ['--sub county--', 'Kilifi North', 'Kilifi South', 'Kaloleni', 'Rabai', 'Ganze', 'Malindi', 'Magarini'];
            }
            if (a === 'Kirinyaga') {
                var array = ['--sub county--', 'Mwea', 'Gichugu', 'Ndia', 'Kirinyaga Central'];
            }
            if (a === 'Kiambu') {
                var array = ['--sub county--', 'Gatundu North', 'Gatundu South', 'Juja', 'Thika Town', 'Ruiru', 'Githunguri', 'Kiambu', 'Kiambaa', 'Kabete', 'Kikuyu', 'Limuru', 'Lari'];
            }
            if (a === 'Kajiado') {
                var array = ['--sub county--', 'Kajiado North', 'Kajiado South', 'Kajiado Central', 'Kajiado East', 'Kajiado West'];
            }
            if (a === 'Kericho') {
                var array = ['--sub county--', 'Kipkelion East', 'Kipkelion West', 'Ainamoi', 'Bureti', 'Belgut', 'Sigowet/Soin'];
            }
            if (a === 'Kakamega') {
                var array = ['--sub county--', 'Lugari', 'Likuyani', 'Malava', 'Lurambi', 'Navakholo', 'Mumias West', 'Mumias East', 'Matundu', 'Butere', 'Khwisero', 'Shinyalu', 'Ikolomani'];
            }
            if (a === 'Kisumu') {
                var array = ['--sub county--', 'Kisumu East', 'Kisumu West', 'Kisumu Central', 'Seme', 'Nyando', 'Muhoroni', 'Nyakach'];
            }
            if (a === 'Kisii') {
                var array = ['--sub county--', 'Bonchari', 'South Mugirango', 'Bomachoge Borabu', 'Bobasi', 'Bomachoge chache', 'Nyaribari Masaba', 'Nyaribari Chache', 'Kitutu Chache North', 'Kitutu Chache South'];
            }
            if (a === 'Laikipia') {
                var array = ['--sub county--', 'Laikipia North', 'Laikipia Central', 'Laikipia East', 'Laikipia West', 'Nyahururu'];
            }
            if (a === 'Kitui') {
                var array = ['--sub county--', 'Kitui East', 'Kitui West', 'Kitui Central', 'Kitui Rural', 'Kitui South', 'Mwingi North', 'Mwingi West', 'Mwingi Central'];
            }
            if (a === 'Lamu') {
                var array = ['--sub county--', 'Lamu East', 'Lamu West'];
            }
            if (a === 'Machakos') {
                var array = ['--sub county--', 'Masinga', 'Yatta', 'Matungulu', 'Kangundo', 'Mwala', 'Kathiani', 'Machakos Town', 'Mavoko'];
            }
            if (a === 'Makueni') {
                var array = ['--sub county--', 'Makueni', 'Kalungu', 'Mukaa', 'Kibwezi East', 'Kibwezi West', 'Kilome'];
            }
            if (a === 'Mandera') {
                var array = ['--sub county--', 'Mandera West', 'Mandera South', 'Banissa', 'Mandera North', 'Mandera East', 'Lafey'];
            }
            if (a === 'Meru') {
                var array = ['--sub county--', 'Igembe East', 'Igembe South', 'Igembe North', 'Igembe West', 'Buuri', 'Imenti South', 'Imenti North', 'Imenti Central'];
            }
            if (a === 'Migori') {
                var array = ['--sub county--', 'Rongo', 'Awendo', 'Suna East', 'Suna West', 'Uriri', 'Nyatike', 'Kuria West', 'Kuria East', 'Ntimaru', 'Mabera'];
            }
            if (a === 'Marsabit') {
                var array = ['--sub county--', 'Laisamis', 'North Norr', 'Moyale', 'Saku'];
            }
            if (a === 'Mombasa') {
                var array = ['--sub county--', 'Changamwe', 'Jomvu', 'Kisauni', 'Nyali', 'Likoni', 'Mvita'];
            }
            if (a === "Muranga") {
                var array = ['--sub county--', 'Kiharu', 'Mathioya', 'Kangema', 'Gatanga', 'Kigumo', 'Kahuro', "Murang'a South"];
            }
            if (a === 'Nairobi') {
                var array = ['--sub county--', 'Dagoretti South', 'Dagoretti Central', 'Embakasi East', 'Embakasi South', 'Embakasi North', 'Embakasi West', 'Kamukunji', 'Kasarani', 'KIbra', 'Langata', 'Makadara', 'Mathare', 'Roysambu', 'Ruaraka', 'Starehe', 'Westlands'];
            }
            if (a === 'Nakuru') {
                var array = ['--sub county--', 'Nakuru Town East', 'Nakuru Town West', 'Njoro', 'Molo', 'Gilgil', 'Naivasha', 'Kuresoi North', 'Kuresoi South', 'Rongai', 'Subukia', 'Bahati'];
            }
            if (a === 'Nandi') {
                var array = ['--sub county--', 'Mosop', 'Emgwen', 'Aldai', 'Tinderet', 'Nandi Hills', 'Chesumei'];
            }
            if (a === 'Narok') {
                var array = ['--sub county--', 'Transmara West', 'Transmara East', 'Narok North', 'Narok South', 'Narok West', 'Narok East'];
            }
            if (a === 'Nyamira') {
                var array = ['--sub county--', 'Nyamira South', 'Nyamira North', 'Borabu', 'Manga', 'Masaba North'];
            }
            if (a === 'Nyandarua') {
                var array = ['--sub county--', 'Kinangop', 'Kipipiri', 'ol Joro Orok', 'Ndaragwa', 'Ol Kalou'];
            }
            if (a === 'Nyeri') {
                var array = ['--sub county--', 'Nyeri Town', 'Mathira East', 'Mathira West', 'Tetu', 'Mukurweni', 'Kieni East', 'Kieni West', 'Othaya'];
            }
            if (a === 'Samburu') {
                var array = ['--sub county--', 'Samburu East', 'Samburu West', 'Samburu North'];
            }
            if (a === 'Siaya') {
                var array = ['--sub county--', 'Alego Usonga', 'Ugenya', 'Gem', 'Bondo​​', 'Ugunja', 'Rarieda​​'];
            }
            if (a === 'Taita Taveta') {
                var array = ['--sub county--', 'Voi', 'Mwatate', 'Wundanyi', 'Taveta'];
            }
            if (a === 'Tana River') {
                var array = ['--sub county--', 'Bura', 'Galole', 'Garsen'];
            }
            if (a === 'Tharaka Nithi') {
                var array = ['--sub county--', 'Tharatha North', 'Tharaka South', 'Chuka', 'Igambang’ombe', 'Muthambi', 'Maara'];
            }
            if (a === 'Trans Nzoia') {
                var array = ['--sub county--', 'Cherengany', 'Endebess', 'Kwanza', 'Kiminini', 'Saboti'];
            }
            if (a === 'Turkana') {
                var array = ['--sub county--', 'Loima', 'Turkana West', 'Turkana East', 'Turkana North', 'Turkana South', 'Turkana Central'];
            }
            if (a === 'Uasin Gishu') {
                var array = ['--sub county--', 'Soy', 'Tarbo', 'Ainabkoi', 'Kapseret', 'Kesses', 'Moiben'];
            }
            if (a === 'Vihiga') {
                var array = ['--sub county--', 'Emuhaya', 'Sabatia', 'Luanda', 'Hamisi', 'Vihiga'];
            }
            if (a === 'Wajir') {
                var array = ['--sub county--', 'Wajir North', 'Wajir South', 'Wajir East', 'Wajir West', 'Eldas', 'Tarbaj'];
            }
            if (a === 'West Pokot') {
                var array = ['--sub county--', 'West Pokot', 'North Pokot', 'Pokot South', 'Pokot Central'];
            }

            var string = "";
            for (let i = 0; i < array.length; i++) {
                string = string + "<option>" + array[i] + "</option>";
            }
            document.getElementById('sub-county').innerHTML = string;
        });
    </script>
</body>

</html>