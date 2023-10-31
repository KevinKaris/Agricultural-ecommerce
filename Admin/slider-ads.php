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
            <a href="#">Slider Ads</a>
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
    $_SESSION['notice'] = '<b>Session ended. PLease log in<b>';
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
        #content #current-ads{
            margin-top: 5%;
            width: 100%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-evenly;
            padding: 7px;
        }
        #content #current-ads .image{
            min-width: 30%;
            height: 160px;
            border-radius: 5px;
            overflow: hidden;
            margin: 20px;
            position: relative;
        }
        #content #current-ads .image > img{
            width: 100%;
            height: 100%;
        }
        #content #current-ads .image > button{
            background: black;
            color: #ffffff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            position: absolute;
            top: 70%;
            left: 85%;
        }
        .pop-up{
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 20;
            display: none;
        }
        .pop-up > form{
            width: 40%;
            height: auto;
            background: #fff;
            border-radius: 5px;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            padding: 20px;
        }
        .pop-up > form > input{
            margin-top: 15px;
        }
        .pop-up > form h5{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        @media only screen and (max-width: 500px){
            #content #current-ads{
                width: 100%;
            }
            .pop-up > form{
                width: 80%;
            }
        }
    </style>
</div>
    <div id="content">
        <?php
        $sql = "SELECT * FROM ad_slider";
        $run = mysqli_query($connection, $sql);
        ?>
        <div id="current-ads">
            <?php
            while($details = mysqli_fetch_assoc($run)){
            ?>
            <div class="image">
                <img src="<?php echo '../'.$details['image']; ?>" alt="">
                <button class="btn"><i class="fa-solid fa-pen"></i><input type="hidden" name="ad-id" value="<?php echo $details['id']; ?>"></button>
            </div>
            <?php }?>
        </div>

        <!--Ad image editor pop-up-->
        <div class="pop-up">
            <form action="../server/ad-slider.php" method="post" class="form-group" enctype="multipart/form-data">
                <h5>Update <a href="javascript:void();"class="btn"><i class="fa-solid fa-xmark"></i></a></h5>
                <input type="hidden" value="" id="id" name="update-id">
                <input type="file" name="picture" accept=".jpg, .png, .webp, .jpeg" class="form-control" required>
                <input type="text" name="product-id" class="form-control" placeholder="Enter product ID. If no ID enter '#'..." required>
                <input type="submit" class="form-control btn btn-success" name="submit" value="Update">
            </form>
        </div>
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

    //closing and poping up the pop-up
    $('.image button').on('click', function(){
        var id = $(this).find('input').val();
        $('#id').val(id);
        $('.pop-up').show();

        $('.pop-up h5 a').on('click', function(){
            $('.pop-up').hide();
        })
    })
});
    </script>
    <script src="../main.js"></script>
</body>
</html>