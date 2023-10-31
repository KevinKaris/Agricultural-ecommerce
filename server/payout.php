<?php
session_start();

if (isset($_POST['pay'])) {
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];
    $user_id = $_POST['user-id'];
    $account_no = ""; //acount in tinypesa
    $url = ""; //url

    $data = array(
        'amount' => $amount,
        'msisdn' => $phone,
        'account_no' => $account_no
    );

    $headers = array('Content-Type: application/x-www-form-urlencoded', 'ApiKey:');

    $info = http_build_query($data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $resp = curl_exec($curl);
    $msg_resp = json_decode($resp);
    if ($msg_resp->success == true) {
    //do something
    }
}
?>