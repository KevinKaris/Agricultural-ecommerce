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
            <a href="#" id="requests"> Add prices</a>
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
        #content form{
            margin-top: 5%;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            padding: 7px;
        }
        #content form input, #content form select{
            width: 100%!important;
            margin-bottom: 15px;
        }
        .excel-upload{
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            padding: 7px;
        }
        @media only screen and (max-width: 500px){
            #content form{
                width: 90%;
            }
        }
    </style>
</div>
    <div id="content">
    <?php
if (isset($_SESSION['notice'])) { ?>
                <div class="alert alert-primary mt-0 w-75 p-1" role="alert">
                    <strong><?php echo $_SESSION['notice']; ?></strong>
                    <?php unset($_SESSION['notice']); ?>
                </div>
            <?php
}?>
        <form action="add-price-server.php" method="post" class="form-group">
            <input type="text" class="form-control w-75" name='product' placeholder="Product name..." required>
            <select name="county" id="" class="form-control w-75" required>
                <option value="0">--county--</option>
                <option value="Nairobi">Nairobi</option>
                <option value="Nakuru">Nakuru</option>
                <option value="Mombasa">Mombasa</option>
                <option value="Kisumu">Kisumu</option>
                <option value="Homa-bay">Homa-Bay</option>
                <option value="Kirinyaga">Kirinyaga</option>
                <option value="Uasin-gishu">Uasin Gishu</option>
                <option value="Nyeri">Nyeri</option>
                <option value="Kakamega">Kakamega</option>
                <option value="Kisii">Kisii</option>
                <option value="Kitui">Kitui</option>
                <option value="Kajiado">Kajiado</option>
            </select>
            <input type="text" class="form-control w-75" name='market' placeholder="Market name..." required>
            <input type="text" class="form-control w-75" name='retail' placeholder="Retail price...">
            <input type="text" class="form-control w-75" name='wholesale' placeholder="Wholesale price...">
            <button class="btn btn-primary form-control" type="submit" name='add'>Add</button>
        </form>

        <!--uploading excel file-->
        <div class="excel-upload mt-3">
            <h5>Import excel/csv file</h5>
            <p><b>Note: </b>That file must be in this format (<b>Product name</b>, <b>County</b>, <b>Market name</b>, <b>Retail price</b>, <b>Wholesale price</b>). Do not write headings on the column, only the data.</p>
            <form action="add-price-excel.php" method="post" class="form-group w-100" enctype="multipart/form-data">
                <input type="file" accept=".xlsx, .xls, .csv" name="upload" class="form-control" required>
                <button class="btn btn-primary w-25" name="fileSubmit" type="submit">Submit</button>
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
});
    </script>
    <script src="../main.js"></script>
</body>
</html>