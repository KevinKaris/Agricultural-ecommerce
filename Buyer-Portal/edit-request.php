<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php
$title = 'Edit';
include_once '../includes/preloader.html';
include_once '../includes/buyer-header.php';
?>
<body>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');
        #Post-title{
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
            height: auto;
            background: rgb(237, 236, 236);
            border: 4px ridge rgb(12, 118, 84);
            box-sizing: border-box;
            padding: 5px;
            margin-left: 20%;
            border-radius: 5px;
        }
        #container form img{
            width: 100%;
            height: 30vw;
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
        .preview {
            max-height: auto;
            width: 100%;
            overflow-y: hidden;
            overflow-x: auto;
            white-space: nowrap;
        }

        .preview img {
            max-width: 10vmin;
            height: auto;
            margin-right: 5px;
        }
        @media only screen and (max-width: 900px){
            #Post-title{
                margin-top: 6%;
                font-size: 4vw;
            }
            #container form{
                width: 95%;
                margin-left: 5%;
            }
            #container form img{
                height: 55vw;
            }
        }
        @media only screen and (max-width: 500px){
            #Post-title{
                margin-top: 10vw;
            }
        }
    </style>
    <div id="content">
        <div id="Post-title" align="center">Edit Request</div>
        <div id="container" class="py-4 container1">
        <?php
if (isset($_GET['edit-button'])) {
    $edit_id = $_GET['edit-id'];

    $query = "SELECT * FROM buyer_request WHERE request_id = $edit_id";
    $execute = mysqli_query($connection, $query);

    foreach ($execute as $product_details) {
        $image_string = $product_details['product_image'];
        $string_to_array = explode(",", $image_string);
         ?>
                
                <form action="../server/edit-buyer-request.php" method="post" enctype="multipart/form-data">
                    <img src="<?php echo'../'. $string_to_array[0] ?>" alt="<?php echo'../'. $string_to_array[0] ?>">
                    <input type="hidden" name="edit-id" value="<?php echo $edit_id; ?>">
                <div class="form-control">
                    <label for="product-title">Enter Product Title</label>
                    <input type="text" class="form-control" name="product-title" placeholder="e.g oranges..." value="<?php echo $product_details['product_title']; ?>">
                </div>
                <div class="form-control">
                    <label for="stock-needed">Stock/Quantity needed</label>
                    <input type="text" class="form-control" name="stock-needed" placeholder="stock-needed...e.g 300 KGS" value="<?php echo $product_details['stock_needed']; ?>">
                </div>
                <div class="form-control">
                    <label for="product-image">Product Image Sample</label>
                    <input type="file" accept="image/*" class="form-control product-image" name="product-image" value="<?php echo $product_details['product_image']; ?>" multiple onchange="preview();">
                    <div class="preview"></div>
                </div>
                <div class="form-control">
                    <label for="product-description">Product Description</label>
                    <textarea name="product-description" class="form-control" cols="30" rows="7" placeholder="Describe more about the product you want. You may include price you want to buy at..."><?php echo $product_details['product_description'] ?></textarea>
                </div>
                <div class="form-control">
                    <label for="preferred-location">Product Preferred Location (optional)</label>
                    <input type="text" class="form-control" name="preferred-location" placeholder="Enter Product preferred location..." value="<?php echo $product_details['preferred_location']; ?>">
                </div>
                <button class="btn btn-outline-success form-control" type="submit" id="update-button" name="update-button">Update</button><br>
                </form>
                <?php
    }
}?>
        </div>
    </div>
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

//product image review
function preview() {
            var preview = $('.product-image').get(0).files.length;
            for (var i = 0; i < preview; i++) {
                $('.preview').append("<img src = '" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        }
    </script>
    <script src="../main.js"></script>
</body>
<?php
include '../includes/footer.html';
?>
</html>