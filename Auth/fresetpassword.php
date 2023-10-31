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
    <title>Reset Password</title>
</head>
<style>
    form{
        width: 30%;
        height: fit-content;
        padding: 10px;
        margin-top: 10%;
        margin-left: 50%;
        transform: translateX(-50%);
        border-radius: 4px;
        box-shadow: 0 0 4px gainsboro;
    }
    form .form-group, form h5{
        width: 100%;
        margin-bottom: 10px;
    }
    form > div{
        display: none;
        margin-bottom: 7px;
        color: red;
        width: 100%;
    }
    @media only screen and (max-width: 900px){
        form{
            margin-top: 20%;
            width: 60%;
        }
    }
    @media only screen and (max-width: 500px){
        form{
            width: 90%;
        }
    }
</style>
<body>
    <form action="#" method="post">
        <h5 class="text-center">Passward Reset</h5>
        <div class="text-center"></div>
        <input type="hidden" value="'<?php echo $_GET['id'] ?>'" name="id">
        <label for="email" class="form-group">New Passward
            <input type="password" name="password" id="password" class="form-control">
        </label>
        <label for="Cemail" class="form-group">Confirm Passward
            <input type="password" name="Cpassword" id="Cpassword" class="form-control">
        </label>
        <button type="submit" name="reset" class="form-control btn btn-secondary" id="reset">Reset</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#password').keyup(function(){
                $('form > div').html('<li>The password must contain at least 8 characters</li><li>At least one capital letter</li><li>At least one lowercase letter</li><li>At least one number</li>').css('color', '#000').show();
            })
            $('#password').blur(function(){
                if(!$('#password').val().match(/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/)){
                    $('form > div').html('<li>The password must contain at least 8 characters</li><li>At least one capital letter</li><li>At least one lowercase letter</li><li>At least one number</li>').css('color', 'red').show();
                    $('#Cpassword').prop('disabled', true);
                }
                else{
                    $('form > div').hide();
                    $('#Cpassword').prop('disabled', false);
                }
            })
            $('#reset').on('click', function(e){
                e.preventDefault();
                if($('#password').val() == '' || $('#Cpassword').val() == ''){
                    $('form > div').html('Fill all fields!').css('color', 'red').show();
                }
                else if($('#password').val() != $('#Cpassword').val()){
                    $('form > div').html('Password mismatch!').css('color', 'red').show();
                }
                else{
                    // reseting password 
                    var data = $('form').serialize();
                    $.ajax({
                        method: 'post',
                        url: "../server/fresetpassword.php",
                        data: data,
                        success: function (response) {
                            if(response == '1'){
                                alert('Reset successful');
                                window.location.assign("../Farmer-Portal/farmer-login-signup.php");
                            }
                        }
                    });
                }
            })
        })
    </script>
</body>
</html>