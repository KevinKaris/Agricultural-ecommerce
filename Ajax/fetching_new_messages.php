<?php
session_start();
include '../DB-config/db-config.php';
                    //checking new comments
                    $id = $_SESSION['id'];

                    $SELECT_COMMENT = "SELECT t.id, t.user_id, t.comment_date, t.page_url
                    from comments t
                    join (select page_url, min(id) as minid from comments group by page_url) x
                    on x.page_url = t.page_url and x.minid = t.id WHERE viewed = '0' ORDER BY comment_date DESC";

                    $comment_run = mysqli_query($connection, $SELECT_COMMENT);
                    $num_of_comments = mysqli_num_rows($comment_run);
                    if($num_of_comments > 0){
                        while($comment_details = mysqli_fetch_array($comment_run)){
                            $product_url = $comment_details['page_url'];
                            $url2 = parse_url($product_url);
                            parse_str($url2['query'], $params);
                            $commented_product_id = $params['detail-id'];

                            //checking all products a farmer have
                            $fp = "SELECT * FROM product WHERE farmer_id = $id";
                            $fprun = mysqli_query($connection, $fp);
                            while($fpdetail = mysqli_fetch_assoc($fprun)){
                                $product_title = $fpdetail['product_title'];
                                if($commented_product_id == $fpdetail['product_id']){
                                    echo "<a href='product".$product_url."#comments' class='py-2 px-2'><span class='w-75' style='overflow: hidden;'><input type='hidden' id='id-holder' value=".$product_url.">".$product_title."</span> has comment(s)</a>";
                                }
                            }
                        }
                    }
                    else{
                        echo "<p class='py-0 px-2' style='font-size: 13px; color: black;'><span class='w-75' style='overflow: hidden;'>No new comments to your products</span></p>";
                    }