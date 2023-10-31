<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$title = 'Profile';
include_once '../includes/preloader.html';
include_once '../includes/farmer-header.php';
?>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');

        #Profile-title {
            margin-top: 3.5vw;
            width: 100%;
            padding: .5vw;
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }

        #content #container {
            width: 100%;
            background: white;
        }

        #container form {
            width: 60%;
            height: 50%;
            background: rgb(237, 236, 236);
            border: 4px ridge rgb(12, 118, 84);
            box-sizing: border-box;
            padding: 5px;
            border-radius: 5px;
        }

        #container form input,
        select,
        #save-button {
            margin-bottom: 2vw;
            font-family: 'Signika Negative', sans-serif;
        }

        #message,
        .message {
            width: 100%;
            background: rgb(255, 139, 139);
        }

        @media only screen and (max-width: 900px) {
            #Profile-title {
                margin-top: 6%;
                font-size: 3vw;
            }

            #container form {
                width: 95%;
            }
        }

        @media only screen and (max-width: 500px) {
            #Profile-title {
                margin-top: 10vw;
            }

            #container form input::placeholder,
            select::placeholder {
                font-size: 4vw;
            }
        }
    </style>
    <div id="content">
        <div id="Profile-title" align="center">
            <?php echo 'Welcome, ' . $data['first_name']; ?>
            <section style='color: rgb(254, 179, 73);'>You can update your profile and save changes by clicking save
                button</section>
        </div>
        <div id="container" class="py-4 container1" align="center">
            <!--Profile editing message-->
            <?php
            if (isset($_SESSION['profile-edit'])) { ?>
                <div class="alert alert-primary mt-0 w-75 p-1" role="alert">
                    <strong>
                        <?php echo $_SESSION['profile-edit']; ?>
                    </strong>
                </div>
                <?php
                unset($_SESSION['profile-edit']);
            } ?>
            <form action="../server/farmer-profile-edit.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>">
                <input type="hidden" name="initial_email" value="<?php echo $data['email']; ?>">
                <input type="name" name="first-name" placeholder="Enter First name..." class="form-control first-name"
                    value="<?php echo $data['first_name']; ?>" required>
                <input type="name" name="last-name" placeholder="Enter Last name..." class="form-control last-name"
                    value="<?php echo $data['last_name']; ?>" required>
                <input type="email" placeholder="Enter a valid email..." class="form-control email" name="email"
                    value="<?php echo $data['email']; ?>" required>
                <input type="number" placeholder="Enter phone number..." class="form-control phone-number"
                    name="phone-number" value="<?php echo $data['phone_number']; ?>" required>
                <select name="county" id="county" class="form-control">
                    <option value="<?php echo $data['county']; ?>"><?php echo $data['county']; ?></option <option
                        value="Baringo">Baringo</option>
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
                    <option value="Muranga">Murang'a</option>
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
                            <option value="<?php echo $data['sub_county']; ?>"><?php echo $data['sub_county']; ?>
                            </option>
                        </select>
                        <input type="tel" placeholder="Enter your location..." class="form-control location"
                            name="location" value="<?php echo $data['location']; ?>" required>
                        <button class="btn btn-outline-success form-control" type="submit" id="save-button"
                            name="save-button">Save</button><br>
                        <a href="javascript:void();" class="btn btn-outline-success" id="change-password">Change
                            Password</a>
            </form>
        </div>
        <div id="container" class="py-4 container2" align="center">
            <form action="../server/farmer-changepassword.php" method="post" class="my-5">
                <input type="password" placeholder="Enter Current Password..." class="form-control password"
                    name="current-password" required>
                <div class="message">You have not done any changes to the password!</div>
                <input type="password" placeholder="Enter New Password..." class="form-control new-password"
                    name="new-password" required>
                <input type="password" placeholder="Confirm New Password..." class="form-control con-password"
                    name="con-new-password" required>
                <div id="message"></div><br>
                <button type="submit" class="btn btn-outline-success" name="save-password" id="save-password">Save
                    Changes</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.container2').hide();
        });
        $('#change-password').on('click', function () {
            $('.container1').hide();
            $('.container2').show();
        });

        //activating save button
        $('#save-button').prop('disabled', true);
        setInterval(function () {
            $('.first-name, .last-name, .email, .phone-number, #county, #sub-county, .location').on('change', function () {
                $('#save-button').prop('disabled', false);
            });
        }, 200);

        //checking passwords
        $('.message').hide();
        $('#save-password').on('click', function () {
            if ($('.new-password').val() == $('.con-password').val()) {
                $('.new-password, .con-password').css('border-color', 'green');
            } else {
                $('.new-password, .con-password').css('border-color', 'red');
                $('#message').show();
                $('#message').html('Password mismatched! Recheck...');
                $('#save-password').prop('disabled', true);
            }
            setInterval(function () {
                if ($('.new-password').val() == $('.con-password').val()) {
                    $('.new-password, .con-password').css('border-color', 'green');
                    $('#save-password').prop('disabled', false);
                    $('#message').hide();
                }
            }, 200);
        });
        setInterval(function () {
            $('.new-password').on('change', function () {
                if ($('.password').val() == $('.new-password').val()) {
                    $('.new-password, .password').css('border-color', 'red');
                    $('.message').show();
                    $('#save-password').prop('disabled', true);
                }
                else {
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

                if ($pass_val.match(/^(?=.*[a-z])(?=.*[0-9])([A-z0-9]{8,})/)) {
                    $('#save-password').prop('disabled', false);
                    $('#message').html('Nice!').css('background', 'rgb(179, 247, 179)').css('margin-top', '5px');
                }
                else {
                    $('#message').html('<li>The password must contain at least 8 characters</li><li>At least one letter</li><li>At least one number</li>');
                    $('#save-password').prop('disabled', true);
                }
            });
        }, 1000);
    </script>
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
include_once('../includes/footer.html');
?>

</html>