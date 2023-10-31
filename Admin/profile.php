<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<div class="loading-gif" style="position: fixed;
    margin: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: white;">
    <img src="../images/logo-removebg.png" alt="" style="height: 4vmin; width: 5vmin;">
    <h6 style="font-size: 4vmin;"><i class="fas fa-spinner fa-spin"></i></h6>
</div>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgb(12, 118, 84)">
    <link href="../used libralies/css/bootstrap.min.css" rel="stylesheet">
    <script src="../used libralies/js/bootstrap.bundle.min.js"></script>
    <script src="../used libralies/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css-files/homepage.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <title>Link directly | Admin</title>
    <header class="navbar fixed-top shadow">
        <nav class="col-md-12">
            <a href="add-price.php" id="requests"> Add prices</a>
            <a href="slider-ads.php">Slider Ads</a>
            <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle"><i class="fa-regular fa-user">
                </i> <?php if (isset($_SESSION['email']) && time() - $_SESSION['login-time'] <= 21600) {
    include '../DB-config/db-config.php';
    $email = $_SESSION['email'];
    $SELECT = "SELECT * FROM admin WHERE email = '$email'";

    $result = mysqli_query($connection, $SELECT);
    $num_of_rows = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    echo 'Hi, ' . $data['username'];
}
elseif (time() - $_SESSION['login-time'] >= 12600) {
    $_SESSION['expiry'] = '<b>Session ended. PLease log in<b>';
    echo '<script>window.location.assign("login.html")</script>';
}
else {
    session_unset();
    session_destroy();
    echo 'Account';
    header('location: ../homepage.php');
}?></button>
                <div class="dropdown-items">
                    <a href="profile.php" class="py-2 px-2">Profile</a>
                    <a href="../server/logout.php" class="py-2 px-2">Logout</a>
                </div>
            </div>
            <a href="./" title="home" id="logo" class="nav-brand"><img src="../images/logo-removebg.png" alt=""></a>
        </nav>
        
    </header>
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&family=Poppins:wght@500&display=swap');
        body{
            background: #f5f5f5!important;
        }
        #content{
            margin-top: 3.5vw;
            padding: 0;
            padding-bottom: 5vmin;
        }
        #content > form{
            margin-top: 5%;
            width: 60%;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }
        #content > form input{
            margin: 10px;
        }
        #content .card{
            width: 90%;
            height: 23.2vw;
            overflow-y: auto;
            overflow-x: hidden;
            font-family: 'Signika Negative', sans-serif;
        }
        #content .card .buttons{
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }
        .card .buttons form{
            margin-right: 1vw;
        }
        #content .card #description{
        }
        #content .card img{
            height: 20.2vw;
            border-radius: 0;
        }
        #content .card .card-title{
            font-weight: bold;
        }
        #content .card .card-footer{
            width: 100%;
        }
        #content #container{
            width: 100%;
        }
        #container form{
            width: 60%;
            height: 50%;
            background: rgb(237, 236, 236);
            border: 4px ridge rgb(12, 118, 84);
            box-sizing: border-box;
            padding: 5px;
            border-radius: 5px;
            margin-top: 30px;
        }
        #container form input, select, #save-button{
            margin-bottom: 2vw;
            font-family: 'Signika Negative', sans-serif;
        }
        @media only screen and (max-width: 500px){
            #container form{
                width: 90%;
                margin-left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</div>
    <div id="content">
    <div id="container" class="py-4 container1" align="center">
        <?php
$id = $data['admin_id'];
$SELECT = "SELECT * FROM admin WHERE admin_id = '$id'";
$run = mysqli_query($connection, $SELECT);
$data = mysqli_fetch_assoc($run);
?>
            <form action="profile.php" method="post">
                <input type="name" name="username" placeholder="Enter First name..." class="form-control" value="<?php echo $data['username']; ?>" required>
                <input type="email" placeholder="Enter a valid email..." class="form-control email" name="email" value="<?php echo $data['email']; ?>" required>
                <input type="number" placeholder="Password..." class="form-control phone-number" name="password" value="<?php echo $data['password']; ?>" required>
                <button class="btn btn-outline-success form-control" type="submit" id="save-button" name="save-button">Save</button><br>
            </form>
        </div>
<?php
if (isset($_POST['save-button'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $UPDATE = "UPDATE admin SET username = '$username', email = '$email', password = '$password' WHERE admin_id = '$id'";
    mysqli_query($connection, $UPDATE);
    echo '<script>alert("Updated successfully!")</script>';
    header('location: profile.php');
}
?>
    </div>
    <script>
        //search suggestion
        $(window).ready(function (){
	$(".search-input").keyup(function(){
		var txt = $(this).val();
		if(txt != ''){
			$.ajax({
				url: "Ajax/search-suggestion.php",
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
</html>