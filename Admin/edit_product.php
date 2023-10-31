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
            height: 100%;
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
        #container form img{
            width: 100%;
            height: 30vw;
        }
        #container form{
            width: 60%;
            height: auto;
            background: rgb(237, 236, 236);
            border: 4px ridge rgb(12, 118, 84);
            box-sizing: border-box;
            padding: 5px;
            margin-left: 20%;
            border-radius: 5px;
        }
        #container form label, select{
            width: 100%;
            font-family: 'Signika Negative', sans-serif;
        }
        #container form input, textarea, button{
            font-family: 'Signika Negative', sans-serif;
        }
        #container form .form-control{
            margin-bottom: 2vw;
        }
        @media only screen and (max-width: 500px){
            #content form{
                width: 100%;
            }
            #container form{
                width: 90%;
                margin-left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</div>
    <div id="content">
        <form action="index.php" method="get" class="form-group">
            <input type="number" class="form-control w-75" name='search-input' placeholder="Search product by id..." required>
            <select name="category" id="" class="form-control w-75">
             <option value="0">--product/request...</option>
             <option value="product">Product</option>
             <option value="request">Request</option>
            </select>
            <button class="btn btn-primary" name='search' type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <?php
            if(isset($_POST['edit_button'])){
                $edit_id = $_POST['edit_id'];

                $query = "SELECT * FROM product WHERE product_id = $edit_id";
                $execute = mysqli_query($connection, $query);

                foreach($execute as $product_details){
                    $image_string = $product_details['product_image'];
                    $string_to_array = explode(",", $image_string);
                    ?>
                <div id="container" class="py-4 container1">
                <form action="../server/edit_product.php" method="post" enctype="multipart/form-data">
                    <img src="<?php echo'../'. $string_to_array[0] ?>" alt="<?php echo'../'. $string_to_array[0] ?>">
                    <input type="hidden" name="edit_id" value="<?php echo $product_details['product_id'] ?>">
                <div class="form-control">
                    <label for="product-title">Enter Product Title</label>
                    <input type="text" class="form-control" name="product-title" placeholder="e.g Tomatoes" value="<?php echo $product_details['product_title'] ?>" id="product-title">
                </div>
                <div class="form-control">
                    <label for="stock-available">Stock/Quantity Available</label>
                    <input type="text" class="form-control" name="stock-available" placeholder="stock-available...e.g 300 KGS" value="<?php echo $product_details['stock_available'] ?>" id="stock-available">
                </div>
                <div class="form-control">
                    <label for="product-category">Product Category</label>
                    <select name="product-category" id="product-category">
                        <option value="<?php echo $product_details['product_category'] ?>"><?php echo $product_details['product_category'] ?></option>
                        <option value="fruits">Fruits</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="cereals">Cereals</option>
                        <option value="cattle">Cattle</option>
                        <option value="poutry">Poutry</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="product-expiry">Product Expiry(Optional)</label>
                    <input type="date" class="form-control" name="product-expiry" placeholder="Product Expiry" value="<?php echo $product_details['product_expiry'] ?>" id="product-expiry">
                </div>
                <div class="form-control">
                    <label for="product-image">Product Image</label>
                    <input type="file" accept="image/*" class="form-control" name="product-image" id="product-image">
                </div>
                <div class="form-control">
                    <label for="product-price">Price per Unit</label>
                    <input type="text" class="form-control" name="product-price" placeholder="e.g 50/kg, 1000/90kg, 20000/cow..." value="<?php echo $product_details['product_price'] ?>" id="product-price">
                </div>
                <div class="form-control">
                    <label for="product-description">Product Description</label>
                    <textarea name="product-description" class="form-control" cols="30" rows="7" id="product-description"><?php echo $product_details['product_description'] ?></textarea>
                </div>
                <div class="form-control">
                    <label for="product-keywords">Product Keywords</label>
                    <input type="text" class="form-control" name="product-keywords" placeholder="Products Keywords" value="<?php echo $product_details['product_keywords'] ?>" id="product-keywords">
                </div>
                <div class="form-control">
                    <label for="product-location">Product location</label>
                    <input type="text" class="form-control" name="product-location" placeholder="Products location" value="<?php echo $product_details['specific_location'] ?>" id="product-location">
                </div>
                <button class="btn btn-outline-success form-control" type="submit" id="update-button" name="update-button">Update</button><br>
            </form>
                </div>
                <?php
                }
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