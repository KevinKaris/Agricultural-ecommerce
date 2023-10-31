<?php
include '../DB-config/db-config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if(!empty($_POST['email'])){
    $email = htmlentities($_POST['email']);

    $sql = "SELECT * FROM farmer_signup WHERE email = '$email'";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);

    if($rows <= 0){
        echo '<h4>No such email!</h4>';
    }
    else{
        $fetch = mysqli_fetch_assoc($run);
        $name = $fetch['first_name'].' '.$fetch['last_name'];
        $email = $fetch['email'];
        $id = $fetch['id'];
        $encode_id = base64_encode($id);

        $email_body = '<html>
        <h4>Password Reset<br>Do not let anyone else access this email.</h4>
        <p>Dear '.$name.', to reset your login password, click the link below:<br></p>
        <a href="http://localhost/dlink/Auth/fresetpassword?id='.$encode_id.'">Reset password link<a/><br><br>
        <p>#Thank you for using our platform</p>
        <p><strong>&copy; 2023 direct-link</strong></p>
        </html>';

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kevinkarish983@gmail.com';
        $mail->Password = 'kbilbikzrzgyuroi';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('kevinkarish983@gmail.com', 'Direct-Link');
        $mail->addAddress($email);
        $mail->Subject = ("Direct-Link (Reset password)");
        $mail->Body = $email_body;
        $mail->send();

        if($mail->send()){
            echo '1';
        }
        else{
            echo '0';
        }
    }
}
