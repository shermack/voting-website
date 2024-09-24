<?php
// vote_handler.php

// Example POST data from form submission
$phone_number = $_POST['phone_number'];
$votes = $_POST['votes'];
$amount = $votes * 20; // Assuming 20 shillings per vote

// Call stk_push.php to initiate the payment
$response = file_get_contents('stk_push.php?phone_number=' . urlencode($phone_number) . '&amount=' . urlencode($amount));

// Process response
echo $response;
?>