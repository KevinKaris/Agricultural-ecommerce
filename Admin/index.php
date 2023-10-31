<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<!-- <div class="loading-gif" style="position: fixed;
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
</div> -->
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
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:wght@500&display=swap');
        body{
            background: #f5f5f5!important;
        }
        .stats{
            background: #ffffff;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .stats > .column{
            width: 180px;
            height: 180px;
            padding: 10px;
            background: #b5e4ff;
            border-radius: 10px;
            margin: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .stats > .column p{
            font-size: 15px;
            font-family: serif;
            font-weight: bold;
            background: #ffffff;
            border-radius: 15px;
            padding-left: 20px;
            padding-right: 20px;
            color: black!important;
        }
        .stats > .column > span{
            font-family: 'Fira Sans', sans-serif;
            font-size: 15px;
        }
        .stats > .column:hover{
            background: var(--text-color);
            color: #ffffff;
            transition-duration: .2s;
        }
        #content{
            margin-top: 3.5vw;
            padding: 0;
            padding-bottom: 5vmin;
            background: #ffffff;
            min-height: 100vh;
            border-radius: 5px;
        }
        #content form{
            margin-top: 5%;
            width: 60%;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }
        #content form input{
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
        #line{
            width: 100%;
            border-bottom: 3px solid #ebebeb;
        }
        @media only screen and (max-width: 500px){
            .stats > .column{
                margin: 10px;
            }
            #content form{
                width: 100%;
            }
            #content .card{
                height: 100vw;
            }
            #content .card img{
                height: 55vw;
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
        </form><div id="line"></div><br>

        <?php
if (isset($_GET['search'])) {
    $input_search = $_GET['search-input'];
    $category = $_GET['category'];

    $SELECT1 = "SELECT * FROM product WHERE product_id = '$input_search'";
    $SELECT2 = "SELECT * FROM buyer_request WHERE request_id = '$input_search'";

    $run1 = mysqli_query($connection, $SELECT1);
    $rows1 = mysqli_num_rows($run1);

    $run2 = mysqli_query($connection, $SELECT2);
    $rows2 = mysqli_num_rows($run2);

    if ($rows1 == 0) {
        echo '<script>alert("No product/request with that ID. Recheck the ID and try again...")</script>';
    }
    else {
        if($category == 'product'){
            $row_details = mysqli_fetch_assoc($run1);
            $image_string = $row_details['product_image'];
            $string_to_array = explode(",", $image_string);
            ?>
            <div class="card mt-3 border-success bg-light">
            <div class="row">
                <div class="col-md-6">
                    <img src="../<?php echo $string_to_array[0]; ?>" alt="<?php echo $string_to_array[0]; ?>" class="card-img">
                </div>
                <div class="col-md-6">
                    <div class="card-body text-center">
                        <div class="card-title"><?php echo $row_details['product_title']; ?></div>
                        <div class="card-text">
                            <p><strong class="fst-italic">Price:</strong> <?php echo $row_details['product_price']; ?></p>
                            <p><strong class="fst-italic">Quantity Available:</strong> <?php echo $row_details['stock_available']; ?></p>
                            <p><strong class="fst-italic">Location:</strong> <?php echo $row_details['specific_location']; ?></p>
                            <p><strong class="fst-italic">Category:</strong> <?php echo $row_details['product_category']; ?></p>
                            <p><strong class="fst-italic">Views:</strong> <?php echo $row_details['views']; ?></p>
                            <p><strong class="fst-italic">Product ID:</strong> <?php echo $row_details['product_id']; ?></p>
                            <div class="buttons" align="right">
                                <form action="edit_product.php" method="Post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row_details['product_id'] ?>">
                                    <button class="btn bg-info" type="submit" name="edit_button">Edit</button>
                                </form>
                                <form action="../server/delete-farmer-product.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row_details['product_id'] ?>">
                                    <button class="btn bg-danger" type="submit" name="delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer m-0 text-muted" align="center">Uploaded: <?php echo $row_details['upload_date']; ?></div>
        </div>
       <?php }
       elseif($category == 'request'){
        $row_details = mysqli_fetch_assoc($run2);?>
            <div class="card mt-3 border-success bg-light">
            <div class="row">
                <div class="col-md-6">
                    <img src="../<?php echo $row_details['product_image']; ?>" alt="<?php echo $row_details['product_image']; ?>" class="card-img">
                </div>
                <div class="col-md-6">
                    <div class="card-body text-center">
                        <div class="card-title"><?php echo $row_details['product_title']; ?></div>
                        <div class="card-text">
                            <p><strong class="fst-italic">Stock needed: </strong><?php echo $row_details['stock_needed']; ?></p>
                            <p><strong class="fst-italic">Preferred Location: </strong><?php echo $row_details['preferred_location']; ?></p>
                            <p id="description"><strong class="fst-italic">Product description: </strong><?php echo $row_details['product_description']; ?></p>
                            <p><strong class="fst-italic">Views: <?php echo $row_details['views']; ?></strong></p>
                            <p><strong class="fst-italic">Request ID: </strong><?php echo $row_details['request_id']; ?></p>
                            <div class="buttons" align="right">
                                <form action="edit-request.php" method="POST">
                                   <input type="hidden" name="edit-id" value="<?php echo $row_details['request_id']; ?>">
                                   <button class="btn btn-info" type="submit" name="edit-button">Edit</button>
                                </form>
                                <form action="../server/delete-buyer-request.php" method="post">
                                    <input type="hidden" name="edit-id" value="<?php echo $row_details['request_id']; ?>">
                                    <button class="btn btn-danger delete-button" type="submit" name="delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer m-0 text-muted" align="center">Uploaded: <?php echo $row_details['upload_date']; ?></div>
        </div>
      <?php }
    }
}
?>

