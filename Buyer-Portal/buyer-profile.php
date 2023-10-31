<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$title = 'Profile';
include_once '../includes/preloader.html';
include_once '../includes/buyer-header.php';
?>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');
        #Profile-title{
            margin-top: 3.5vw;
            width: 100%;
            padding: .5vw;
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }
        #content #container{
            width: 100%;
            background: white;
        }
        #container form{
            width: 60%;
            height: 50%;
            background: rgb(237, 236, 236);
            border: 4px ridge rgb(12, 118, 84);
            box-sizing: border-box;
            padding: 5px;
            border-radius: 5px;
        }
        #container form input, select, #save-button{
            margin-bottom: 2vw;
            font-family: 'Signika Negative', sans-serif;
        }
        #message, .message{
            width: 100%;
            background: rgb(255, 139, 139);
        }
        @media only screen and (max-width: 900px){
            #Profile-title{
                margin-top: 6%;
                font-size: 3vw;
            }
            #container form{
                width: 95%;
            }
        }
        @media only screen and (max-width: 500px){
            #Profile-title{
                margin-top: 10vw;
            }
            #container form input::placeholder, select::placeholder{
                font-size: 4vw;
            }
        }
    </style>
    <div id="content">
        <div id="Profile-title" align="center"><?php echo 'Welcome, ' . $data['first_name']; ?><section style='color: rgb(254, 179, 73);'>You can update your profile and save changes by clicking save button</section></div>
        <div id="container" class="py-4 container1" align="center">
            <!--Profile editing message-->
<?php
if (isset($_SESSION['profile-edit'])) { ?>
            <div class="alert alert-primary mt-0 w-75 p-1" role="alert">
                <strong><?php echo $_SESSION['profile-edit']; ?></strong>
            </div>
        <?php
    unset($_SESSION['profile-edit']);
}?>
            <form action="../server/buyer-profile-edit.php" method="post">
            <input type="hidden" name="initial_email" value="<?php echo $data['email']; ?>">
                <input type="name" name="first-name" placeholder="Enter First name..." class="form-control first-name" value="<?php echo $data['first_name']; ?>" required>
                <input type="name" name="last-name" placeholder="Enter Last name..." class="form-control last-name" value="<?php echo $data['last_name']; ?>" required>
                <input type="email" placeholder="Enter a valid email..." class="form-control email" name="email" value="<?php echo $data['email']; ?>" required>
                <input type="number" placeholder="Enter phone number..." class="form-control phone-number" name="phone-number" value="<?php echo $data['phone_number']; ?>" required>
                <button class="btn btn-outline-success form-control" type="submit" id="save-button" name="save-button">Save</button><br>
                <a href="javascript:void();" class="btn btn-outline-success" id="change-password">Change Password</a>
            </form>
        </div>
        <div id="container" class="py-4 container2" align="center">
            <form action="../server/buyer-changepassword.php" method="post" class="my-5">
                <input type="password" placeholder="Enter Current Password..." class="form-control password" name="current-password" required>
                <div class="message">You have not done any changes to the password!</div>
                <input type="password" placeholder="Enter New Password..." class="form-control new-password" name="new-password" required>
                <input type="password" placeholder="Confirm New Password..." class="form-control con-password" name="con-new-password" required>
                <div id="message"></div><br>
                <button type="submit" class="btn btn-outline-success" name="save-password" id="save-password">Save Changes</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.container2').hide();
        });
        $('#change-password').on('click', function(){
            $('.container1').hide();
            $('.container2').show();
        });

        //activating save button
        $('#save-button').prop('disabled', true);
        setInterval(function () {
            $('.first-name, .last-name, .email, .phone-number').on('change', function(){
                $('#save-button').prop('disabled', false);
            });
        }, 200);

        //checking passwords
        $('.message').hide();
        $('#save-password').on('click', function(){
            if($('.new-password').val() == $('.con-password').val()){
                $('.new-password, .con-password').css('border-color', 'green');
            }else{
                $('.new-password, .con-password').css('border-color', 'red');
                $('#message').show();
                $('#message').html('Password mismatched! Recheck...');
                $('#save-password').prop('disabled', true);
                setInterval(function(){
                    if($('.new-password').val() == $('.con-password').val()){
                        $('.new-password, .con-password').css('border-color', 'green');
                        $('#save-password').prop('disabled', false);
                        $('#message').hide();
                    }
            }, 200);
        }
        });
        setInterval(function () {
            $('.new-password').on('change', function(){
                if($('.password').val() == $('.new-password').val()){
                    $('.new-password, .password').css('border-color', 'red');
                    $('.message').show();
                    $('#save-password').prop('disabled', true);
                }
                else{
                    $('.password, .new-password').css('border-color', 'green');
                    $('.message').hide();
                    $('#save-password').prop('disabled', false);
                }
            });
        }, 200);

        //checking password pattern
        setInterval(function () {
                $('.con-password').focus(function () {
                $pass_val = $('.new-password').val();

                if($pass_val.match(/^(?=.*[a-z])(?=.*[0-9])([A-z0-9]{8,})/)){
                    $('#message').html('Nice!').css('background', 'rgb(179, 247, 179)').css('margin-top', '5px');
                    $('#save-password').prop('disabled', false);
                }
                else{
                    $('#message').html('<li>The password must contain at least 8 characters</li><li>One capital letter followed by small letters</li><li>At least one number</li>');
                    $('#save-password').prop('disabled', true);
                }
            });
            }, 200);

    </script>
    <script>
        //search suggestion
        $(window).ready(function (){
	$(".search-input").keyup(function(){
		var txt = $(this).val();
		if(txt != ''){
			$.ajax({
				url: "../Ajax/search-suggestion.php",
				method: 'POST',
				data: {txt:txt},
				success: function(data){
                    $('#search-suggestion').html(data);
				}
			});
		}else{
			$('#search-suggestion').html('');
		}
		$(document).on('click',"#search-suggestion a", function(){
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