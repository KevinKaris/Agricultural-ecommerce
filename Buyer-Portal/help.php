<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../images/logo-removebg.png">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<?php 
$title = 'Help';
include_once '../includes/preloader.html';
include_once('../includes/buyer-header.php'); ?>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&family=Poppins:wght@500&display=swap');
        #content{
            background: white;
            margin-top: 5.5vw !important;
            padding: 0;
        }
        #content .title{
            background: rgb(12, 118, 84);
            color: white;
            font-size: 1.5vw;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            width: 100%;
            padding: .4vw;
        }
        #price .note{
            padding: 1vw;
            /*background: linear-gradient(to bottom, rgb(65, 165, 253), rgb(40, 146, 239), rgb(18, 119, 208), rgb(7, 97, 175));*/
            font-size: 1.1vw;
            font-family: 'Poppins', sans-serif;
        }
        .video-part{
            width: 100%;
            height: auto;
            overflow: hidden;
        }
        .video-part #video1{
            margin-top: 4%;
            margin-bottom: 3vw;
            width: 70%;
            height: auto;
        }
        .video-part .play{
            position: absolute;
            color: white;
            border-radius: 50%;
            border: 4px solid white;
            width: 4vw;
            height: 4vw;
            background: lightseagreen;
            top: 52%;
            left: 50%;
            transform: translate(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            cursor: pointer;
            font-size: 1.2vw;
        }
        .video-part .play:hover{
            opacity: .8;
        }
        @media only screen and (max-width: 900px){
            #content .title{
                margin-top: 4%;
                font-size: 4vw;
            }
            #price .note{
                font-size: 3vw;
            }
            .video-part #video1{
                width: 90%;
            }
            .video-part .play{
                font-size: 3vw;
                width: 8vw;
                height: 8vw;
                top: 55%;
            }
        }
        @media only screen and (max-width: 500px){
            #content .title{
                margin-top: 6vw;
            }
            .video-part #video1{
                width: 95%!important;
            }
        }
    </style>
    <div id="content">
        <div class="title" align="center">Help</div>
        <div class="row m-3" id="price">
            <div class="note col-md-12">
            Below is video showing how to post a product request. For more help contact us...
        </div>
        <div class="video-part" align="center">
                <video id="video1" src="../images/requesting product_Trim.mp4" controls poster="../images/requesting a product.jpg"></video>
                <div class="play"><i class="fa-solid fa-play"></i></div>
            </div>
        </div>
    </div>
    <script>
        //playing video
        $(document).ready(function(){
            $('video').removeAttr('controls');
            
            $('.play').click(function(){
                $('video').trigger('play');
                $('video').attr('controls', '');
                $('.play').hide();
            });
            setInterval(function() {
                if($('video').get(0).paused){
                    $('.play').show();
                    $('video').removeAttr('controls');
                }
                else{
                    $('.play').hide();
                    $('video').attr('controls', '');
                }
            }, 50);
        });

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
include_once('../includes/footer.html');
?>
</html>