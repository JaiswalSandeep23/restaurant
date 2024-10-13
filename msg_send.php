<?php
// Your WhatsApp API token
$access_token = 'EAAMC6Xv5EroBOxAeB3b7Xh6UQ1Je0ZCHrhZAZCTIqsOzk5Tq4p9rCGzXgtUIyxZC8DKg0lR0Q2MZAkP4F1adnTIVcVHa3Y6DtZBwFZAeQ2HUwZBu90nhhuJJk9oY7ilu6qROOmHHLwMSVl6lfK4mBCNfKLuk6TkxIqZA2DPArAFqJol8kdUlhVtbE9ABJrf8OiYGDMv5BtxDIYws0ioUmjB28u1yQ6rsZD';

// WhatsApp Phone Number ID
$phone_number_id = '426002267270625';

// Recipient's WhatsApp number in international format (replace with the actual phone number)
$recipient_phone_number = '919974078451';

// WhatsApp API URL
$url = "https://graph.facebook.com/v20.0/{$phone_number_id}/messages";

// Prepare the message data
$data = [
    "messaging_product" => "whatsapp",
    "to" => $recipient_phone_number,
    "type" => "template",
    "template" => [
        "name" => "hello_world", // Correct template name without dot
        "language" => [
            "code" => "en_US"
        ]
    ]
];

// Convert the data to JSON
$payload = json_encode($data);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token",
    "Content-Type: application/json"
]);

// Execute cURL request and capture response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Output response (for debugging purposes)
    echo $response;
}

// Close cURL session
curl_close($ch);
?>