<!--stats-->
<?php
//Products uploaded in the last 7 days
$query1 = "SELECT * FROM product WHERE (DATEDIFF(CURDATE(), upload_date)) <= 7";
$execute1 = mysqli_query($connection, $query1);
$rows1 = mysqli_num_rows($execute1);

//Total uploaded products
$query2 = "SELECT * FROM product";
$execute2 = mysqli_query($connection, $query2);
$rows2 = mysqli_num_rows($execute2);

//Leading product category
function leadingCategory(){
    include '../DB-config/db-config.php';
    $query3 = "SELECT product_category FROM product WHERE product_category = 'Fruits'";
    $query4 = "SELECT product_category FROM product WHERE product_category = 'Vegetables'";
    $query5 = "SELECT product_category FROM product WHERE product_category = 'Poutry'";
    $query6 = "SELECT product_category FROM product WHERE product_category = 'Cattle'";
    $query7 = "SELECT product_category FROM product WHERE product_category = 'Cereals'";
    $query8 = "SELECT product_category FROM product WHERE product_category = 'Other'";
    $execute3 = mysqli_query($connection, $query3);
    $rows3 = mysqli_num_rows($execute3);
    $execute4 = mysqli_query($connection, $query4);
    $rows4 = mysqli_num_rows($execute4);
    $execute5 = mysqli_query($connection, $query5);
    $rows5 = mysqli_num_rows($execute5);
    $execute6 = mysqli_query($connection, $query6);
    $rows6 = mysqli_num_rows($execute6);
    $execute7 = mysqli_query($connection, $query7);
    $rows7 = mysqli_num_rows($execute7);
    $execute8 = mysqli_query($connection, $query8);
    $rows8 = mysqli_num_rows($execute8);

    $array = max(array($rows3, $rows4, $rows5, $rows6, $rows7, $rows8));

    if($array == $rows3){
        echo 'Fruits';
    }
    elseif($array == $rows4){
        echo 'Vegetables';
    }
    elseif($array == $rows5){
        echo 'Poutry';
    }
    elseif($array == $rows6){
        echo 'Cattle';
    }
    elseif($array == $rows7){
        echo 'Cereals';
    }
    else{
        echo 'Others';
    }
}

//Total requested products
$SELECTReq = "SELECT * FROM buyer_request";
$executeReq = mysqli_query($connection, $SELECTReq);
$rowsReq = mysqli_num_rows($executeReq);

//Guest user population
$query9 = "SELECT * FROM view_behaviour WHERE user_location IS NULL";
$execute9 = mysqli_query($connection, $query9);
$rows9 = mysqli_num_rows($execute9);

$query10 = "SELECT * FROM farmer_signup";
$execute10 = mysqli_query($connection, $query10);
$rows10 = mysqli_num_rows($execute10);

$querybb = "SELECT * FROM buyer_signup";
$executebb = mysqli_query($connection, $querybb);
$rowsbb = mysqli_num_rows($executebb);

$pop = round($rows9/($rows10+$rowsbb+$rows9)*100, 2, PHP_ROUND_HALF_UP);

//Registered User population
$pop2 = (100-$pop);

//New registered users
$query11 ="SELECT * FROM farmer_signup WHERE (DATEDIFF(CURDATE(), signup_date)) <= 30";
$execute11 = mysqli_query($connection, $query11);
$rows11 = mysqli_num_rows($execute11);
$querybb2 = "SELECT * FROM buyer_signup WHERE (DATEDIFF(CURDATE(), signup_date)) <= 30";
$executebb2 = mysqli_query($connection, $querybb2);
$rowsbb2 = mysqli_num_rows($executebb2);

$rows11 = ($rows11+$rowsbb2);

//Products of minimum price tag of Ksh.1000
$query12 = "SELECT * FROM product WHERE product_price >= 1000";
$execute12 = mysqli_query($connection, $query12);
$rows12 = mysqli_num_rows($execute12);
?>
    <div class="stats">
        <div class="column text-center products-added"><span>Products Uploaded in the last 7 days</span><br><p><?php echo $rows1; ?></p></div>
        <div class="column text-center total-uploaded-products"><span>Total Uploaded Products</span><br><p><?php echo $rows2; ?></p></div>
        <div class="column text-center leading-product-category"><span>Leading Product Category</span><br><p><?php leadingCategory(); ?></p></div>
        <div class="column text-center total-requests"><span>Total Requested Products</span><br><p><?php echo $rowsReq; ?></p></div>
        <div class="column text-center guest-user-population"><span>Guest Users Population</span><br><p><?php echo $pop.'%'; ?></p></div>
        <div class="column text-center registered-user-population"><span>Registered Users Population</span><br><p><?php echo $pop2.'%'; ?></p></div>
        <div class="column text-center new-registered-customers"><span>New Registered Users</span><br><p><?php echo $rows11; ?></p></div>
        <div class="column text-center products-prices-over-1k"><span>Total Products with Minimum Price tags of Ksh. 1000</span><br><p><?php echo $rows12; ?></p></div>
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