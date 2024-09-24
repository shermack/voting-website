<?php
// stk_push.php
require 'vendor/autoload.php'; // Assuming you're using Composer

use GuzzleHttp\Client;

$consumer_key = 'VeC0bIuLO296ATDGV5GATsI37fMSFwwDL6yIX98BLeX3TlFp';
$consumer_secret = 'ZCr4QZsMdfC1Zu9z5INma07rraBknyWEVtAS5NufDpntVBG2q5dtHz4BahSF3McJ';
$shortcode = '600997';
$lipa_na_mpesa_online_shortcode = '600997';
$lipa_na_mpesa_online_key = 'YOUR_LIPA_NA_MPESA_ONLINE_KEY';
$phone_number = $_POST['254 725364442'];
$amount = $_POST['amount'];
$callback_url = 'https://yourdomain.com/php/callback.php';

$client = new Client();
$auth_response = $client->post('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
    'auth' => [$consumer_key, $consumer_secret]
]);

$auth_data = json_decode($auth_response->getBody(), true);
$access_token = $auth_data['access_token'];

$response = $client->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
    'headers' => [
        'Authorization' => 'Bearer ' . $access_token,
        'Content-Type' => 'application/json'
    ],
    'json' => [
        'BusinessShortCode' => $lipa_na_mpesa_online_shortcode,
        'Password' => base64_encode($lipa_na_mpesa_online_shortcode . $lipa_na_mpesa_online_key . date('YmdHis')),
        'Timestamp' => date('YmdHis'),
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone_number,
        'PartyB' => $lipa_na_mpesa_online_shortcode,
        'PhoneNumber' => $phone_number,
        'CallBackURL' => $callback_url,
        'AccountReference' => 'Vote',
        'TransactionDesc' => 'Payment for voting'
    ]
]);

echo $response->getBody();
?>