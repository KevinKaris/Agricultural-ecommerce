<?php
include '../DB-config/db-config.php';
ini_set('display_errors', 0);

if (!empty($_POST['page_url']) && !empty($_POST['user_id']) && !empty($_POST['user_email'])) {
    $page_url = $connection->real_escape_string($_POST['page_url']);
    $user_id_initial = $connection->real_escape_string($_POST['user_id']);
    $user_email_initial = $connection->real_escape_string($_POST['user_email']);

    $SELECT = "SELECT id, user_id, user_email, parent_id, comment, UNIX_TIMESTAMP()-unix_timestamp(comment_date) FROM comments WHERE page_url LIKE '%$page_url' ORDER BY comment_date ASC";

    $sql = mysqli_query($connection, $SELECT);

    if ($sql) {
        function toFriendlyTime($seconds)
        {
            $measures = array(
                'year' => 12 * 4 * 7 * 24 * 60 * 60,
                'month' => 4 * 7 * 24 * 60 * 60,
                'week' => 7 * 24 * 60 * 60,
                'day' => 24 * 60 * 60,
                'hour' => 60 * 60,
                'minute' => 60,
            );
            foreach ($measures as $label => $amount) {
                if ($seconds >= $amount) {
                    $howMany = floor($seconds / $amount);
                    return $howMany . " " . $label . ($howMany > 1 ? "s ago" : " ago");
                }
            }
            return "now";
        }
        while ($details = mysqli_fetch_array($sql)) {
            $user_id = $details['user_id'];
            $user_email = $details['user_email'];
            $comment_id = $details['id'];

            //fetching the latest names of a user
            $SELECT2 = "SELECT * FROM ((SELECT first_name, last_name FROM farmer_signup WHERE id = '$user_id' AND email = '$user_email') UNION(SELECT first_name, last_name FROM buyer_signup WHERE id = '$user_id' AND email = '$user_email'))collection";

            $sql2 = mysqli_query($connection, $SELECT2);
            $result = mysqli_fetch_assoc($sql2);

            $first_name = $result['first_name'];
            $last_name = $result['last_name'];

            $time_posted = toFriendlyTime($details['UNIX_TIMESTAMP()-unix_timestamp(comment_date)']);

            if($user_id_initial == $user_id && $user_email_initial == $user_email){
                if($details['parent_id'] > 0){
                    //fetching the commented comment
                    $parent_id = $details['parent_id'];
                    $SELECT3 = "SELECT id, user_id, user_email, comment, UNIX_TIMESTAMP()-unix_timestamp(comment_date) FROM comments WHERE id='$parent_id' ORDER BY comment_date ASC";

                    $sql3 = mysqli_query($connection, $SELECT3);
                    $result2 = mysqli_fetch_assoc($sql3);
                    $user_id2 = $result2['user_id'];
                    $user_email2 = $result2['user_email'];

                    $SELECT4 = "SELECT * FROM ((SELECT first_name, last_name FROM farmer_signup WHERE id = '$user_id2' AND email = '$user_email2') UNION(SELECT first_name, last_name FROM buyer_signup WHERE id = '$user_id2' AND email = '$user_email2'))collection";

                    $sql4 = mysqli_query($connection, $SELECT4);
                    $result3 = mysqli_fetch_assoc($sql4);

                    $first_name2 = $result3['first_name'];
                    $last_name2 = $result3['last_name'];

                    echo '<div class="d-flex flex-row" style="margin-left: 30px;"><div id="names-Abbrev">'.mb_substr($first_name, 0, 1).mb_substr($last_name, 0, 1).'</div><div id="comment-message1"><i>' . $first_name . ' ' . $last_name."'s". ' <i style="font-weight:200!important;">reply to</i> '.$first_name2.' '.$last_name2."'s".' <i style="font-weight:200!important;">comment</i></i><br><div style="padding: 10px; background: #e7e7e7; border-radius:4px; border: 1px solid #cccccc;">'.$result2['comment'].'</div>' . $details['comment'] . '<span><div><a href="javascript:void()"><input type="hidden" value='.$comment_id.'>reply</a>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"><input type="hidden" value='.$comment_id.'></i></div>' . $time_posted . '</span></div></div>';
                }
                else{
                    echo '<div class="d-flex row"><div id="names-Abbrev">'.mb_substr($first_name, 0, 1).mb_substr($last_name, 0, 1).'</div><div id="comment-message1"><i>' . $first_name . ' ' . $last_name . '</i><br>' . $details['comment'] . '<span><div><a href="javascript:void()"><input type="hidden" value='.$comment_id.'>reply</a>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"><input type="hidden" value='.$comment_id.'></i></div>' . $time_posted . '</span></div><?div>';
                }
            }
            else{
                if($details['parent_id'] > 0){
                    //fetching the commented comment
                    $parent_id = $details['parent_id'];
                    $SELECT3 = "SELECT id, user_id, user_email, comment, UNIX_TIMESTAMP()-unix_timestamp(comment_date) FROM comments WHERE id='$parent_id' ORDER BY comment_date ASC";

                    $sql3 = mysqli_query($connection, $SELECT3);
                    $result2 = mysqli_fetch_assoc($sql3);
                    $user_id2 = $result2['user_id'];
                    $user_email2 = $result2['user_email'];

                    $SELECT4 = "SELECT * FROM ((SELECT first_name, last_name FROM farmer_signup WHERE id = '$user_id2' AND email = '$user_email2') UNION(SELECT first_name, last_name FROM buyer_signup WHERE id = '$user_id2' AND email = '$user_email2'))collection";

                    $sql4 = mysqli_query($connection, $SELECT4);
                    $result3 = mysqli_fetch_assoc($sql4);

                    $first_name2 = $result3['first_name'];
                    $last_name2 = $result3['last_name'];

                    echo '<div class="d-flex flex-row" style="margin-left: 30px;"><div id="names-Abbrev">'.mb_substr($first_name, 0, 1).mb_substr($last_name, 0, 1).'</div><div id="comment-message1"><i>' . $first_name . ' ' . $last_name."'s". ' <i style="font-weight:200!important;">reply to</i> '.$first_name2.' '.$last_name2."'s".' <i style="font-weight:200!important;">comment</i></i><br><div style="padding: 10px; background: #e7e7e7; border-radius:4px; border: 1px solid #cccccc;">'.$result2['comment'].'</div>' . $details['comment'] . '<span><div><a href="javascript:void()"><input type="hidden" value='.$comment_id.'>reply</a>&nbsp;&nbsp;&nbsp;</div>' . $time_posted . '</span></div></div>';
                }
                else{
                    echo '<div class="d-flex row"><div id="names-Abbrev">'.mb_substr($first_name, 0, 1).mb_substr($last_name, 0, 1).'</div><div id="comment-message1"><i>' . $first_name . ' ' . $last_name . '</i><br>' . $details['comment'] . '<span><div><a href="javascript:void()"><input type="hidden" value='.$comment_id.'>reply</a>&nbsp;&nbsp;&nbsp;<input type="hidden" value='.$comment_id.'></div>' . $time_posted . '</span></div></div>';
                }
            }
        }
    }
}

?>