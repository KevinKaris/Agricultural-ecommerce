<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo-removebg.png">
    <link href="../used libralies/css/bootstrap.min.css" rel="stylesheet">
    <script src="../used libralies/js/bootstrap.bundle.min.js"></script>
    <script src="../used libralies/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <title>Buyer Login/Signup</title>
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
            background: rgba(0, 0, 0, .4)url('../images/buyer-login.jpg');
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
            height: 80%;
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
                top: 20% !important;
                width: 90%;
                height: 50% !important;
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
        <form action="../server/buyer-login.php" method="post">
            <h4>Buyer Login</h4><br>
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
}?>

            <!--signing up notification-->
            <div class="alert alert-danger mt-0 w-75 p-1 response-alert" role="alert">
                <strong></strong>
            </div>
            <div class="alert alert-primary mt-0 w-75 p-1 response-alert2" role="alert">
                <strong></strong>
            </div>

            <input type="tel" placeholder="Enter your phone number..." class="form-control" name="phone-number" id="loginphone" value>
            <input type="password" placeholder="Enter password..." class="form-control" name="password" id="loginpassword" value><br>
            <a href="#" id="forgot-password">Forgot password?</a><br>
            <button class="btn btn-outline-success form-control" id="loginbutton" type="submit"><span>Login</span><i class="fas fa-circle-notch fa-spin"></i></button>
            <p id="signup-link">Have no account? <a href="javascript:void();">Signup</a></p>
        </form>
    </div>
    <!--Buyer signup-->
    <div class="form-group" id="farmer-signup" align="center">
        <form action="../server/buyer-signup.php" method="post">
            <h4>Buyer Signup</h4>
            <!--signing up notification-->
            <div class="alert alert-danger mt-0 w-75 p-1 response-alert3" role="alert">
                <strong></strong>
            </div>
            <input type="name" name="first-name" placeholder="Enter First name..." class="form-control"
                name="first-name" id="signupfname">
            <input type="name" name="last-name" placeholder="Enter Second name..." class="form-control" name="last-name" id="signuplname">
            <input type="email" placeholder="Enter a valid email..." class="form-control" name="email" id="signupemail">
            <input type="tel" placeholder="Enter phone number..." class="form-control" name="phone-number" id="signupphone">
            <input type="password" placeholder="Enter password..." class="form-control password" name="password" id="signuppassword">
            <input type="password" placeholder="Confirm password..." class="form-control con-password"
                name="con-password" required>
            <div id="message"></div><br>
            <p id="login-link">Have account? <a href="javascript: void();">Log in</a></p>
            <button class="btn btn-outline-success form-control" type="submit" id="signup-button"><span>Signup</span><i class="fas fa-circle-notch fa-spin"></i></button><br>
        </form>
    </div>

    <div id="forgot-password-form">
        <form action="../server/bsendEmail.php" method="post" class="form-group">
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
                        url: "../server/bsendEmail.php",
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
                        url: "../server/buyer-login.php",
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
                if($('#signupphone').val() != '' && $('#signupemail').val() != '' && $('#signuplname').val() != '' && $('#signupfname').val() != '' && $('.password, .con-password').val() != ''){
                    $('#signup-button span').css('display', 'none');
                    $('#signup-button .fa-circle-notch').css('display', 'block');
                    $('#signup-button').prop('disabled', true).css('opacity', '.5');
                    $.ajax({
                        url: "../server/buyer-signup.php",
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
                $('#farmer-signup').fadeIn(800);
                $('#farmer-login').hide();
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

    </script>
</body>

</html>